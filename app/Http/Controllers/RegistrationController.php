<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Reunion;
use App\Reunion_dl;
use App\State;
use App\Mail\Registration_Admin;
use App\Mail\Registration_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RegistrationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$reunions = \App\Reunion::orderby('reunion_year', 'desc')->get();

        return view('admin.registrations.index', compact('reunions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Reunion $reunion)
    {
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$states = State::all();
		
        return view('admin.registrations.create', compact('reunion', 'members', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// dd($request);
		
		if(!Auth::check()) {
			$this->validate($request, [
				'firstname' => 'required|max:50',
				'lastname' => 'required|max:50',
				'address' => 'required|max:100',
				'city' => 'required|max:100',
				'zip' => 'required|max:9999|min:0',
				'email' => 'email',
				'phone1' => 'max:999|min:0',
				'phone2' => 'max:999|min:0',
				'phone3' => 'max:9999|min:0',
			]);
		
			$registration = new Registration();
			$registration->reunion_id = $request->reunion_id;
			$registration->address = $request->address;
			$registration->city = $request->city;
			$registration->state = $request->state;
			$registration->zip = $request->zip;
			$registration->email = $request->email;
			$registration->phone = $request->phone1 . $request->phone2 . $request->phone3;
			$registration->phone = $registration->phone != '' ? $registration->phone : null;
			$registration->registree_name = $request->firstname . ' ' . $request->lastname;
			$registration->reg_date = Carbon::now();
			$registration->shirt_sizes = isset($request->shirt_sizes) ? join('; ', $request->shirt_sizes) : null;
			
			// If the adult name isn't entered then use the
			// registree's first name
			if($request->attending_adult < 1) {
				$registration->adult_names = $registration->firstname;
			} else {
				$registration->adult_names = isset($request->attending_adult_name) ? join('; ', $request->attending_adult_name) : null;
			}
			
			$registration->youth_names = isset($request->attending_youth_name) ? join('; ', $request->attending_youth_name) : null;
			$registration->children_names = isset($request->attending_children_name) ? join('; ', $request->attending_children_name) : null;
			$registration->total_amount_due = $registration->due_at_reg = $request->total_amount_due;
			
			if($registration->save()) {
				\Mail::to($registration->email)->send(new Registration_Admin($registration, $registration->reunion, $request->attending_adult, $request->attending_youth, $request->attending_children));
				\Mail::to('lorenzodevonj@yahoo.com')->send(new Registration_User($registration, $registration->reunion, $request->attending_adult, $request->attending_youth, $request->attending_children));
				
				return redirect()->back()->with('status', 'Registration Completed Successfully');
			}
			
		} else {
			$registration = new Registration();
			$reunion = Reunion::find($request->reunion_id);
			$member = Reunion_dl::find($request->reg_member);
			$totalPrice = $reunion->adult_price;
			$adults = $member->firstname;
			$youth = '';
			$children = '';
			
			// Get household members if exist
			if($member->family_id != null) {
				$registration->family_id = $member->family_id;
				
				$family_members = Reunion_dl::where([
					['family_id', $member->family_id],
					['family_id', '<>', 'null']
				])->get();
				
				foreach($family_members as $family_member) {
					if($family_member->id != $member->id) {
						if($family_member->age_group == 'adult') {
							$adults .= '; ' . $family_member->firstname;
							$totalPrice += $reunion->adult_price;
						} elseif($family_member->age_group == 'youth') {
							$youth .= '; ' . $family_member->firstname;
							$totalPrice = $reunion->youth_price;
						} elseif($family_member->age_group == 'child') {
							$children .= '; ' . $family_member->firstname;
							$totalPrice = $reunion->child_price;
						}
					}
				}
			}
			
			$registration->dl_id = $member->id;
			$registration->reunion_id = $reunion->id;
			$registration->registree_name = $member->firstname . ' ' . $member->lastname;
			$registration->total_amount_due = $registration->due_at_reg = $totalPrice;
			$registration->reg_date = Carbon::now();
			$registration->adult_names = $adults;
			$registration->youth_names = $youth == '' ? null : $youth;
			$registration->children_names = $children == '' ? null : $children;
			
			if($registration->save()) {
				return redirect()->action('RegistrationController@edit', $registration)->with('status', 'Registration Added Successfully');
			}
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
// dd('Test');
		$reunion = Reunion::find($id);
        $registrations = Registration::where('reunion_id', $reunion->id)->get();
		return view('admin.registrations.show', compact('registrations', 'reunion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
		$all_members = Reunion_dl::orderby('firstname', 'asc')->get();
		$states = State::all();
		$family = Reunion_dl::where([
			['family_id', $registration->family_id],
			['family_id', '<>', null]
		])->get();
		
		// Get all the shirt sizes
		$shirtSizes = explode('; ', $registration->shirt_sizes);

		// Get the count of each age group
		$adults = $registration->adult_names != null || $registration->adult_names != '' ? explode('; ', $registration->adult_names) : null;
		$youths = $registration->youth_names != null || $registration->youth_names != '' ? explode('; ', $registration->youth_names) : null;
		$childs = $registration->children_names != null || $registration->children_names != '' ? explode('; ', $registration->children_names) : null;
		
		// Get the sizes of the shirts in reference to the amount
		// of each age group
		$adultSizes = array_slice($shirtSizes, 0, count($adults));
		$youthSizes = array_slice($shirtSizes, count($adults), count($youths));
		$childrenSizes = array_slice($shirtSizes, (count($adults) + count($youths)));

		return view('admin.registrations.edit', compact('registration', 'states', 'family', 'adultSizes', 'youthSizes', 'childrenSizes', 'adults', 'youths', 'childs', 'all_members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
		// dd($registration);
		$registration->total_amount_due = $request->total_amount_due;
		$registration->total_amount_paid = $request->total_amount_paid;
		$registration->due_at_reg = $request->due_at_reg;
		$registration->shirt_sizes = implode('; ', $request->shirt_sizes);
		$registration->reg_notes = $request->reg_notes;

		if($request->registree != $registration->dl_id) {
			$member = Reunion_dl::find($request->registree);
			$registration->registree_name = $member->firstname . ' ' . $member->lastname;
			$registration->dl_id = $member->id;
		}
		
		if($registration->save()) {
			return redirect()->action('RegistrationController@edit', $registration)->with('status', 'Registration Updated Successfully');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        if($registration->delete()) {
			return redirect()->back()->with('status', 'Registration Deleted Successfully');
		}
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function add_registration_member(Request $request, Registration $registration)
    {
		dd($request);
		$this->validate($request, [
			'firstname' => 'required|max:50',
			'lastname' => 'required|max:50',
		]);
		
		// Get all the shirt sizes
		$shirtSizes = explode('; ', $registration->shirt_sizes);
		
		// Get the count of the adults and youths age group
		// And get the sizes of the shirts in reference to
		// the amount of each age group
		$adults = $registration->adult_names != null || $registration->adult_names != '' ? explode('; ', $registration->adult_names) : null;
		$adultSizes = array_slice($shirtSizes, 0, count($adults));
		$youths = $registration->youth_names != null || $registration->youth_names != '' ? explode('; ', $registration->youth_names) : null;
		$youthSizes = array_slice($shirtSizes, count($adults), count($youths));
		$childs = $registration->children_names != null || $registration->children_names != '' ? explode('; ', $registration->children_names) : null;
		$childrenSizes = array_slice($shirtSizes, (count($adults) + count($youths)));
		
		// Add user to appropriate age group and their shirt size
        if($request->age_group == 'adult') {
			if(count(explode('; ', $registration->adult_names)) > 1) {
				$registration->adult_names .= '; ' . $request->firstname;
				array_push($adultSizes, $request->shirt_size);
			} else {
				if($adults != null) {
					$registration->adult_names .= '; ' . $request->firstname;
					array_push($adultSizes, $request->shirt_size);
				} else {
					$registration->adult_names = $request->firstname;
					array_unshift($adultSizes, $request->shirt_size);
				}
			}
			
			$registration->shirt_sizes = implode('; ', array_merge($adultSizes, $youthSizes, $childrenSizes));
		} elseif($request->age_group == 'youth') {
			if(count(explode('; ', $registration->youth_names)) > 1) {
				$registration->youth_names .= '; ' . $request->firstname;
				array_push($youthSizes, $request->shirt_size);
			} else {
				if($registration->youth_names != null || $registration->youth_names != '') {
					$registration->youth_names .= '; ' . $request->firstname;
					array_push($youthSizes, $request->shirt_size);
				} else {
					$registration->youth_names = $request->firstname;
					array_unshift($youthSizes, $request->shirt_size);
				}
			}
			
			$registration->shirt_sizes = implode('; ', array_merge($adultSizes, $youthSizes, $childrenSizes));
		} elseif($request->age_group == 'child') {
			$registration->shirt_sizes .= '; ' . $request->shirt_size;
			
			if(count(explode('; ', $registration->children_names)) > 1) {
				$registration->children_names .= '; ' . $request->firstname;
			} else {
				if($registration->children_names != null || $registration->children_names != '') {
					$registration->children_names .= '; ' . $request->firstname;
				} else {
					$registration->children_names = $request->firstname;
				}
			}
		}
		
		// Adjust registration price to reflect the amount of 
		// people in the registration
		$adultCost = $adults != null ? $registration->reunion->adult_price * count($adults) : 0;
		$youthCost = $youths != null ? $registration->reunion->youth_price * count($youths) : 0;
		$childrenCost = $childs != null ? $registration->reunion->child_price * count($childs) : 0;
		$registration->due_at_reg = $adultCost + $youthCost + $childrenCost;
		$registration->total_amount_due = $registration->due_at_reg - $registration->total_amount_paid;
		
		// Add user to member distribution list
		$member = new Reunion_dl();
		$member->firstname = $request->firstname;
		$member->lastname = $request->lastname;
		$member->age_group = $request->age_group;
		$maxFamilyID = Reunion_dl::max('family_id');
		
		// If household members isn't empty then add a family ID
		// to all the parties
		if($registration->reunion_dl->family_id == null) {
			$newFamilyID = $maxFamilyID + 1;
			$member->family_id = $newFamilyID;
			$registration->reunion_dl->family_id = $newFamilyID;
			
			if($registration->reunion_dl->save()) {}
		} else {
			$member->family_id = $registration->reunion_dl->family_id;
		}
		
		// If registered member is in distribution list then add their home information
		// Else if are not added to distribution list add their home info from registration
		if($registration->reunion_dl) {
			$member->email = $registration->reunion_dl->email;
			$member->address = $registration->reunion_dl->address;
			$member->city = $registration->reunion_dl->city;
			$member->state = $registration->reunion_dl->state;
			$member->zip = $registration->reunion_dl->zip;
			$member->phone = $registration->reunion_dl->phone;
		} else {
			$member->email = $registration->email;
			$member->address = $registration->address;
			$member->city = $registration->city;
			$member->state = $registration->state;
			$member->zip = $registration->zip;
			$member->phone = $registration->phone;
		}
		
		if($registration->save()) {
			if($member->save()) {
				return redirect()->back()->with('status', 'New Member Added to Registration Successfully');
			}
		}
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function remove_ind_member($registration, $remove_ind_member)
    {
		$registration = Registration::find($registration);
		$adults = explode('; ', $registration->adult_names);
		$youths = explode('; ', $registration->youth_names);
		$childs = explode('; ', $registration->children_names);
		$shirtSizes = explode('; ', $registration->shirt_sizes);
		$adultSizes = array_slice($shirtSizes, 0, count($adults));
		$youthSizes = array_slice($shirtSizes, count($adults), count($youths));
		$childrenSizes = array_slice($shirtSizes, (count($adults) + count($youths)));
		$removeIndex = 0;
		$all_members = Reunion_dl::orderby('firstname', 'asc')->get();
		$states = State::all();
		$family = Reunion_dl::where([
			['family_id', $registration->family_id],
			['family_id', '<>', null]
		])->get();

		if(substr_count($remove_ind_member, 'adult') > 0) {
			$removeIndex = (int)(str_ireplace('adult', '', $remove_ind_member) - 1);
			
			unset($adults[$removeIndex]);
			unset($adultSizes[$removeIndex]);

			$registration->adult_names = implode('; ', $adults);
		} elseif(substr_count($remove_ind_member, 'youth') > 0) {
			$removeIndex = (int)(str_ireplace('youth', '', $remove_ind_member) - 1);
			
			unset($youths[$removeIndex]);
			unset($youthSizes[$removeIndex]);

			$registration->youth_names = implode('; ', $youths);
		} elseif(substr_count($remove_ind_member, 'child') > 0) {
			$removeIndex = (int)(str_ireplace('child', '', $remove_ind_member) - 1);
			
			unset($childs[$removeIndex]);
			unset($childrenSizes[$removeIndex]);

			$registration->children_names = implode('; ', $childs);
		}
		
		// Adjust registration price to reflect the amount of 
		// people in the registration
		$adultCost = $adults != null ? $registration->reunion->adult_price * count($adults) : 0;
		$youthCost = $youths != null ? $registration->reunion->youth_price * count($youths) : 0;
		$childrenCost = $childs != null ? $registration->reunion->child_price * count($childs) : 0;
		$registration->due_at_reg = $adultCost + $youthCost + $childrenCost;
		$registration->total_amount_due = $registration->due_at_reg - $registration->total_amount_paid;
		
		$registration->shirt_sizes = implode('; ', array_merge($adultSizes, $youthSizes, $childrenSizes));

		if($registration->save()) {
			return view('admin.registrations.edit', compact('registration', 'states', 'family', 'adultSizes', 'youthSizes', 'childrenSizes', 'adults', 'youths', 'childs', 'all_members'))->with('status', 'Member removed from registration successful');
		}
	}
}

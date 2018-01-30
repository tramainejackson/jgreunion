<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Reunion;
use App\Reunion_dl;
use App\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
dd('Test');
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
		$states = State::all();
		$family = Reunion_dl::where('family_id', $registration->reunion_dl->family_id)->get();
		
		// Get all the shirt sizes
		$shirtSizes = explode('; ', $registration->shirt_sizes);

		// Get the count of each age group
		$adultCount = count(explode('; ', $registration->adult_names));
		$youthCount = count(explode('; ', $registration->youth_names));
		$childCount = count(explode('; ', $registration->child_names));
		
		// Get the sizes of the shirts in reference to the amount
		// of each age group
		$adultSizes = array_slice($shirtSizes, 0, $adultCount);
		$youthSizes = array_slice($shirtSizes, $adultCount, $youthCount);
		$childrenSizes = array_slice($shirtSizes, ($adultCount + $youthCount));

		return view('admin.registrations.edit', compact('registration', 'states', 'family', 'adultSizes', 'youthSizes', 'childrenSizes'));
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
    public function destroy(registration $registration)
    {
        //
    }
}

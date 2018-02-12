<?php

namespace App\Http\Controllers;

use App\Reunion_dl;
use App\Registration;
use App\Reunion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
		$userPost = $user->post;
		$rows = $user->post->count();
		$userPhone1 = substr($user["phone"], 0, 3);
		$userPhone2 = substr($user["phone"], 3, 3);
		$userPhone3 = substr($user["phone"], 6, 4);
		$newReunionCheck = \App\Reunion::where('reunion_complete', 'N')->get()->last();
		$states = \App\State::all();

        return view('home', compact('user', 'userPhone1', 'rows', 'userPhone1', 'userPhone2', 'userPhone3', 'newReunionCheck', 'states'));
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function distribution_list()
    {
		$user = Auth::user();
		$userPost = $user->post;
		$rows = $user->post->count();
		$userPhone1 = substr($user["phone"], 0, 3);
		$userPhone2 = substr($user["phone"], 3, 3);
		$userPhone3 = substr($user["phone"], 6, 4);
		$newReunionCheck = \App\Reunion::where('reunion_complete', 'N')->get();
		$states = \App\State::all();

        return view('home', compact('user', 'userPhone1', 'rows', 'userPhone1', 'userPhone2', 'userPhone3', 'newReunionCheck', 'states'));
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$states = \App\State::all();
		$descent_options = \App\Descent_option::all();

        return view('admin.members.create', compact('states', 'descent_options'));
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'firstname' => 'required|max:30',
			'lastname' => 'required|max:30',
			'phone' => 'nullable|numeric',
			'zip' => 'nullable|max:99999|min:0',
		]);
			
		$member = new Reunion_dl();
		$member->firstname = $request->firstname;
		$member->lastname = $request->lastname;
		$member->email = $request->email;
		$member->address = $request->address;
		$member->city = $request->city;
		$member->state = $request->state;
		$member->zip = $request->zip;
		$member->phone = $request->phone;
		$member->age_group = $request->age_group;
		$member->mail_preference = $request->mail_preference;

		if($member->save()) {
			if(isset($request->reunion_id)) {
				$reunion = Reunion::find($request->reunion_id);
				
				$registration = new Registration();
				$totalPrice = $reunion->adult_price;
				$registration->dl_id = $member->id;
				$registration->reunion_id = $reunion->id;
				$registration->registree_name = $member->firstname . ' ' . $member->lastname;
				$registration->total_amount_due = $registration->due_at_reg = $totalPrice;
				$registration->reg_date = Carbon::now();
				$registration->adult_names = $member->firstname;
				
				if($registration->save()) {
					return redirect()->action('HomeController@edit', $member)->with('status', 'Member and Registration Created Successfully');				
				}
			} else {
				return redirect()->action('HomeController@edit', $member)->with('status', 'Member Created Successfully');				
			}
		}	
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Reunion_dl $reunion_dl)
    {
		$states = \App\State::all();
		$member = $reunion_dl;
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$siblings = explode('; ', $member->sibling);
		$children = explode('; ', $member->child);
		$family_members = Reunion_dl::where([
			['family_id', $member->family_id],
			['family_id', '<>', 'null']
		])->get();
		$potential_family_members = Reunion_dl::where([
			['address', $member->address],
			['city', $member->city],
			['state', $member->state]
		])->get();
		$active_reunion = Reunion::where('reunion_complete', 'N')->first();
		$registered_for_reunion = Registration::where('dl_id', $member->id)->get()->first();
        return view('admin.members.edit', compact('states', 'family_members', 'member', 'active_reunion', 'potential_family_members', 'members', 'siblings', 'children', 'registered_for_reunion'));
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reunion_dl $reunion_dl)
    {
		$this->validate($request, [
			'firstname' => 'required|max:30',
			'lastname' => 'required|max:30',
			'email' => 'nullable',
			'address' => 'nullable',
			'city' => 'nullable',
			'phone' => 'nullable|numeric',
			'zip' => 'nullable|max:99999|min:0|numeric',
		]);
		$member = $reunion_dl;
		$member->firstname = $request->firstname;
		$member->lastname = $request->lastname;
		$member->email = $request->email;
		$member->address = $request->address;
		$member->city = $request->city;
		$member->state = $request->state;
		$member->zip = $request->zip;
		$member->descent = $request->descent;
		$member->notes = $request->notes;
		$member->mother = $request->mother != 'blank' ? $request->mother : null;
		$member->father = $request->father != 'blank' ? $request->father : null;
		$member->spouse = $request->spouse != 'blank' ? $request->spouse : null;
		$member->sibling = str_ireplace('; blank', '', implode('; ', $request->siblings)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->siblings)) : null;
		$member->child = str_ireplace('; blank', '', implode('; ', $request->children)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->children)) : null;
		$houseMembers = str_ireplace('; blank', '', implode('; ', $request->houseMember)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->houseMember)) : null;
		$member->phone = $request->phone;
		$member->age_group = $request->age_group;
		$member->mail_preference = $request->mail_preference;
		// dd($member);
		
		// If household members isn't empty then add a family ID
		// to all the parties
		if($houseMembers != null) {
			$maxFamilyID = Reunion_dl::max('family_id');
			$hhMembers = explode('; ', $houseMembers);
			
			if($member->family_id == null) {
				$newFamilyID = $maxFamilyID + 1;
				$member->family_id = $newFamilyID;
				
				foreach($hhMembers as $hhID) {
					$hhMember = Reunion_dl::find($hhID);
					$hhMember->family_id = $newFamilyID;
					$hhMember->save();
				}
			} else {
				foreach($hhMembers as $hhID) {
					$hhMember = Reunion_dl::find($hhID);
					
					if($hhMember->family_id != $member->family_id) {
						$hhMember->family_id = $member->family_id;
						$hhMember->save();
					}
				}
			}
		}

		if($member->save()) {
			return redirect()->action('HomeController@edit', $member)->with('status', 'Member Updated Successfully');
		}		
    }

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_house_hold(Request $request) {
		$member = Reunion_dl::find($request->reunion_dl);
		$addingMember = Reunion_dl::find($request->houseMember);
		$maxFamilyID = Reunion_dl::max('family_id');

		// If household members isn't empty then add a family ID
		// to all the parties
		if($member->family_id == null) {
			$newFamilyID = $maxFamilyID + 1;
			$member->family_id = $newFamilyID;
			$addingMember->family_id = $newFamilyID;
			
			if($addingMember->save()) {
				$member->save();					
			}
		} else {
			$addingMember->family_id = $member->family_id;
			$addingMember->save();
		}
		
		$states = \App\State::all();
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$siblings = explode('; ', $member->sibling);
		$children = explode('; ', $member->child);
		$active_reunion = Reunion::where('reunion_complete', 'N')->first();

		$family_members = Reunion_dl::where([
			['family_id', $member->family_id],
			['family_id', '<>', 'null']
		])->get();

		$potential_family_members = Reunion_dl::where([
			['address', $member->address],
			['city', $member->city],
			['state', $member->state]
		])->get();

		$registered_for_reunion = Registration::where([
			['family_id', $member->family_id],
			['family_id', '<>', 'null']
		])
		->orwhere('dl_id', $member->id)
		->get();
			
		return view('admin.members.edit', compact('states', 'family_members', 'member', 'active_reunion', 'potential_family_members', 'members', 'siblings', 'children', 'registered_for_reunion'));
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove_house_hold(Request $request) {
		$member = Reunion_dl::find($request->reunion_dl);
		$removeHH = Reunion_dl::find($request->remove_hh);
		$familyID = $member->family_id;
		$familyMembers = Reunion_dl::where([
			['family_id', $familyID],
			['family_id', '<>', null]
		])->get();
		
		// If household members is equal to 2 then remove
		// family ID from both users
		if($familyMembers->count() <= 2) {
			$removeHH->family_id = $member->family_id = null;
			
			if($removeHH->save()) {
				if($member->save()) {}					
			}
		} else {
			$removeHH->family_id = null;
			$removeHH->save();
		}
		
		$states = \App\State::all();
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$siblings = explode('; ', $member->sibling);
		$children = explode('; ', $member->child);
		$family_members = Reunion_dl::where([
			['family_id', $member->family_id],
			['family_id', '<>', 'null']
		])->get();
		$potential_family_members = Reunion_dl::where([
			['address', $member->address],
			['city', $member->city],
			['state', $member->state]
		])->get();
		$active_reunion = Reunion::where('reunion_complete', 'N')->first();
		$registered_for_reunion = Registration::where([
				['family_id', $member->family_id],
				['family_id', '<>', 'null']
			])
			->orwhere('dl_id', $member->id)
			->get();
			
		return view('admin.members.edit', compact('states', 'family_members', 'member', 'active_reunion', 'potential_family_members', 'members', 'siblings', 'children', 'registered_for_reunion'));
	}
}

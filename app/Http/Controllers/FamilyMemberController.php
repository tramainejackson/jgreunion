<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilyMember;
use App\State;
use App\Registration;
use App\Reunion;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distribution_list = FamilyMember::orderby('lastname', 'asc')->orderby('address', 'asc')->get();
		$duplicates_check = FamilyMember::checkDuplicates();
		$duplicates = $duplicates_check->isNotEmpty() ? $duplicates_check : null;
		
		return view('admin.index', compact('registrations', 'distribution_list', 'duplicates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = \App\State::all();

        return view('admin.members.create', compact('states'));
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
			
		$member = new FamilyMember();
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
				$registration->family_member_id = $member->id;
				$registration->reunion_id = $reunion->id;
				$registration->registree_name = $member->firstname . ' ' . $member->lastname;
				$registration->total_amount_due = $registration->due_at_reg = $totalPrice;
				$registration->reg_date = Carbon::now();
				$registration->adult_names = $member->firstname;
				
				if($registration->save()) {
					return redirect()->action('RegistrationController@edit', $registration)->with('status', 'Member and Registration Created Successfully');				
				}
			} else {
				return redirect()->action('FamilyMemberController@edit', $member)->with('status', 'Member Created Successfully');				
			}
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyMember $member)
    {
		$family_member = $member;
        $states = State::all();
		$members = FamilyMember::orderby('firstname', 'asc')->get();
		$siblings = explode('; ', $family_member->siblings);
		$children = explode('; ', $family_member->children);
		$family_members = FamilyMember::household($family_member->family_id);
		$potential_family_members = FamilyMember::potentialHousehold($member);
		$active_reunion = Reunion::active()->first();
		$registered_for_reunion = Registration::memberRegistered($family_member->id)->first();
		
        return view('admin.members.edit', compact('states', 'family_members', 'family_member', 'active_reunion', 'potential_family_members', 'members', 'siblings', 'children', 'registered_for_reunion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyMember $member)
    {
		// dd($request);
        $this->validate($request, [
			'firstname' => 'required|max:30',
			'lastname' => 'required|max:30',
			'email' => 'nullable',
			'address' => 'nullable',
			'city' => 'nullable',
			'phone' => 'nullable|numeric',
			'zip' => 'nullable|max:99999|min:0|numeric',
		]);

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
		$member->siblings = str_ireplace('; blank', '', implode('; ', $request->siblings)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->siblings)) : null;
		$member->children = str_ireplace('; blank', '', implode('; ', $request->children)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->children)) : null;
		$houseMembers = str_ireplace('; blank', '', implode('; ', $request->houseMember)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->houseMember)) : null;
		$member->phone = $request->phone;
		$member->age_group = $request->age_group;
		$member->mail_preference = $request->mail_preference;
		
		// If household members isn't empty then add a family ID
		// to all the parties
		if($houseMembers != null) {
			$maxFamilyID = FamilyMember::max('family_id');
			$hhMembers = explode('; ', $houseMembers);
			
			if($member->family_id == null) {
				$newFamilyID = $maxFamilyID + 1;
				$member->family_id = $newFamilyID;
				
				foreach($hhMembers as $hhID) {
					$hhMember = FamilyMember::find($hhID);
					$hhMember->family_id = $newFamilyID;
					$hhMember->save();
				}
			} else {
				foreach($hhMembers as $hhID) {
					$hhMember = FamilyMember::find($hhID);
					
					if($hhMember->family_id != $member->family_id) {
						$hhMember->family_id = $member->family_id;
						$hhMember->save();
					}
				}
			}
		}

		if($member->save()) {
			return redirect()->back()->with('status', 'Member Updated Successfully');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyMember $member)
    {
        if($member->delete()) {
			
			return redirect()->action('FamilyMemberController@index')->with('status', 'Family member account deleted successfully');
			
		}
		
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function duplicates()
    {
		$duplicates_check = FamilyMember::checkDuplicates();
		$duplicates_check = $duplicates_check->isNotEmpty() ? $duplicates_check : null;
		$allMembers = FamilyMember::all();
		
		return view('admin.members.duplicates', compact('duplicates_check', 'allMembers'));

    }
	
	/**
     * Delete the duplicate account.
     *
     * @return \Illuminate\Http\Response
    */
    public function delete_duplicates(FamilyMember $member)
    {
		$duplicates = FamilyMember::getDuplicates($member->firstname, $member->lastname, $member->city, $member->state)->get();
		$usersInDupes = FamilyMember::getDuplicates($member->firstname, $member->lastname, $member->city, $member->state)->users()->get();
		$returnData = [];

		if($usersInDupes->count() >= 1) {
			
			$userAccount = $usersInDupes->first();
			
			if($userAccount->id !== $member->id) {
				if($member->user) {
					if($userAccount->user->email === null) {
						$userAccount->user->email = $member->user->email;
					}
				}

				// If the account being deleted has a registration
				// Change the registration to the account with a profile
				if($member->registrations->isNotEmpty()) {
					
					foreach($member->registrations as $dupeReg) {
						$dupeReg->family_member_id = $userAccount->id;
						
						if($dupeReg->save()) {}
					}
					
				}
				
				// Delete the member account
				if($member->delete()) {

					array_push($returnData, 'Removed Account',  $duplicates->count() - 1 == 1 ? 'Remove Card' : null);
					return $returnData;
					
				}
				
			}
			
		} else {

			// Get the parent account that any additional accounts
			// will be associated to
			$userAccount = $duplicates->first();
					
			// If the account being deleted has a registration
			// Change the registration to the account with a profile
			if($member->registrations->isNotEmpty()) {
				foreach($member->registrations as $dupeReg) {
					$dupeReg->family_member_id = $userAccount->id;
					
					if($dupeReg->save()) {}
				}
			}

			if($member->delete()) {

				array_push($returnData, 'Removed Account', $duplicates->count() - 1 == 1 ? 'Remove Card' : null);
				return $returnData;
				
			}
			
		}

    }
	
	/**
     * Keep the potential duplicate account.
     *
     * @return \Illuminate\Http\Response
    */
    public function keep_duplicate(FamilyMember $member)
    {
		$duplicates = FamilyMember::getDuplicates($member->firstname, $member->lastname, $member->city, $member->state)->get();
		$returnData = [];
		
		$member->duplicate = 'N';
		
		if($member->save()) {

			array_push($returnData, 'Account Saved', $duplicates->count() - 1 == 1 ? 'Remove Card' : null);
			return $returnData;
			
		}

    }
}

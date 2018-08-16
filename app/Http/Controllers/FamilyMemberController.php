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
		$siblings = explode('; ', $family_member->sibling);
		$children = explode('; ', $family_member->child);
		$family_members = FamilyMember::household($family_member->family_id);
		$potential_family_members = FamilyMember::potentialHousehold($member);
		$active_reunion = Reunion::active()->first();
		$registered_for_reunion = $active_reunion !== null ? Registration::memberRegistered($family_member->id, $active_reunion->id)->first() : null;

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
		$member->sibling = str_ireplace('; blank', '', implode('; ', $request->siblings)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->siblings)) : null;
		$member->child = str_ireplace('; blank', '', implode('; ', $request->children)) != 'blank' ? str_ireplace('; blank', '', implode('; ', $request->children)) : null;
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
		
		return view('admin.members.duplicates', compact('duplicates_check'));

    }
	
	/**
     * Delete the duplicate account.
     *
     * @return \Illuminate\Http\Response
    */
    public function delete_duplicates(FamilyMember $member)
    {
		$duplicates = FamilyMember::getDuplicates($member->firstname, $member->lastname, $member->city, $member->state)->get();
		$userAccount = $duplicates->first();
		$committee_member = $member->committees;
		$reunion_registrations = $member->registrations;
		$profile_post = $member->posts;

		$returnData = [];
		
		if($userAccount->user && $member->user) {
			if($userAccount->user->email === null) {
				$userAccount->user->email = $member->user->email;
			}
		} elseif(!$userAccount->user && $member->user) {
			$userAccount->user_id = $member->user->id;
		}

		$userAccount->family_id = $userAccount->family_id !== null ? $userAccount->family_id : $member->family_id;
		$userAccount->email = $userAccount->email !== null ? $userAccount->email : $member->email;
		$userAccount->address = $userAccount->address !== null ? $userAccount->address : $member->address;
		$userAccount->city = $userAccount->city !== null ? $userAccount->city : $member->city;
		$userAccount->state = $userAccount->state !== null ? $userAccount->state : $member->state;
		$userAccount->zip = $userAccount->zip !== null ? $userAccount->zip : $member->zip;
		$userAccount->phone = $userAccount->phone !== null ? $userAccount->phone : $member->phone;
		$userAccount->descent = $userAccount->descent !== null ? $userAccount->descent : $member->descent;
		$userAccount->mother = $userAccount->mother !== null ? $userAccount->mother : $member->mother;
		$userAccount->father = $userAccount->father !== null ? $userAccount->father : $member->father;
		$userAccount->spouse = $userAccount->spouse !== null ? $userAccount->spouse : $member->spouse;
		$userAccount->sibling = $userAccount->sibling !== null ? $userAccount->sibling : $member->sibling;
		$userAccount->child = $userAccount->child !== null ? $userAccount->child : $member->child;
		$userAccount->notes = $userAccount->notes !== null ? $userAccount->notes : $member->notes;
		$userAccount->age_group = $userAccount->age_group !== null ? $userAccount->age_group : $member->age_group;
		$userAccount->mail_preference = $userAccount->mail_preference !== null ? $userAccount->mail_preference : $member->mail_preference;
		$userAccount->instagram = $userAccount->instagram !== null ? $userAccount->instagram : $member->instagram;
		$userAccount->facebook = $userAccount->facebook !== null ? $userAccount->facebook : $member->facebook;
		$userAccount->twitter = $userAccount->twitter !== null ? $userAccount->twitter : $member->twitter;
		$userAccount->show_contact = $userAccount->show_contact !== null ? $userAccount->show_contact : $member->show_contact;
		$userAccount->show_socail = $userAccount->show_socail !== null ? $userAccount->show_socail : $member->show_socail;
		
		if($userAccount->save()) {}
		
		// If the account being deleted has a registration
		// Change the registration to the account with a profile
		if($member->registrations->isNotEmpty()) {
			
			foreach($member->registrations as $dupeReg) {
				// Check if there is a registration for 
				// the parent account already
				if(Registration::memberRegistered($userAccount->id, $dupeReg->reunion_id)->get()->isNotEmpty()) {
					$parentReg = Registration::memberRegistered($userAccount->id, $dupeReg->reunion_id)->first();
					
					$parentReg->youth_names = $parentReg->youth_names !== null ? $parentReg->youth_names : $dupeReg->youth_names;
					$parentReg->children_names = $parentReg->children_names !== null ? $parentReg->children_names : $dupeReg->children_names;
					$parentReg->adult_shirts = $parentReg->adult_shirts !== null ? $parentReg->adult_shirts : $dupeReg->adult_shirts;
					$parentReg->youth_shirts = $parentReg->youth_shirts !== null ? $parentReg->youth_shirts : $dupeReg->youth_shirts;
					$parentReg->children_shirts = $parentReg->children_shirts !== null ? $parentReg->children_shirts : $dupeReg->children_shirts;
					$parentReg->email = $parentReg->email !== null ? $parentReg->email : $dupeReg->email;
					$parentReg->address = $parentReg->address !== null ? $parentReg->address : $dupeReg->address;
					$parentReg->city = $parentReg->city !== null ? $parentReg->city : $dupeReg->city;
					$parentReg->city = $parentReg->city !== null ? $parentReg->city : $dupeReg->city;
					$parentReg->state = $parentReg->state !== null ? $parentReg->state : $dupeReg->state;
					$parentReg->zip = $parentReg->zip !== null ? $parentReg->zip : $dupeReg->zip;
					$parentReg->phone = $parentReg->phone !== null ? $parentReg->phone : $dupeReg->phone;
					$parentReg->due_at_reg = $parentReg->due_at_reg !== null ? $parentReg->due_at_reg : $dupeReg->due_at_reg;
					$parentReg->total_amount_due = $parentReg->total_amount_due !== null ? $parentReg->total_amount_due : $dupeReg->total_amount_due;
					$parentReg->total_amount_paid = $parentReg->total_amount_paid !== null ? $parentReg->total_amount_paid : $dupeReg->total_amount_paid;
					$parentReg->reg_notes = $parentReg->reg_notes !== null ? $parentReg->reg_notes : $dupeReg->reg_notes;
					$parentReg->parent_reg = $parentReg->parent_reg !== null ? $parentReg->parent_reg : $dupeReg->parent_reg;
					$parentReg->additional_tees = $parentReg->additional_tees !== null ? $parentReg->additional_tees : $dupeReg->additional_tees;
					$parentReg->addt_sizes = $parentReg->addt_sizes !== null ? $parentReg->addt_sizes : $dupeReg->addt_sizes;
					
					if($parentReg->save()) {
						
						if($dupeReg->delete()) {}
					}
					
				} else {
					
					$dupeReg->family_member_id = $userAccount->id;
					
					if($dupeReg->save()) {}
				}
				
			}
			
		}
		
		// If the account being deleted is a part of
		// a reunion committee. Update with parent account id
		if($member->committees->isNotEmpty()) {
			foreach($member->committees as $committee_member) {
				
				$committee_member->family_member_id = $userAccount->id;
					
				if($committee_member->save()) {}
					
			}
		}

		// Delete the member account
		if($member->delete()) {
			
			$duplicates_check = FamilyMember::checkDuplicates();
			$duplicates_check = $duplicates_check->isNotEmpty() ? $duplicates_check : null;

			array_push($returnData, 'Removed Account', view('admin.members.duplicates', compact('duplicates_check'))->render());

			return $returnData;
			
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

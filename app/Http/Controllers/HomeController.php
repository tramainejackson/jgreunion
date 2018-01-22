<?php

namespace App\Http\Controllers;

use App\Reunion_dl;
use App\Registration;
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
        $this->middleware('auth');
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
		$newReunionCheck = \App\Reunion::where('reunion_complete', 'N')->get();
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
			'phone1' => 'max:999|min:0',
			'phone2' => 'max:999|min:0',
			'phone3' => 'max:9999|min:0',
			'zip' => 'max:9999|min:0',
		]);
			
		$member = new Reunion_dl();
		$member->firstname = $request->firstname;
		$member->lastname = $request->lastname;
		$member->email = $request->email;
		$member->address = $request->address;
		$member->city = $request->city;
		$member->state = $request->state;
		$member->zip = $request->zip;
		$member->phone = $request->phone1 . $request->phone2 . $request->phone3;
		$member->age_group = $request->age_group;
		$member->mail_preference = $request->mail_preference;

		if($member->save()) {
			return redirect()->action('HomeController@edit', $member)->with('status', 'Member Created Successfully');
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
			['state', $member->state],
			['family_id', 'null']
		])->get();
		$active_reunion = \App\Reunion::where('reunion_complete', 'N')->first();

        return view('admin.members.edit', compact('states', 'family_members', 'member', 'active_reunion', 'potential_family_members', 'members', 'siblings', 'children'));
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
			'phone1' => 'max:999|min:0',
			'phone2' => 'max:999|min:0',
			'phone3' => 'max:9999|min:0',
			'zip' => 'max:9999|min:0',
		]);
			
		// dd($request);
		
		$member = $reunion_dl;
		$member->firstname = $request->firstname;
		$member->lastname = $request->lastname;
		$member->email = $request->email;
		$member->address = $request->address;
		$member->city = $request->city;
		$member->state = $request->state;
		$member->zip = $request->zip;
		$member->notes = $request->notes;
		$member->mother = $request->mother;
		$member->father = $request->father;
		$member->spouse = $request->spouse;
		$member->sibling = implode('; ', $request->siblings);
		$member->child = implode('; ', $request->children);
		$member->phone = $request->phone1 . $request->phone2 . $request->phone3;
		$member->age_group = $request->age_group;
		$member->mail_preference = $request->mail_preference;

		if($member->save()) {
			return redirect()->action('HomeController@edit', $member)->with('status', 'Member Updated Successfully');
		}		
    }
}

<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Reunion;
use App\Reunion_committee;
use App\Reunion_event;
use App\Reunion_dl;
use App\State;
use App\Year;
use Carbon\Carbon;
use App\Committee_Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ReunionController extends Controller
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
		$states = State::all();
		$years = Year::all();
		
        return view('admin.reunions.index', compact('reunions', 'states', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$states = State::all();
		$years = Year::all();
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$titles = Committee_Title::all();
		
        return view('admin.reunions.create', compact('states', 'years', 'members', 'titles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$reunion = new Reunion();
		$reunion->reunion_city = $request->reunion_city;
		$reunion->reunion_state = $request->reunion_state;
		$reunion->reunion_year = $request->reunion_year;
		$reunion->adult_price = $request->adult_price;
		$reunion->youth_price = $request->youth_price;
		$reunion->child_price = $request->child_price;
		
		if($reunion->save()) {
			for($x=0; $x < count($request->member_title); $x++) {
				// Create New Reunion Object
				$committee_member = new Reunion_committee();
				
				// Get member from distro list
				$member = Reunion_dl::find($request->dl_id[$x]);
				
				$committee_member->dl_id = $member->id;
				$committee_member->reunion_id = $reunion->id;
				$committee_member->member_name = $member->firstname . ' ' . $member->lastname;
				$committee_member->member_title = $request->member_title[$x];
				$committee_member->member_email = $member->email;
				$committee_member->member_phone = $member->phone;
				
				if($committee_member->save()) {
					
				}
			}
			
			return redirect()->action('ReunionController@edit', $reunion)->with('status', 'Reunion Created Succssfully');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reunion $reunion)
    {
		$states = State::all();
		$years = Year::all();
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$titles = Committee_Title::all();
		$reunion_events = $reunion->events()->orderBy('event_date')->get();
		
		return view('admin.reunions.edit', compact('reunion', 'reunion_events', 'states', 'years', 'members', 'titles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reunion $reunion)
    {
		// dd($request);
		$reunion->reunion_complete = $request->reunion_complete;
		$reunion->reunion_city = $request->reunion_city;
		$reunion->reunion_state = $request->reunion_state;
		$reunion->reunion_year = $request->reunion_year;
		$reunion->adult_price = $request->adult_price;
		$reunion->youth_price = $request->youth_price;
		$reunion->child_price = $request->child_price;
		
		if($request->hasFile('paper_reg_form')) {
			$path = $request->file('paper_reg_form')->store('public/reg_forms');
			$reunion->registration_form = $path;
		}
		
		if($reunion->save()) {
			// dd($request);
			if(isset($request->event_id)) {
				if(count($request->event_id) < count($request->event_date)) {
					foreach($reunion->events as $key => $event) {
						$eventDate = new Carbon($request->event_date[$key]);
						$event->event_location = $request->event_location[$key];
						$event->event_description = $request->event_description[$key];
						$event->event_date = $eventDate;

						$event->save();
					}
					
					for($x=count($request->event_id); $x < count($request->event_date); $x++) {
						// Create New Reunion Event Object
						$event = new Reunion_event();
					
						$eventDate = new Carbon($request->event_date[$x]);
						$event->reunion_id = $reunion->id;
						$event->event_location = $request->event_location[$x];
						$event->event_description = $request->event_description[$x];
						$event->event_date = $eventDate;
						
						if($event->save()) {
							
						}
					}
				} else {
					foreach($reunion->events as $key => $event) {
						$eventDate = new Carbon($request->event_date[$key]);
						$event->event_location = $request->event_location[$key];
						$event->event_description = $request->event_description[$key];
						$event->event_date = $eventDate;

						$event->save();
					}
				}
			} elseif(!isset($request->event_id) && isset($request->event_date)) {
				for($x=0; $x < count($request->event_date); $x++) {
					// Create New Reunion Event Object
					$event = new Reunion_event();

					$eventDate = new Carbon($request->event_date[$x]);
					$event->reunion_id = $reunion->id;
					$event->event_location = $request->event_location[$x];
					$event->event_description = $request->event_description[$x];
					$event->event_date = $eventDate->toDateString();
					
					if($event->save()) {}
				}
			}
			
			if(isset($request->committee_member_id)) {
				if(count($request->committee_member_id) < count($request->member_title)) {
					foreach($reunion->committee as $key => $committee_member) {
						$member_dl = Reunion_dl::find($request->dl_id[$key]);
						$committee_member->dl_id = $request->dl_id[$key];
						$committee_member->member_title = $request->member_title[$key];
						$committee_member->member_name = $member_dl->firstname . ' ' . $member_dl->lastname;
						$committee_member->member_email = $member_dl->email;
						$committee_member->member_phone = $member_dl->phone;
						$committee_member->save();
					}
					
					for($x=count($request->committee_member_id); $x < count($request->member_title); $x++) {
						// Create New Reunion Object
						$committee_member = new Reunion_committee();
						
						// Get member from distro list
						$member = Reunion_dl::find($request->dl_id[$x]);
						
						$committee_member->dl_id = $member->id;
						$committee_member->reunion_id = $reunion->id;
						$committee_member->member_name = $member->firstname . ' ' . $member->lastname;
						$committee_member->member_title = $request->member_title[$x];
						$committee_member->member_email = $member->email;
						$committee_member->member_phone = $member->phone;
						
						if($committee_member->save()) {
							
						}
					}
				} else {
					foreach($reunion->committee as $key => $committee_member) {
						$member_dl = Reunion_dl::find($request->dl_id[$key]);
						$committee_member->dl_id = $request->dl_id[$key];
						$committee_member->member_title = $request->member_title[$key];
						$committee_member->member_name = $member_dl->firstname . ' ' . $member_dl->lastname;
						$committee_member->member_email = $member_dl->email;
						$committee_member->member_phone = $member_dl->phone;
						$committee_member->save();
					}
				}
			} elseif(!isset($request->committee_member_id) && isset($request->member_title)) {
				for($x=0; $x < count($request->member_title); $x++) {
					// Create New Reunion Object
					$committee_member = new Reunion_committee();
					
					// Get member from distro list
					$member = Reunion_dl::find($request->dl_id[$x]);
					
					$committee_member->dl_id = $member->id;
					$committee_member->reunion_id = $reunion->id;
					$committee_member->member_name = $member->firstname . ' ' . $member->lastname;
					$committee_member->member_title = $request->member_title[$x];
					$committee_member->member_email = $member->email;
					$committee_member->member_phone = $member->phone;
					
					if($committee_member->save()) {
						
					}
				}
			}
				
			return redirect()->action('ReunionController@edit', $reunion)->with('status', 'Reunion Updated Succssfully');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

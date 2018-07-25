<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Reunion;
use App\Reunion_committee;
use App\Reunion_event;
use App\Reunion_dl;
use App\State;
use App\Year;
use App\Committee_Title;
use App\CarouselImage;
use App\ReunionImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

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
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$titles = Committee_Title::all();
		$carbonDate = Carbon::now()->subYear();
		
        return view('admin.reunions.create', compact('states', 'carbonDate', 'members', 'titles'));
    }    
	
	/**
     * Show the form for creating new pictures for specific reunion.
     *
     * @return \Illuminate\Http\Response
    */
    public function create_reunion_pictures(Reunion $reunion)
    {
		$images = CarouselImage::all();
		
        return view('admin.reunions.pictures.create', compact('images', 'reunion'));
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function update_reunion_image(Request $request, Reunion $reunion)
	{
		if($request->hasFile('photo')) {
			$newImage = $request->file('photo');
			
			// Check to see if upload is an image
			if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
				
				// Check to see if images is too large
				if($newImage->getError() == 1) {
					
					$fileName = $request->file('photo')[0]->getClientOriginalName();
					$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
					
				} elseif($newImage->getError() == 0) {
					
					// Check to see if images is about 25MB
					// If it is then resize it
					if($newImage->getClientSize() < 25000000) {
						$image = Image::make($newImage->getRealPath())->orientate();
						$path = $newImage->store('public/reunion_background');
						
						if($image->save(storage_path('app/'. $path))) {
							// Prevent possible upsizing
							// Create a larger version of the image
							// and save to large image folder
							$image->resize(1700, null, function ($constraint) {
								$constraint->aspectRatio();
								// $constraint->upsize();
							});
							
							if($image->save(storage_path('app/'. $path))) {
							
								$reunion->picture = str_ireplace('public', 'storage', $path);

								if($reunion->save()) {}
								
							}
						}
						
					} else {
						// Resize the image before storing. Will need to hash the filename first
						$path = $newImage->store('public/reunion_background');
						$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
							$constraint->aspectRatio();
							$constraint->upsize();
						});
						
						if($image->save(storage_path('app/'. $path))) {
							
							$reunion->picture = str_ireplace('public', 'storage', $path);

							if($reunion->save()) {}
							
						}
							
					}
				} else {
					$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
				}
			} else {
				$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
			}

			return 'Image added';
		}

	}
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function update_reunion_pictures(Request $request, Reunion $reunion)
	{
		if($request->hasFile('photo')) {
			foreach($request->file('photo') as $newImage) {
				
				// Check to see if upload is an image
				if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
					
					$addImage = new ReunionImage();
					
					// Check to see if images is too large
					if($newImage->getError() == 1) {
						$fileName = $request->file('photo')[0]->getClientOriginalName();
						$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
					} elseif($newImage->getError() == 0) {
						// Check to see if images is about 25MB
						// If it is then resize it
						if($newImage->getClientSize() < 25000000) {
							$image = Image::make($newImage->getRealPath())->orientate();
							$path = $newImage->store('public/images');
							
							if($image->save(storage_path('app/'. $path))) {
								// prevent possible upsizing
								// Create a larger version of the image
								// and save to large image folder
								$image->resize(1700, null, function ($constraint) {
									$constraint->aspectRatio();
									// $constraint->upsize();
								});
								
								
								if($image->save(storage_path('app/'. str_ireplace('images', 'images/lg', $path)))) {
									// Get the height of the current large image
									$addImage->lg_height = $image->height();
									
									// Create a smaller version of the image
									// and save to large image folder
									$image->resize(544, null, function ($constraint) {
										$constraint->aspectRatio();
									});
									
									if($image->save(storage_path('app/'. str_ireplace('images', 'images/sm', $path)))) {
										// Get the height of the current small image
										$addImage->sm_height = $image->height();
									}
								}
							}
							
							$addImage->path = str_ireplace('public', 'storage', $path);
							$addImage->reunion_id = $reunion->id;

							if($addImage->save()) {}
							
						} else {
							// Resize the image before storing. Will need to hash the filename first
							$path = $newImage->store('public/images');
							$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
							
							$image->save(storage_path('app/'. $path));
							$addImage->property_id = $showSeason->id;
							
							if($carouselCount < 10) {
								
								if($addImage->save()) {
									$counter++;
								}
								
							}
						}
					} else {
						$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
					}
				} else {
					$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
				}
			}
			
			return redirect()->back()->with('status', 'Images added successfully');
		}
	}
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Check for any active reunions and make completed_reunion
		if(Reunion::active()->count() > 0) {
			$completeReunion = Reunion::active()->first();
			
			$completeReunion->reunion_complete = 'Y';
			
			if($completeReunion->save()) {}
		}
		
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
		$carbonDate = Carbon::now()->subYear();
		$members = Reunion_dl::orderby('firstname', 'asc')->get();
		$titles = Committee_Title::all();
		$reunion_events = $reunion->events()->orderBy('event_date')->get();
		$totalRegistrations = $reunion->registrations()->where('parent_reg', null)->count();
		$adults = $reunion->registrations()->where('parent_reg', null)->pluck('adult_names');
		$youths = $reunion->registrations()->where('parent_reg', null)->pluck('youth_names');
		$children = $reunion->registrations()->where('parent_reg', null)->pluck('children_names');
		$adultShirts = $reunion->registrations()->where('parent_reg', null)->pluck('adult_shirts');
		$youthShirts = $reunion->registrations()->where('parent_reg', null)->pluck('youth_shirts');
		$childrenShirts = $reunion->registrations()->where('parent_reg', null)->pluck('children_shirts');

		$totalAdults = count(array_filter(explode(';', $adults->implode(';'))));
		$totalYouths = count(array_filter(explode(';', $youths->implode(';'))));
		$totalChildren = count(array_filter(explode(';', $children->implode(';'))));

		$totalShirts = count(array_filter(explode(';', $adultShirts->implode(';')))) + count(array_filter(explode(';', $youthShirts->implode(';')))) + count(array_filter(explode(';', $childrenShirts->implode(';'))));

		$totalFees = is_numeric($reunion->registrations()->totalRegFees()) ? $reunion->registrations()->totalRegFees() : 0;
		$totalRegFeesPaid = is_numeric($reunion->registrations()->totalRegFeesPaid()) ? $reunion->registrations()->totalRegFeesPaid() : 0;
		$totalRegFeesDue = is_numeric($reunion->registrations()->totalRegFeesDue()) ? $reunion->registrations()->totalRegFeesDue() : 0;
		
		// Shirts Sizes Totals
		// Adults
		$aSm = $aMd = $aLg = $aXl = $aXXl = $aXXXl = 0; 
		foreach(array_filter(explode(';', $adultShirts->implode(';'))) as $shirtSize) {
			if(trim($shirtSize) == 'S') {
				$aSm++;
			} elseif(trim($shirtSize) == 'M') {
				$aMd++;
			} elseif(trim($shirtSize) == 'L') {
				$aLg++;
			} elseif(trim($shirtSize) == 'XL') {
				$aXl++;
			} elseif(trim($shirtSize) == 'XXL') {
				$aXXl++;
			} elseif(trim($shirtSize) == 'XXXL') {
				$aXXXl++;
			}
		}

		// Youths
		$yXSm = $ySm = $yMd = $yLg = 0; 
		foreach(array_filter(explode(';', $youthShirts->implode(';'))) as $shirtSize) {
			if(trim($shirtSize) == 'S') {
				$yXSm++;
			} elseif(trim($shirtSize) == 'M') {
				$ySm++;
			} elseif(trim($shirtSize) == 'L') {
				$yMd++;
			} elseif(trim($shirtSize) == 'XL') {
				$yLg++;
			} elseif(trim($shirtSize) == 'XXL') {
				$aSm++;
			} elseif(trim($shirtSize) == 'XXXL') {
				$aLg++;
			}
		}
		
		// Children
		$c6 = $c5T = $c4T = $c3T = $c2T = $c12M = 0; 
		foreach(array_filter(explode(';', $childrenShirts->implode(';'))) as $shirtSize) {
			if(trim($shirtSize) == 'S') {
				$c12M++;
			} elseif(trim($shirtSize) == 'M') {
				$c2T++;
			} elseif(trim($shirtSize) == 'L') {
				$c3T++;
			} elseif(trim($shirtSize) == 'XL') {
				$c4T++;
			} elseif(trim($shirtSize) == 'XXL') {
				$c5T++;
			} elseif(trim($shirtSize) == 'XXXL') {
				$c6++;
			}
		}
		
		return view('admin.reunions.edit', compact('reunion', 'reunion_events', 'states', 'carbonDate', 'members', 'titles', 'totalRegistrations', 'totalAdults', 'totalYouths', 'totalChildren', 'totalFees', 'totalRegFeesPaid', 'totalRegFeesDue', 'totalShirts', 'aSm', 'aMd', 'aLg', 'aXl', 'aXXl', 'aXXXl', 'yXSm', 'ySm', 'yMd', 'yLg', 'c5T', 'c4T', 'c3T', 'c2T', 'c12M', 'c6'));
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
		if(isset($request->completed_reunion)) {

			$reunion->reunion_complete = $request->completed_reunion;
			
			if($reunion->save()) {
				return redirect()->action('ReunionController@index')->with('status', 'Reunion Completed');
			}
		} else {
			
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
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove_event(Reunion_event $reunion_event)
    {
		if($reunion_event->delete()) {
			return $reunion_event;
		}
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove_committee_member(Reunion_committee $reunion_committee)
    {
		if($reunion_committee->delete()) {
			return $reunion_committee;
		}
    }
}

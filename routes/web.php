<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test_email/{registration}', function (App\Registration $registration) {
	// $reunion = $registration->reunion;
	// $totalYouths = $totalAdults = $totalChildren = 10;
	// // Get all the shirt sizes
	// $shirtSizes = explode('; ', $registration->shirt_sizes);
	
	// // Get the count of each age group
	// $adults = explode('; ', $registration->adult_names);
	// $youths = explode('; ', $registration->youth_names);
	// $childs = explode('; ', $registration->child_names);
	
	// // Get the sizes of the shirts in reference to the amount
	// // of each age group
	// $adultSizes = array_slice($shirtSizes, 0, count($adults));
	// $youthSizes = array_slice($shirtSizes, count($adults), count($youths));
	// $childrenSizes = array_slice($shirtSizes, (count($adults) + count($youths)));
	
    // return view('emails.new_message', compact('reunion', 'registration', 'totalYouths', 'totalAdults', 'totalChildren', 'adultSizes', 'youthSizes', 'childrenSizes'));
// });

Route::get('/reunion_registration', function () {
	$images = \App\Images::where('id', '>', '5')->get();
	$reunions = \App\Reunion::orderby('reunion_year', 'desc')->get();
	
    return view('reunion_registration_form', compact('images', 'reunions'));
});

Route::get('/delete_registration/{registration}', function (\App\Registration $registration) {
	$family = \App\Reunion_dl::where([
		['family_id', $registration->family_id],
		['family_id', '<>', null]
	])->get();
	
    return view('admin.delete_modal.delete_registration', compact('registration', 'family'));
});

Route::get('/', function () {
	$images = \App\Images::where('id', '>', '5')->get();
	$reunions = \App\Reunion::orderby('reunion_year', 'desc')->get();
	$newReunionCheck = \App\Reunion::where('reunion_complete', 'N')->get()->last();
	
    return view('welcome', compact('images', 'reunions', 'newReunionCheck'));
});

Route::get('/past_reunion/{reunion}', function (\App\Reunion $reunion) {
	$registrations = \App\Registration::where('reunion_id', $reunion->id);
	$committee_members = $reunion->committee;
	
    return view('past_reunion', compact('registrations', 'reunion', 'committee_members'));
});

Route::get('/upcoming_reunion/{reunion}', function (\App\Reunion $reunion) {
	$registrations = \App\Registration::where('reunion_id', $reunion->id)->get();
	$committee_members = $reunion->committee;
	$committee_president = $committee_members->isNotEmpty() ? $committee_members->where('member_title', 'president')->first()->reunion_dl : $committee_members;
	$states = \App\State::all();
	$events = $reunion->events->groupBy('event_date');
	
    return view('upcoming_reunion', compact('registrations', 'committee_members', 'events', 'committee_president', 'reunion', 'states'));
});

Route::get('/administrator', function () {
	$distribution_list = \App\Reunion_dl::orderby('lastname', 'asc')->orderby('address', 'asc')->get();
	
    return view('admin.index', compact('registrations', 'distribution_list'));
});

Auth::routes();

Route::resource('/registrations', 'RegistrationController');

Route::get('/registrations/create/{reunion}', 'RegistrationController@create')->name('create_registration');

Route::resource('/reunions', 'ReunionController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/members/create', 'HomeController@create')->name('new_member');

Route::post('/members', 'HomeController@store')->name('add_member');

Route::put('/members/{reunion_dl}', 'HomeController@update')->name('update_member');

Route::get('/members/{reunion_dl}/edit', 'HomeController@edit')->name('edit_member');

Route::put('/members/{reunion_dl}/add_house_hold', 'HomeController@add_house_hold')->name('add_house_hold');

Route::delete('/members/{reunion_dl}/remove_house_hold', 'HomeController@remove_house_hold')->name('remove_house_hold');

Route::delete('/reunion_events/{reunion_event}', 'ReunionController@remove_event')->name('remove_event');

Route::delete('/reunion_committee_members/{reunion_committee}', 'ReunionController@remove_committee_member')->name('remove_committee_member');

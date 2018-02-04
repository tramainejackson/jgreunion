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
	
    return view('welcome', compact('images', 'reunions'));
});

Route::get('/past_reunion/{reunion}', function (\App\Reunion $reunion) {
	$registrations = \App\Registration::where('reunion_id', $reunion->id);
	$committee_members = $reunion->committee;
	
    return view('past_reunion', compact('registrations', 'reunion', 'committee_members'));
});

Route::get('/upcoming_reunion/{reunion}', function (\App\Reunion $reunion) {
	$registrations = \App\Registration::where('reunion_id', $reunion->id)->get();
	$committee_members = $reunion->committee;
	$committee_president = $committee_members->where('member_title', 'president')->first()->reunion_dl;
	$events = $reunion->events->groupBy('event_date');
	$states = \App\State::all();
	
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

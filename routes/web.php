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

Route::get('/', 'HomeController@home');

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

Route::get('/upcoming_reunion/{reunion}/registration_form', function (\App\Reunion $reunion) {
	$states = \App\State::all();
	
    return view('upcoming_reunion_reg_form', compact('reunion', 'states'));
});

Route::get('/administrator', function () {
	$distribution_list = \App\Reunion_dl::orderby('lastname', 'asc')->orderby('address', 'asc')->get();
	
    return view('admin.index', compact('registrations', 'distribution_list'));
});

Auth::routes();

Route::resource('/registrations', 'RegistrationController');

Route::resource('/reunions', 'ReunionController');

Route::get('/registrations/create/{reunion}', 'RegistrationController@create')->name('create_registration');

Route::get('/reunions/{reunion}/pictures/create', 'ReunionController@create_reunion_pictures')->name('create_reunion_pictures');

Route::get('/settings', 'HomeController@settings')->name('settings');

Route::put('/update_settings', 'HomeController@update_settings');

Route::patch('/update_carousel/{picture}', 'HomeController@update_carousel');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/members/create', 'HomeController@create')->name('new_member');

Route::get('/members/{reunion_dl}/edit', 'HomeController@edit')->name('edit_member');

Route::post('/members', 'HomeController@store')->name('add_member');

Route::post('/reunion_images_add/{reunion}', 'ReunionController@update_reunion_pictures');

Route::post('/reunion_image_add/{reunion}', 'ReunionController@update_reunion_image');

Route::put('/members/{reunion_dl}', 'HomeController@update')->name('update_member');

Route::put('/members/{reunion_dl}/add_house_hold', 'HomeController@add_house_hold')->name('add_house_hold');

Route::put('/registrations/{registration}/add_registration_member', 'RegistrationController@add_registration_member')->name('add_registration_member');


Route::delete('/members/{reunion_dl}/remove_house_hold', 'HomeController@remove_house_hold')->name('remove_house_hold');

Route::delete('/remove_reg_member/{registration}/{remove_ind_member}', 'RegistrationController@remove_ind_member')->name('remove_ind_member');

Route::delete('/reunion_events/{reunion_event}', 'ReunionController@remove_event')->name('remove_event');

Route::delete('/reunion_committee_members/{reunion_committee}', 'ReunionController@remove_committee_member')->name('remove_committee_member');

Route::delete('/delete_carousel/{picture}', 'HomeController@delete_carousel');
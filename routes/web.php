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

Route::get('/', 'HomeController@home');

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

Route::get('/upcoming_reunion/{reunion}/registration_form', function (\App\Reunion $reunion) {
	$states = \App\State::all();
	
    return view('upcoming_reunion_reg_form', compact('reunion', 'states'));
});

Route::get('/members/duplicates', 'FamilyMemberController@duplicates')->name('duplicate_members');

Auth::routes();

Route::resource('/administrator', 'AdministratorController');

Route::resource('/members', 'FamilyMemberController');

Route::resource('/registrations', 'RegistrationController');

Route::resource('/reunions', 'ReunionController');

Route::get('/past_reunion/{reunion}', 'ReunionController@show_past_reunion')->name('show_past_reunion');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registrations/create/{reunion}', 'RegistrationController@create')->name('create_registration');

Route::get('/reunions/{reunion}/pictures/create', 'ReunionController@create_reunion_pictures')->name('create_reunion_pictures');

Route::get('/settings', 'HomeController@settings')->name('settings');

Route::put('/update_settings', 'HomeController@update_settings');

Route::patch('/update_carousel/{picture}', 'HomeController@update_carousel');

Route::post('/reunion_images_add/{reunion}', 'ReunionController@update_reunion_pictures');

Route::post('/reunion_image_add/{reunion}', 'ReunionController@update_reunion_image');

Route::put('/members/{reunion_dl}/add_house_hold', 'HomeController@add_house_hold')->name('add_house_hold');

Route::put('/registrations/{registration}/add_registration_member', 'RegistrationController@add_registration_member')->name('add_registration_member');

Route::delete('/members/{reunion_dl}/remove_house_hold', 'HomeController@remove_house_hold')->name('remove_house_hold');

Route::delete('/remove_reg_member/{registration}/{remove_ind_member}', 'RegistrationController@remove_ind_member')->name('remove_ind_member');

Route::delete('/reunion_events/{reunion_event}', 'ReunionController@remove_event')->name('remove_event');

Route::delete('/reunion_committee_members/{reunion_committee}', 'ReunionController@remove_committee_member')->name('remove_committee_member');

Route::delete('/delete_carousel/{picture}', 'HomeController@delete_carousel');

Route::delete('/members_remove/duplicate/{member}', 'FamilyMemberController@delete_duplicates');
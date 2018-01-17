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

Route::get('/', function () {
	$images = \App\Images::where('id', '>', '5')->get();
	$reunions = \App\Reunion::orderby('reunion_year', 'desc')->get();
	
    return view('welcome', compact('images', 'reunions'));
});

Route::get('/past_reunion/{id}', function () {
	$registrations = \App\Registration::all();
	
    return view('past_reunion', compact('registrations'));
});

Route::get('/administrator', function () {
	$distribution_list = \App\Reunion_dl::all();
	
    return view('admin.index', compact('registrations', 'distribution_list'));
});

Route::get('/registrations/{reunions}', function (\App\Reunion $reunions) {
	$registrations = \App\Registration::where('reunion_id', $reunions->id)->get();
	
    return view('admin.registrations', compact('registrations', 'reunions'));
});

Auth::routes();

Route::resource('/registration', 'RegistrationController');

Route::get('/home', 'HomeController@index')->name('home');

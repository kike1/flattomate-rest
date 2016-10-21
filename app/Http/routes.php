<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* 
*
* USER
*/
Route::resource('user','UserController');

Route::post('user/{email}/{password}', ['uses' => 'UserController@login', 'as' => 'users.login']);

//avatar img
Route::get('imgs/{filename}', function ($filename)
{
    return Image::make(storage_path() . '/' . $filename)->response();
});

Route::get('announcements/{filename}', function ($filename)
{
    return Image::make(storage_path() . '/' . $filename)->response();
});

//Languages
//get
Route::get('user/{iduser}/languages', ['uses' => 'UserController@getLanguages', 'as' => 'users.getLanguages']);
//add
Route::post('languages/add/{iduser}/{language}', ['uses' => 'UserController@setLanguage', 'as' => 'users.setLanguage']);//remove
Route::delete('languages/remove/{iduser}/{language}', ['uses' => 'UserController@removeLanguage', 'as' => 'users.removeLanguage']);

//upload
Route::post('user/upload', ['uses' => 'UserController@uploadImageProfile', 'as' => 'users.uploadImageProfile']); //user profile

//request negotiation
Route::post('user/{id}/chat/{idUserAnnouncement}/{idAnnouncement}', ['uses' => 'UserController@requestNegotiation', 
																	'as' => 'users.removrequestNegotiationeLanguage']);

/*
*
* ANNOUNCEMENT
*/
Route::resource('announcement','AnnouncementController');

Route::get('announcement/{id}/user', ['uses' => 'AnnouncementController@getUser', 'as' => 'announcements.getUser']);
Route::get('announcement/{id}/services', ['uses' => 'AnnouncementController@getServices', 'as' => 'announcements.getServices']);
Route::get('announcement/{id}/images', ['uses' => 'AnnouncementController@getImages', 'as' => 'announcements.getImages']);
Route::get('announcement/{id}/accommodation', ['uses' => 'AnnouncementController@getAccommodation', 'as' => 'announcements.getAccommodation']);

/*
* SERVICE
*/
Route::resource('service','ServiceController');

/*
*
* ACCOMMODATION
*/
Route::resource('accommodation','AccommodationController');

/*
*
* REVIEWS
*/
Route::resource('review','ReviewController');
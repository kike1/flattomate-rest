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
Route::get('user/{id}/reviews', ['uses' => 'UserController@getReviews', 'as' => 'users.getReviews']);

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
Route::post('languages/add/{iduser}/{language}', ['uses' => 'UserController@setLanguage', 'as' => 'users.setLanguage']);
//remove
Route::delete('languages/remove/{iduser}/{language}', ['uses' => 'UserController@removeLanguage', 'as' => 'users.removeLanguage']);

//upload
Route::post('user/upload', ['uses' => 'UserController@uploadImageProfile', 'as' => 'users.uploadImageProfile']); //user profile

//request negotiation
Route::post('user/{id}/chat/{idUserAnnouncement}/{idAnnouncement}', ['uses' => 'UserController@requestNegotiation', 
																	'as' => 'users.requestNegotiation']);
Route::get('user/{id}/chat/{idUserAnnouncement}/{idAnnouncement}', ['uses' => 'UserController@isRequestedNegotiation', 
																	'as' => 'users.isRequestedNegotiation']);

//send review message
Route::post('user/{id_sender}/chat/{id_receiver}/message/{message}', ['uses' => 'UserController@chat', 'as' => 'users.chat']);

Route::post('user/chat', ['uses' => 'UserController@sendChatMessage', 'as' => 'users.sendChatMessage']);

Route::get('user/{id}/chats', ['uses' => 'UserController@chatsFromUser', 'as' => 'users.chatsFromUser']);



/*
*
* ANNOUNCEMENT
*/
Route::resource('announcement','AnnouncementController');

Route::get('announcement/{id}/user', ['uses' => 'AnnouncementController@getUser', 'as' => 'announcements.getUser']);
Route::get('announcement/{id}/services', ['uses' => 'AnnouncementController@getServices', 'as' => 'announcements.getServices']);
Route::get('announcement/{id}/images', ['uses' => 'AnnouncementController@getImages', 'as' => 'announcements.getImages']);
Route::get('announcement/{id}/mainimage', ['uses' => 'AnnouncementController@getMainImage', 'as' => 'announcements.getMainImage']);
Route::get('announcement/{id}/accommodation', ['uses' => 'AnnouncementController@getAccommodation', 'as' => 'announcements.getAccommodation']);

Route::post('announcement/{id}/upload', ['uses' => 'AnnouncementController@uploadAnnouncementImage', 'as' => 'announcements.uploadAnnouncementImage']);
Route::get('announcement/last', ['uses' => 'AnnouncementController@last', 'as' => 'announcements.last']);
Route::get('announcement/{id}/reviews', ['uses' => 'AnnouncementController@reviews', 'as' => 'announcements.reviews']);
Route::post('announcement/review', ['uses' => 'AnnouncementController@makeReview', 'as' => 'announcements.makeReview']);

Route::get('announcement/search/{title}', ['uses' => 'AnnouncementController@search', 'as' => 'announcements.search']);

/*
* SERVICE
*/
Route::resource('service','ServiceController');


/*
*
* ACCOMMODATION
*/
Route::resource('accommodation','AccommodationController');
//set services
Route::post('accommodation/{id}/service/{service}', ['uses' => 'AccommodationController@setService', 'as' => 'accommodations.setService']);

/*
*
* REVIEWS
*/
Route::resource('review','ReviewController');
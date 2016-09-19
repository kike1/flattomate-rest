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

Route::resource('user','UserController');

Route::post('user/{email}/{password}', ['uses' => 'UserController@login', 'as' => 'users.login']);
//Route::get('user/{id}', ['uses' => 'UserController@show', 'as' => 'users.show']);

//avatar img
Route::get('imgs/{filename}', function ($filename)
{
    $path = storage_path() . '/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

//Languages
//get
Route::get('user/{iduser}/languages', ['uses' => 'UserController@getLanguages', 'as' => 'users.getLanguages']);
//add
Route::post('languages/add/{iduser}/{language}', ['uses' => 'UserController@setLanguage', 'as' => 'users.setLanguage']);//remove
Route::delete('languages/remove/{iduser}/{language}', ['uses' => 'UserController@removeLanguage', 'as' => 'users.removeLanguage']);

//upload
Route::post('user/upload', ['uses' => 'UserController@uploadImageProfile', 'as' => 'users.uploadImageProfile']); //user profile


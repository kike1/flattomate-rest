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

Route::resource('users','UserController');

Route::post('users/{email}/{password}', ['uses' => 'UserController@login', 'as' => 'users.login']);
Route::get('users/{id}', ['uses' => 'UserController@show', 'as' => 'users.show']);

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
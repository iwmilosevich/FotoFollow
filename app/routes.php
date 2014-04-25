<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('logout', array('uses' => 'UserController@doLogout'));
Route::get('login', array('uses' => 'UserController@showLogin'));
Route::post('login', array('uses' => 'UserController@doLogin'));
Route::get('/', array('uses' => 'BaseController@showHome'));
Route::post('signUp', array('uses' => 'UserController@doSignUp'));


Route::group(array('before' => 'auth'), function()
{
   // Covered in the filters section as far as what the auth group does
   Route::resource('feeds','FeedController');
   Route::get('userProfile', array('uses' => 'UserController@showUser'));
   Route::get('uploadPhoto', array('uses' => 'FeedController@showUploadPhoto'));
   Route::post('uploadPhoto', array('uses' => 'FeedController@doUpload'));
});

App::missing(function($exception)
{
	return Response::view('error', array(), 404);
});

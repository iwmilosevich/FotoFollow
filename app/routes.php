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
Route::get('logout', array('uses' => 'HomeController@doLogout'));
Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::group(array('before' => 'auth'), function()
{
   // Covered in the filters section as far as what the auth group does
   Route::get('/', array('uses' => 'HomeController@showFeed'));
   Route::get('userProfile', array('uses' => 'HomeController@showUser'));
});

App::missing(function($exception)
{
	return Response::view('error', array(), 404);
});



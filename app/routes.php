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

// PROTECTED
Route::group(array('before' => 'auth'), function()
{
   Route::get('/', array('uses' => 'HomeController@showHome'));
   Route::get('userProfile', array('uses' => 'HomeController@showUser'));
});

// AUTH FILTER
Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::to('login');
});


App::missing(function($exception)
{
	return Response::view('error', array(), 404);
});



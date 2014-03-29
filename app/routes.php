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

// show a static view for the home page (app/views/home.blade.php)
Route::get('/', function()
{
	return View::make('pages.home');
});

Route::get('userProfile', array('uses' => 'HomeController@showUser'));

Route::get('login', array('uses' => 'HomeController@showLogin'));

Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('logout', array('uses' => 'HomeController@doLogout'));

App::missing(function($exception)
{
	return Response::view('error', array(), 404);
});



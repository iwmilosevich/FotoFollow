<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showOtherUser($id)
	{
		$user = User::find($id);
		return View::make('pages.userProfile')
			->with('user', $user);
	}

	public function showMyUser()
	{
		$userid = Session::get('userid');
		$user = User::find($userid);
		return View::make('pages.userProfile')
			->with('user', $user);
	}

	public function showLogin()
	{
		return View::make('pages.login');
	}

	public function showHome()
	{
		return View::make('pages.home');
	}

	public function doLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				// validation successful!
				$userid = DB::table('users')
					->where('email', $userdata['email'])
					->pluck('id');
				Session::put('userid', $userid);
				return Redirect::to('feeds');

			} else {

				// validation not successful, send back to form
				return Redirect::to('login');

			}

		}
	}

	public function doLogout()
	{
		Session::flush();
		Auth::logout();
		return Redirect::to('login');
	}

	public function doSignUp()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'name'		 => 'required',
			'email'    => 'required|email|unique:users,email', // make sure the email is an actual email
			'username' => 'required|unique:users,username',
			'password' => 'required|alphaNum|min:6', // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'name'    => Input::get('name'),
				'email' 	=> Input::get('email'),
				'username'	=>	Input::get('username'),
				'password' 	=> Hash::Make(Input::get('password')),
			);

			$checkAuth = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')

				);

			$id = DB::table('users')->insertGetId($userdata);

			// attempt to do the login
			if (Auth::attempt($checkAuth)) {

				// validation successful!
				return Redirect::to('feeds');

			} else {

				// validation not successful, send back to form
				return Redirect::to('login');

			}

		}
	}

}

<?php

class FeedController extends BaseController {

	/**
	 * Index of all of the feeds
	 *
	 * @return Response
	 */
	public function index()
	{
		$feeds = Feed::all();
		return View::make('pages.feed')
			->with('feeds', $feeds);
	}


	/**
	 * creation of a feed
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pages.feedCreate');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'feedName'    => 'required',
			'description' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		// process the login
		if ($validator->fails()) {
			return Redirect::to('feeds/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$feed = new Feed;
			$feed->feedName    = Input::get('feedName');
			$feed->description = Input::get('description');
			$feed->save();

			// Add user as Moderator
			$userid = Session::get('userid');
			$user = User::find($userid);
			DB::table('moderators')->insert(
				array('user_id' => $userid, 'feed_id' => $feed->id, 
					'feed_name' => $feed->feedName, 'user_name' => $user->username)
			);

			// redirect
			Session::flash('message', 'Successfully created feed!');
			return Redirect::to('feeds/' . $feed->id);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$feed = Feed::find($id);
		return View::make('pages.feedProfile')
			->with('feed', $feed);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete feed. Need to add a confirmation modal or something to this
		$feed = Feed::find($id);
		$feed->delete();

		Session::flash('message', 'Successfully deleted the feed!');
		return Redirect::to('feeds');		
	}

	public function showUploadPhoto()
	{
		$userid = Session::get('userid');
		$user = User::find($userid);
		$subscribedFeeds = DB::table('users_feeds')
			->where('user_name', $user->username)
			->orderBy('feed_name', 'asc')
			->lists('feed_name','id');
		return View::make('pages.uploadPhoto')
			->with('subscribed', $subscribedFeeds);
	}

	public function doUpload() 
	{
		$input = Input::all();

		$rules = [
			'image' => 'required|image'
		];

		$messages = [];
		$validate = Validator::make($input, $rules, $messages);

		if ($validate->passes()) {
			$file = Input::file('image');
			$destinationPath = 'uploads/images/';
			$filename = $file->getClientOriginalName();
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			$upload_success = $file->move($destinationPath, $filename);

			// putting userid and pathname into db. Still need to have it coorespond to a feed. 
			$userid = Session::get('userid');
			DB::table('photos')->insert(
				array('user_id' => $userid, 'pathName' => $destinationPath . $filename)
			);

			// send message here

			return Redirect::back();
		} else {
			return Redirect::back()->withErrors($validate)->withInput();
		}
	}

	public function doSubscription($id)
	{
		$userid = Session::get('userid');
		$feed = Feed::find($id);
		$user = User::find($userid);
		DB::table('users_feeds')->insert(
			array('user_id' => $userid, 'feed_id' => $id, 
				'user_name' => $user->username, 'feed_name' => $feed->feedName,
				'user_email' => $user->email)
		);
		return Redirect::to('feeds');
	}

}

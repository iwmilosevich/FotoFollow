<?php

class FeedController extends BaseController {

	public function showUploadPhoto()
	{
		return View::make('pages.uploadPhoto');
	}

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
		//
	}

}
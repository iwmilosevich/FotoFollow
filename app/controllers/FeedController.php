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
		$subscriptions = DB::table('users_feeds')->where('user_id', Session::get('userid'))->lists('feed_id');

		return View::make('pages.feed')
			->with('feeds', $feeds)
			->with('sub', $subscriptions);
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
		$feedPhotos = DB::table('photos')->where("feed_id", $id)->lists("pathName");

		return View::make('pages.feedProfile')
			->with('feed', $feed)
			->with('photos', $feedPhotos);
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
		$subscribedFeeds = DB::table('moderators')
			->where('user_name', $user->username)
			->orderBy('feed_name', 'asc')
			->lists('feed_name','feed_id');
		return View::make('pages.uploadPhoto')
			->with('subscribed', $subscribedFeeds);
	}

	public function sendMail($feed, $emailArray, $imagePath){

		$mail = new PHPMailer;

		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "thefotofollow@gmail.com";  // GMAIL username
		$mail->Password   = "fotofollowivanbrianfotofollow";            // GMAIL password

		$mail->Subject    = "New Photo for feed ".$feed." .";
		$body             = "Hello, Feed ".$feed." has uploaded a new photo";
		$mail->AddAttachment($imagePath);
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->SetFrom('thefotofollow@gmail.com', 'FotoFollow');
		$mail->MsgHTML($body);
		$mail->AddAddress("thefotofollow@gmail.com");

		foreach ($emailArray as $value) {
			$mail->AddBCC($value);
		}

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		  Log::error($mail->ErrorInfo);
		} else {
		  echo "Message sent!";
		  Log::error('SENT MESSAGE NOOB');
		}

	}

	public function doUpload() 
	{
		$input = Input::all();
		$feedId = Input::get('subscribeFeed');

		$rules = [
			'image' => 'required|image'
		];

		$messages = [];
		$validate = Validator::make($input, $rules, $messages);

		$user = User::find(Session::get('userid'));

		if ($validate->passes()) {
			$file = Input::file('image');
			$destinationDatabaseString = 'uploads/feeds/' . $feedId .'/';
			$destinationPath = 'public/uploads/feeds/' . $feedId .'/';
			$filename = $file->getClientOriginalName();
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			$upload_success = $file->move($destinationPath, $filename);

			$row = DB::table('feed')->where('id', $feedId)->first();
			$subscribedUsers = DB::table('users_feeds')->where('feed_id', $feedId)->lists('user_email');

			
			$this->sendMail($row->feedName, $subscribedUsers, $destinationPath.$filename);

			$userid = Session::get('userid');
			DB::table('photos')->insert(
				array('user_id' => $userid, 'feed_id' => $feedId, 'pathName' => $destinationDatabaseString . $filename)
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

	public function removeSubscription($id)
	{
		$userid = Session::get('userid');
		$feed = Feed::find($id);
		$user = User::find($userid);
		DB::table('users_feeds')->where('user_id', '=', $userid)->where('feed_id', '=', $id)->delete();
		return Redirect::to('feeds');
	}

}

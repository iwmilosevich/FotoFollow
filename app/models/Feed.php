<?php

class Feed extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'feed';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the Name for the user.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->feedName;
	}

	/**
	 * Get the Name for the user.
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	public function users() {
		return $this->belongsToMany('User', 'users_feeds', 'feed_id', 'user_id');
	}
}

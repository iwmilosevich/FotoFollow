<?php

class Photo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'photos';

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
	public function getPath()
	{
		return $this->pathName;
	}

	public function feeds() {
		return $this->belongsTo('Feed');
	}

	public function users() {
		return $this->belongsTo('User');
	}
}

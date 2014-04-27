<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModeratorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('moderators', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->integer('feed_id');
			$table->string('user_name');
			$table->string('feed_name');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('moderators');
	}

}
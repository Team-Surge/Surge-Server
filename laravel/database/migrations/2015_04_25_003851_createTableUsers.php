<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('users', function($table)
    {
      // User ID
      $table->increments('id');
      
      // Timestamps for user account creation
      $table->timestamps();
      
      // Email address for login
      $table->string('email');
      
      // Password hash
      $table->string('password');
      
      // Remember token
      $table->rememberToken();
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::dropIfExists('users');
	}

}

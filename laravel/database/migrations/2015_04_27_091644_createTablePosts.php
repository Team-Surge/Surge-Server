<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('posts', function($table)
    {
      // Post ID
      $table->increments('id');
      
      // Timestamps for post
      $table->timestamps();
      
      // Owner ID
      $table->integer('user_id')->unsigned();
      
      // Post content
      $table->string('content');
      
      // Post content
      $table->string('handle');
      
      // Foreign key in user table
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
    });
      
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::dropIfExists('posts');
	}

}

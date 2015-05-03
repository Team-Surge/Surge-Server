<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('comments', function($table)
    {
      // Post ID
      $table->increments('id');
      
      // Timestamps for post
      $table->timestamps();
      
      // Owner ID
      $table->integer('user_id')->unsigned();
      
      // Referenced post
      $table->integer('post_id')->unsigned();
      
      // Post content
      $table->string('content');
      
      // Vote count cache
      $table->integer('voteCount')->default(0);
      
      // Foreign key in user table
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
        
      // Foreign key in user table
      $table->foreign('post_id')
        ->references('id')->on('posts')
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
    Schema::dropIfExists('comments');
	}

}

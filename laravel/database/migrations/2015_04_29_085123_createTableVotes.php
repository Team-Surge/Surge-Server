<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVotes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('votes', function($table)
    {
      $table->increments('id');
    
      // Index by post_id/user_id for faster lookup
      $table->unique(['post_id', 'user_id']);
      
      // Timestamps for vote
      $table->timestamps();
      
      // Owner ID
      $table->integer('user_id')->unsigned();
      
      // Post ID
      $table->integer('post_id')->unsigned();
      
      // Vote value. Typically {-1, 0, 1}
      // Allow for "super votes" of larger weight later
      $table->tinyInteger('vote');
      
      // Foreign key in user table
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
        
      // Foreign key in post table
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
    Schema::dropIfExists('votes');
	}

}

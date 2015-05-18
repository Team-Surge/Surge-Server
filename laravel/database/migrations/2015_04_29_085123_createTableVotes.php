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
      
      // Timestamps for vote
      $table->timestamps();
      
      // Owner ID
      $table->integer('user_id')->unsigned();
      
      // Vote polymorph
      // $table->morphs('vote');
      // morphs creates a too-long vote_type
      $table->integer('vote_id')->unsigned();
      $table->string('vote_type');
      
      // Vote value. Typically {-1, 0, 1}
      // Allow for "super votes" of larger weight later
      $table->tinyInteger('value');
      
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
    Schema::dropIfExists('votes');
	}

}

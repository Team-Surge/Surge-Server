<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResponses extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('responses', function($table)
    {
      $table->increments('id');
      
      // Timestamps for vote
      $table->timestamps();

      // Associtated post ID
      $table->integer('poll_id')->unsigned();
      
      // Owner ID
      $table->integer('user_id')->unsigned();
      
      // Select the users preference
      $table->tinyInteger('value')->default(0);
      
      // Foreign key in post table
      $table->foreign('poll_id')
        ->references('id')->on('posts')
        ->onDelete('cascade');
        
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
    Schema::dropIfExists('responses');
	}

}

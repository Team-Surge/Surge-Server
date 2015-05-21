<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePolls extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('polls', function($table)
    {
      // Post ID
      $table->increments('id');
      
      // Timestamps for post
      $table->timestamps();
      
      // Associtated post ID
      $table->integer('post_id')->unsigned();
      
      // Number of options
      $table->tinyInteger('optionCount')->unsigned();
      
      // Post option
      $table->string('option1', 50)->default("Option One");
      
      // Post option
      $table->string('option2', 50)->nullable();
      
      // Post option
      $table->string('option3', 50)->nullable();
      
      // Post option
      $table->string('option4', 50)->nullable();
      
      // Post option count
      $table->integer('option1Count')->default(0);
      
      // Post option count
      $table->integer('option2Count')->default(0);
      
      // Post option count
      $table->integer('option3Count')->default(0);
      
      // Post option count
      $table->integer('option4Count')->default(0);
      
      // Foreign key in posts table
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
    Schema::dropIfExists('polls');
	}

}

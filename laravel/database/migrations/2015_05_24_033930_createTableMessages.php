<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('messages', function($table)
    {
      // Post ID
      $table->increments('id');
      
      // Timestamps for conversation
      $table->timestamps();
      
      // User1 ID
      $table->integer('conversation_id')->unsigned();
      
      // Content of message
      $table->string('content', 200);
      
      // User's TID
      $table->integer('tid')->unsigned();
      
      // Foreign key in conversation table
      // Delete messages with conversation deletion
      $table->foreign('conversation_id')
        ->references('id')->on('conversations')
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
    Schema::dropIfExists('messages');
	}

}

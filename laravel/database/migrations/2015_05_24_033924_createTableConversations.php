<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConversations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('conversations', function($table)
    {
      // Conversation ID
      $table->increments('id');
      
      // Timestamps for conversation
      $table->timestamps();

      // Post ID
      $table->integer('post_id')->unsigned();
      
      // Conversation subject line
      $table->string('subject');

      // Status
      $table->tinyInteger('status')->unsigned()->default(0);
      
      // Random Seed, future use with icons
      $table->integer('seed')->unsigned()->default(0);

    });

    Schema::create('conversation_user', function($table)
    {
      // Conversation ID
      $table->increments('id');
      
      // Timestamps for conversation
      $table->timestamps();

      // User ID
      $table->integer('user_id')->unsigned();
      
      // Conversation ID
      $table->integer('conversation_id')->unsigned();
      
      // Thread ID
      $table->integer('tid')->unsigned();

    }); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::dropIfExists('conversations');
    Schema::dropIfExists('conversation_user');
	}

}

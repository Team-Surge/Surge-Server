<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	protected $table = 'votes';
	
	// Do not serialize user_ids because they are private
	protected $hidden = ['user_id'];
	
  protected $fillable = ['user_id', 'post_id'];

}

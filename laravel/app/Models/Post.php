<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $table = 'posts';
	protected $hidden = ['user_id'];
	
	// One-to-many relation on votes
  public function votes()
  {
      return $this->hasMany('App\Models\Vote');
  }

}

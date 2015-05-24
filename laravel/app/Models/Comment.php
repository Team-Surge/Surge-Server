<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $table = 'comments';
	protected $hidden = ['user_id'];
	
  public function votes()
  {
      return $this->morphMany('App\Models\Vote', 'vote');
  }

  public function post()
  {
      return $this->belongsTo('App\Models\Post');
  }

  public function post()
  {
    return $this->belongsTo('App\Models\User');
  }
  
}

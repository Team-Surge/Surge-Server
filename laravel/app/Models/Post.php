<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $table = 'posts';
	protected $hidden = ['user_id'];


  public function votes()
  {
      return $this->morphMany('App\Models\Vote', 'vote');
  }
  
  public function comments()
  {
      return $this->hasMany('App\Models\Comment');
  }
  
  public function poll()
  {
      return $this->hasOne('App\Models\Poll');
  }


}

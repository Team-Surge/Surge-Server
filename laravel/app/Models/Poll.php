<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model {

	protected $table = 'polls';
	protected $hidden = ['user_id'];
  
  /*
  public function comments()
  {
      return $this->hasMany('App\Models\Comment');
  }
  */


}

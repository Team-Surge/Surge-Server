<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {

	protected $table = 'conversations';
	protected $hidden = ['user1_id', 'user2_id'];
	
  public function messages()
  {
      return $this->hasMany('App\Models\Message');
  }
  
  public function users()
  {
    return $this->belongsToMany('App\Models\User')->withPivot('tid');
  }

}

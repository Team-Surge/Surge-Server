<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model {

	protected $table = 'polls';
	protected $hidden = ['user_id'];
  
  public function responses()
  {
      return $this->hasMany('App\Models\Response');
  }


}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	protected $table = 'votes';
	
  public function vote()
  {
      return $this->morphTo();
  }
	
	// Do not serialize user_ids because they are private
	protected $hidden = ['user_id'];

}

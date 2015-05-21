<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model {

	protected $table = 'responses';
	protected $hidden = ['user_id'];
	protected $fillable = ['user_id'];

}

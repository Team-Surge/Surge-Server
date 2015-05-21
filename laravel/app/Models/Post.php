<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DB;

class Post extends Model {

	protected $table = 'posts';
	protected $hidden = ['user_id', 'location'];


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
  
  /*
    Based Shamelessly on:
    http://www.codetutorial.io/geo-spatial-mysql-laravel-5/
  
  */
  
  protected $geofields = array('location');

  protected function setLocationAttribute($value)
  {
    $this->attributes['location'] = DB::raw("POINT($value)");
  }

  protected function getLocationAttribute($value)
  {

    $loc =  substr($value, 6);
    $loc = preg_replace('/[ ,]+/', ',', $loc, 1);

    return substr($loc,0,-1);
  }

  public function newQuery($excludeDeleted = true)
  {
    $raw = '';
    
    foreach($this->geofields as $column)
    {
      $raw .= ' astext('.$column.') as '.$column.' ';
    }

    return parent::newQuery($excludeDeleted)->addSelect('*',DB::raw($raw));
  }


}

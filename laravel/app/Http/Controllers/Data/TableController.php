<?php namespace App\Http\Controllers\Data;

use App\Models\Post;
use \Auth;
use \Session;
use \DB;
use \Input;

class TableController extends \App\Http\Controllers\Controller {

	public function index()
	{
	  $data = [];
	
	  $data['pageid'] = "tables";
	  	
		return view('data.tables', $data);
	}
	
	public function process($table = null)
	{
	  $action = Input::get('action');
	  
	  $valid = ['posts', 'users', 'votes', 'comments'];
	  
	  if(!in_array($table, $valid))
	  {
      Session::flash('message', ['type' => 'success', 'message' => 'Not this table...']);

	  }
	  else
	  {
      DB::table($table)->delete();
      
      Session::flash('message', ['type' => 'success', 'message' => 'Table ' . $table . '  deleted']);
	  }
	
    return redirect()->action('\\' . get_class($this) . '@index'); 
	}

}

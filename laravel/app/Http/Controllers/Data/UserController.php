<?php namespace App\Http\Controllers\Data;

use App\Models\User;
use \Auth;
use \Session;

class UserController extends \App\Http\Controllers\Controller {

	public function index()
	{
	  $data = [];
	
	  $data['pageid'] = "users";
	  $data['users'] = User::all();
	  	
		return view('data.users', $data);
	}
	
	public function show($id)
  {
    $user = User::find($id);
    
    if($user)
    {
      Auth::login($user);
      Session::flash('message', ['type' => 'success', 'message' => 'logged in as user']);
    }
    else
    {
      Session::flash('message', ['type' => 'info', 'message' => 'not logged in: no such user']);
    }
  
    return redirect()->action('\\' . get_class($this) . '@index');
  }
  
  public function destroy($id)
  {
    $user = User::find($id);
    
    if($user)
    {
      $user->delete();
      Session::flash('message', ['type' => 'success', 'message' => 'user deleted']);
    }
    else
    {
      Session::flash('message', ['type' => 'info', 'message' => 'user not deleted: no such user']);
    }
    
    return redirect()->action('\\' . get_class($this) . '@index'); 
  }

}

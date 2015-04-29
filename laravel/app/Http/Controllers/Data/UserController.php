<?php namespace App\Http\Controllers\Data;

use App\Models\User;
use \Auth;

class UserController extends \App\Http\Controllers\Controller {

	public function index()
	{
	  $data = [];
	
	  $data['users'] = User::all();
	  	
		return view('data.users', $data);
	}
	
	public function show($id)
  {
    $user = User::find($id);
    
    if($user)
    {
      Auth::login($user);
    }
  
    return redirect()->action('\\' . get_class($this) . '@index');
  }
  
  public function destroy($id)
  {
    $user = User::find($id);
    
    if($user)
    {
      $user->delete();
    }
    
    return redirect()->action('\\' . get_class($this) . '@index'); 
  }

}

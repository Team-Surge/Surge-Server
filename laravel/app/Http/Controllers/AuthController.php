<?php namespace App\Http\Controllers;

use App\Models\User;
use \Hash;
use Auth;

class AuthController extends ReqController {
	
	protected $rules = 
	[
	  'userCreate' =>
  	  [
        'password' => 'required', // "|min:8"
        'email' => 'required|email|unique:users'
      ],
      
    'userLogin' =>
      [
        'password' => 'required',
        'email' => 'required|email'
      ],
	];
	
  protected $validActions = [
	  "userCreate",
	  "userLogin",
	  "userDelete"
  ];

	protected function userCreate($input, &$output)
	{
	  	 
    $user = new User;
    $user->email = $input['email'];
    $user->password = Hash::make($input['password']);
    $user->save();
	 
    $output['success'] = true;
	}
	
	protected function userLogin($input, &$output)
  { 
    $login = Auth::attempt(['email' => $input['email'], 'password' => $input['password']]);
    
    if($login)
    {
      $output['success'] = true;
    }
    else
    {
      $output['success'] = false;
    }
  }
  
	protected function userDelete($input, &$output)
  { 
    $valid = Auth::check();
    
    if($valid)
    {
      $user = Auth::User();
      $user->delete();
      $output['success'] = true;
    }
    else
    {
      $output['success'] = false;
      $output['reasons'] = ['Not authenticated'];
    }
  }
}

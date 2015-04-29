<?php namespace App\Http\Controllers;

use App\Models\Post;
use \Hash;
use Auth;

class PostController extends ReqController {
	
	protected $rules = 
	[
	  'postCreate' =>
  	  [
        'handle' => 'required',
        'content' => 'required'
      ],
      
    'postDelete' =>
      [
        'postId' => 'required'
      ],
      
    'postVote' =>
      [
        'postId' => 'required',
        'direction' => 'required|in:up,down,neutral',
      ],
	];
	
  protected $validActions = [
	  "postCreate",
	  "postDelete",
	  "postVote"
  ];

	protected function postCreate($input, &$output)
	{
	
    $valid = Auth::check();
	  
	  if(!$valid)
	  {
      $output['success'] = false;
      $output['reasons'] = ['Not authenticated'];
    }
    else
    {   
      $post = new Post;
      $post->user_id = Auth::user()->id;
      $post->handle = $input['handle'];
      $post->content = $input['content'];
      $post->save();
      
      $output['success'] = true; 
    }

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
  
	protected function postDelete($input, &$output)
  { 
    $valid = Auth::check();
    
    if(!$valid)
    {
      $output['success'] = false;
      $output['reasons'] = ['Not authenticated'];
    }
    else
    {
      $user = Auth::User();    
      $post = Post::find($input['postId']);
      
      if(!$post)
      {
        $output['success'] = false;
        $output['reasons'] = ['No such post'];  
      }
      else
      {  
        if($post->user_id == $user->id)
        {
          $post->delete();
          $output['success'] = true;
        }
        else
        {
          $output['success'] = false;
          $output['reasons'] = ['User does not own post'];
        }
      }
    }
  }
  
  
  
}

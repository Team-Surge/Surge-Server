<?php namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
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
	  "postVote",
	  "postList"
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
  
	protected function postVote($input, &$output)
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
        $dir = 0;
        
        switch($input['direction'])
        {
          case "up":
            $dir = 1;
          break;
          
          case "down":
            $dir = -1;
          break;
          
          case "neutral":
          default:
            $dir = 0;
          break;

        }

        $vote = Vote::firstOrNew(
        [
          'user_id' => $user->id,
          'post_id' => $post->id,
        ]);
        
        $vote->vote = $dir;
        
        $vote->save();
        
        $output['success'] = true;

      }
    }
    
	}
	
	protected function postList($input, &$output)
  {
    $output['success'] = true;
    $output['posts'] = Post::all()->toJson();
  }  
}

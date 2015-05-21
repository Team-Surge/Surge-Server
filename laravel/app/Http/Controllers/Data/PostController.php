<?php namespace App\Http\Controllers\Data;

use App\Models\Post;
use \Auth;
use \Session;

class PostController extends \App\Http\Controllers\Controller {

	public function index()
	{
	  $data = [];
	
	  $data['pageid'] = "posts";
	  $data['posts'] = Post::all();
	  	
		return view('data.posts', $data);
	}
	
	public function show($id)
  {
    $data = [];
    
	  $data['pageid'] = "posts";
    $post = Post::with('votes','comments','poll','poll.responses')->find($id);
    
    if(!$post)
    {
      // Todo flash data
      return redirect()->action('\\' . get_class($this) . '@index'); 
    }
    
    $data['post'] = $post;
  
		return view('data.postSingle', $data);
  }
  
  public function destroy($id)
  {
    $post = Post::find($id);
    
    if($post)
    {
      $post->delete();
      
      Session::flash('message', ['type' => 'success', 'message' => 'post deleted']);
    }
    else
    {
      Session::flash('message', ['type' => 'info', 'message' => 'post not deleted: no such post']);
    }
    
    return redirect()->action('\\' . get_class($this) . '@index'); 
  }

}

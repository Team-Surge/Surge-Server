<?php namespace App\Http\Controllers\Data;

use App\Models\Post;
use \Auth;

class PostController extends \App\Http\Controllers\Controller {

	public function index()
	{
	  $data = [];
	
	  // Todo... enable this once the table exists
	  $data['posts'] = Post::all();
	  	
		return view('data.posts', $data);
	}
	
	public function show($id)
  {
    $data = [];
    
    $post = Post::find($id);
    
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
    }
    
    return redirect()->action('\\' . get_class($this) . '@index'); 
  }

}

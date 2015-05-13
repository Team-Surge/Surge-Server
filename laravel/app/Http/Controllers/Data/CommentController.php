<?php namespace App\Http\Controllers\Data;

use App\Models\Comment;
use \Auth;
use \Session;
use \Request;

class CommentController extends \App\Http\Controllers\Controller {

	public function index()
	{
	  $data = [];
	
	  $data['pageid'] = "comments";
	  $data['comments'] = Comment::all();
	  	
		return view('data.comments', $data);
	}
	
	public function show($id)
  {
    $data = [];
    
	  $data['pageid'] = "comments";
    $comment = Comment::with('votes')->find($id);
    
    if(!$comment)
    {
      // Todo flash data
      return redirect()->action('\\' . get_class($this) . '@index'); 
    }
    
    $data['comment'] = $comment;
  
		return view('data.commentSingle', $data);
  }
  
  public function destroy($id)
  {
    $comment = Comment::find($id);
    
    if($comment)
    {
      $comment->delete();
      
      Session::flash('message', ['type' => 'success', 'message' => 'comment deleted']);
    }
    else
    {
      Session::flash('message', ['type' => 'info', 'message' => 'comment not deleted: no such comment']);
    }
    
    if(Request::Input('return') == 'back')
    {
      return redirect()->back();
    }
    else
    {
      return redirect()->action('\\' . get_class($this) . '@index');
    }
  }

}

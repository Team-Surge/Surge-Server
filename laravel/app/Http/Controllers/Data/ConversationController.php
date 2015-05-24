<?php namespace App\Http\Controllers\Data;

use App\Models\User;
use App\Models\Conversation;
use \Auth;
use \Session;

class ConversationController extends \App\Http\Controllers\Controller {

	public function index()
	{
	  $data = [];
	
	  $data['pageid'] = "conversations";
	  $data['conversations'] = Conversation::all();
	  	
		return view('data.conversations', $data);
	}
	
	public function show($id)
  {
    $data = [];
    
	  $data['pageid'] = "conversations";
    $conversation = Conversation::with('messages')->find($id);
    
    if(!$conversation)
    {
      // Todo flash data
      return redirect()->action('\\' . get_class($this) . '@index'); 
    }
    
    $data['conversation'] = $conversation;
  
		return view('data.conversationSingle', $data);
  }
  
  public function destroy($id)
  {
    $conversation = Conversation::find($id);
    
    if($conversation)
    {
      $conversation->delete();
      Session::flash('message', ['type' => 'success', 'message' => 'Conversation deleted']);
    }
    else
    {
      Session::flash('message', ['type' => 'info', 'message' => 'Conversation not deleted: no such conversation']);
    }
    
    return redirect()->action('\\' . get_class($this) . '@index'); 
  }

}

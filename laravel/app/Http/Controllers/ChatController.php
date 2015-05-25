<?php namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use \Hash;
use Auth;
use App\Models\Conversation;
use App\Models\Message;
use App\Helpers\Chat;

class ChatController extends ReqController {
	
	protected $rules = 
	[
	  'chatCreate' =>
  	  [
        'fromType' => 'required|in:post,comment',
        'fromId' => 'required|integer|min:0',
      ],
	  'chatSend' =>
  	  [
        'conversationId' => 'required|integer',
        'content' => 'required|string|min:1|max:200',
      ],
	  'chatSend' =>
  	  [
        'conversationId' => 'required|integer',
        'content' => 'required|string|min:1|max:200',
      ],
	  'chatSend' =>
  	  [
        'conversationId' => 'required|integer',
        'content' => 'required|string|min:1|max:200',
      ],
	];
	
  protected $validActions = [
	  "chatCreate",
	  "chatSend",
	  "chatList",
	  "chatDetail",
  ];
  
  protected $authActions = [
	  "chatCreate",
	  "chatSend",
	  "chatList",
	  "chatDetail",
  ];

	protected function chatCreate($input, &$output)
	{
	  $details = $this->findChatDetails($input);
	  
	  $post = $details['post'];
	  $other = $details['other'];
	  $subject = $details['subject'];
	  
	  $conversation = null;
	
    if(is_null($post))
    {
      $output['success'] = false;
      $output['reasons'] = ['No such Post or Comment'];
      
      return;
    }
    
    if(is_null($other))
    {
      $output['success'] = false;
      $output['reasons'] = ['No such User'];
      
      return;
    }
    
    $user = Auth::User();
    
    if($details !== false)
    {
      $otherId = $details['other']->id;
      $conversations = $user->conversations()->with('messages','users')->where('post_id', '=', $post->id)->get();
      
      foreach($conversations as $convo)
      {
        if($convo->users->contains($otherId))
        {
          $conversation = $convo;
          break;
        }
      }
    }

    if(is_null($conversation))
    {
      $conversation = new Conversation;
      $conversation->post_id = $post->id;
      $conversation->subject = $subject;
      $conversation->save();
      
      $conversation->users()->attach($user->id, ['tid' => 0]);
      $conversation->users()->attach($other->id, ['tid' => 1]);
    }
    
    $output['conversationId'] = $conversation->id;
    $output['success'] = true; 

	}

	protected function chatSend($input, &$output)
	{
    $conversation = Conversation::with('users')->find($input['conversationId']);
    
    if(is_null($conversation))
    {
      $output['success'] = false;
      $output['reasons'] = ['No such conversation'];
      return;
    }
    
    $user = Auth::User();
    
    $users = $conversation->users;
    
    $tid = false;
    
    $recipients = [];
    
    foreach($users as $u)
    {
      $recipients[] = $u->id;
    
      if($u->id == $user->id)
      {
        $tid = $u->pivot->tid;
      }
    }
    
    if($tid === false)
    {
      $output['success'] = false;
      $output['reasons'] = ['Not a participant'];
      return;
    }
    
    $message = new Message;
    $message->conversation_id = $conversation->id;
    $message->content = $input['content'];
    $message->tid = $tid;
    
    $message->save();
    
    $chat = new Chat;
    $chat->send($user->id, $recipients ,json_encode($message));
    
    $output['success'] = true;
	}
	
	protected function chatList($input, &$output)
	{
	  $user = Auth::User();
	
	  $conversations = $user->conversations()->get();
	  
	  $output['conversations'] =  $conversations;
	}
	
	protected function chatDetail($input, &$output)	
	{
	  $user = Auth::User();
	  
	  $conversation = null;
	  
	  if(isset($input['conversationId']))
	  {
	    $conversation = $user->conversations()->with('messages')->find($input['conversationId']);
	  }
	  else
	  {
	    $details = $this->findChatDetails($input);
	    
	    $post = $details['post'];
	    
	    if($details !== false)
	    {
	      $otherId = $details['other']->id;
	      $conversations = $user->conversations()->with('messages','users')->where('post_id', '=', $post->id)->get();
	      
	      foreach($conversations as $convo)
	      {
	        if($convo->users->contains($otherId))
	        {
	          $conversation = $convo;
	          break;
	        }
	      }
	    }
	  }
	  
	  if(is_null($conversation))
	  {
	    $output['success'] = false;
	    $output['reasons'] = ['No such chat'];
	  }
	  else
	  {
	    $output['success'] = true;
	    $output['conversation'] = $conversation;
	  } 
	}
	
	protected function findChatDetails($input)
	{
    $post = null;
    $other = null;
    $subject = "";
	
    if($input['fromType'] == "comment")
    {
      $comment = Comment::find($input['fromId']);
      
      if(!is_null($comment))
      {
        $post = $comment->post;
        $subject = $comment->content;
        
        $other = $comment->user;
      }
      else
      {
        return false;
      }
      
    }
    else if($input['fromType'] == "post")
    {
      $post = Post::find($input['fromId']);
      
      if(is_null($post))
      {
        return false;
      }
      
      $subject = $post->content;
      
      $other = $post->user;     
    }
    else
    {
      return false;
    }
    
    return [
      'post' => $post,
      'subject' => $subject,
      'other' => $other
      ];

	}
	
}


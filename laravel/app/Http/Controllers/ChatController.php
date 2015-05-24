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
	];
	
  protected $validActions = [
	  "chatCreate",
	  "chatSend",
	  "chatList",
	  "chatDetail",
  ];

	protected function chatCreate($input, &$output)
	{
	
    $valid = Auth::check();
	  
	  if(!$valid)
	  {
      $output['success'] = false;
      $output['reasons'] = ['Not authenticated'];
    }
    else
    {   
      $post = null;
      $other = null;
      $subject = "";
      
      if($input['fromType'] == "comment")
      {
        $comment = Comment::find($input['fromId']);
        
        if(!is_null($comment))
        {
          $post = $comment->post();
          $subject = $comment->content;
          
          $other = $comment->user;
        }
        
      }
      else if($input['fromType'] == "post")
      {
        $post = Post::find($input['fromId']);
        $subject = $post->content;
        
        $other = $post->user;
        
      }
      
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

      $convo = new Conversation;
      $convo->post_id = $post->id;
      $convo->subject = $subject;
      $convo->save();
      
      $convo->users()->attach($user->id, ['tid' => 0]);
      $convo->users()->attach($other->id, ['tid' => 1]);
      
      $output['success'] = true; 
    }

	}

	protected function chatSend($input, &$output)
	{
	
    $valid = Auth::check();
	  
	  if(!$valid)
	  {
      $output['success'] = false;
      $output['reasons'] = ['Not authenticated'];
    }
    else
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
          break;
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

	}
		
}


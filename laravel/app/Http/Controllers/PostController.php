<?php namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Vote;
use App\Models\Poll;
use \Hash;
use Auth;

class PostController extends ReqController {
	
	protected $rules = 
	[
	  'postCreate' =>
  	  [
        'handle' => 'string|max:15',
        'content' => 'required|string|min:1|max:200',
        'type' => 'in:standard,poll',
        'pollOptionCount' => 'required_if:type,poll|integer|min:1|max:4',
        'pollOption1' => 'required_if:type,poll|string|max:50',
        'pollOption2' => 'string|max:50',
        'pollOption3' => 'string|max:50',
        'pollOption4' => 'string|max:50',
        'lat' => 'required|numeric|min:-90|max:90',
        'lng' => 'required|numeric|min:-180|max:180',
      ],
      
	  'postCreateComment' =>
  	  [
        'postId' => 'required',
        'content' => 'required|string|min:1|max:200'
      ],
      
    'postDelete' =>
      [
        'postId' => 'required'
      ],

    'postDetail' =>
      [
        'postId' => 'required'
      ],

    'postVote' =>
      [
        'postId' => 'required',
        'direction' => 'required|string|in:up,down,neutral',
      ],
    'postCommentVote' =>
      [
        'commentId' => 'required',
        'direction' => 'required|string|in:up,down,neutral',
      ],
    'postPollRespond' =>
      [
        'postId' => 'required',
        'selection' => 'required|integer|min:0|max:4',
      ],
	  'postList' =>
  	  [
        'lat' => 'required|numeric|min:-90|max:90',
        'lng' => 'required|numeric|min:-180|max:180',
      ],
	];
	
  protected $validActions = [
	  "postCreate",
	  "postCreateComment",
	  "postDelete",
	  "postDetail",
	  "postVote",
	  "postCommentVote",
	  "postPollRespond",
	  "postList",
	  "postListSelf"
  ];
  
  protected $authActions = [
	  "postCreate",
	  "postCreateComment",
	  "postDelete",
	  "postDetail",
	  "postVote",
	  "postCommentVote",
	  "postPollRespond",
	  "postList",
	  "postListSelf"
  ];

	protected function postCreate($input, &$output)
	{
	
    $valid = Auth::check();
    
    // Backwards compatibility with unset post types
    if(!isset($input['type']))
    {
      $input['type'] = 'standard';
    }
	  
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
      $post->type = $input['type'];
      $post->location = $input['lat'] . ',' . $input['lng'];
      
      $post->save();
      
      if($input['type'] == 'poll')
      {
        $poll = new Poll;
        
        $count = intval($input['pollOptionCount']);
        
        $poll->optionCount = $count;
        
        for($i = 1; $i <= $count; $i++)
        {
          $prop = 'option' . $i;
          $inputProp = 'pollOption' . $i;
          $poll->$prop = isset($input[$inputProp]) ? $input[$inputProp] : "";
        }
        
        $post->poll()->save($poll);
        
      }
      
      $output['success'] = true; 
    }

	}
  
	protected function postCreateComment($input, &$output)
	{
	
    $valid = Auth::check();
	  
	  if(!$valid)
	  {
      $output['success'] = false;
      $output['reasons'] = ['Not authenticated'];
    }
    else
    { 
      $post = Post::find($input['postId']);
      
      if($post)
      {
      
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->content = $input['content'];

        $post->comments()->save($comment);
        
        $post->increment('commentCount', 1);
      
      }
      else
      {
        $output['success'] = false;
        $output['reasons'] = ['No such post'];
      }
      
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
  
	protected function postDetail($input, &$output)
  {
  
    $votes = ['-1' => 'down', 0 => 'neutral', 1 => 'up'];
   
    if(Auth::Check())
    {
      $post = Post::with(
      ['comments', 'comments.votes' => 
          function($query)
          {
            $user = Auth::User();
            $query->where('user_id', '=', $user->id);
          },
          'poll',
          'poll.responses' =>
          function($query)
          {
            $user = Auth::User();
            $query->where('user_id', '=', $user->id);
          }
      ]
      )->find($input['postId']);
      
      
      foreach($post['comments'] as $comment)
      {
        if(isset($comment['votes']) && isset($comment['votes'][0]))
        {
          $value = $comment['votes'][0]['value'];
          $comment['userVote'] = isset($votes[$value]) ? $votes[$value] : "invalid";
        }
        else
        {
          $comment['userVote'] = 'neutral';
        }
        
        unset($comment['votes']);
      }
      
      if(isset($post['poll']['responses'][0]))
      {
        $post['userResponse'] = $post['poll']['responses'][0]['value'];
        unset($post['poll']['responses']);
      }
      else
      {
        $post['userResponse'] = 0;
      }
      
      
    }
    else
    {
      $post = Post::with('comments')->find($input['postId']);
    }
    
    if(!$post)
    {
      $output['success'] = false;
      $output['reasons'] = ['No such post'];  
    }
    else
    {  
      $output['post'] = $post;
      $output['success'] = true;
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
      
      if(is_null($post))
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
       
        $vote = $post->votes()->where('user_id', '=', $user->id)->first();
        
        $voteOld = 0;
        
        if(is_null($vote))
        {
          $vote = new Vote;
          $vote->user_id = $user->id;
          $vote->vote_id = $post->id;          
        }

        $voteOld = $vote->value;
        
        $vote->value = $dir;
        $post->votes()->save($vote);
        
        $post->increment('voteCount', $dir + ($voteOld * -1));
        
        $output['success'] = true;

      }
    }
	}
	
	protected function postList($input, &$output)
  {
    $output['success'] = true;
    
    $location = $input['lat'] . ',' . $input['lng'];
    $dist = 0.15;
    
    if(Auth::check())
    {
      $posts = Post::with(
      ['votes' => function($query)
        {
          $user = Auth::User();
          $query->where('user_id', '=', $user->id);
        }
      ])->whereRaw('st_distance(location,POINT('.$location.')) < '.$dist)->get();

      $this->votesToStatus($posts); 
      $this->postsAddOwnership($posts);     

    }
    else
    {
      // This is the case where a user is not logged in.
      // Eventually we will not allow unauthed users to view posts
      $posts = Post::all();
    }
    
    $output['posts'] = $posts;
  }
  
	protected function postListSelf($input, &$output)
  { 
    if(Auth::check())
    {
      $user = Auth::User();
    
      $posts = $user->posts()->with(
      ['votes' => function($query)
        {
          $user = Auth::User();
          $query->where('user_id', '=', $user->id);
        }
      ])->get();

      $this->votesToStatus($posts);     
      
      $output['success'] = true; 
      
      $this->postsAddOwnership($posts);
      
      $output['posts'] = $posts;

    }
    else
    {
      
      $output['success'] = false;
      $output['reasons'] = ['Not authenticated'];  
    }
    

  }
  
  protected function votesToStatus(&$posts)
  {
    $votes = ['-1' => 'down', 0 => 'neutral', 1 => 'up'];
  
    foreach($posts as $post)
    {
      if(isset($post['votes']) && isset($post['votes'][0]))
      {
        $value = $post['votes'][0]['value'];
        $post['userVote'] = isset($votes[$value]) ? $votes[$value] : "invalid";
      }
      else
      {
        $post['userVote'] = 'neutral';
      }
      
      unset($post['votes']);
    }
  }

  protected function postsAddOwnership(&$posts)
  {
    $user = Auth::User();
    
    if(!is_null($user))
    {
      foreach($posts as $post)
      {
        if($post->user_id == $user->id)
        {
          $post->ownedByUser = true;
        }
        else
        {
          $post->ownedByUser = false;
        }
      }
    }
  }

	protected function postCommentVote($input, &$output)
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
      $comment = Comment::find($input['commentId']);
      
      if(is_null($comment))
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
        
        $vote = $comment->votes()->firstOrCreate(
          [
            'user_id' => $user->id,
            'comment_id' => $comment->id
          ]
          );

        $voteOld = $vote->value;
        
        $vote->value = $dir;
        $vote->save();
        
        $comment->increment('voteCount', $dir + ($voteOld * -1));
        
        $output['success'] = true;

      }
    }
	}
	
	protected function postPollRespond($input, &$output)
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
      
      if(is_null($post))
      {
        $output['success'] = false;
        $output['reasons'] = ['No such post'];  
      }
      else
      {  
        
        $poll = $post->poll;
        
        if(is_null($poll))
        {
          $output['success'] = false;
          $output['reasons'] = ['No such poll'];
        }
        else
        {
        
          $selection = intval($input['selection']);
          
          if($selection > $poll->optionCount)
          {
            $output['success'] = false;
            $output['reasons'] = ['No such option'];
          }
          else
          {
        
            $response = $poll->responses()->firstOrCreate(
              [
                'user_id' => $user->id,
                'poll_id' => $poll->id
              ]
              );
            
            $selectionOld = $response->value;
            
            $response->value = $selection;
            $response->save();
            
            if($selection != 0)
            {
              $poll->increment('option' . $selection . 'Count', 1);
            }
            
            if($selectionOld != 0)
            {
              $poll->decrement('option' . $selectionOld . 'Count', 1);
            }
            
            $output['success'] = true;
          
          }
        
        }

      }
      
    }
 
	}

}

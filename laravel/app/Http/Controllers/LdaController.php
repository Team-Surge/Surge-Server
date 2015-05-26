<?php namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Vote;
use App\Models\Poll;
use \Hash;
use Auth;

class LdaController extends ReqController {
	
	protected $rules = 
	[
	  'ldaTopics' =>
  	  [
        'content' => 'required|string|max:200',
      ],
	];
	
  protected $validActions = [
	  "ldaTopics"
  ];
  
  protected $authActions = [
	  "ldaTopics"
  ];

	protected function ldaTopics($input, &$output)
	{
    
	}

}

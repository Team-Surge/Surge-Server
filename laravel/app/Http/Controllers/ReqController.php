<?php namespace App\Http\Controllers;

use \Request;
use \Validator;

class ReqController extends Controller {

  /*
    This is a generic request controller:
    Please extend this controller by defining an array of action-named rules
    for validating requests, as well as the action-named functions which
    respond to requests.. Functions take $input and &$output. Please 
    modify $output before returning.
    
    Please also define $validActions, to validate requested actions.
    
  */

	public function process()
	{
	  $input = Request::all();
	  
	  $output = [];
	  $output['action'] = $input['action'];
	  
	  if(!in_array($input['action'], $this->validActions))
	  {
      $output['success'] = false;
      $output['reasons'] = ['No such action']; 
	  }
	  
	  $valid = $this->reqValidate($input, $output, $input['action']);
	  
    if($valid)
    {
      if(method_exists($this, $input['action']))
      {
        $this->$input['action']($input, $output);
      }
      else
      {
        $output['success'] = false;
        $output['reasons'] = ['No such method ' . $input['action']];
      }
    }
	
		return json_encode($output);
	}
	
	private function reqValidate($input, &$output, $rule)
	{
	  // If there are no rules, return true.
	  if(!isset($this->rules[$rule]))
	  {
	    return true;
	  }
	
	  $validator = Validator::make(
      $input,
      $this->rules[$rule]
      );
      
    if($validator->fails())
    {
	    $output['success'] = false;
	    $output['reasons'] = $validator->messages();
	    return false;
    }
    else
    {
      return true;
    }
    
	}

}

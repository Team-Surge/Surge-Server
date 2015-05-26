<?php namespace App\Helpers;

class Lda {

  static public function topics($input)
  {
	  $command = "python " . app_path() . "/lda/lda2.py load " . escapeshellarg($input);
	  $output = [];
	  $result = 0;
	
	
	  echo $command;
    exec($command, $output, $result);
    
    if($result != 0)
    {
      return false;
    }
    else
    {
      return $output;
    }
  }

}

<?php namespace App\Helpers;

class Lda {

  static public function topics($input)
  {
	  $command = "python " . app_path() . "/lda/lda2.py load " . escapeshellarg($input);
	  $output = [];
	  $result = 0;
	  
    exec($command, $output, $result);
    
    array_shift($output);
    
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

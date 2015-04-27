<?php namespace App\Http\Controllers;

use \View;

class TestController extends Controller {

	public function index()
	{
	  $data = [];
	  $data['tests'] = $this->getTests();
	
		return view('test', $data);
	}

  protected function getTests()
  {
    $path = base_path() . "/resources/views/test";
    
    $output = "";
    
    $tests = [];
    
    if(!is_dir($path))
    {
      return $path;
    }
    
    $files = array_diff(scandir($path), ['.', '..']);
    
    foreach($files as $dir)
    {
      $subpath = $path . '/' . $dir;
    
      if(! is_dir($subpath) )
      {
        continue;
      }
      
      $views = array_diff(scandir($subpath), ['.', '..']);
      
      $tests[$dir] = [];
    
      foreach($views as $view)
      {
        $viewName = 'test' . '.' . $dir . '.' . basename($view, '.blade.php');
        
        if(View::exists($viewName))
        {
          $output .= $viewName . ", ";
          
          $tests[$dir][] = $viewName;
          
        }
        
      }
      
    }
    
    return $tests;

  }

}

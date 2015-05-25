<?php namespace App\Helpers;

use \Exception;

class Chat {

  public function __construct()
  {
    $this->connected = $this->connect();
  }

  protected function connect()
  {
    $hostname = "localhost";
    $port = 8000;
    $errno = 0;
    $errstr = "";
    $timeout = 2;
    
    try
    {
      $result = $this->socket = pfsockopen ($hostname, $port, $errno, $errstr, $timeout);
    }
    catch(Exception $e)
    {
      return false;
    }
    
    if($this->connNew())
    {
      return $this->auth();
    }
    
    return true;
  }
  
  protected function connNew()
  {
    return (ftell($this->socket) === 0);
  }
  
  protected function auth()
  {    
    $message = [
    "clientType" => "surgeserver",
    "messageType" => "connectRequest",
    ];
    
    $result = $this->write($message);
    
    if($result)
    {
      $data = $this->read();
      
      $result = $this->write($this->createResponse($data->challengeToken));
      
      $data = $this->read();
      
      if($data->messageType == "OK")
      {
        return true;
      }
      else
      {
        return false;
      }
      
    }
    else
    {
       return false;
    }
    
  }
  
  protected function createResponse($challenge)
  {
    $key = 'My AES Key bitch';
    
    $key_size =  strlen($key);
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
  
    $token = mcrypt_encrypt ( MCRYPT_RIJNDAEL_128 , $key , $challenge , MCRYPT_MODE_CBC, $iv );
  
    return [
      'clientType' => 'surgeserver',
      'messageType' => 'challengeResponse',
      'responseToken' => base64_encode($token),
      'responseIV' => base64_encode($iv),
    ];
  }

  protected function write($message)
  {
    return fwrite($this->socket, json_encode($message));
  }
  
  protected function read()
  {
    return json_decode(fgets($this->socket));
  }
  
  public function send($sender, $receivers, $message)
  {
    if(!$this->connected)
    {
      return false;
    }
    
    $data = [
    'clientType' => 'surgeserver',
    'messageType' => 'chat',
    'senderID' => $sender,
    'recipientID' => $receivers,
    'message' => json_encode($message)
    ];
    
    $this->write($data);
  }

}

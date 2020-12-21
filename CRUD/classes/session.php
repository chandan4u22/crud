<?php
class Session{
  public function __construct(){
  if (session_status() == PHP_SESSION_NONE){
    session_start();
  }
  }
  public function set($key,$value){
    $_SESSION[$key] = $value;
  }
  public function get($key){
    return $this->has($key) ? $_SESSION[$key] : '';
}
public function has($key){
  return isset($_SESSION[$key]);
}
public function remove($key){
  if ($this->has($key)){
    unset($_SESSION[$key]);
  }
}
public function destroy(){
  session_unset();
  session_destroy();
}
}
 ?>

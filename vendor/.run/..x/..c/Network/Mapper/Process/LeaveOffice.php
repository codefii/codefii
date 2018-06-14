<?php
namespace Network\Mapper\Process;
use Network\{
  Location\Redirect,
  Session\Session
};

class LeaveOffice{
  public function __construct(){
    $session= new Session();
    if($session->isRegistered()){
      $session->kill();
      Redirect::to('/admin/login');
    }
  }

}

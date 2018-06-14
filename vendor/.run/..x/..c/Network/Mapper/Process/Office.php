<?php
namespace Network\Mapper\Process;
use Network\{
  Location\Redirect,
  Session\Session,
  Mapper\Process\Model\Adder

};

class Office{
  /**
   * [__construct description]
   */
   public $session_id,$route_value,$session_start,$post;
  public function __construct(){
    $this->session_start = new Session();
    $this->session_id = $this->session_start->get("codefiiAdmin");
    if(!$this->session_start->isRegistered()){
      Redirect::to('/admin/login');
    }
    if(empty($this->session_id)){
      Redirect::to('/admin/login');
    }
  }
  protected function getNamespace()
  {
    $namespace = 'Codefii\Models\\';
    return $namespace;
  }
  public function getCurrentAdmin(){
    return $this->session_id;
  }
  public function validator(){
    if($this->session_start->isRegistered()){
      return TRUE;
    }
  }
  public function getPost($param){
    $this->post = $param;
    $user = new Adder();
    $data = $user->dispenseByTable("{$param}")->All();
    return $data;
  }
}

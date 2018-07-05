<?php
namespace Codefii\Mapper\Process;
use Codefii\Http\Response;
use Codefii\Session\Session;
use  Codefii\Mapper\Process\Model\Admin;
use Codefii\Controllers\Controller;
class Office {
  /**
   * [__construct description]
   */
  public static function Strict(){
    $admin = new Admin();
    $admin->start();
    if(!$admin->isLoggedIn()){
      Response::redirect('/admin/login');
    }else{
      echo Session::get('codefiiAdmin');
    }
  }
   public $session_id,$route_value,$session_start,$post;
  protected function getNamespace()
  {
    $namespace = 'Codefii\Models\\';
    return $namespace;
  }
  public function getPost($param){
    $this->post = $param;
    $user = new Admin();
    $data = $user->selectAllFrom("{$param}")->all();
    return $data;
  }
}

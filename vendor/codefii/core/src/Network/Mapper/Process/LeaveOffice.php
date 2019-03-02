<?php
namespace Codefii\Mapper\Process;

  use Codefii\Http\Response;
  use Codefii\Session\Session;
  use Codefii\Mapper\Process\Model\Admin;

class LeaveOffice{
  public function __construct(){
  $admin = new Admin();
  $admin->logout();
  }

}

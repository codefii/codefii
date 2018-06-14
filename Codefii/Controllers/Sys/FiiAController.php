<?php
namespace Codefii\Controllers\Sys;
use Network\Controller\Controller;
use Network\View\View;
use Network\Mapper\Process\Runner;
use Network\Mapper\Process\Office;
use Network\Mapper\Process\LeaveOffice;
use Network\Mapper\Process\Logger;
use Network\Mapper\ModelValidator\ModelValidator;
use Network\ORM\Fiirm;
class FiiAController extends Controller {
  public function loginAction(){
    new Logger();
    View::render("System/Admin/header/header");
    View::render("System/Admin/landing/index");
  }
  public function addUser(){
    new Runner();
    View::render("System/Admin/header/header");
    View::render("System/Admin/landing/signup",['error'=>Runner::filter(),
    "signuperror"=>Runner::signupError()]);
  }
  public function baseOffice(){
    $office= new Office();
    $FiiA= new ModelValidator();
    View::render("System/Admin/header/header",['AdminSession'=>$office->validator()]);
    View::render("System/Admin/office/home",['data'=>$FiiA->getDatas()]);
  }
  public function exitOffice(){
   new LeaveOffice();

  }
}

<?php
namespace App\Controllers\Sys;
use App\Controllers\Controller;
use Codefii\View\View;
use Codefii\Mapper\Process\Runner;
use Codefii\Mapper\Process\Office;
use Codefii\Mapper\Process\LeaveOffice;
use Codefii\Mapper\Process\Logger;
use Codefii\Mapper\ModelValidator\ModelValidator;
use Codefii\Http\Response;
use  Codefii\Session\Session;
use Codefii\Checker\SessionChecker;
class FiiAController extends Controller {
  public function login(){
  new Logger();
    View::render("System/Admin/header/Initial");
    View::render("System/Admin/landing/login");
  }
  public function addUser(){
    new Runner();
    View::render("System/Admin/header/header");
    View::render("System/Admin/landing/signup",['error'=>Runner::filter(),
    "signuperror"=>Runner::signupError()]);
  }
  public function baseOffice(){
    $FiiA = new ModelValidator();
    View::render("System/Admin/header/header");
    View::render("System/Admin/office/home",['data'=>$FiiA->getDatas()]);
  }
  public function exitOffice(){
   new LeaveOffice();
  }
  final public function ready(){
  View::render('System/Admin/landing/ready');
  }
}

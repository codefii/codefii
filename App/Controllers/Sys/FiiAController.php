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
    View::render("System/Admin/landing/login",['value'=>Logger::filter()]);
  }
  public function addUser(){
    new Runner();
    Office::AuthorisedUser();
    View::render("System/Admin/header/header",['value'=>Office::getSessionName()]);
    View::render("System/Admin/landing/signup",['error'=>Runner::filter(),
    "signuperror"=>Runner::signupError()]);
  }
  public function baseOffice(){
    $FiiA = new ModelValidator();
    Office::AuthorisedUser();
    View::render("System/Admin/header/header",['value'=>Office::getSessionName()]);
    View::render("System/Admin/office/home",['data'=>$FiiA->getDatas()]);
  }
  public function exitOffice(){
   Office::unAuthorise();  
 }
  final public function ready(){
  View::render('System/Admin/landing/ready');
  }
}

<?php
namespace Codefii\Mapper\Process;
use App\Controllers\Sys\FiiAController;
use Codefii\Mapper\Process\Model\Admin;
use Codefii\Http\Request;
use Codefii\Validation\Validation;
use Codefii\Http\Response;
use Codefii\Session\Session;
class Logger extends FiiAController {
  /**
   * @param login admin
   */
    public $username;
     public static $errors,
                   $signupError;
  public function __construct(){
    if(Request::exists()){
      $validation = new Validation();
      $validation->validate($_POST,array(
        'email'=>array(
            'required'=>true
        ),
        'password'=>array(
          'required'=>true
        )
      ));

      if($validation->passes()){
        $Admin = new Admin();
        $Admin->start();
        $Admin->setSessionName("codefiiAdmin");
        $Admin->login(["email"=>Request::get('email')],Request::get('password'));
        if($Admin->isLoggedIn()){
          Response::redirect('/admin');
        }
      }else{
          self::$errors = $validation->errors();
      }

    }

  }
  public static function filter(){
    return self::$errors;
  }
}

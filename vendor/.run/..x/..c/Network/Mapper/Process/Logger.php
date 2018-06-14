<?php
namespace Network\Mapper\Process;
use Codefii\Controllers\Sys\FiiAController;
use Network\Mapper\Process\Model\Adder;
use Network\Request\Request;
use Network\Validation\Validation;
use Network\ORM\Auth;
use Network\Location\Redirect;
use Network\Session\Session;
class Logger extends FiiAController {
  /**
   * @param login admin
   */
    public $username;
     public static $errors,
                   $signupError;
  public function __construct(){
    $session = new Session();
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
        $adder = new Adder();
        $adder->loginUsing(["email"=>Request::get('email'),"password"=>Request::get('password')]);
        if($adder->isLoggedIn){
          $AdminData = $adder->dispense()->where(['email'=>Request::get('email')])->All();
          foreach($AdminData as $data){
            if($data->email == Request::get('email')){
              $session->set('codefiiAdmin',$data->username);
              $session->register();
              if($session->isRegistered()){
                  Redirect::to("/admin");
              }
            }
          }
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

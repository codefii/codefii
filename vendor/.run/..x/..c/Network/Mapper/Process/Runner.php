<?php
namespace Network\Mapper\Process;
use Network\Request\Request;
use Codefii\Controllers\Sys\FiiAController;
use Network\Validation\Validation;
use Network\View\View;
use Network\Mapper\Process\Model\Adder;
use Network\Location\Redirect;
use Network\Hash\Hash;
use Network\Hash\RandomKey;
use Network\Session\Session;

 class Runner extends FiiAController{

  public static $errors,
                $signupError;
  public function __construct(){
    if(Request::exists()){
      $validation = new Validation();
      $validation->validate($_POST,array(
        "full_name"=>array(
          "required"=>true
        ),
        "email"=>array(
          "required"=>true,
          "max"=>200
        ),
        "password"=>array(
          "required"=>true,
          "min"=>6,
        ),
        "confirm_password"=>array(
          "required"=>true,
          "matches"=>"password",
          "min"=>6
        )
      ));
      if($validation->passes()){
          $adder = new Adder();
          $salt = Hash::salt(32);
          $user_data = $adder->dispense()->where(["email"=>Request::get('email')])->All();
          if(empty($user_data)){
            $adder->create([Request::get('full_name'),Request::get('email'),
            $salt,Hash::make(Request::get('password'),$salt)]);
            if($adder->isAdded){
              Redirect::to('login');
            }
          }else{
            foreach($user_data as $account){
                if($account->email == Request::get('email')){
                  self::$signupError = "<div class='error'>Admin with this emailalready exists</div>";
                }else{
                    $adder->create([Request::get('full_name'),Request::get('email'),
                    $salt,Hash::make(Request::get('password'),$salt)]);
                    if($adder->isAdded){
                      Redirect::to('login');
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
  public static function signupError(){
    return self::$signupError;
  }
}

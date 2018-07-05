<?php
namespace Codefii\Mapper\Process;
use Codefii\Http\Request;
use App\Controllers\Sys\FiiAController;
use Codefii\Validation\Validation;
use Codefii\View\View;
use Codefii\Mapper\Process\Model\Admin;
use Codefii\Location\Redirect;
use Codefii\Hash\Hash;
use Codefii\Hash\RandomKey;
use Codefii\Session\Session;

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
          $Admin = new Admin();
          $salt = Hash::salt(32);
          $user_data = $Admin->dispense()->where(["email"=>Request::get('email')])->All();
          if(empty($user_data)){
            $Admin->create([Request::get('full_name'),Request::get('email'),
            $salt,Hash::make(Request::get('password'),$salt)]);
            if($Admin->isAdded){
              Redirect::to('login');
            }
          }else{
            foreach($user_data as $account){
                if($account->email == Request::get('email')){
                  self::$signupError = "<div class='error'>Admin with this emailalready exists</div>";
                }else{
                    $Admin->create([Request::get('full_name'),Request::get('email'),
                    $salt,Hash::make(Request::get('password'),$salt)]);
                    if($Admin->isAdded){
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

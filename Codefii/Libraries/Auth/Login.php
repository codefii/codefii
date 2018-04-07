<?php
/**
  * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Codefii\Libraries\Auth;
use Network\Model\Model;
use Network\Hash\Hash;
use Network\Session\Session;
class Login{
   public static $_loggedIn;
    public static function auth($user)
    {
        if(is_numeric($user)){
           Model::getDb()->get('id',array(//change the params to any params of your choice
            'username',"=",$user//modify this
        ));
        return true;
        }else{
        Model::getDb()->get('users',array(
            'username',"=",$user//modify this

        ));
        return true;
        }
    return false;
    }
    public static function data(){
      $get = Model::getDb()->query("SELECT * FROM users")->results();//change the table name

    }
    public static function process($username=null,$password=null){
        $user = Login::auth($username);
        if($user){
        $data = Model::getDb()->query("SELECT * FROM users")->results();//change the table name
        foreach($data  as $dat){
            if($dat->password === Hash::make($password,$dat->salt)){
            return self::$_loggedIn = true;

            }
        }
        }
        return false;
    }
}

<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Network\ORM;
use Network\Hash\Hash;
use Network\ORM\Fiirm;
class Auth extends Hash {
  public $isLoggedIn=false;
  public function loginUsing($params=array()){
      $keys = array_keys($params);
      $values= array_values($params);
      $user_data = $this->dispense()->where([$keys[0]=>$values[0]])->All();
      foreach($user_data as $account){
        if($account->password ==Hash::make($values[1],$account->salt)){
          $this->isLoggedIn =TRUE;
        }
      }
      return  $this;

  }
  public function returnLogIn(){
    return $this->isLoggedIn;
}

}

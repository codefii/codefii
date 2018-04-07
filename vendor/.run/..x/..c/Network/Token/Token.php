<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Network\Token;
use Network\Session\Session;
use Codefii\Database\Config\Config;

class Token
{
  public static function generate()
  {
    return Session::put(Config::get('session/token_name'),sha1(uniqid()));
  }
  public static function check($token)
  {
    $tokenName = Config::get('session/token_name');

    if(Session::exists($tokenName) && $token === Session::get($tokenName))
    {
      Session::delete($tokenName);
      return true;
    }
    return false;
  }
}

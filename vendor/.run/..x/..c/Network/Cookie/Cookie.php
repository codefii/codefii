<?php
/**
  * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Network\Cookie;
class Cookie{

  public static function exists($name)
  {
    return (isset($_COOKIE[$name])) ? true : false;
  }

  public static function get($name)
  {
    return $_COOKIE[$name];

  }
  public static function put($name,$value,$expiry)
  {
    if(setcookie($name,$value,time() + $expiry, '/'))
    {
      return true;
    }
    return false;
  }
  public static function delete($name)
  {
    self::put($name, '', time() - 1);
  }
}

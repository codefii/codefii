<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Codefii\Session;
class Session
{
  public static function init(){
      session_start();
  }
    public static function exists($name)
       {
         return (isset($_SESSION[$name])) ? true : false;
       }
       public static function set($name,$value)
       {
         return $_SESSION[$name] = $value;
       }
       public static function delete($name)
       {
         if(self::exists($name))
         {
           unset($_SESSION[$name]);
         }
       }
       public static function get($name)
       {
         return $_SESSION[$name];
       }
       //this function flashes error messages
       public static function flash($name,$string='')
       {
         if(self::exists($name))
         {
           $session = self::get($name);
           self::delete($name);
           return $session;
         }
         else {
           self::put($name,$string);
         }
         return '';
       }
}

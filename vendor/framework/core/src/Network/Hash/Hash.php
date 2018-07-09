<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Codefii\Hash;

class Hash
{
  public static function make($string,$salt)
  {
    return hash('sha256',$string.$salt);
  }
  public static function salt($length)//generate a salt of a particular length
  {
     $characters = sha1(md5(uniqid()));
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  public static function unique()
  {
    return self::make(base64_encode(openssl_random_pseudo_bytes(50)));

  }


}

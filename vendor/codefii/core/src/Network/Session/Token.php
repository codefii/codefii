<?php
namespace Codefii\Session;
use Codefii\Session\Session;
use Codefii\Session\PathGetter;
class Token
{
  public static function generate()
  {
  	$session = new Session();
  	$token = md5(uniqid());
  	$session->set(PathGetter::get('session/csrf_token'),$token);
    return $token;
  }
  public static function check($token)
  {
  	$session = new Session();
    $tokenName = PathGetter::get('session/csrf_token');
    if($session->exists($tokenName) || $token === $session->get($tokenName))
    {
      $session->delete($tokenName);
      return true;
    }
    return false;
  }
}
<?php
namespace Codefii\Http;
use Codefii\Http\HttpInterfaces\RedirectInterface;
final class Redirect implements RedirectInterface
{
  public static $header =  array(
		'Content-Type: text/html; charset=utf-8'
	);

  public static function to(string $url,int $status =302){
   header('Location: ' . str_replace(array('&amp;', "\n", "\r"), 
   array('&', '', ''), $url), true, $status);
		exit();
  }
  public static function back():string{
    return header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
  public static function getHeader(){
    return self::$header;
  }
}

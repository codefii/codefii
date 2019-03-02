<?php
namespace Codefii\Http;
use Codefii\Http\Input;
use App\Http\HttpInterfaces\RequestInterface;
class Request
{
  protected static $fileName, $fileMoved=false;
  public static function exists($type='post')
  {
    switch($type){
      case 'post':
      return (!empty($_POST)) ? true :false;
      break;
      case 'get':
      return (!empty($_GET)) ? true :false;
      break;
      default:
      return false;
      break;

    }

  }
  public static function get($item)
  {
    if(isset($_POST[$item]))
    {
      return htmlentities(htmlspecialchars($_POST[$item]),ENT_QUOTES,'UTF-8');
    }else{
      return htmlentities(htmlspecialchars($_GET[$item]),ENT_QUOTES,'UTF-8');
    }
    return '';
  }
 
}

<?php
namespace Codefii\Session;
class PathGetter
{
public static function get($path=null)
  {
    if($path)
    {
      $config = include($_SERVER['DOCUMENT_ROOT']."/config/session.php");
      $path = explode('/',$path);
      foreach ($path as $bit)
      {
        if(isset($config[$bit]))
        {
          $config = $config[$bit];
        }
      }
      return $config;
    }
    return false;
  }
}
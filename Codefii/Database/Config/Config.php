<?php
/*
MIT License

Copyright (c) 2018 Prince E. Darlington <?ekeminyd@gmail.com?>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
namespace Codefii\Database\Config;

session_start();
$GLOBALS['config'] =  array(
  'mysql'=>array(
    'host'=>'localhost',
    'username'=>'root',
    'password'=>'prince',
    'database'=>'codefi',
    'encoding' => 'utf8',
    'timezone' => 'UTC',
    'cacheMetadata' => true,
    'log' => false,

  ),
  'remember'=>array(
    'cookie_name'=>'hash',
    'cookie_expiry'=>604800
  ),
  'session'=>array(
    'session_name'=>'user',
    'token_name'=>'token'
  )
);

class Config

{
public static function get($path=null)
  {
    if($path)
    {
      $config = $GLOBALS['config'];
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

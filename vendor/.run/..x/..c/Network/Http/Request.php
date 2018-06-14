<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
  namespace Network\Request;
  class Request
  {
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
        return $_POST[$item];
      }else{
        return $_GET[$item];
      }
      return '';//return an empty string
    }
    public static function getParam($param = array()){
      return $param;
    }

}

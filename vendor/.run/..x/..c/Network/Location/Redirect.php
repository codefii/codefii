<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Network\Location;

final class Redirect
{
  protected static $with=null;
  public function __construct(){
    ob_start();
  }
  public  function to($url,$param=array()){

        if(count($param)==1){
          foreach($param as $param_key=>$param_value){
            if(!headers_sent()) {
              header("Location:".$url."/".urlencode($param_value), TRUE, 302);
              exit;
            }
            exit('<meta http-equiv="refresh" content="0; url='.$url."/".urlencode($param_value).'"/>');
          }
        }else if(count($param)== 0 || empty(count($param))){
          if(!headers_sent()) {
            header("Location:".$url, TRUE, 302);
            exit;
          }
          exit('<meta http-equiv="refresh" content="0; url='.$url.'"/>');
        }
  }
}

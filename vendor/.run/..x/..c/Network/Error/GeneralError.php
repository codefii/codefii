<?php
/**
  * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
 namespace Network\Error;

 abstract class GeneralError{
     public static function getWhiteScreenError(){
       error_reporting(E_ALL & ~E_STRICT);
        ini_set('display_errors', TRUE);
         ini_set('html_errors', 0);
         error_reporting(-1);
     }
 }

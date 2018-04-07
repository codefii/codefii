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

 class Redirect
{
  public static function to($location=null)
  {
    if($location)
    {
      if(is_string($location))
      {
        try{
            header('Location:'.$location);
           exit();
            throw new RuntimeException();

        }catch(LogicExcception $e){
            die($e->getMessage());
        }finally{
            header('Location:'.$location);
            exit();
        }
      }
    }
  }
}

<?php
namespace Codefii\Errors;
use Codefii\View\View;
abstract class Error {
    public static function rase(String $message=null){
       return View::render('System/Errors',['error'=>$message]);
    }
}








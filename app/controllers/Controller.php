<?php

namespace App\Controllers;
use Codefii\Controller\BaseController;
abstract class Controller extends BaseController
{
  public function __construct(){
    //add or register your header and footer here
    //public function __construct(){
      // $this->setHeader("foldername/filename");
      // $this->setFooter("foldername/filename");

  }
}

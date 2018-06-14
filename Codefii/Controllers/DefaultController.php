<?php
namespace Codefii\Controllers;
use Network\Controller\Controller;
use Network\View\View;
use Network\Registers\Mappers;

class DefaultController extends Controller {
  public function index()
  {
    $dotenv = new \Dotenv\Dotenv("../");
    $dotenv->load();

    echo $_ENV['SECRET_KEY'];
  }

}

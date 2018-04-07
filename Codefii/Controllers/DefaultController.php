<?php
namespace Codefii\Controllers;
use Network\Controller\Controller;
use Network\View\View;
class DefaultController extends Controller {
  public function index()
  {
    View::render('Default/default');
    View::render('footer/footer');
  }
}

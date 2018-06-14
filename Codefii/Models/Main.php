<?php
namespace Codefii\Models;
use Network\ORM\Fiirm;
use Network\ORM\Auth;
class Main extends Fiirm {
  protected $table ="books";
  public $columns = array("bookname","title");
}

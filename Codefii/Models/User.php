<?php
namespace Codefii\Models;
use Network\ORM\Fiirm;
use Network\ORM\Auth;
class User extends Fiirm {
  protected $table ="users";
  public $columns = array("full_name","email","salt","password");
}

<?php
namespace Codefii\Mapper\Process\Model;
use Codefii\Entity\Auth\FiiAuth;
use Codefii\Hash\Hash;
class Admin extends FiiAuth {
  public $table = 'admin';
  protected $pk  = 'id';
  public $columns =["username","full_name","email","salt","password"];

}

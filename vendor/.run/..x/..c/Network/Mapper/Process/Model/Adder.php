<?php
namespace Network\Mapper\Process\Model;
use Network\ORM\Fiirm;
class Adder extends Fiirm {
  protected $table = 'admin';
  public $columns = array('full_name','email','salt','password');
}

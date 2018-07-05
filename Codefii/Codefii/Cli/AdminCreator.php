<?php
namespace Codefii\Cli;
use Codefii\Entity\Model;
class AdminCreator extends Model{
  public $table ='simple';
  public function createUser(){

   $this->addTable("CREATE TABLE yam(
      id INT(6) AUTO_INCREMENT PRIMARY KEY,
      firstname VARCHAR(30) NOT NULL,
      lastname VARCHAR(30) NOT NULL
    )");
  }
}

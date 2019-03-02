<?php
namespace App\Models;
use Codefii\Entity\orm\Fiirm;
class Admin extends Fiirm{
    public $pk = "id";
    public $table ='admin';
    public $columns = ["username","email","salt","password"];
    // public function createUser(){
    //     return $this->addTable("
    //     CREATE TABLE IF NOT EXISTS contackkkt (
    //         id INTEGER PRIMARY KEY, 
    //         name TEXT, 
    //         email TEXT 
    //     );");
    // }
}

?>
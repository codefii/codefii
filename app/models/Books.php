<?php
namespace App\Models;
use Codefii\Entity\orm\Fiirm;
class Books extends Fiirm{
    // public $pk = "id";
    public $columns = ["bookname","title","author"];
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
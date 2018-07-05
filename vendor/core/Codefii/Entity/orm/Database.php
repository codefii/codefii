<?php

namespace Codefii\Entity\Orm;
use \PDO;
abstract class Database
{
    protected   $conn;
    /*
    * create database connection
    */
    public function __construct()
    {
        try{
            $dotenv = new \Dotenv\Dotenv("../");
          $dotenv->load();
          $this->conn = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      }catch(PDOEXception $e){
          die($e->getMessage());
      }
    }
}

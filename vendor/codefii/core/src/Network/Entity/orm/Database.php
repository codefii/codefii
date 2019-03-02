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
            $dotenv = new \Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT']);
          $dotenv->load();
          switch ($_ENV['DB_CONNECTION']) {
            case 'mysql':
            $this->conn = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

              break;

            case 'pgsql':
           $this->conn = new PDO('pgsql:host='.$_ENV['DB_HOST'].''.$_ENV['DB_PORT'].'dbname='.$_ENV['DB_DATABASE'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            break;
            default:
              //leave empty
              break;
          }

      }catch(PDOEXception $e){
          die($e->getMessage());
      }
    }
}

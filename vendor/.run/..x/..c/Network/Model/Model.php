<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
 namespace Network\Model;
  use Codefii\Database\Config\Config;
 use Network\Auth\Auth;
 use PDO;
class Model
{
  private static $_instance = null;
  public $_pdo,
          $_errors=false,
          $_count=0,
          $_results,
          $_data,
          $_rowCount,
          $_query;
  public function __construct()
  {
  try{
    $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/database'),Config::get('mysql/username'),Config::get('mysql/password'));

    $this->_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e)
  {
    die($e->getMessage());
  }
  }


  public static function getDb()
  {
    if(!isset(self::$_instance))
    {
      self::$_instance = new Model();
    }
    return self::$_instance;
  }
  //generic query method

  public function query($sql,$params=array())
  {
    $this->_error = false;
    if($this->_query = $this->_pdo->prepare($sql))
    {
        $x =1;
        if(count($params))
        {
          foreach($params as $param){
            $this->_query->bindValue($x,$param);
            $x++;
          }

        }
        if($this->_query->execute())
        {
          $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
          $this->_count   = $this->_query->rowCount();
        }else {
          $this->_error = true;
        }
    }
    return $this;
  }

  //database acction
  public function action($action,$table,$where =array())
  {
    if(count($where)===3)
    {
      $operators = array('=','<','>','<=','>=');
      $field     =$where[0];
      $operator  =$where[1];
      $value     =$where[2];
      //check if the operator  is inside the array
      if(in_array($operator,$operators))
      {
        $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

        if(!$this->query($sql,array($value))->error())
        {
          return $this;
        }
      }
    }
    return false;
  }
  //get records function
  public function find($table,$where)
  {
    return $this->action('SELECT *',$table,$where);
  }
  public function hasMany($table=array(),$id){
    if(count($table)==2){
      $table1 = $table[0];
      $table2 = $table[1];
      $sql = "SELECT * FROM {$table1} LEFT JOIN {$table2} ON {$table1}.id ={$table2}.id WHERE {$table1}.id = {$id} ";
      if(!$this->query($sql)->error())
      {
        return $this;
      }
    }
  }
  // public function queryWithoutParams($sql){
  //     $this->_error = false;
  //   if($this->_query = $this->_pdo->prepare($sql))
  //   {
  //       }
  //       if($this->_query->execute())
  //       {
  //         $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
  //         $this->_count   = $this->_query->rowCount();
  //       }else {
  //         $this->_error = true;
  //     }
  //     return $this;
  // }
  //delete records



  public function delete($table,$where)
  {
    return $this->action('DELETE',$table,$where);
  }
  //insert method
  public function insertInTo($table,$fields=array())
  {
      $keys = array_keys($fields);
      $values = null;
      $x =1;//this is a counter
      foreach($fields as $field)
      {
          $values .='?';
        if($x < count($fields))
        {
          $values .=',';
        }
        $x++;
    }
    $sql ="INSERT INTO {$table} (`".implode('`,`',$keys)."`) VALUES({$values})";
    echo "  ";
      if(!$this->query($sql,$fields)->error())
      {
        return true;
      }
    return false;
  }
  //update records
  public function update($table,$id,$fields)
  {
    $inputs ='';
    $x =1;
    foreach ($fields as $name=>$value)
    {
      $inputs .="{$name} =?";
      if($x < count($fields))
      {
        $inputs .=',';
      }
      $x++;
    }
    $sql ="UPDATE {$table} SET {$inputs} WHERE id={$id}";
    echo "  ";
      if(!$this->query($sql,$fields)->error())
      {
        return true;
      }
    return false;
  }



  //the error function
  public function error()
  {
    return $this->_error;
  }

  //count
  public function count()
  {
    return $this->_count;
  }
  public function results()
  {
    return $this->_results;
  }
  public function first()
  {
    return $this->results()[0];
  }
}

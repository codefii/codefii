<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
 namespace Network\ORM;
use Network\ORM\Auth;
 use PDO;
 class Fiirm extends Auth{
     protected $table,$_error=false;
     public  $columns= array();
     protected $_relation,
               $_relationTable;
     private $_pdo,
             $create,
             $_errors=false,
             $_count=0,
             $_results,
             $_data,$_sql,
             $_rowCount,
             $_query,$id;
      public $isAdded = false;
  public function __construct()
  {
  try{
    $dotenv = new \Dotenv\Dotenv("../");
    $dotenv->load();
    $this->_pdo = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);
    $this->_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $e)
      {
        die($e->getMessage());
      }
      if(empty($this->table)){
        $this->table = strtolower(get_called_class());
      }else{
        return $this->table;
      }
  }
  public function first()
  {
  return $this->All()[0];
  }
  public function error(){
    return $this->_error;
  }
  public function count(){
  return $this->_count ;
  }
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

      }else {
        $this->_error = true;
      }
  }
  return $this;
  }

  public function create($fields=array()){
  $keys = $this->columns;
  $values = null;
  $x =1;
  foreach($fields as $field)
  {
    $values .='?';
  if($x < count($fields) && $x<count($keys))
  {
    $values .=',';
  }
  $x++;
  }
  $sql ="INSERT INTO {$this->table} (`".implode('`,`',$keys)."`) VALUES({$values})";
  if(!$this->query($sql,$fields)->error())
  {
  $this->isAdded = true;
  return true;
  }

  return false;
  }

  public function action($action,$where =array())
  {
  if(count($where)===3)
  {
  $operators = array('=','<','>','<=','>=');
  $field     =$where[0];
  $operator  =$where[1];
  $value     =$where[2];
  if(in_array($operator,$operators))
  {
    $sql = "{$action} FROM {$this->table} WHERE {$field} {$operator} ?";

    if(!$this->query($sql,array($value))->error())
    {
      return $this;
    }
  }
  }
  return false;
  }
  public function deleteById($id){
  return $this->action("DELETE",array("id","=","{$id}"));
  }
  public function dispense(){
  $this->_sql ="SELECT * FROM {$this->table}";
  if($this->_query = $this->_pdo->prepare($this->_sql))
  {
  return $this;
  }
  }
  public function dispenseByTable($table){
  $this->_sql ="SELECT * FROM {$table}";
  if($this->_query = $this->_pdo->prepare($this->_sql))
  {
  return $this;
  }
  }
  public function orderBy($column, $order) {
  if(!empty($this->_sql)){
    $this->_sql.=" ORDER BY {$column} {$order}";
    $this->_relation.=" ORDER BY {$column} {$order}";

    if(($this->_query = $this->_pdo->prepare($this->_sql)) || ( $this->_query = $this->_pdo->prepare($this->_relation)))
    {
      return $this;
    }
  }
  }
  public function where($values){
  if(is_array($values)){
  foreach($values as $value=>$key){
    if(!empty($this->_sql)){
      $this->_sql.=" WHERE {$value} = '{$key}'";
      if($this->_query = $this->_pdo->prepare($this->_sql))
      {
        return $this;
      }
    }

  }
  }
  }
  public function relatedTo($table){
  $this->_relationTable = $table;
  $this->_relation ="SELECT * FROM {$this->table} LEFT JOIN {$table}";
  if($this->_query = $this->_pdo->prepare($this->_relation))
  {
  return $this;
  }
  }
  public function with($fields){
  if(is_array($fields)){
   if(count($fields)==2){
    $columnOfTable1 = $fields[0];
    $columnOfTable2 = $fields[1];
    if(!empty($this->_relation)){
      $this->_relation.=" ON {$this->table}.{$columnOfTable1}= {$this->_relationTable}.{$columnOfTable2}";
      if($this->_query = $this->_pdo->prepare($this->_relation))
      {
        return $this;
      }
    }
  }
  }
  }

  public function findById($id){
  return $this->action('SELECT *',array("id","=","{$id}"));
  }


  public function All()
  {
  if($this->_query->execute())
  {

    $this->_count   =$this->_query->rowCount();
  }
  return $this->_query->fetchAll(PDO::FETCH_OBJ);

  }
  public function adminAll(){
    if($this->_query->execute()){
      return $this->_query->fetchAll(PDO::FETCH_COLUMN,1);
    }
  }

  public function returnAdded(){
    return $this->isAdded;
  }
  }

<?php

namespace Codefii\Entity\Orm;

use Codefii\Entity\Orm\Database;
use \PDO;

abstract class Fiirm extends Database
{
    private $stmt;
    public $data = array();
    private $sql=[];
    private $where;
    public  $columns= array();
    private $fields;
    private $count;
    private $fetch;
    private $lastId;
    private $limit;
    private $belongsTo;
    private $joinType;
    private $_errors=false;

    public function __construct()
    {
        parent::__construct();
        self::setTable();
        self::setPrimaryKey();
        // $this->data = $m;
    }

    private function setTable()
    {
        if (!isset($this->table)) {
            $modelName = (new \ReflectionClass($this))->getShortName();
            $this->table = strtolower($modelName);
        }
    }

    private function setPrimaryKey()
    {
        if ( ! isset($this->pk)) {
            $this->pk = 'id';
        }
    }

    private function param($data = null)
    {
        if (empty($data)) {
            $data = $this->data['conditions'];
        }

        foreach ($data as $k => $v) {
            $tipo = (is_int($v)) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $this->stmt->bindValue(":{$k}", $v, $tipo);
        }
    }

    private function fields($data = null)
    {
        if (empty($data) && isset($this->data['fields'])) {
            return implode(',', $this->data['fields']);
        }

        if ( ! empty($data)) {
            if(count($this->columns)==count($data)){
                foreach ($this->columns as $k) {
                    $fields[] = $k;
                }
            }
            return implode(',', $fields);
        }

        return '*';
    }

    private function conditions($separator)
    {
        $param = [];
        foreach ($this->data['conditions'] as $k => $v) {
            $param[] = "{$k} = :{$k}";
        }

        return implode($separator, $param);
    }

    private function where()
    {
        return $this->where = (isset($this->data['conditions']))
                 ? 'WHERE ' . self::conditions(' AND ')
                : '';
    }
    public function withWhere($values){
        if(is_array($values)){
            foreach($values as $value=>$key){
              if(!empty($this->sql)){
                $this->sql.=" WHERE {$value} = '{$key}'";
                if($this->stmt = $this->conn->prepare($this->sql))
                {
                  return $this;
                }
              }

            }
        }
    }

    public function find()
    {
        $this->sql = "SELECT " . self::fields() . " FROM {$this->table} " . self::where();

        $this->stmt = $this->conn->prepare($this->sql);

        if ( ! empty($this->where)) {
            self::param();
        }
        $this->stmt->execute();
        return $this;
    }

    public function all(){
        if($this->stmt->execute()){
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    public function orderBy(string $orderBy,string $order){
        if($this->stmt->execute()){
            $this->sql .= " ORDER BY ".$orderBy." ".$order." ";
            $this->stmt =  $this->conn->prepare($this->sql);
            return $this;

        }
    }
    public function limit($limit)
    {
        if($this->stmt->execute()){
        // $this->limit = $limit;
        $this->sql .= " LIMIT {$limit} ";
        $this->stmt= $this->conn->prepare($this->sql);
        return $this;
        }
    }

    public function relatedTo(array $values,string $table=null,string $joinType=null){
        if(count($values)==1){
            foreach($values as $key=>$value){
            $this->sql =" SELECT * FROM users LEFT JOIN books ON users.username=books.author";
            if($this->stmt= $this->conn->prepare($this->sql)){
                return $this;
            }
            }
        }

    }
    public function select(){
        $this->sql =" SELECT * FROM";
        $this->stmt= $this->conn->prepare($this->sql);
        return $this;
    }
    public function selectAllFrom($table){
        $this->sql =" SELECT * FROM  {$table}";
        $this->stmt= $this->conn->prepare($this->sql);
        return $this;
    }

    private function values()
    {
        foreach ($this->data as $k => $v) {
            $values[] = ":{$k}";
        }

        return implode(',', $values);
    }

    private function insertQueryString()
    {
        $fields = self::fields($this->data);
        $values = self::values();

        return "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";
    }

    private function updateWhere($data)
    {
        $this->data['conditions'] = [$this->pk => $data[$this->pk]];
        $where = 'WHERE ' . self::conditions('');
        unset($data[$this->pk]);

        return $where;
    }

    private function updateQueryString($data)
    {
        $this->data['conditions'] = $data;
        $fields = self::conditions(',');

        return "UPDATE {$this->table} SET {$fields} {$this->where}";
    }

    public function findAll($data = null)
    {
        $this->data = $data;
        return $this->find()
                    ->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findOne($data)
    {
        $this->data['conditions'] = $data;
        return $this->fetch = $this->find()
                                    ->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findById($id)
    {
        return self::findOne([$this->pk => $id]);
    }
    public function findBy(array $id){
        if(count($id)==1){
            foreach($id as $key=>$value){
            return self::findOne([$key => $value]);
            }
        }
    }

    public function exists($id)
    {
        if (is_array($id)) {
            return (self::findOne($id));
        }

        return (self::findById($id));
    }

    public function fetch()
    {
        return $this->fetch;
    }

    public function lastSavedId()
    {
        $id = $this->conn->lastInsertId();
        return ($id) ? $id : $this->lastId;
    }

    public function query($sql)
    {
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute();
        $result      = $this->stmt->fetchAll(PDO::FETCH_OBJ);
        $this->count = count($result);

        return $result;
    }
    public function addTable($sql){

        return  $this->conn->exec($sql);
    }
    public function save($data)
    {
        if (array_key_exists($this->pk, $data)) {
            $this->count = $this->findOne([$this->pk => $data[$this->pk]]);
            $this->lastId = $data[$this->pk];
        }

        if ( ! empty($this->count)) {
            return $this->update($data);
        }

        return $this->create($data);
    }

    public function update($data)
    {
        if ( ! array_key_exists($this->pk, $data)) {
            return false;
        }

        $param       = $data;
        $this->where = self::updateWhere($data);
        $this->stmt  = $this->conn->prepare(self::updateQueryString($data));
        self::param($param);
        $this->stmt->execute();
        $this->count = $this->stmt->rowCount();
    }

    public function create($data=array())
    {
        $this->data = $data;
        $this->stmt = $this->conn->prepare(self::insertQueryString());
        self::param($data);

        $this->stmt->execute();
        $this->count = $this->stmt->rowCount();
    }
    protected function queryBinder($sql,$params=array())
    {
    $this->_error = false;
    if($this->query = $this->conn->prepare($sql))
    {
        $x =1;
        if(count($params))
        {
          foreach($params as $param){
            $this->query->bindValue($x,$param);
            $x++;
          }
        }
        if($this->query->execute())
        {

        }else {
          $this->_error = true;
        }
    }
    return $this;
    }

      public function createArray($fields){
        $keys = $this->columns;
        if(is_array($fields)){
            $count=0;
            $inputs ='';
            foreach($fields as $field){
              foreach($field as $key=>$value){
                $count++;
                    $inputs .= "?";
                    if($count <count($field))
                    {
                      $inputs .=",";
                    }
              }
              $sql ="INSERT INTO {$this->table} (`".implode('`,`',$keys)."`) VALUES({$inputs})";
              if(!$this->queryBinder($sql,$field)->error())
              {
              $this->isAdded = true;
              return true;
              }
            }
            return false;
        }

    }

    public function error(){
      return $this->_error;
    }

    public function delete($data)
    {
        $this->data['conditions'] = $data;

        $sql = "DELETE FROM {$this->table} " . self::where();
        $this->stmt = $this->conn->prepare($sql);

        if ( ! empty($this->where)) {
            self::param();
        }

        $this->stmt->execute();
        $this->count = $this->stmt->rowCount();
    }

}

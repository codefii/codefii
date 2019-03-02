<?php
namespace Codefii\Mapper\ModelValidator;
  use App\Controllers\Sys\Posts;
class ModelValidator{

  public $datas = array(),$newParams,  $columns=array(),$models,$modelTable,$isDeleted=false;
  public function __construct(){
    if(file_exists("App/registers/Register.php")){
      require 'App/registers/Register.php';
      foreach($Registers as $register=>$key){
        if(class_exists($this->getNamespace().$register)){
          $controller = $this->getNamespace().$register;
          $this->datas = $Registers;
            $controller_object = new $controller($Registers);
        }else{
          echo "Model {$register} not found";
        }
      }
    }
    $this->getDatas();
  }
  protected function getNamespace()
  {
    $namespace = 'App\Models\\';
    return $namespace;
  }
  public function getDatas(){
    return $this->datas;
  }
  public function getColumnNames($names = array()){
    $this->columns = $names;
  }
  public function getColumns(){
      return $this->columns;
  }
  public function getModel($param){
    if(file_exists("App/registers/Register.php")){
      require 'App/registers/Register.php';
      foreach($Registers as $register=>$key){
        if(class_exists($this->getNamespace().$register)){
          $controller = $this->getNamespace().$register;
          $this->datas = $Registers;
          if(strpos($register,$param) !==false){
            $controller_object = new $controller($Registers);
            $this->models = $param;
            $this->getColumnNames($controller_object->columns);
          }

        }else{
          echo "Model {$register} not found";
        }
      }
    }
  }
  public function returnModel(){
    return $this->models;
  }
  public function setModelTable($table,$id){
    if(file_exists("App/registers/Register.php")){
      require 'App/registers/Register.php';
      foreach($Registers as $register=>$key){
        if(class_exists($this->getNamespace().$register)){
          $controller = $this->getNamespace().$register;
          if(strpos($key,$table) !==false){
            $controller_object = new $controller($Registers);
            $this->modelTable = $controller_object->table;
            $controller_object->delete(['id'=>$id]);
            $this->isdeleted =true;
          }

        }
      }
    }
  }
  public function getModelTable(){
    return $this->modelTable;
  }
}

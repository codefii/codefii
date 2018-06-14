<?php
namespace Network\Mapper\ModelValidator;
  use Codefii\Controllers\Sys\Posts;
class ModelValidator{

  public $datas = array(),$newParams,  $columns=array();
  public function __construct(){
    if(file_exists("../Codefii/Registers/Register.php")){
      require '../Codefii/Registers/Register.php';
      foreach($Registers as $register=>$key){
        if(class_exists($this->getNamespace().$register)){
          $controller = $this->getNamespace().$register;
          $this->datas = $Registers;
            $controller_object = new $controller($Registers);

              $this->getColumnNames($controller_object->columns);

        }else{
          echo "Model {$register} not found";
        }
      }
    }
    $this->getDatas();
  }
  protected function getNamespace()
  {
    $namespace = 'Codefii\Models\\';
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

}

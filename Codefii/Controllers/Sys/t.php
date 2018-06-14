
<?php
include("../Codefii/Registers/Register.php");
foreach($files as $file=>$key){
  if(file_exists("..".DIRECTORY_SEPARATOR."Codefii/Models/".$file.".php")){

?>
<h1><?php echo "<a href='baseOffice/$file'>{$key}</a>"; ?></h1>
<?php

}else{
  echo "{$file} does not exists";
}
}

?>

// foreach($GLOBALS['models'] as $value=>$key){
//   // $contoller = $this->params = $name;
//   if(count($value)==count($key)){
//     $controller = $this->getNamespace() .$value;
//     if (class_exists($controller)) {
//         $controller_object = new $controller($value);
//         $controller_object = $this->dispenseByTable("$key")->adminAll();
//         return $controller_object;
//       }
//   }
// }

}
protected function getNamespace()
{
  $namespace = 'Codefii\Models\\';
  return $namespace;
}
public function Gho(){
$controller_object = $this->dispenseByTable("$key")->adminAll();
foreach($controller_object as $row=>$p){
  echo "Records from".$value."s\t Model"."<a href='".urlencode($p)."'>{$p}</a>"."<hr />";
}
}
}

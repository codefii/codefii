<?php
/**
 * Codefii PHP Framework https:///codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Codefii\Libraries;
use Network\Model\Model;
class Pagination {
  public $pages,$db,$table;
  public function results($table,$max){
    $db = Model::getDb();
    $this->table  = $table;
    $this->pages = $max;
    $page = $_GET["page"];
   if($page==" "|| $page==1){
     $page1=0;
   }else{
     $page1 = ($page*$max)-$max;
   }
   if($page==0){
    $page1 -= ($page*$max)-$max;//if it has nagative sign, multiple through by -ve to have +ve
   }
    $data = $db->query("SELECT * FROM {$table} limit $page1,$max ");
    return $data;
  }
  public function paginate(){
    $table = $this->table;
    $db = Model::getDb();
    $data= $db->query("SELECT * FROM {$table}")->count();
      $k = $data/$this->pages;
      $k = ceil($k);
      for($b=1; $b<=$k; $b++){
      ?><a  href="/new-framework/page=<?php echo $b; ?>"><?php echo $b." "; ?></a><?php
      }
  }
}

<?php
namespace Codefii\Controller;
use Codefii\Controller\BaseController;
class Template extends BaseController{
	protected $add_file;
	protected $path;
	public function __construct(){

	}
	public function setPath(string $file){
	
		$GLOBALS['path'] = $file;

	}
	public function getTemp(){
		$path = $GLOBALS['path'];
		 if(is_readable($this->template_path."$path".".php")){
	       if(isset($GLOBALS['magic'])){
	          extract($GLOBALS['magic'], EXTR_SKIP | EXTR_REFS);
	      		  }
	      		  
      return require_once($this->template_path."$path".".php");
		     }
	}
}
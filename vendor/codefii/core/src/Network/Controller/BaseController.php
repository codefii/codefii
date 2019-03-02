<?php
namespace Codefii\Controller;
use Codefii\FileReader;
use Codefii\View\View;
use Codefii\Controller\Template;
use Codefii\Session\Session;

abstract class BaseController
{
    
    protected $middleware = [];

     protected $route_params = [];

    protected $template_path ="app/templates/";

    protected $layout_path ="app/templates/layouts/";

    public   $global_view;
    public $session;
    protected $set_template;

    protected $view_data = array();
    public $components =  [];
    public function __construct(){
        foreach($this->components as $component){
           $comp =$this->getNamespace().ucfirst($component)."Component";
           if(class_exists($comp)){
            // echo $this- 
           }
        }
          $this->session  = new Session();
        
    }
   

    public function getNamespace(){
        return "\App\Controllers\Components\\";
    }
    final protected function view($view,$data=[])
    {
       if(is_array($view)){
            $paths_values  = array_values($view);

      $this->view_data = $data;

      $GLOBALS['magic'] = $data;
      
      $template = new Template();
      
      if($view !==NULL){
      
        $this->set_template = $paths_values[0];
      
        $template->setPath($paths_values[0]);
         if(!file_exists($this->layout_path)){

        return Error::raise([
            "404"=>"No base file found in <b>apps/templates/layouts</b>"]);
        }else{
           if(empty($paths_values[1])){
               $this->setFileName('base');
           }else{
               $this->setFileName("{$paths_values[1]}");
            
           }
        }   

        }
       }else{

      $this->view_data = $data;

      $GLOBALS['magic'] = $data;
      
      $template = new Template();
      
      if($view !==NULL){
      
        $this->set_template = $view;
      
        $template->setPath($view);
         if(!file_exists($this->layout_path)){

        return Error::raise([
            "404"=>"No base file found in <b>apps/templates/layouts</b>"]);
        }else{
           if(empty($base)){
               $this->setFileName('base');
           }else{
               $this->setFileName("{$base}");
           }
        }

        }
       }
    }
    public function setFileName($file){
      $this->global_view = $file;
      if(is_readable($this->layout_path."{$file}".".php")){
        if(isset($this->view_data)){
          extract($this->view_data, EXTR_SKIP | EXTR_REFS);
        }
      return require_once($this->layout_path."{$file}".".php");
     }
      
  }
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new ControllerMiddlewareOptions($options);
    }

    public function getMiddleware()
    {
        return $this->middleware;
    }

   
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    public function __call($method, $parameters)
    {
        echo "Method [{$method}] does not exist on [".get_class($this).'].';
    }

  }
  
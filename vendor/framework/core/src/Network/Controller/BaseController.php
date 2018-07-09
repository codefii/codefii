<?php

namespace Codefii\Controller;

use Codefii\Http\Response;
use Codefii\Support\Porter;
/**
 * Controller parent
 */
use BadMethodCallException;
class BaseController
{
    private $layout;

        public $header,$footer;
     protected $export,$partials;

    protected $middleware = [];

    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
      // $n = new BaseView();
        $this->route_params = $route_params;
    }
    public function __call($name, $args)
  {
      $method = $name . 'Action';

      if (method_exists($this, $method)) {
          if ($this->before() !== false) {
              call_user_func_array([$this, $method], $args);
              $this->after();
          }
      } else {
          return $this->View('System/notfound',["error"=>
          "Method $method not found in controller " . get_class($this)]);
      }
  }

  /**
   * Before filter - called before an action method.
   *
   * @return void
   */
  protected function before()
  {
  }

  /**
   * After filter - called after an action method.
   *
   * @return void
   */
  protected function after()
  {
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

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }


    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }


    final protected function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    final protected function view($params,$data = [])
    {
          if(is_array($params)){
            if(count($params)==2){
              for($i=1; $i<count($params); $i++){
                extract($data, EXTR_SKIP);
              $file = "../App/templates/".$params[0].".php";
              if (is_readable($file)) {
                require_once "../App/templates/".$params[1].".php";
                $this->getHeader();
                  require_once $file;
                    $this->getFooter();
              }
            }
          }
        } else {
            echo $file."not found";
        }
        exit();
    }

    public function setHeader($header){
      $this->header = $header;
    }
    public function setFooter($footer){
        $this->footer = $footer;
      }
    public function getHeader(){
      return require "../App/templates/".$this->header.".php";
    }
    public function getFooter(){
      return require "../App/templates/".$this->footer.".php";
    }
    public function url($link){
      if(!empty($link)){
        if(is_array($link)){
          if(count($link)==1){
            foreach($link as $url=>$value){
              return "<a href='/$url'>".$value."</a>";
            }
          }
        }
      }
    }
    final protected function header(string $content, string $type = null)
    {
        Response::header($content, $type);
    }

}

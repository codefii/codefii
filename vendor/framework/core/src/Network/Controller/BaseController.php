<?php

namespace Codefii\Controller;

use Codefii\Http\Response;
use Codefii\Support\Porter;
/**
 * Controller parent
 */
use BadMethodCallException;
abstract class BaseController
{
    private $layout;
    public $datas =[];

     protected $export;

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
          echo "Method $method not found in controller " . get_class($this);
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

    //
    // public function __call($method, $parameters)
    // {
    //     throw new BadMethodCallException("Method [{$method}] does not
    //      exist on [".get_class($this).'].');
    // }



    final protected function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    final protected function view(string $file, array $data = [])
    {
        extract($data, EXTR_SKIP);

        $file = "../App/templates/$file.php";
        if (is_readable($file)) {
            require_once $file;
        } else {
            echo $file."not found";
        }
        exit();
    }


    final protected function header(string $content, string $type = null)
    {
        Response::header($content, $type);
    }

}

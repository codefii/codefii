<?php

namespace Codefii\Http;
use Codefii\View\View;
class Router
{
    
    protected $afterRoutes = array();
   
    protected $beforeRoutes = array();
    
    protected $notFoundCallback;
   
    protected $baseRoute = '';
   
    protected $requestedMethod = '';
   
    protected $serverBasePath;
   
    protected $namespace = '';
    
    public function before($methods, $pattern,$function)
    {
        $pattern = $this->baseRoute.'/'.trim($pattern, '/');
        $pattern = $this->baseRoute ? rtrim($pattern, '/') : $pattern;
        foreach (explode('|', $methods) as $method) {
            $this->beforeRoutes[$method][] = array(
                'pattern' => $pattern,
                'function' => $function,
            );
        }
        // return $pattern;
    }

    public function match($methods, $pattern, $function)
    {
        $pattern = $this->baseRoute.'/'.trim($pattern, '/');
        $pattern = $this->baseRoute ? rtrim($pattern, '/') : $pattern;
        foreach (explode('|', $methods) as $method) {
            $this->afterRoutes[$method][] = array(
                'pattern' => $pattern,
                'function' => $function,
            );
        }
    }
 
    public function all($pattern, $function)
    {
        $this->match('GET|POST|PUT|DELETE|OPTIONS|PATCH|HEAD', $pattern, $function);
    }
   
    public function get($pattern, $function)
    {
        $this->match('GET', $pattern, $function);
    }
  
    public function post($pattern, $function)
    {
        $this->match('POST', $pattern, $function);
    }
 
    public function patch($pattern, $function)
    {
        $this->match('PATCH', $pattern, $function);
    }
   
    public function delete($pattern, $function)
    {
        $this->match('DELETE', $pattern, $function);
    }

    public function put($pattern, $function)
    {
        $this->match('PUT', $pattern, $function);
    }
 
    public function options($pattern, $function)
    {
        $this->match('OPTIONS', $pattern, $function);
    }
   
    public function mount($baseRoute, $function)
    {
        // Track current base route
        $curBaseRoute = $this->baseRoute;
        // Build new base route string
        $this->baseRoute .= $baseRoute;
        // Call the callable
        call_user_func($function);
        // Restore original base route
        $this->baseRoute = $curBaseRoute;
    }
    /**
     * Get all request headers.
     *
     * @return array The request headers
     */
    public function getRequestHeaders()
    {
        $headers = array();
        // If getallheaders() is available, use that
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            // getallheaders() can return false if something went wrong
            if ($headers !== false) {
                return $headers;
            }
        }
        // Method getallheaders() not available or went wrong: manually extract 'm
        foreach ($_SERVER as $name => $value) {
            if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH')) {
                $headers[str_replace(array(' ', 'Http'), array('-', 'HTTP'), ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
  
    public function getRequestMethod()
    {
        // Take the method as found in $_SERVER
        $method = $_SERVER['REQUEST_METHOD'];
        // If it's a HEAD request override it to being GET and prevent any output, as per HTTP Specification
        // @url http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4
        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_start();
            $method = 'GET';
        } // If it's a POST request, check for a method override header
        elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $headers = $this->getRequestHeaders();
            if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], array('PUT', 'DELETE', 'PATCH'))) {
                $method = $headers['X-HTTP-Method-Override'];
            }
        }
        return $method;
    }
 
    public function setNamespace($namespace)
    {
        if (is_string($namespace)) {
            $this->namespace = $namespace;
        }
    }

    public function getNamespace()
    {
        return $this->namespace;
    }
   
    public function run($callback = null)
    {
        // Define which method we need to handle
        $this->requestedMethod = $this->getRequestMethod();
        // Handle all before middlewares
        if (isset($this->beforeRoutes[$this->requestedMethod])) {
            $this->handle($this->beforeRoutes[$this->requestedMethod]);
        }
        // Handle all routes
        $numHandled = 0;
        if (isset($this->afterRoutes[$this->requestedMethod])) {
            $numHandled = $this->handle($this->afterRoutes[$this->requestedMethod], true);
        }
        // If no route was handled, trigger the 404 (if any)
        if ($numHandled === 0) {
            if ($this->notFoundCallback) {
                $this->invoke($this->notFoundCallback);
            } else {
                // header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
                //    $error ="Controller class $class not found";
                View::render('System.Errors',['error'=>"No route found"]);
            }
        } // If a route was handled, perform the finish callback (if any)
        else {
            if ($callback && is_callable($callback)) {
                $callback();
            }
        }
        // If it originally was a HEAD request, clean up after ourselves by emptying the output buffer
        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_end_clean();
        }
        // Return true if a route was handled, false otherwise
        return $numHandled !== 0;
    }
  
    public function set404($function)
    {
        $this->notFoundCallback = $function;
    }
    
    private function handle($routes, $quitAfterRun = false)
    {
        // Counter to keep track of the number of routes we've handled
        $numHandled = 0;
        // The current page URL
        $uri = $this->getCurrentUri();
        // Loop all routes
        foreach ($routes as $route) {
            // Replace all curly braces matches {} into word patterns (like Laravel)
            $route['pattern'] = preg_replace('/{([A-Za-z]*?)}/', '(\w+)', $route['pattern']);
            // we have a match!
            if (preg_match_all('#^'.$route['pattern'].'$#', $uri, $matches, PREG_OFFSET_CAPTURE)) {
                // Rework matches to only contain the matches, not the orig string
                $matches = array_slice($matches, 1);
                // Extract the matched URL parameters (and only the parameters)
                $params = array_map(function ($match, $index) use ($matches) {
                    // We have a following parameter: take the substring from the current param position until the next one's position (thank you PREG_OFFSET_CAPTURE)
                    if (isset($matches[$index + 1]) && isset($matches[$index + 1][0]) && is_array($matches[$index + 1][0])) {
                        return trim(substr($match[0][0], 0, $matches[$index + 1][0][1] - $match[0][1]), '/');
                    } // We have no following parameters: return the whole lot
                    else {
                        return isset($match[0][0]) ? trim($match[0][0], '/') : null;
                    }
                }, $matches, array_keys($matches));
                // Call the handling function with the URL parameters if the desired input is callable
                $this->invoke($route['function'], $params);
                ++$numHandled;
                // If we need to quit, then quit
                if ($quitAfterRun) {
                    break;
                }
            }
            
        }
        // Return the number of routes handled
        return $numHandled;
    }
    private function invoke($function, $params = array()) {
        if (is_callable($function)) {
            call_user_func_array($function, $params);
        } // If not, check the existence of special parameters
        elseif (stripos($function, '.') !== false) {
            // Explode segments of given route
            list($controller, $method) = explode('.', $function);
            // Adjust controller class if namespace has been set
            if ($this->getNamespace() !== '') {
                $controller = $this->getNamespace().'\\'.$controller."Controller";
            }
            // Check if class exists, if not just ignore and check if the class exists on the default namespace
            if (class_exists($controller)) {
                // First check if is a static method, directly trying to invoke it.
                // If isn't a valid static method, we will try as a normal method invocation.
                if (call_user_func_array(array(new $controller(), $method), $params) === false) {
                    // Try to call the method as an non-static method. (the if does nothing, only avoids the notice)
                    if (forward_static_call_array(array($controller, $method), $params) === false);
                }
            }else{
                echo "Controller doesn't exist";
            }
        }
    }

    protected function getCurrentUri()
    {
        // Get the current Request URI and remove rewrite base path from it (= allows one to run the router in a sub folder)
        $uri = substr($_SERVER['REQUEST_URI'], strlen($this->getBasePath()));
        // Don't take query params into account on the URL
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        // Remove trailing slash + enforce a slash at the start
        return '/'.trim($uri, '/');
    }
    /**
     * Return server base Path, and define it if isn't defined.
     *
     * @return string
     */
    protected function getBasePath()
    {
        // Check if server base path is defined, if not define it.
        if ($this->serverBasePath === null) {
            $this->serverBasePath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
        }
        return $this->serverBasePath;
    }
}
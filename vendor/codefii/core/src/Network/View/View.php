<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Codefii\View;
/**
 * View
 *
 * PHP version 5.4
 */
class View
{
    public static $datas =[];
    public static $file;
    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public function __construct($file){

    }
    public static function render($view, $args)
    {
        if(is_callable($args)){ 
          self::$datas= $args();
        list($page,$fileName) = sizeof(explode("/", $view)) > 1 ? explode("/", $view) : explode(".", $view);
        extract(self::$datas, EXTR_SKIP);
        $file = "App/templates/$page/$fileName.php";
        if (is_readable($file)) {
            require_once $file;
        } else {
            echo $file."<h2>404 not found</h2>";
        }
        }else if(is_array($args)){
        list($page,$fileName) = sizeof(explode("/", $view)) > 1 ? explode("/", $view) : explode(".", $view);
        self::$datas = $args;
        extract($args, EXTR_SKIP);
        $file = "App/templates/$page/$fileName.php";

        if (is_readable($file)) {
            require_once $file;
        } else {
            echo $file."<h2>404 not found</h2>";
        }
        }
        
    }


}

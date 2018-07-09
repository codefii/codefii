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
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        extract(self::$datas, EXTR_SKIP);
        self::$file = "App/templates/$view.php";

        if (is_readable(self::$file)) {
            require_once require_once($_SERVER['DOCUMENT_ROOT']).$file;
        } else {
            echo self::$file."not found";
        }
    }


    /**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem('../App/templates/');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}

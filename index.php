<?php
// spl_autoload_register(function ($class) {
//     $root = dirname(__DIR__);   // get the parent directory
//     $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//     if (is_readable($file)) {
//         require $root . '/' . str_replace('\\', '/', $class) . '.php';
//     }
// });

require 'vendor/autoload.php';
require_once 'vendor/codefii/framework/src/Network/Debugger/Error.php';
        \php_error\reportErrors();
require_once 'App/Routes/Routes.php';
// var_dump(dirname(dirname(__FILE__)));
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
if ($uri !== '/' && file_exists(__DIR__.'/web'.$uri)) {
    return false;
}else{
    $router->dispatch($uri);

}

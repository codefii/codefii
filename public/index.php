<?php

require '../vendor/autoload.php';
require '../vendor/core/Codefii/Debugger/Error.php';
        \php_error\reportErrors();
require_once '../app/Routes/Routes.php';
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}else{
    $router->dispatch($uri);

}

<?php

require '../vendor/autoload.php';
require_once '../vendor/framework/core/src/Network/Debugger/Error.php';
        \php_error\reportErrors();
require_once '../App/Routes/Routes.php';
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
if ($uri !== '/' && file_exists(__DIR__.'/web'.$uri)) {
    return false;
}else{
    $router->dispatch($uri);

}

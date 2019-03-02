<?php 
$baseRoot = getcwd();
$baseLoader = require $baseRoot.'/vendor/autoload.php';
$baseLoader = require $baseRoot.'/App/routes/Routes.php';
$baseLoader = require_once 'vendor/codefii/core/src/Network/Debugger/Error.php';
        \php_error\reportErrors();
$router->run();


<?php
/**
 * [$router description]
 * @var Network
 */
$router = new Network\Router\Router();
/**
 * [$router->routes description]
 * make sure you don't start your route name with a controller
 */

$router->routes('/',['controller'=>'DefaultController','action'=>'index']);
/**
 * [$router->routes description]
 * @var [codefii default admin route]
 */
// $router->routes('{controller}/{action}');
$router->routes('/admin/login',['namespace'=>'Sys','controller'=>'FiiAController','action'=>'login']);
$router->routes('/admin/addUser',['namespace'=>'Sys','controller'=>'FiiAController','action'=>'addUser']);
$router->routes('/admin',['namespace'=>'Sys','controller'=>'FiiAController','action'=>'baseOffice']);
$router->routes('/admin/logout',['namespace'=>'Sys','controller'=>'FiiAController','action'=>'exitOffice']);
$router->routes('/admin/{controller}/{post:([a-zA-Z0-9])*}',['namespace'=>'Sys','controller'=>'Posts','action'=>'index']);
$router->routes('/admin/{controller}/{post:([a-zA-Z0-9])*}',['namespace'=>'Sys','controller'=>'AddPosts','action'=>'index']);

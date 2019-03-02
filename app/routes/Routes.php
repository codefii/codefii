<?php
/**
 * modify the router and get it working as you want
 * 
 * 
 */
$router = new Codefii\Http\Router();
$router->setNamespace('App\Controllers');
$router->before('/about','*.',function(){
    return "hello world";
});
$router->get('/','Home.index');

// $router->post('/','Home.index');
// $router->post('/','Home.index');
// $router->getallheaders()
$router->get('/about/{id}','Home.about');


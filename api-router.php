<?php
require_once './libs/Router.php';
require_once './app/controllers/exp-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('experiencies', 'GET', 'ExpApiController', 'getExps');
$router->addRoute('experiencies/:ID', 'GET', 'ExpApiController', 'getExpById');
$router->addRoute('experiencies/:ID', 'DELETE', 'ExpApiController', 'deleteExp');
$router->addRoute('experiencies', 'POST', 'ExpApiController', 'insertExp'); 
$router->addRoute('experiencies/:ID', 'PUT', 'ExpApiController', 'updateExp'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']); 
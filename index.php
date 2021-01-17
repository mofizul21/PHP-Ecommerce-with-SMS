<?php

use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteParser;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;

require_once 'vendor/autoload.php';

$router = new RouteCollector(new RouteParser());

require_once __DIR__ . '/routes.php';


$dispatcher = new Dispatcher($router->getData());

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} catch (HttpMethodNotAllowedException $e) {
    echo $e->getMessage();
    die();
} catch(HttpRouteNotFoundException $e){
    echo $e->getMessage();
    die();
}

// Print out the value returned from the dispatched function
echo $response;


<?php

use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteParser;
use Phroute\Phroute\RouteCollector;

require_once 'vendor/autoload.php';

$router = new RouteCollector(new RouteParser());

$router->get('/', function () {
    return 'This route responds to requests with the GET method at the path is okay';
});

$dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Print out the value returned from the dispatched function
echo $response;
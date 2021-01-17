<?php

$router->controller('/', App\Controllers\Frontend\HomeController::class);
$router->controller('/users', App\Controllers\Frontend\UsersController::class);
$router->controller('/dashboard', App\Controllers\Backend\DashboardController::class);

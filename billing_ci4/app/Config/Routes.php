<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('login', 'LoginController::login');
$routes->get('products', 'LoginController::fetchAllProducts');
$routes->post('fetchproduct', 'LoginController::fetchProduct');

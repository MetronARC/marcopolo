<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Login::login');
$routes->group('api', static function ($routes) {
    $routes->post('user/create', 'Users::create');
});

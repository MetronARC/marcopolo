<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'authGuard']);
$routes->get('login', 'Login::login');
$routes->post('actionlogin', 'Login::actionlogin');
$routes->get('logout', 'Login::logout');
$routes->group('api', static function ($routes) {
    $routes->post('user/create', 'Users::create');
});

// , ['filter' => 'authGuard']

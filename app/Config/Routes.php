<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'Login::login');
$routes->get('logout', 'Login::logout');
$routes->post('actionlogin', 'Login::actionlogin');


$routes->get('/', 'Home::index', ['filter' => 'authGuard']);


$routes->get('management', 'Management::index', ['filter' => 'authGuard']);


$routes->group('api', static function ($routes) {
    $routes->post('user/create', 'Users::create');
});

// , ['filter' => 'authGuard']

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'authGuard']);
$routes->get('logs', 'Logs::index');
$routes->get('login', 'Login::login');
$routes->post('actionlogin', 'Login::actionlogin');
$routes->get('logout', 'Login::logout', ['filter' => 'authGuard']);

$routes->group('api', static function ($routes) {
    $routes->post('user/create', 'Users::create');
});

$routes->group('user', static function ($routes) {
    $routes->post('create', 'Users::create');
    $routes->post('changepassword', 'Users::changepassword');
    $routes->post('delete', 'Users::delete');
    $routes->post('view', 'Users::view');
});

$routes->group('ticket', static function ($routes) {
    $routes->post('create', 'Ticket::create', ['filter' => 'authGuard']);
    $routes->post('update/engineer', 'Ticket::update_engineer', ['filter' => 'authGuard']);
    $routes->post('update/cs', 'Ticket::update_cs', ['filter' => 'authGuard']);
    $routes->get('unfinish/engineer', 'Ticket::unfinish_engineer', ['filter' => 'authGuard']);
    $routes->post('unfinish/cs', 'Ticket::unfinish_cs', ['filter' => 'authGuard']);
    $routes->post('unfinish/checking', 'Ticket::unfinish_checking', ['filter' => 'authGuard']);
    $routes->post('view', 'Ticket::view', ['filter' => 'authGuard']);
    $routes->get('stat', 'Ticket::stat', ['filter' => 'authGuard']);
});

$routes->group('parts', static function ($routes) {
    $routes->post('insert', 'Parts::insert', ['filter' => 'authGuard']);
    $routes->post('assign', 'Parts::assign', ['filter' => 'authGuard']);
    $routes->post('use', 'Parts::use', ['filter' => 'authGuard']);
    $routes->post('cancel', 'Parts::cancel', ['filter' => 'authGuard']);
});




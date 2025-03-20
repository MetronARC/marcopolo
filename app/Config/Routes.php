<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('access/(:segment)', 'Login::access/$1');
$routes->get('/', 'Home::index', ['filter' => 'authGuard']);
$routes->get('logs', 'Logs::index');
$routes->get('login', 'Login::login');
$routes->get('dashboard', 'Pages::index');
$routes->get('cs', 'Pages::ticketCS');
$routes->get('engineer', 'Pages::ticketEngineer');
$routes->get('parts', 'Pages::parts');
$routes->get('view_ticket', 'Pages::viewTicket');
$routes->post('actionlogin', 'Login::actionlogin');
$routes->get('logout', 'Login::logout', ['filter' => 'authGuard']);
$routes->post('set_view_ticket', 'Pages::setViewTicket');

$routes->group('api', static function ($routes) {
    $routes->post('user/create', 'Users::create');
});

$routes->group('user', static function ($routes) {
    $routes->get('get/(:segment)', 'Users::get/$1');
    $routes->get('getall', 'Users::getall');
    $routes->post('create', 'Users::create');
    $routes->post('changepassword', 'Users::changepassword');
    $routes->post('changetype', 'Users::changetype');
    $routes->post('delete', 'Users::delete');
    $routes->post('view', 'Users::view');
    $routes->get('getlog', 'Users::getlog');
    $routes->post('searchlog', 'Users::searchlog');
    $routes->post('validation', 'Users::validation');
});

$routes->group('ticket', static function ($routes) {
    $routes->post('create', 'Ticket::create', ['filter' => 'authGuard']);
    $routes->post('update/engineer', 'Ticket::update_engineer', ['filter' => 'authGuard']);
    $routes->post('update/cs', 'Ticket::update_cs', ['filter' => 'authGuard']);
    $routes->get('unfinish/engineer', 'Ticket::unfinish_engineer', ['filter' => 'authGuard']);
    $routes->post('unfinish/cs', 'Ticket::unfinish_cs', ['filter' => 'authGuard']);
    $routes->post('unfinish/checking', 'Ticket::unfinish_checking', ['filter' => 'authGuard']);
    $routes->get('unfinish/part', 'Ticket::unfinish_part', ['filter' => 'authGuard']);
    $routes->post('view', 'Ticket::view', ['filter' => 'authGuard']);
    $routes->get('stat', 'Ticket::stat', ['filter' => 'authGuard']);
    $routes->get('stat_device', 'Ticket::stat_device', ['filter' => 'authGuard']);
    $routes->post('stat_engineer', 'Ticket::stat_engineer', ['filter' => 'authGuard']);
    $routes->get('ticketprint/(:segment)', 'Ticket::ticketprint/$1', ['filter' => 'authGuard']);
});

$routes->group('parts', static function ($routes) {
    $routes->post('insert', 'Parts::insert', ['filter' => 'authGuard']);
    $routes->post('assign', 'Parts::assign', ['filter' => 'authGuard']);
    $routes->post('use', 'Parts::use', ['filter' => 'authGuard']);
    $routes->post('search', 'Parts::search', ['filter' => 'authGuard']);
    $routes->post('cancel', 'Parts::cancel', ['filter' => 'authGuard']);
    $routes->post('get', 'Parts::get', ['filter' => 'authGuard']);
    $routes->post('getlog', 'Parts::getlog', ['filter' => 'authGuard']);
});

$routes->group('brand', static function ($routes) {
    $routes->get('get', 'Brand::get', ['filter' => 'authGuard']);
    $routes->post('insert', 'Brand::insert', ['filter' => 'authGuard']);
    $routes->post('update', 'Brand::update', ['filter' => 'authGuard']);
    $routes->post('delete', 'Brand::delete', ['filter' => 'authGuard']);
});

$routes->group('device', static function ($routes) {
    $routes->get('get', 'Ticket::getdevice', ['filter' => 'authGuard']);
});

$routes->group('setting', static function ($routes) {
    $routes->get('/', 'Setting::index', ['filter' => 'authGuard']);
});




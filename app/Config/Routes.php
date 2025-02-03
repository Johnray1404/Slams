<?php

use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//user routes
$routes->get('/', 'Home::index');
$routes->get('/homepage', 'UserController::index');
$routes->get('/signup', 'UserController::signup');
$routes->post('/signup', 'UserController::processSignup');
$routes->get('/login', 'UserController::login');
$routes->post('/login', 'UserController::processLogin');
$routes->get('/home', 'UserController::home');



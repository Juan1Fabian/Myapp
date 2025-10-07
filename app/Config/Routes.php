<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rutas de autenticación
$routes->get('/login', 'UsuarioControllers::login');
$routes->post('/login', 'UsuarioControllers::procesarLogin');
$routes->get('/logout', 'UsuarioControllers::logout');

// Rutas protegidas
$routes->get('/dashboard', 'UsuarioControllers::dashboard');
$routes->get('/perfil', 'UsuarioControllers::perfil');

// Ruta opcional para registro
$routes->get('/registro', 'UsuarioControllers::registro');
$routes->post('/registro', 'UsuarioControllers::registro');

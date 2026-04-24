<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===================================================
// AUTH ROUTES
// ===================================================
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login', ['as' => 'login']);
$routes->post('/login', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout', ['as' => 'logout']);

// ===================================================
// ADMIN ROUTES (Dilindungi AuthFilter + AdminFilter)
// ===================================================
$routes->group('admin', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index', ['as' => 'admin.dashboard']);

    // CRUD Buku
    $routes->get('buku', 'Admin\BukuController::index', ['as' => 'admin.buku']);
    $routes->get('buku/create', 'Admin\BukuController::create', ['as' => 'admin.buku.create']);
    $routes->post('buku/store', 'Admin\BukuController::store', ['as' => 'admin.buku.store']);
    $routes->get('buku/edit/(:num)', 'Admin\BukuController::edit/$1', ['as' => 'admin.buku.edit']);
    $routes->post('buku/update/(:num)', 'Admin\BukuController::update/$1', ['as' => 'admin.buku.update']);
    $routes->get('buku/delete/(:num)', 'Admin\BukuController::delete/$1', ['as' => 'admin.buku.delete']);

    // CRUD User
    $routes->get('users', 'Admin\UserController::index', ['as' => 'admin.users']);
    $routes->get('users/create', 'Admin\UserController::create', ['as' => 'admin.users.create']);
    $routes->post('users/store', 'Admin\UserController::store', ['as' => 'admin.users.store']);
    $routes->get('users/edit/(:num)', 'Admin\UserController::edit/$1', ['as' => 'admin.users.edit']);
    $routes->post('users/update/(:num)', 'Admin\UserController::update/$1', ['as' => 'admin.users.update']);
    $routes->get('users/delete/(:num)', 'Admin\UserController::delete/$1', ['as' => 'admin.users.delete']);

    // Kelola Peminjaman
    $routes->get('pinjam', 'Admin\DashboardController::pinjam', ['as' => 'admin.pinjam']);
    $routes->get('pinjam/return/(:num)', 'Admin\DashboardController::returnBook/$1', ['as' => 'admin.pinjam.return']);
});

// ===================================================
// USER ROUTES (Dilindungi AuthFilter)
// ===================================================
$routes->group('user', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'UserDashboardController::index', ['as' => 'user.dashboard']);
    $routes->post('pinjam/(:num)', 'UserDashboardController::borrow/$1', ['as' => 'user.borrow']);
    $routes->get('history', 'UserDashboardController::history', ['as' => 'user.history']);
});

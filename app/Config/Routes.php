<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->post('/do-login', 'Auth::doLogin');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('home', 'Home::index');

    $routes->group('core', ['filter' => 'core'],  function ($routes) {
        $routes->resource('user', ['controller' => 'Core\User', 'only' => ['index', 'show', 'create', 'update', 'delete']]);
        $routes->resource('store', ['controller' => 'Core\Store', 'only' => ['index', 'show', 'create',  'update', 'delete']]);

        $routes->get('store-user', 'Core\Store::storeUser');
    });

    $routes->group('', ['filter' => 'admin'],  function ($routes) {
        $routes->resource('unit', [
            'controller' => 'Unit',
            'only' => ['index', 'create',  'update', 'delete']
        ]);
        $routes->resource('user', ['controller' => 'Core\User', 'only' => ['index', 'show', 'create', 'update', 'delete']]);
        $routes->resource('category', [
            'controller' => 'Category',
            'only' => ['index', 'create', 'update', 'delete']
        ]);
        $routes->resource('setting', [
            'controller' => 'Setting',
            'only' => ['index', 'update']
        ]);
        $routes->resource('product', [
            'controller' => 'Product',
            'only' => ['index', 'show', 'create', 'update', 'delete']
        ]);

        $routes->resource('report', [
            'controller' => 'Report',
            'only' => ['index', 'show', 'create', 'update', 'delete']
        ]);
    });

    // Transaction
    $routes->group('', ['filter' => 'sales'],  function ($routes) {
        $routes->get('product-more-zero', 'Product::ProductMoreZero');

        $routes->post('fetch-product', 'Product::fetchProduct');
        $routes->resource('cart', ['controller' => 'CartHandler', 'only' => ['create', 'delete']]);
        $routes->resource('sales', ['controller' => 'Sales', 'only' => ['index', 'create',  'delete']]);
    });
});

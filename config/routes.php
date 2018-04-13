<?php

return [
    'home' => [
        'handler' => 'App\Controllers\Controller@home',
        'path' => '/'
    ],
    'index' => [
        'handler' => 'App\Controllers\ProductController@index',
        'path' => '/products'
    ],
    'product_show' => [
        'handler' => 'App\Controllers\ProductController@show',
        'path' => '/product/{id}',
        'method' => 'GET'
    ],
    'product_create' => [
        'handler' => 'App\Controllers\ProductController@create',
        'path' => '/product',
        'method' => 'POST'
    ],
    'product_update' => [
        'handler' => 'App\Controllers\ProductController@update',
        'path' => '/product/{id}',
        'method' => 'PUT'
    ],
    'product_delete' => [
        'handler' => 'App\Controllers\ProductController@delete',
        'path' => '/product/{id}',
        'method' => 'DELETE'
    ],
];
<?php

return [
    'home' => [
        'handler' => 'App\Controllers\Controller@home',
        'path' => '/'
    ],
    // products routing
    'index' => [
        'handler' => 'App\Controllers\ProductController@index',
        'path' => '/products',
        'method' => 'GET'
    ],
    'product_show' => [
        'handler' => 'App\Controllers\ProductController@show',
        'path' => '/products/{id}',
        'method' => 'GET'
    ],
    'product_create' => [
        'handler' => 'App\Controllers\ProductController@create',
        'path' => '/products',
        'method' => 'POST',
        'acl' => ['user', 'admin']
    ],
    'product_update' => [
        'handler' => 'App\Controllers\ProductController@update',
        'path' => '/products/{id}',
        'method' => 'PUT',
        'acl' => ['user', 'admin']
    ],
    'product_delete' => [
        'handler' => 'App\Controllers\ProductController@delete',
        'path' => '/products/{id}',
        'method' => 'DELETE',
        'acl' => ['user', 'admin']
    ],
    // user's routing
    'user_login' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@login',
        'path' => '/login',
        'method' => 'POST',
        'acl' => ['guest']
    ],
    'user_register' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@register',
        'path' => '/register',
        'method' => 'POST',
        'acl' => ['guest']
    ],
    'user_logout' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@logout',
        'path' => '/logout',
        'method' => 'GET',
        'acl' => ['user', 'admin']
    ],
    // image's routing
    'image_create' => [
        'handler' => 'App\Controllers\ImageController@create',
        'path' => '/images',
        'method' => 'POST',
        'acl' => ['user', 'admin']
    ],
    'image_delete' => [
        'handler' => 'App\Controllers\ImageController@delete',
        'path' => '/images/{id}',
        'method' => 'DELETE',
        'acl' => ['user', 'admin']
    ],
    // users controller routing
    // available just for user->role == 'admin'
    'user_index' => [
        'handler' => 'App\Controllers\UserAppController@index',
        'path' => '/users',
        'method' => 'GET',
        'acl' => ['admin']
    ],
    'user_show' => [
        'handler' => 'App\Controllers\UserAppController@show',
        'path' => '/users/{id}',
        'method' => 'GET',
        'acl' => ['admin']
    ],
    'user_update' => [
        'handler' => 'App\Controllers\UserAppController@update',
        'path' => '/users/{id}',
        'method' => 'PUT',
        'acl' => ['admin']
    ]
];
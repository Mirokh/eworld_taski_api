<?php

return [
    'product' => [
        'namespace' => 'Module\Product\Controllers',
        'endpoints' => base_path('modules/product/endpoints.php'),
        'path' => base_path('modules/product')
    ],
    'cart' => [
        'namespace' => 'Module\Cart\Controllers',
        'endpoints' => base_path('modules/cart/endpoints.php'),
        'path' => base_path('modules/cart')
    ]
];

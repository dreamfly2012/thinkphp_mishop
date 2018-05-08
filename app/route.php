<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    '/admin/out' => 'admin/login/out',

    '/goods/:id' => 'goods/index',
    '/goods/add_cart' => 'goods/add_cart',
    '/cart/' => 'cart/index',
    '/cart/addproduct' => 'index/cart/addproduct',
    '/cart/delcart' => 'index/cart/delcart',
    '/search' => 'search/index',
    '/register' => 'index/users/register',
    'login/' => 'index/login/index',
    'users/out' => 'index/users/out',
    'user' => 'index/users/index',
    'user/address' => 'index/users/address',
    'user/order' => 'index/users/orders',

    'order/confirm' => 'index/order/confirm',
    'order' => 'index/order/index',
    'order/create' => 'index/order/create',

    'payment/:id' => 'index/payment/index',
];

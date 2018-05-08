<?php
//配置文件
return [
    'view_replace_str' => [
        '__Css__' => '/static/admin/css',
        '__Js__' => '/static/admin/js',
        '__Img__' => '/static/admin/images'
    ],
    'session' => [
        'auto_start'     => true,
        'expire' => 3600 * 24 * 7	/*时间长度*/
    ],
];
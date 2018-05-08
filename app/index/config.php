<?php
//配置文件
return [
	'captcha' => [
		// 验证码位数
        'length'      => 4,
        // 关闭验证码杂点
        'useNoise'    => true,
        // 图片高
        'imageH'      => 40,
        //宽
        'imageW'      =>150,
        // 验证码字体大小(px)
        'fontSize'    => 16,
        // 验证成功后是否重置        
        'reset'       => true,
        'fontttf'     => '5.ttf',
	],
];
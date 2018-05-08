<?php
/**
 * ============================================================================
 * 版权所有 2015-2018
 * 网站地址: https://www.xiaoxiang.ga
 * ----------------------------------------------------------------------------
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 本程序采用thinkphp v5.0开发
 * ============================================================================
 * Author: chiqing_85
 * Time: 2018/5/5 18:11
 */

namespace app\admin\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        ['username', 'require','用户名不能为空'],
        ['password', 'require|min:5|/^(?![0-9]+$)[0-9A-Za-z]/', '密码不能为空|密码长度不能小于6位|密码必须数字和字母组合'],
        ['__token__', 'require|max:50|token'],
    ];

    //场景验证
    protected $scene = [
        'user' => [ 'username', '__token__'],
        'pwd' => ['password','__token__'],
    ];
}
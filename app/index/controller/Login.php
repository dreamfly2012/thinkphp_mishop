<?php
/**
 * ============================================================================
 * 版权所有 2015-2018
 * 
 * ----------------------------------------------------------------------------
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 本程序采用thinkphp v5.0开发
 * ============================================================================
 * 
 * Time: 2018/4/24 22:46
 */

namespace app\index\controller;

use think\Loader;
use think\Request;

class Login extends Common
{
    public function index()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $verify = Request::instance()->param('iver');  //验证码验证

            if(!captcha_check($verify)) {

                return  jsdata(203,'验证码错误……');
            };

            $validate = Loader::validate('login');

            if(!$validate->check($data))
            {
                return jsdata(203, $validate->getError());
            }
            return model('users')->login($data);
        } else {
            return view();
        }
    }
}
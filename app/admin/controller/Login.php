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
 * Time: 2018/4/18 17:40
 */

namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Loader;
use think\Request;
use think\Session;

class Login extends Controller
{
    public function _initialize()
    {
        $MetaCopyright =  '</a> Copyright&copy; 2015 - '. date('Y',time()) . ' 版权所有';
        $this->assign('MetaCopyright', $MetaCopyright);
    }
    /**
     * title index
     * @return \think\response\View
     */
    public function index()
    {
        $this->assign('title', '后台登录');

        if(request()->isPost())
        {
            $data = input('post.');
            $verify = Request::instance()->param('iver');  //验证码验证

          if(!captcha_check($verify))
          {
                return '验证码错误！';
          };

            $validate = Loader::validate('Login');  //验证令牌及用户名和密码是否为空

            if(!$validate->check($data))
            {
                return $validate->getError();
            }

            return model('Login')->login($data);
        } else {
            return view();
        }
    }

    /**
     * Title: 退出登录
     * Notes:out
     */
    public function out()
    {
        Session::delete('user');
        $this->redirect( '/admin/login.shtml');
    }
}
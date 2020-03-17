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
 * Time: 2018/4/30 17:45
 */

namespace app\admin\controller;

use think\Loader;
use app\admin\model\User as Users;

class User extends Common
{
    /**
     * Title:修改昵称
     * Notes:userinfo
     */
    public function userinfo()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $vlistade = Loader::validate('user');

            if(!$vlistade->scene('user')->check($data))
            {
                return $vlistade->getError();
            }

            $status = new Users();
            $status = $status->userinfo($data['username']);
            return $status;
        } else {
            return view();
        }
    }

    /**
     * Title: 修改密码
     * Notes:pwd
     */
    public function pwd()
    {
        if(request()->isPost())
        {
            $data  = input('post.');
            $vlidate = Loader::validate('user');

            if(!$vlidate->scene('pwd')->check($data))
            {
                return $vlidate->getError();
            }

            $rand = mt_rand(100000,999999);    //生成随机数
            $data['password'] = md5($data['password'].$rand);
            $status =new Users();
            $status = $status-> pwd($data['password'], $rand);
            return $status;
        } else {
            return view();
        }
    }
}
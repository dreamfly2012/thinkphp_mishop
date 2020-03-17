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
 * Time: 2018/4/30 18:16
 */

namespace app\admin\model;

use think\Model;
use think\Session;

class User extends Model
{
    /**
     * Title: 修改昵称
     * Notes:userinfo
     * @param $username
     * @return array
     */
    public function userinfo($username)
    {
        $status = $this->update(['id' => session('user.id'), 'username' => $username]);

        if($status)
        {
            Session::set('user.username',$username);
            return jsdata(200,'用户名更新成功……');
        } else {
            return jsdata(203,'用户名更新失败……','');
        }
    }

    public function pwd($password, $token)
    {
        $status = $this->update(['id' => session('user.id'), 'password' => $password, 'token' => $token]);

        if($status)
        {
            return jsdata(200, '密码修改成功……');
        } else {
            return jsdata(203, '密码修改失败……');
        }
    }
}
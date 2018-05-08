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
 * Time: 2018/4/18 21:16
 */
namespace app\admin\model;

use think\Db;
use think\Model;

use think\Session;

class Login extends Model
{
    protected $table = 'user';

    public function login($data)
    {
        $user = $data['username'];

        $password = $data['password'];

        $info = Login::where('username', $user)->whereOr('email', $user)->find();

        if(empty($info))
        {
            return '帐户不存在！';

        }elseif(md5($password . $info['token']) !== $info['password'])
        {
            return '密码错误，请重新输入……';

        }else{

            if($info['status'] == false) return '该用户已冻结，禁止登录';

            Login::where('id',$info['id'])->update(array('login_time' => time(), 'login_ip' => request()->ip()));

            $user = array(
                'id' => $info['id'],
                'username' => $info['username'],
                'pic' => $info['pic']
            );

            session::set('user', $user);

            $log = array(
                'user' => $info['username'],
                'time' => time(),
                'ip' => request()->ip(),
                'location' => Getiplookup( request()->ip())
            );

           Db::name('user_log')->insert($log);

            return jsdata(200, '登录成功，正在进入系统……', '/admin/index', 2);

        }

    }


}
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
namespace app\index\model;
use think\Model;
use think\Session;
use think\Db;

class Users extends Model{
	public function login($a)
	{	
		$n = $a['username'];
		$p = $a['password'];
		$info = Users::where('username', $n)->whereOr('email', $n)->find();
		if(empty($info)) 
		{
			return jsdata(203, '帐号不存在！');
		}
		elseif(md5($p . $info['token']) !== $info['password'])
		{
			return jsdata(203, '密码错误！');
		} else if($info['status'] == 2) {
		    return jsdata(203,'该用户已经被管理员禁用，详情请询管理处……','/');
        } else {

			$this->where('id',$info['id'])->update(array('last_login_time' => time(), 'last_login_ip' => request()->ip()));

			if($info['headimgurl'] == false) {
				$info['headimgurl'] = "/index/images/user.png";
			}
			$user = array(
				'id'	=>	$info['id'],
				'username' =>$info['username'],
				'headimgurl' => $info['headimgurl']
			);
			session('users',$user);
            $log = array(
                'user' => $info['username'],
                'time' => time(),
                'ip' => request()->ip(),
                'location' => Getiplookup( request()->ip())
            );
            Db::name('user_log')->insert($log);

            $cart = new CartLogic();
            $cart->setUserId($info['id']);
            $cart->doUserLoginHandle();     //用户登录后修改购物车的操作
			return jsdata(200, '登录成功……','/');
		}
	}
}
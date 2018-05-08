<?php
namespace app\base\controller;

use app\index\model\CartLogic;
use think\Controller;
use think\Db;
use think\Session;

class Qqlogin extends Controller {

    public function index() {
        $user_nickname = Session::get('users');
        if (!empty($user_nickname)) {
            $cart = new CartLogic;
            $cart->setUserId(session('users.id'));
            $cart->doUserLoginHandle();     //用户登录后修改购物车的操作
            return '<script>window.opener.location.href = \'/\';window.close();</script>';
        } else {
            $YY_CODE_ID = $_GET['YY_CODE_ID'];
            $QQ_json = file_get_contents("http://www.cn300.cn/API/QQ/DB.php?YY_CODE_ID=" . $YY_CODE_ID);
            $QQ_json_array = json_decode($QQ_json, true);
            if (!empty($QQ_json_array['openid'])) {
                $info = Db::name('users')->where('openid', $QQ_json_array['openid'])->find();
                if ($info) {
                    $user = array(
                        'id'	=>	$info['id'],
                        'username' =>$info['nickname'],
                        'headimgurl' => $info['headimgurl']
                    );
                    session('users',$user);
                     Db::name('users')->where('id',$info['id'])->update(['last_login_time' => time(),'last_login_ip' => request()->ip()]);
                    $log = array(
                        'user' => $info['nickname'],
                        'time' => time(),
                        'ip' => request()->ip(),
                        'location' => Getiplookup( request()->ip())
                    );
                    Db::name('user_log')->insert($log);

                    $cart = new CartLogic;
                    $cart->setUserId($info['id']);
                    $cart->doUserLoginHandle();     //用户登录后修改购物车的操作

                    return '<script>window.opener.location.href = \'/\';window.close();</script>';

                } else {
                    $reg = Db::name('users')->insert(
                        [
                            'openid' => $QQ_json_array['openid'],
                            'nickname' => $QQ_json_array['Info']['nickname'],
                            'headimgurl' => $QQ_json_array['Info']['figureurl_2'],
                            'create_time' => time(),
                            'last_login_time' => time(),
                            'last_login_ip' => request()->ip() ]
                    );
                    if ($reg) {
                        $info = Db::name('users')->where('openid', $QQ_json_array['openid'])->find();
                        $user = array(
                            'id'	=>	$info['id'],
                            'username' =>$info['nickname'],
                            'headimgurl' => $info['headimgurl']
                        );
                        session('users',$user);
                        $log = array(
                            'user' => $info['nickname'],
                            'time' => time(),
                            'ip' => request()->ip(),
                            'location' => Getiplookup( request()->ip())
                        );

                        Db::name('user_log')->insert($log);
                        $cart = new CartLogic;
                        $cart->setUserId($info['id']);
                        $cart->doUserLoginHandle();     //用户登录后修改购物车的操作
                        $this->success('注册成功', '/');
                        return '<script>window.opener.location.href = \'/\';window.close();</script>';
                    } else {
                        $this->error('注册失败！', '/');
                        return '<script>window.opener.location.href = \'/\';window.close();</script>';
                    }
                }
            } else {
                $this->error('注册失败！', '/');
                return '<script>window.opener.location.href = \'/\';window.close();</script>';
            }
        }
    }
    /**
     * 退出登录
     */
    public function out() {
        Session::delete('user_id');
        Session::delete('user_nickname');
        Session::delete('user_headimgurl');
        $this->success('退出成功', '/');
    }
}

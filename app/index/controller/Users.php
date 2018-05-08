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
 * Time: 2018/4/227 21:13
 */
namespace app\index\controller;
use app\index\model\OrderGoods;
use app\index\model\Orders;
use think\Db;
use think\Loader;
use think\Request;
use think\Validate;
use think\Session;
use think\Controller;
use  app\index\model\Users as Userser;

class Users extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        action('Index/navlist');
    }

    /**
     * Title: 个人中心
     * Notes:index
     */
    public function index()
    {
        if(empty(session('users')))
        {
            $this->redirect( '/login.shtml');
        } else {
            $info = Db::name('users')->where('id', session('users.id'))->field('openid,password,token,status',true)->find();
            if($info['mobile'])
            {
                $info['mobile'] = substr_replace($info['mobile'],'********',3,6);
            }

            if($info['email'])
            {
                $info['email']  = substr_replace($info['email'],'********',2,5);
            }
            $order = new Orders();
            $order_status_0 = $order->where(['users_id' => session('users.id'), 'pay_status' => 0])->count();   //待支付的订单
            $order_status_3 = $order->where(['users_id' => session('users.id'), 'order_status' => 3])->count(); //待收货的订单
            $order_status_6 = $order->where(['users_id' => session('users.id'), 'order_status' => 6])->count(); //待评价的订单
                                                                                                                //喜欢的商品
            $this->assign('order_status_0', $order_status_0);
            $this->assign('order_status_3', $order_status_3);
            $this->assign('order_status_6', $order_status_6);
            $this->assign('user',$info);
            return view();
        }
    }

    /**
     * Title: 添加用户地址
     * Notes:address
     */
    public function address()
    {
        if(request()->isAjax())
        {
            $data = input('get.');
            $validate = Loader::validate('address');
            $data['users_id'] = session('users.id');

            if(!$validate->check($data))
            {
                return jsdata(203,$validate->getError());
            }

            if($ress = Db::name('address')->insertGetId($data))
            {
                return ['status' => 200, 'msg' => '收货地址添加成功……','ress' => $ress];
            } else {
                return jsdata(203, '收货地址添加失败……');
            }
        } else {
            $dress = Db::name('address')->where('users_id', session('users.id'))->select();
            $this->assign('dress',$dress);
            return view();
        };
    }

    /**
     * Title: 用户登录
     * Notes:login
     * @return array
     */
	public function login()
	{
		if(request()->isPost())
		{	
			$data = input('post.');
			$validate = new Validate([
				['name','require','用户名不能为空！'],
				['password','require', '密码不能为空']
			]);
			if(!$validate->check($data)) {
				return jsdata(530, $validate->getError());
			};
			$verify = Request::instance()->param('verifys');
			//验证码验证
		    if(!captcha_check($verify)) {
		    	return jsdata(531, '验证码错误！');
		    }
		    return model('users')->login($data);
		}else{
			return view();
		}
	}
	//忘记密码
	public function forgot()
	{
		return view();
	}

    /**
     * Title: 用户订单
     * Notes:orders
     */
	public function orders()
    {
        $type = (empty(input('type')) and input('type') !== '0') ? null : input('type');
        if($type == null)
        {
            $where = ['users_id' => session('users.id')];
        } else {
            $where = ['users_id' => session('users.id'),'order_status' => $type];
        }
        $Orders = new Orders;
        $OrderGoods = new OrderGoods;
        $Order = $Orders->where($where)->order('order_time desc')->select();
        $arr = [];
        foreach ($Order as $v)
        {
            $v['order_goods'] = $OrderGoods->where('order_id', $v['id'])->select();
            $arr[] = $v;
        }
        $order_status = $Orders->where('users_id',session('users.id'))->count();   //全部订单
        $order_status_0 = $Orders->where(['users_id' => session('users.id'), 'order_status' => 0])->count(); //待支付
        $order_status_2 = $Orders->where(['users_id' => session('users.id'), 'order_status' => 2])->count(); //待发货
        $order_status_3 = $Orders->where(['users_id' => session('users.id'), 'order_status' => 3])->count(); //待收货

        $this->assign('order_status', $order_status);
        $this->assign('order_status_0', $order_status_0);
        $this->assign('order_status_2', $order_status_2);
        $this->assign('order_status_3', $order_status_3);
        $this->assign('OrdersGoods',$arr);
        $this->assign('type',$type);
        return view();
    }

    /**
     * Title: 用户注册
     * Notes:register
     * @return array|
     */
	public function register()
	{
	    if(request()->isPost())
        {
            $data = input('post.');
            $verify = Request::instance()->param('Vcode');  //验证码

            if(!captcha_check($verify)) {
                return  jsdata(203,'验证码错误……');
            };

            $validate = Loader::validate('users');

            if(!$validate->check($data))
            {
                return jsdata(203,$validate->getError());
            }

            if(!empty(Db('users')->where('username', $data['username'])->count()))
            {
                return jsdata(203,'用户名已经被注册，请更换一个用户名……');
            }

            if(!empty(Db('users')->where('email', $data['email'])->count()))
            {
                return jsdata(203,'邮箱已被注册，同一邮箱只能注册一个帐号……');
            }

            $rand = mt_rand(100,999);   //生成随机数
            $users = model('users');
            $users->data($data, true);
            $users->token = $rand;
            $users->password = md5($data['password'].$rand);
            $users->create_time = time();
            if($users->allowField(true)->save()) {

                return jsdata(200,'用户注册成功，将跳转到登录页','/login.shtml');

            } else {
                return jsdata(203,'注册失败……');
            }
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
		Session::delete('users');
        $this->redirect( '/');

	}
}
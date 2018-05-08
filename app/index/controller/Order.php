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
 * Time: 2018/4/26 23:14
 */

namespace app\index\controller;

use app\index\model\CartLogic;
use think\Db;
use app\index\model\Cart;
use app\index\model\Orders;

class Order extends Common
{
    /**
     * Title: 跳转订单页
     * Notes:confirm
     */
    public function confirm()
    {
        if(empty(session('users')))
        {
            $this->error('未登录，将跳转到登录页','/login.shtml');
        };

        if(empty(input('listItem/a')))
        {
            return jsdata(203,'购物车为空……');
        } else {
            session('listItem',input('listItem/a'));
            return jsdata(200, '','/order.shtml');
        }
    }

    /**
     * Title: 确认订单
     * Notes:index
     * @return view
     */
    public function index()
    {
        if(empty(session('users')))
        {
            $this->error('未登录，将跳转到登录页','/login.shtml');
        }
        $uid = session('users.id');
        $cartlist = session('listItem');

        $cart = new CartLogic();
        $cart->setUserId($uid);

        if($cart->getUserCartOrderCount() == 0)
        {
            $this->error('您的购物车没有选中商品', '/cart');
        }
        $cartlist = Cart::all($cartlist);
        if(!empty($cartlist))
        {
            $address = Db::name('address')->where('users_id', $uid)->order('`default` desc')->select();  //用户收货地址
            $this->assign('address', $address);
        }
        $alltotal = '';
        $num = 0;
        foreach ($cartlist as $k => $v)
        {
            $num += $v->goods_num;        //商品件数
            $alltotal += $v->goods_price * $v->goods_num;   //总价
        }
        $this->assign('num', $num);
        $this->assign('cartlist', $cartlist);
        $this->assign('alltotal', $alltotal);
        return view();
    }

    /**
     * Title: 生成订单
     * Notes:create
     */
    public function create()
    {
        $address = input('address');
        if(empty($address))
        {
            return jsdata(203, '请选择收货地址');
        }
        $cart = session('listItem');    //商品 id

        $cartlist = Cart::all($cart);
        $alltotal = '';
        $num = '';

        foreach ($cartlist as $k => $v)
        {
            $num += $v->goods_num;        //商品件数
            $alltotal += $v->goods_price * $v->goods_num;   //总价
        }

        $order = new Orders;
        $order_id = $order->addOrder($address, $cartlist, $alltotal );
        return jsdata(200, '','/payment/' .$order_id.'.shtml'); //跳转到支付页

    }
}
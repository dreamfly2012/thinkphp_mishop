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
 * Time: 2018/4/30 18:44
 */

namespace app\admin\controller;

use app\admin\model\OrderGoods;
use app\admin\model\Orders as order;
use app\index\model\Address;

class Orders extends Common
{
    /**
     * Title: 订单列表
     * Notes:index
     * @return string
     */
    public function index()
    {
        $order = new order;
        $list = $order->get_orders();  //获取订单
        $this->assign('list', $list);
        return view();
    }

    /**
     * Title: 待发货
     * Notes:sphipping
     */
    public function sphipping()
    {
        $order = new order;
        $list = $order->ship();
        $this->assign('list',$list);
        return view();
    }

    /**
     * Title: 订单信息
     * Notes:info
     * @param $id
     */
    public function info($id)
    {
        $data = order::get($id);
        if($data['order_status'] !== 2 || $data['pay_status'] !== 1)
        {
            $this->error('该订单买家还未付款');
        }
        $address = Address::get($data['address_id']);   //配送地址信息
        $order_goods = OrderGoods::all(['order_id' => $data['id']]);    //查询订单商品
        $this->assign('order_goods', $order_goods);
        $this->assign('dress', $address);
        $this->assign('info', $data);
        return view();
    }

    /**
     * Title: 订单详情
     * Notes:orderinfo
     */
    public function orderinfo($id)
    {
        $data = order::get($id);
        $dress = Address::get($data['address_id']);
        $order_goods = OrderGoods::all(['order_id' => $data['id']]);    //查询订单商品
        $this->assign('order_goods', $order_goods);
        $this->assign('dress', $dress);
        $this->assign('data', $data);
        return view();
    }

    /**
     * Title: 打印订单
     * Notes:order_print
     *  @param $id 商品 ID
     */
    public function order_print($id)
    {
        $data = order::get($id);
        if($data['order_status'] !== 2 || $data['pay_status'] !== 1)
        {
            $this->error('该订单买家还未付款');
        }
        $address = Address::get($data['address_id']);   //配送地址信息
        $order_goods = OrderGoods::all(['order_id' => $data['id']]);    //查询订单商品
        $this->assign('order_goods', $order_goods);
        $this->assign('dress', $address);
        $this->assign('info', $data);
        return view();
    }

    /**
     * Title: 退货单
     * Notes:refund
     */
    public function refund()
    {
        $list =order::refund();
        $this->assign('list',$list);
       return view();
    }
}
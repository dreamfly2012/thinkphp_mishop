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
 * Time: 2018/4/29 0:26
 */

namespace app\index\controller;

use app\index\model\Address;
use app\index\model\OrderGoods;
use app\index\model\Orders;
use think\Db;
use think\Loader;

class Payment extends Common
{
    /**
     * Title:生成支付页面
     * Notes:index
     * @return int
     */
    public function index()
    {
        $id = input('id');
        $order = Orders::get($id);
        if(session('users.id') !== $order['users_id']) $this->error('您没有查看权限……');
        $ress = Address::get($order['address_id']);
        $OrderGoods = OrderGoods::all(['order_id' => $order['id']]);
        $this->assign('order_goods', $OrderGoods);
        $this->assign('ress', $ress);
        $this->assign('order', $order);
        return view();
    }
}
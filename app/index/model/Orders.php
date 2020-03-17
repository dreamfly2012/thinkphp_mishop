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
 * Time: 2018/4/28 19:14
 */

namespace app\index\model;


use think\Db;
use think\Model;

class Orders extends Model
{
    protected $shipping_id = 0; //物流 id
    protected $shipping_name = '顺风快递';  //物流名称
    protected $pack_fee = 0;  //物流费用
    protected $pay_name = null; //支付方式
    protected $users_note = null; //用户备注

    /**
     * Title: 创建订单
     * Notes:addOrder
     * @param $address 收货地址 id
     * @param $cart　选中的商品 id
     * @return array
     */
    public function addOrder($address,$cart, $alltotal)
    {
        $order = new Orders;
        $order->order_sn = date('YmdHis').rand(0001,9999);
        $order->users_id = session('users.id');
        $order->pay_id = 0;
        $order->pay_name = $this->pay_name;
        $order->address_id = $address;
        $order->shipping_id = $this->shipping_id;
        $order->shipping_name = $this->shipping_name;
        $order->pack_fee = $this->pack_fee;
        $order->goods_price = $alltotal;    //商品价
        $order->order_price = $alltotal + $this->pack_fee;   //应付金额 = 商品价 + 运费
        $order->order_time = time();
        $order->users_note = $this->users_note;
        $order->save();
        $order_id = $order->id;
        if($order_id == false)
        {
            return jsdata(203,'您提交的订单失败……');
        }

        foreach ($cart as $k => $v)
        {
            $order_goods = [
                'order_id' => $order_id,   //订单 ID
                'goods_id' => $v['goods_id'],   //商品 ID
                'goods_name' =>$v['goods_name'],   //商品名称
                'goods_sn' => $v['goods_sn'], //商品货号
                'goods_num' => $v['goods_num'], //购买数量
                'goods_price' => $v['goods_price'],   //商品价格
                'spec_key' => $v['spec_key'],
                'spec_key_name' => $v['spec_name'], //商品规格
                'created_time' => time(),
            ];
            Db::name('order_goods')->insert($order_goods);
            db::name('goodsseec')->where(['goods_id' => $v['goods_id'], 'key' => $v['spec_key']])->setDec('store_count', $v['goods_num']);  //减库存
            Db::name('goods')->where('id',$v['goods_id'])->setDec('count', $v['goods_num']);
        }
        Db::name('cart')->delete(session('listItem'));    //删除购物车中已提交的商品
        //用户提交了订单，发送消息给后台管理
        $news = [
            'uid' => session('users.id'),   //发起消息的用户
            'content' => '用户' .session('users.username').'提交了一份订购订单，请管理员尽快安排处理！', //消息内容
            'aid' => 0,  //等级，或者说本消息接收对象
            'status' => 0,     //是否已经阅读
            'create_time' => time()     //发起时间
        ];
        Db::name('news')->insert($news);

        return $order_id;
    }

    public function OrderGoods()
    {
        return $this->hasOne('OrderGoods','order_id','id');
    }

    public function Address()
    {
        return $this->hasOne('Address','id', 'address_id');
    }
}
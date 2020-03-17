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
 * Time: 2018/4/30 18:55
 */

namespace app\admin\model;

use think\Model;

class Orders extends Model
{
    /**
     * Title:　获取订单数据
     * Notes:get_orders
     * @return \think\Paginator
     */
    public function get_orders()
    {
        return $this->order('order_time desc')->field('users_note',true)->paginate(12);
    }

    /**
     * Title: 待发货
     * Notes:ship
     */
    public function ship()
    {
        return $this->where('pay_status',1)->where('order_status',2)->order('order_time desc')->field('users_note',true)->paginate(12);
    }

    /**
     * Title: 退货
     * Notes:refund
     */
    public static function refund()
    {
        return self::where('order_status', 5)->order('order_time desc')->field('users_note',true)->paginate(12);
    }

    /**
     * Title: 订单收件地址
     * Notes:Address
     * @return
     */
    public function Address()
    {
        return $this->hasOne('Address','id', 'address_id');
    }

    /**
     * Title: 订单用户
     * Notes:Users
     * @return \think\model\relation\HasOne
     */
    public function Users()
    {
        return $this->hasOne('Users', 'id', 'users_id');
    }
}
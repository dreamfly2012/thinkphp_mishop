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
 * Time: 2018/4/21 17:51
 */

namespace app\index\model;


use think\Model;

class Cart extends Model
{
    /**
     * Title: 限购数量
     * Notes:getLimitNumAttr
     */
    public function getLimitNumAttr($value,$data)
    {
        $goodsseec = null;
        $goods = Goods::get($data['goods_id'],'', 20);

        if($data['spec_key'])
        {
            $goodsseec = Goodsseec::get(['goods_id' => $data['goods_id'], 'key' => $data['spec_key']]);
            $liimitNum = $goodsseec['store_count'];
        } else {
            $liimitNum = $goods['count'];
        }

        return $liimitNum;
    }
    public function goods()
    {
        return $this->hasOne('Goods', 'id', 'goods_id')->cache(true,10);
    }

    public function Goodsimages()
    {
        return $this->hasOne('Goodsimages','goodsid', 'goods_id');
    }
}
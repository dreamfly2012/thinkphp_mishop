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
 * Time: 2018/4/19 16:44
 */

namespace app\admin\model;


use think\Model;

class Goodsattr extends Model
{
    public function Goodsattrsave($goods_id)
    {
        $goodsattrlist = $this->where('goods_id =' .$goods_id)->select();

        $goods_attr = [];
        foreach ($goodsattrlist as $k => $v)
        {
            $goods_attr[$v['attr_id'].'_'.$v['attr_value']] = $v;
        }

        $data = input('post.');
        foreach ($data as $k => $v)
        {
            $attr_id = str_replace('attr_','',$k);

            if(!strstr($k,'attr_') || strstr($k, 'attr_price_')) continue;

            foreach ($v as $k2 => $v2)
            {
                $v2 = str_replace('_','',$v2);
                $v2 = str_replace('@','',$v2);
                $v2 = trim($v2);

                if(empty($v2)) continue;

                $tmp_key = $attr_id."_".$v2;
//                $post_attr_price =  "attr_price_".$attr_id;
//                $attr_price = $post_attr_price[$k2];
                $attr_price = 0;
                if(array_key_exists($tmp_key, $goods_attr))
                {
                    if($goods_attr[$tmp_key]['attr_price'] != $attr_price)
                    {
                        $goods_attr_id = $goods_attr[$tmp_key]['goods_attr_id'];
                        $this->where('goods_attr_id = ' . $goods_attr_id)->save(array('attr_price' => $attr_price));
                    }
                } else {
                    $data = array('goods_id'=>$goods_id,'attr_id'=>$attr_id,'attr_value'=>$v2, 'attr_price' => $attr_price);
                    $this->insert($data);
                }
            }
            unset($goods_attr[$tmp_key]);
        }
        foreach ($goods_attr as $k => $v)
        {
            $this->where('goods_attr_id = '. $v['goods_attr_id'])->delete();
        }
    }
}
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
 * Time: 2018/4/21 11:23
 */

namespace app\index\model;


use think\Db;
use think\Model;

class Goodsseec extends Model
{
    /**
     * Title:
     * Notes:get_spec
     */
    public function get_spec($id)
    {
        $key = $this->where('goods_id', $id)->column("group_concat(`key` ORDER BY store_count desc SEPARATOR ',')");

        $arr = [];
        $arr2 = [];

        foreach ($key as $vo)
        {
            $arr = explode(',',$vo);
        }

        $arr = array_unique($arr);  //移除数组中重复的数据
        sort($arr);
        foreach ($arr as $vo2)
        {
           $spec = explode('.', $vo2);
           $spec2 = Db::name('spec')->where('id',$spec[0])->select();

            if($spec2)
            {
                $items = explode(',',$spec2[0]['items'] );
                $arr2[$spec2[0]['name']][] = array(
                    'key' => $vo2,
                    'item' =>  $items[$spec[1]-1]
                );
                sort($arr2[$spec2[0]['name']]);
            }
        }
       return $arr2;
    }

    /**
     * Title:
     * Notes:goods
     */
    public function goods()
    {
        return $this->hasOne('Goods','id', 'goods_id');
    }
}
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
 * Time: 2018/4/22 21:35
 */

namespace app\index\model;


use think\Db;
use think\Model;

class Goodsattr extends Model
{
    /**
     * Title:
     * Notes:getattr
     */
    public function getattr($id)
    {
        $attr = Db('goodsattr')->where('goods_id',$id)->limit(7)->select();
        $array = [];

        foreach ($attr as $k => $v)
        {
            $name = Db::name('goods_attr')->where('id', $v['attr_id'])->value('name');
            $array[] = $name .' : '. $v['attr_value'];

        }

        return $array;
    }
}
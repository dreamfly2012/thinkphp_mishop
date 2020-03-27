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
 * Time: 2018/4/18 15:50
 */

namespace app\admin\model;

use think\Model;

class Attr extends Model
{
    protected $table = 'goods_attr';

    public function category()
    {
        return $this->hasOne('category', 'attr_id', 'cid');
    }

}

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
 * Time: 2018/4/22 17:13
 */

namespace app\index\model;


use think\Model;
use app\index\model\Goods;

class Index extends Model
{
    public function recommend()
    {
        $goods = new Goods;
        $goods = $goods->where(array('gender' => 1,'recommend' => 0))->field('content', true)->limit(10)->select();
        return $goods;
    }

}
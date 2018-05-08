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
 * Time: 2018/4/20 20:26
 */

namespace app\index\model;


use think\Model;

class Goods extends Model
{

    public function Brand()
    {
        return $this->hasOne('Brand', 'id', 'cid');
    }

    public function Goodsimages()
    {
        return $this->hasOne('Goodsimages','goodsid','id');
    }
}
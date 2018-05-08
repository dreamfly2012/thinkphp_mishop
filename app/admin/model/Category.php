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
 * Time: 2018/4/17 18:48
 */

namespace app\admin\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;
    //创建数据时间戳
    protected $createTime = 'time';

}
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
 * Time: 2018/4/25 12:32
 */

namespace app\admin\controller;


use think\Controller;

class Charts extends Controller
{
    /**
     * Title: 月销售表
     * Notes:index
     */
    public function index()
    {
        $days = date('t');

        echo $days;
        die;
        $arr = [];
        for($i = 1; $i <= $days; $i++)
        {
            $arr[] = $i;
        }
        var_dump($arr);
        die;
    }

}
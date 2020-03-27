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
 * Time: 2018/4/27 17:03
 */

namespace app\admin\controller;

class Database extends Common
{
    /**
     * 数据库列表
     * @return \think\response\View
     */
    public function index()
    {
        $datalist = Db()->query('show table STATUS');

        $this->assign('datalist', $datalist);

        return view();
    }
}

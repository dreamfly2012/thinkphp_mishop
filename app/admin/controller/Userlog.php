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
 * Time: 2018/2/17 0:27
 */

namespace app\admin\controller;


use think\Db;

class Userlog extends Common
{
    /**
     * Title:登录日志
     * Notes:index
     * @return \think\response\View
     */
    public function index()
    {
        $log = Db::name('user_log')->order('id desc')->paginate(12);
        $this->assign('list', $log);
        return view();
    }
}
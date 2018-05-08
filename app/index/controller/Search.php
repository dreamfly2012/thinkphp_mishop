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
 * Time: 2018/4/25 11:38
 */
namespace app\index\controller;

use think\Db;

class Search extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        action('Index/navlist');
    }

    /**
     * Title: 搜索功能
     * Notes:index
     * @return mixed
     */
    public function index()
    {
        $q =input('q');
        $goods = model('goods');
        $or = empty(input('or')) ? null : 'price '. input('or');

        $uid = Db::name('category')->where('name','like',  $q.'%')->value('id');
        $cid['uid'] = empty($uid) ? null : array('like',$uid);
        $name['name'] = array('like', '%'. $q .'%');
        $data = $goods->where($cid)->whereOr($name)->field('name,id,price')->order($or)->limit(24)->select();
        $new = $goods->where('gender',1)->field('name,id')->order('starttime desc')->limit(10)->select();   //最近更新

        $this->assign('or',empty(input('or') ) ? null : (input('or') == 'desc'? 'asc' : 'desc'));
        $this->assign('new', $new);
        $this->assign('search', $q);
        $this->assign('list', $data);
        return view();
    }
}

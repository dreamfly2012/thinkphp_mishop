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
 * Time: 2018/4/20 16:53
 */
namespace app\index\controller;

use think\Controller;
use think\Cache;
use think\Db;

class Index extends Common
{
    /**
     * Title: 首页
     * Notes:index
     * @return
     */
    public function index() {
        $recommend = new \app\index\model\Index();
        $rainbowitem = $recommend->recommend();
        $this->assign('recommend', $rainbowitem);
        $this->navlist();
        $this->ad();
        $cat = $this->act();
        $this->assign('cat', $cat);
		return view();
    }

    /**
     * Title: 分类导航
     * Notes:navlist
     */
    public function navlist()
    {
        $NavList = Db('category')->order('id,sort')->field('id,name')->select();
        $data = [];

        foreach ($NavList as $v)
        {
            $goods = model('goods')->where('uid', $v['id'])->where('gender',1)->field('id,name')->select();
            $goods = array_chunk($goods, 6);

            foreach ($goods as $g)
            {
                $v['level'][] = $g;
            }

            $data[] = $v;
        }
        return $this->assign('NavList',$data);
    }

    /** 轮播数据
     * Title:
     * Notes:ad
     * @return $this|void
     */
    public function ad()
    {
    	$ad = Db('ad')->where('pid', 11) -> select();
    	$floor_ad = Db('ad')->where('pid', 1)-> select();
        $this->assign('floor_ad', $floor_ad);
    	return $this->assign('ad', $ad);
    }

    /**
     * Title: 自定义导航
     * Notes:navigation
     * @return $this|void
     */
    public function navigation()
    {
        $data = db('navigation')->field('ico', true)->order('sort')->select();
        return $this->assign('navigation', $data);
    }

    /**
     * Title: 首页楼层
     * Notes:act
     * @return array
     */
    public function act()
    {
        $act = Db('category')->order('id,sort')->field('id,name')->select();  //楼层
        $data = [];

        foreach ($act as $v) {
            $goods = model('goods')->where('uid', $v['id'])->where('gender',1)->order('eye,sales_sum')->field('id,name,price')->limit(8)->select(); //楼层商品
            $ad = db('ad')->where('pid', $v['id'])->find(); //楼层左侧广告
            $adf = Db::name('ad')->where('pid', $v['id'] + 11)->find(); //楼层底部广告

            if(!empty($goods))
            {
                $v['item'][] = $goods;
                $v['ad'] = $ad;
                $v['adf'] = $adf;
                $data[] = $v;
            }
        }
        return $data;
    }
}
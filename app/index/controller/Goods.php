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
 * Time: 2018/4/23 08:23
 */
namespace app\index\controller;

use app\index\model\Goodsattr;
use app\index\model\Goodsseec;

class Goods extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        action('Index/navlist');
    }

    /**
     * Title: 商品详情
     * Notes:index
     * @return \
     */
    public function index()
    {
        $data = model('goods')->get(input('id'));

        if(empty($data) || $data['gender'] == 2)
        {
            $this->error('该商品已经下架',url('/'));
        }

        $goods_images_list = db('goodsimages')->where('goodsid', input('id'))->field('imageurl')->select();       //商品图
        $goodsseec = db('goods_spec')->where('goods_id', input('id'))->column('key,id,price,key_name,store_count'); //规格　价格　库存
        $Goodsseec = new Goodsseec;
        $keys = $Goodsseec->get_spec(input('id'));
        $goodsattr = new Goodsattr();
        $attr = $goodsattr->getattr(input('id'));   //商品参数
        //同类商品的热卖产品
        $uid = $data->uid;
        $sales = model('goods')->where('uid', $uid)->order('sales_sum, id')->field('id,name,price')->limit(12)->select();

        $this->assign('sales', $sales);
        $this->assign('attr',$attr);
        $this->assign('keys', $keys);
        $this->assign('goodsseec', json_encode($goodsseec));
        $this->assign('goodsimageslist',$goods_images_list);
        $this->assign('data', $data);
        $data->setInc('eye');
	return view();
    }

    /**
     * Title: 添加购物车成功
     * Notes:add_cart
     * @return \think\response\View
     */
	public function add_cart()
    {
        return view();
    }

}

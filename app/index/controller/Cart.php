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
 * Time: 2018/4/21 13:26
 */

namespace app\index\controller;

use app\index\model\CartLogic;

/**
 * title 购物车类
 * Class Cart
 * @package
 */
class Cart extends Common
{
    public $user_id = 0;
    public function _initialize()
    {
        parent::_initialize();
        $this->user_id = empty(session('users')) ? 0 : session('users.id');
    }
    /**
     * Title: 购物车首页
     * Notes:index
     * @return
     */
	public function index()
	{
        $alltotal = '';
        $cartLogic = new CartLogic;
		$cartLogic->setUserId( $this->user_id);
		$cartlist = $cartLogic->getCartlist();
		$usercartnum = $cartLogic->getuserCartGoodsTypeNum();
		$listItem = '';

		foreach ($cartlist as $v)
        {
            $listItem .= $v['id'].',';
            $alltotal += $v['goods_price'] * $v['goods_num'];   //总价
        }

        $listItem = trim($listItem,',');
		$this->assign('alltotal', $alltotal);
        $this->assign('listItem', $listItem);
		$this->assign('usercartnum', $usercartnum);
		$this->assign('cartlist', $cartlist);
		return view();
	}

    /** 添加购物车
     * Title:
     * Notes:ajaxaddcart
     */
	public function ajaxaddcart()
    {
        if(request()->isPost())
        {
            $data = input('post.');

            if(empty($data['goods_id']))
            {
                return jsdata('0','请选择要购买的商品','javascript:;');
            }

            if(empty($data['store_count']))
            {
                return jsdata('0', '购买的商品不能为 0 ','javascript:;');
            }

            $cartLogic = new CartLogic;
            $cartLogic->setUserId($this->user_id);
            $cartLogic->setGoodsModel($data['goods_id']);

            if($data['goodsseec_id'])
            {
                $cartLogic->setSpecGoodsPriceModel($data['goodsseec_id']);
            }

            $cartLogic->setGoodsBuyNum($data['store_count']);
            $result = $cartLogic->addGoodsToCart();

            return $result;
        }
    }

    /**
     * Title: 更新购物车,并返回计算结果
     * Notes:addproduct
     */
    public function addproduct()
    {
        $post = input('get.');

        if(empty($post['id']))
        {
            return jsdata(203,'请选择要更改的商品');
        }

        $cartLogic = new CartLogic;
        $result = $cartLogic->changeNum($post['id'], $post['num']);

        if($result)
        {
            $cartLogic->setUserId($this->user_id);
            $result = $cartLogic->AsyncUpdateCart($post);
            return $result;
        }
    }

    /**
     * Title:  删除购物车商品
     * Notes:delcart
     * @return array
     */
    public function delcart()
    {
        $listItem = input('get.listItem/a');

        if(in_array(input('id'),$listItem))
        {
            $key = array_search(input('id'), $listItem);
            unset($listItem[$key]);
        }
        $cartLogic = new CartLogic;
        $cartLogic->setUserId($this->user_id);

        $carts = $cartLogic->delcart(input('id'), $listItem);
        return $carts;
    }
}
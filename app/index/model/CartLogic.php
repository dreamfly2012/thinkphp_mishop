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
 * Time: 2018/4/21 16:14
 */

namespace app\index\model;

use think\Db;
use think\Model;
use app\index\model\Goods;
use app\index\model\Goodsseec;
use app\index\model\Cart;

class CartLogic extends Model
{
    protected $user_id = 0;//user_id
    protected $session_id; //session_id
    protected $goodsBuyNum; //购买的商品数量

    public function __construct()
    {
        parent::__construct();
        $this->session_id = session_id();
    }

    /**
     * Title: 设置用户ID
     * Notes:setUserId
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        return  $this->user_id = $user_id;
    }

    /**
     * Title: 商品模型
     * Notes:setGoodsModel
     * @param $id
     */
    public function setGoodsModel($id)
    {
        $goodsModel = new Goods;
        $this->goods = $goodsModel::get($id);
    }

    /**
     * Title: 一个商品规格模型
     * Notes:setSpecGoodsPriceModel
     */
    public function setSpecGoodsPriceModel($id)
    {
        $goodsspec = new Goodsseec;
        $this->specGoodsPrice = $goodsspec::get($id,'', 10);
    }

    /**
     * Title: 购买的商品数量
     * Notes:setGoodsBuyNum
     * @param $goodsBuyNum
     */
    public function setGoodsBuyNum($goodsBuyNum)
    {

        $this->GoodsBuyNum = $goodsBuyNum;
    }

    /**
     * Title:
     * Notes:addGoodsToCart
     */
    public function addGoodsToCart()
    {
        if(empty($this->goods))
        {
            return jsdata('203','您购买的商品不存在或已下架删除……','' );
        }
        $GoodsPriceCount = Db::name('goodsseec')->where('goods_id',$this->goods['id'])->count('id');

        if(empty($this->specGoodsPrice) && !empty($GoodsPriceCount))
        {
            return jsdata('203','必须传递商品规格……','');
        };

        $result = $this->addNormalCart();

        $result['result'] = $userCartGoodsNum = $this->getuserCartGoodsNum();

        setcookie('cn', $userCartGoodsNum, null, '/');

        return $result;
    }

    /** 购物车添加商品
     * Title:
     * Notes:addNormalCart
     */
    private function addNormalCart()
    {
        if(empty($this->specGoodsPrice)){
            $pric = $this->goods['price'];
            $count = $this->goods['count'];
        } else {
            $pric = $this->specGoodsPrice['price'];
            $count = $this->specGoodsPrice['store_count'];
        }

        // 查询购物车是否已经存在这商品
        if(!$this->user_id)
        {
            $userCartGoods = Cart::get(['user_id' => $this->user_id,'session_id' => $this->session_id,'goods_id' => $this->goods['id'], 'spec_key' => ($this->specGoodsPrice['key']?:'')]);
        } else {
            $userCartGoods = Cart::get(['user_id' => $this->user_id, 'goods_id' => $this->goods['id'], 'spec_key' => ($this->specGoodsPrice['key'] ?: '')]);
        }
        //如果购物车中存在相同商品，数量相加
        if($userCartGoods)
        {
            $userWantGoodsNum = $this->goodsBuyNum + $userCartGoods['goods_num'];

            if($userWantGoodsNum > $count) {
                return jsdata(203, '当前商品库存不足，剩余'. $count . ',当前购物车已有'. $userCartGoods['goods_num']. '件……','javascript:;');
            }
            $cartResult = $userCartGoods->save(['goods_num' => $userWantGoodsNum, 'goods_price' => $pric]);
        }else {
            // 如果购物车没有该商品
            if($this->GoodsBuyNum > $count)
            {
                return jsdata(203, '当前商品库存不足，剩余'. $count ,'javascript:;');
            }

            $cartdata = [
                'user_id' => $this->user_id,
                'session_id' => $this->session_id,
                'goods_id' => $this->goods['id'],
                'goods_sn' => $this->goods['serial'],
                'goods_name' => $this->goods['name'],
                'market_price' => $this->goods['market_price'],
                'goods_price' => $this->specGoodsPrice['price'],
                'goods_num' => $this->GoodsBuyNum,
                'add_time' => time(),
            ];

            if($this->specGoodsPrice)
            {
                $cartdata['spec_key'] = $this->specGoodsPrice['key'];
                $cartdata['spec_name'] = $this->specGoodsPrice['key_name'];
                $cartdata['sku'] = $this->specGoodsPrice['sku'];
            }

            $cartResult = Db::name('cart')->insertGetId($cartdata);
        }

        if($cartResult !== false)
        {
            return jsdata(200,'成功加入购物车');
        } else {
            return jsdata(203, '加入购物车失败');
        }
    }

    /**
     * Title: 计算购物车商品总数
     * Notes:getuserCartGoodsNum
     */
    public function getuserCartGoodsNum(){
        if($this->user_id)
        {
            $goods_num = Db('cart')->where(['user_id' => $this->user_id])->sum('goods_num');
        } else {
            $goods_num = Db('cart')->where('session_id', $this->session_id)->sum('goods_num');
        }

        return empty($goods_num) ? 0 : $goods_num;
    }

    /**
     * Title: 获取用户购物车商品总数
     * Notes:getuserCartGoodsTypeNum
     */
    public function getuserCartGoodsTypeNum()
    {
        if($this->user_id)
        {
            $goods_num = db('cart')->where('user_id', $this->user_id)->count();

        } else {
            $goods_num = Db('cart')->where('session_id', $this->session_id)->count();
        }

        return empty($goods_num) ? 0 : $goods_num;

    }

    /**
     * Title: 获取用户的购物车列表
     * Notes:getCartlist
     * @param int $selected 0 全部，1 为选中
     */
    public function getCartlist($selected = 0)
    {
        $cart = new Cart;

        if($this->user_id)
        {
            $cartwhere['user_id'] = $this->user_id;
        } else {
            $cartwhere['session_id'] = $this->session_id;
        }

        if($selected != 0)
        {
            $cartwhere['selected'] = 1;
        }

        $cartlist = $cart->with('goods')->where($cartwhere)->select(); //获取购物车商品

        $cartcheckafterList = $this->checkcartlist($cartlist);

        $cartnum = array_sum(array_map(function($val){return $val['goods_num'];}, $cartcheckafterList));  //购物车购买的商品总数

        setcookie('cn', $cartnum, null,'/');

        return $cartcheckafterList;
    }

    /**
     * Title: 过滤无效的商品
     * Notes:checkeartlist
     * @param $cartlist
     */
    public function checkcartlist($cartlist)
    {
        foreach ($cartlist as $key => $cart)
        {
            //商品不存在或已经下架
            if(empty($cart['goods']) || $cart['goods']['gender'] != 1)
            {
                $cart->delete();
                unset($cartlist[$key]);
                continue;
            }
        }
        return $cartlist;
    }

    /**
     * Title: 更改购物车数量
     * Notes:changeNum
     * @param $cart_id 购物车商品 id
     * @param $goods_num 商品数量
     */
    public function changeNum($cart_id, $goods_num)
    {
        $cart = new Cart;
        $cart = $cart::get($cart_id);

        if($goods_num > $cart->limit_num){
            return jsdata(203,'商品数量不能大于'. $cart->limit_num);
        };

        $cart->goods_num = $goods_num;
        $cart->save();
        return true;
    }

    /**
     * Title:更新购物车，并返回计算结果
     * Notes:AsyncUpdateCart
     */
    public function AsyncUpdateCart($cart = [])
    {
        $alltotal = 0;

        if(empty($cart))
        {
            return jsdata('200','购物车没有商品');
        }

        $sku = Cart::get($cart['id']);

        if(empty($cart['listItem']))
        {
            $data = array(
                'status' => 0,
                'msg' => 'ok',
                'alltotal' => number_format(0, 2),
                'price' => $sku->goods_price,
                'total' => number_format($sku->goods_price * $cart['num'], 2),
            );
        } else if($cart['listItem'] && in_array($cart['id'],$cart['listItem']))
        {

            $carts = Cart::all( $cart['listItem']);

            foreach ($carts as $k => $v)
            {
                $alltotal += $v->goods_price * $v->goods_num;
            }
        } else {

            $carts = Cart::all($cart['listItem']);

            foreach ($carts as $k => $v)
            {
                $alltotal += $v->goods_price * $v->goods_num;
            }
        }

        if(!empty($alltotal) && is_numeric($alltotal))
        {
            $data = array(
                'status' => 0,
                'msg' => 'ok',
                'price' => $sku->goods_price,
                'total' => number_format($sku->goods_price * $cart['num'], 2),
                'alltotal' => number_format($alltotal),
            );
        }
        return $data;
    }

    /**
     * Title: 删除购物车商品
     * Notes:delcart
     * @param $id
     * @param $listItem
     */
    public function delcart($id, $listItem)
    {
        $alltotal = 0;

        if($this->user_id)
        {
            $cartWhere['user_id'] = $this->user_id;
        } else {
            $cartWhere['session_id'] = $this->session_id;
            $user['user_id'] = 0;
        }

        $delete = Cart::where($cartWhere)->where('id', $id)->delete();

        if($delete)
        {
            $carts = Cart::all($listItem);

            if(!empty($carts))
            {
                foreach ($carts as $k => $v)
                {
                    $alltotal += $v->goods_price * $v->goods_num;
                }
            }

            $data = array(
                'status' => 0,
                'msg' => 'ok',
                'alltotal' => $alltotal
            );

            return $data;

        } else {

            return jsdata(203, '删除失败……');
        }
    }

    /**
     * Title: 用户登录后对购物车的操作
     * Notes:doUserLoginHandle
     */
    public function doUserLoginHandle()
    {
        if(!empty($this->session_id) || !empty($this->user_id))
        {
            $cart = new Cart();
            $cart->save(['user_id' => $this->user_id],['session_id' => $this->session_id, 'user_id' => 0]);
        }

    }

    /**
     * Title: 获取用户购物车欲购买的商品种数
     * Notes:getUserCartOrderCount
     */
    public function getUserCartOrderCount()
    {
        $count = Db::name('cart')->where(['user_id' => $this->user_id, 'selected' => 1])->count();
        return $count;
    }
}
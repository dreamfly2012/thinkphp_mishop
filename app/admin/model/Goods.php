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
 * Time: 2018/4/18 23:43
 */

namespace app\admin\model;

use think\Db;
use think\Model;

class Goods extends Model
{
    /**
     * Title: 添加商品图片
     * Notes:afterSave
     * @param int $gooods_id 商品id
     */
    public function afterSave($gooods_id)
    {
        $goods_images = input('goods_images/a');    // 商品图片

        if(count($goods_images) > 1)
        {
            $goodsImagesAll = model('goodsimages')->where('goodsid = '. $gooods_id)->column('id,imageurl');
        }

        if(!empty($goodsImagesAll)) {

//            foreach ($goodsImagesAll as $k => $v)
            foreach ($goods_images as $k => $v)
            {
                if(in_array($v, $goodsImagesAll))

                   unset($goods_images[$k]);

//                    model('goodsimages')->where('id = '. $k)->delete();     //查看是否有相同的图片，有则删除，
            }
        }
        if(!empty($goods_images))
        {
            foreach ($goods_images as $v)
            {
                if($v == null) continue;
                $data = array(
                    'goodsid' => $gooods_id,
                    'imageurl' => $v
                );
                model('Goodsimages')->insert($data);
            }
        }

        // 商品规格
        if(input('item/a'))
        {
            $keyarr = [];

            foreach (input('item/a') as $k => $v)
            {
                $v['price'] = trim($v['price']);
                $store_count = $v['store_count'] = trim($v['store_count']);
                $v['sku'] = trim($v['sku']);

                $data = [
                    'goods_id' => $gooods_id,
                    'key' => $k,
                    'key_name' => $v['key_name'],
                    'price' => $v['price'],
                    'store_count' => $v['store_count'],
                    'sku' => $v['sku']
                ];

                $specGoodsPrice = Db('goodsseec')->where(['goods_id' => $data['goods_id'], 'key' => $data['key']])->find();

                if($specGoodsPrice)
                {
                    Db('goodsseec')->where(['goods_id' => $gooods_id, 'key' => $k])->update($data);
                } else {
                    Db('goodsseec')->insert($data);
                }

            }
            //刷新总库存
        }
    }

    /**
     * Title: 查询仓库商品
     * Notes:warehouse
     * @return \think\Paginator
     */
    public static function warehouse()
    {
        return self::where('gender', 2)->order('id desc')->field('content', true)->paginate(12);
    }

    /**
     * Title: 商品上/下架
     * Notes:gender
     * @param $id 商品
     * @return array
     */
    public static function gender($id)
    {
        $goods = self::get($id);
        $gender = $goods->gender == 2 ? 1 : 2;
        $goods->gender = $gender;
        $goods->starttime = time();
        if($goods->save())
        {
            return jsdata(200,'操作成功!','');
        } else {
            return jsdata(203,'操作成功！');
        }
    }


    public function Category()
    {
        return $this->hasOne('Category', 'id', 'uid');
    }

    public function Goodsimages()
    {
        return $this->hasOne('Goodsimages','goodsid', 'id');
    }
}
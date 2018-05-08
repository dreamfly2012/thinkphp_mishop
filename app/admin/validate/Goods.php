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
 * Time: 2018/4/18 23:45
 */

namespace app\admin\validate;


use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        ['name', 'require|min:3|max:100','商品名称不能为空|商品名称至少3个字符|商品名称到多50个汉字'],
        ['market_price','require|number','市场价必填|市场价格式有误'],
        ['price','require|^[0-9]+(.[0-9]{1,2})?$','售价必填|售价格式有误'],
        ['count','require|number|gt:10','库存不能为空|库存格式有误|库存量不能小于10'],
//        ['goods_images','require','请上传商品图片'],
        ['content','require','商品详情不能为空'],
//        ['__token__','require|max:50|token']
    ];
}
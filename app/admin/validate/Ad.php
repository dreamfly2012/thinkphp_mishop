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
 * Time: 2018/4/22 21:00
 */

namespace app\admin\validate;


use think\Validate;

class Ad extends Validate
{
    protected $rule = [
        ['ad_name','require','广告名称不能为空……'],
        ['pid','require', '广告位置不能为空!'],
        ['ad_code', 'require', '请上传广告图片……'],
        ['__token__', 'require|max:50|token']
    ];

}
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
 * Time: 2018/4/26 18:04
 */

namespace app\index\validate;


use think\Validate;

class Address extends Validate
{
    protected $rule = [
        ['user_name','require','收货人不能为空'],
        ['user_phone','require','收货人联系电话不能为空'],
        ['province', 'require','请选择所在地的省份/自治区'],
        ['city', 'require', '请选择所在地的城市'],
        ['county','require', '请选择所在地的区/县'],
        ['user_zipcode', 'require', '请填写所在地的邮编'],
        ['user_adress','require', '请填写详细地址']
    ];

}
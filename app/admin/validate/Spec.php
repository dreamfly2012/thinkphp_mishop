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
 * Time: 2018/2/17 17:51
 */

namespace app\admin\validate;


use think\Validate;

class Spec extends Validate
{
    protected $rule = [
        ['name','require','规格名称不能为空'],
        ['__token__','require|max:50|token']
    ];
}
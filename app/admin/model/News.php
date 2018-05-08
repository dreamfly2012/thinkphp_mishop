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
 * Time: 2018/5/7 22:04
 */

namespace app\admin\model;

use think\Model;

class News extends Model
{
    protected $users_id = 0; //session_id
    /**
     * Title: 读取消息
     * Notes:get_news
     * @param string $linm
     * @return string
     */
    public function get_news($linm = '')
    {
       return $this->where('aid',$this->users_id)->where('status', 0)->order('id desc')->limit($linm)->select();

    }

    public function users()
    {
        return $this->hasOne('Users','id','uid');
    }

}
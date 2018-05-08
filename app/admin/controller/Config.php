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
 * Time: 2018/4/18 19:26
 */

namespace app\admin\controller;

use think\Loader;

class Config extends Common
{
    /**
     * title 网点设置
     * Notes:index
     * @return \think\response\View
     */
    public function index()
    {
        $config = db('config')->where('type', 'system')->order('id')->select();
        $this->assign('config', $config);
        return view();
    }

    /**
     * Title: 重置网点设置
     * Notes:save
     * @return array|string
     */
    public function save()
    {
        $data = input('post.');
        $validate = Loader::validate('config');

        if(!$validate->check($data))
        {
            return $validate->getError();
        };

        $a = 0;
        foreach($data as $k => $v)
        {
            if($v !== "" && $k !== "__token__")
            {
                $data = model('config')->get(['keyname'=> $k]);
                $data->v = $v;
                $data->save();
                $a ++;
            }
        }
        if($a >= 1)
        {
            return jsdata(200, '提交成功', 'javascript:window.location.reload();', 2);
        }else{
            return '更新失败，请查看提交数据是否为空！';
        }
    }
}
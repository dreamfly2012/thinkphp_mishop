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
 * Time: 2018/4/26 20:48
 */

namespace app\admin\controller;

use think\Db;

class Users extends Common
{
    /**
     * Title: 会员列表
     * Notes:index
     */
    public function index()
    {
        $data = Db::name('users')->order('id desc')->field('password,openid,headimgurl,',true)->paginate(12);
        $this->assign('users', $data);
        return view();
    }

    /**
     * Title: 编辑会员
     * Notes:save
     */
    public function save()
    {
        if(request()->isPost())
        {
            $data = input('post.');

            if(empty($data['status'])) {
                $data['status'] = 2 ;
            }

            if(db('users')->update($data))
            {
                return jsdata(200,'会员状态已更新……','/admin/users');
            }
        } else {
            $data = Db('users')->where('id',input('id'))->find();
            $this->assign('users', $data);
            return view();
        }
    }

    /**
     * Title: 删除会员
     * Notes:del
     */
    public function del()
    {
        $id = input('id');
        if(db('users')->delete($id))
        {
            return jsdata(200,'会员删除成功……','/admin/users');
        }
    }
}
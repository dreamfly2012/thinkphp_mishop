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
 * Time: 2018/4/18 12:21
 */

namespace app\admin\controller;

use think\Loader;

class Attr extends Common
{
    /**
     * Title:商品属性列表
     * Notes:index
     * @return \think\response\View
     */
    public function index()
    {
        $this->assign('list', model('attr')->order('sort, id')->paginate(12));
        return view();
    }
    /**
     * Title:添加商品属性
     * Notes:add
     * @return array|string|\think\response\View
     */
    public function add()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $validate = Loader::validate('attr');

            if(!$validate->check($data))
            {
                return $validate->getError();
            }

            $data['items'] = str_replace('，',',', $data['items']);  //中文逗号统一半角逗号
            $attr = model('attr')->data($data,true);

            if($attr->allowField(true)->save())
            {
                return jsdata(200, '商品属性添加成功……','/admin/attr');
            } else {
                return '商品属性添加失败……';
            }
        } else {
            $cate = db('category')->where('pid', 0)->field('id,name')->order('id')->select();
            $this->assign('cate', $cate);
            return view();
        }
    }

    /**
     * Title: 编辑属性类
     * Notes:save
     * @return int
     */
    public function save()
    {
        if(request()->isPost())
        {
            $data = input('post.');

            if(model('attr')->allowField(true)->save($data,$data['id']))
            {
                return jsdata(200,'更新成功……', '/admin/attr');
            } else {
                return '更新失败';
            }
        } else {
            $data = model('attr')->get(input('id'));
            $this->assign('spec', $data);
            $cate = db('category')->where('pid', 0)->field('id,name')->order('id')->select();       //所属分类
            $this->assign('cate', $cate);
            return view();
        }
    }
}
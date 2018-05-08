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
 * Time: 2018/4/17 16:27
 */

namespace app\admin\controller;
use think\Db;
use think\Loader;

class Spec extends Common
{
    /**
     * Title:商品规格列表
     * Notes:index
     * @return \
     */
    public function index()
    {
        $list = model('spec')->order('sort, id')->paginate(12);
        $this->assign('list', $list);
        return view();
    }
    /**
     * Title: 添加商品规格
     * Notes:add
     * @return array|string|
     */
    public function add()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $validate = Loader::validate('spec');

            if(!$validate->check($data))
            {
                return $validate->getError();
            }

            $data['items'] = str_replace('，',',', $data['items']);  //中文逗号统一半角逗号
            $spec = model('spec')->data($data,true);

            if($spec->allowField(true)->save())
            {
                return jsdata(200, '商品规格添加成功……','/admin/spec');
            } else {
                return '商品规格添加失败……';
            }
        } else {
            $cate = db('category')->where('pid', 0)->field('id,name')->order('id')->select();
            $this->assign('cate', $cate);
            return view();
        }
    }

    /**
     * Title: 编辑商品规格
     * Notes:save
     * @return array
     */
    public function save()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            if(model('spec')->allowField(true)->save($data,$data['id']))
            {
                return jsdata(200,'更新成功……', '/admin/spec');
            } else {
                return '更新失败';
            }
        } else {
            $data = model('spec')->get(input('id'));
            $this->assign('spec', $data);
            $cate = db('category')->where('pid', 0)->field('id,name')->order('id')->select();       //所属分类
            $this->assign('cate', $cate);
            return view();
        }
    }

    /**
     * Title: 删除规格
     * Notes:del
     */
    public function del()
    {
        $id = input('id');
        if(Db::name('spec')->delete($id))
        {
            return jsdata(200,'商品规格删除成功!','/admin/spec');
        } else {
            return jsdata(203,'商品规格删除失败');
        }
    }
}
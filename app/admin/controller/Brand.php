<?php
/**
 * ============================================================================
 * 版权所有 2015-2018
 * 
 * ----------------------------------------------------------------------------
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 本程序采用thinkphp v5.0开发
 * ============================================================================
 * 
 * Time: 2018/4/17 16:11
 */

namespace app\admin\controller;

use think\Loader;

class Brand extends Common
{
    /**
     * Title:品牌列表
     * Notes:index
     * @return string
     */
    public function index()
    {
        $list = model('brand')->order('sort, id')->paginate(12);
        $this->assign('list', $list);
        return view();
    }

    /**
     * Title:添加品牌
     * Notes:add
     * @return View
     */
    public function add()
    {
        if(request()->isPost())
        {
            $date = input('post.');
            $validate = Loader::validate('brand');

            if(!$validate->check($date))
            {
                return $validate->getError();
            }

            $brand = model('brand')->data($date, true);

            if($brand->allowField(true)->save())
            {
                return jsdata(200, '品牌添加成功……','/admin/brand');
            } else {
                return '品牌添加失败……';
            }

        } else {

            $cate = db('category')->where('pid', 0)->field('id,name')->order('id')->select();
            $this->assign('cate', $cate);
            return view();
        }
    }

    /**
     * Title:品牌更新
     * Notes:save
     * @return string
     */
    public function save()
    {
        if(request()->isPost())
        {
            $date = input('post.');
            if(empty($date['isshow'])) $date['isshow'] = 0;
            $validate = Loader::validate('brand');

            if(!$validate->check($date))
            {
                return $validate->getError();
            }

            if($date['logo'] !== model('brand')->get($date['id'])->logo)
            {
                @unlink('.'.model('brand')->get($date['id'])->logo);   //如果品牌logo图片改变，删除原图片
            }

            if(model('brand')->allowField(true)->save($date,$date['id']))
            {
                return jsdata(200,'品牌更新成功……', '/admin/brand');
            } else {
                return '更新失败';
            }
        } else {
            $data = model('brand')->get(input('id'));
            $this->assign('brand', $data);
            $cate = db('category')->where('pid', 0)->field('id,name')->order('id')->select();
            $this->assign('cate', $cate);
            return view();
        }
    }

    /**
     * Title:删除品牌
     * Notes:del
     * @return mixed
     */
    public function del()
    {
        if(@unlink('.'.model('brand')->get(input('id'))->logo) && Db('brand')->delete(input('id')))
        {
            return jsdata(200, '删除成功！','/admin/brand/');
        }else{
            return '删除失败！';
        }
    }
}
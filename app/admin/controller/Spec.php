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
        $list = model('spec')->order(array('sort' => 'asc', 'spec_id' => 'asc'))->paginate(10);

        $this->assign('list', $list);

        return view();
    }

    /**
     * 根据类别获取规格
     *
     * @return void
     */
    public function get()
    {
        $cid = input('post.cid');
        $specs = db('goods_spec')->where(['cid' => $cid])->select();
        return ['status' => 200, 'msg' => '规格列表', 'data' => $specs];
    }
    /**
     * Title: 添加商品规格
     * Notes:add
     * @return array|string|
     */
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $validate = Loader::validate('spec');

            if (!$validate->check($data)) {
                return $validate->getError();
            }

            $spec = model('spec')->data($data, true);

            if ($spec->allowField(true)->save()) {
                return jsdata(200, '商品规格添加成功……', '/admin/spec');
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
        if (request()->isPost()) {
            $data = input('post.');

            if (model('spec')->allowField(true)->save($data, ['spec_id' => $data['spec_id']])) {
                return jsdata(200, '更新成功……', '/admin/spec');
            } else {
                return '更新失败';
            }
        } else {
            $data = model('spec')->get(input('id'));
            $this->assign('spec', $data);
            $cate = db('category')->where('pid', 0)->field('id,name')->order('id')->select(); //所属分类
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
        if (Db::name('spec')->delete($id)) {
            return jsdata(200, '商品规格删除成功!', '/admin/spec');
        } else {
            return jsdata(203, '商品规格删除失败');
        }
    }
}

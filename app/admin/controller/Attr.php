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
        $this->assign('list', model('attr')->order('attr_id')->paginate(12));
        return view();
    }
    /**
     * Title:添加商品属性
     * Notes:add
     * @return array|string|\think\response\View
     */
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $validate = Loader::validate('attr');

            if (!$validate->check($data)) {
                return $validate->getError();
            }

            // $data['items'] = str_replace('，', ',', $data['items']); //中文逗号统一半角逗号
            $attr = model('attr')->data($data, true);

            if ($attr->allowField(true)->save()) {
                return jsdata(200, '商品属性添加成功……', '/admin/attr');
            } else {
                return '商品属性添加失败……';
            }
        } else {
            $categories = db('category')->where('pid', 0)->field('id,name')->order('id')->select();
            $this->assign('categories', $categories);
            $cid = $categories[0]['id'];
            $specs = db('goods_spec')->where('cid', $cid)->select();
            $this->assign('specs', $specs);
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
        if (request()->isPost()) {
            $data = input('post.');

            if (model('attr')->allowField(true)->save($data, $data['attr_id'])) {
                return jsdata(200, '更新成功……', '/admin/attr');
            } else {
                return '更新失败';
            }
        } else {
            $attr = model('attr')->get(input('id'));
            $this->assign('attr', $attr);

            $spec_id = $attr['spec_id'];

            $spec = db('goods_spec')->where(['spec_id' => $spec_id])->find();
            $this->assign('spec', $spec);

            $categories = db('category')->select();
            $this->assign('categories', $categories);

            $specs = db('goods_spec')->where('cid', $spec['cid'])->order('spec_id')->select(); //所属分类
            $this->assign('specs', $specs);
            return view();
        }
    }

    /**
     * 删除属性
     */
    public function del()
    {
        $id = input('id');
        db('goods_attr')->where(['attr_id' => $id])->delete();
        return ['status' => 200, 'msg' => '删除成功', 'url' => '/admin/attr'];
    }
}

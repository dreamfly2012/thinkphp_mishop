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
 * Time: 2018/4/17 15:29
 */

namespace app\admin\controller;

use think\Loader;

class Category extends Common
{
    /**
     * Title: 分类列表
     * Notes:index
     * @return db
     */
    public function index()
    {
        $list = db('category')->order('sort, id')->select();

        function tree_Classify($data,  $pid = 0, $html = "", $l = 0){
            $tree=array();
            foreach ($data as $vo)
            {
                if($vo['pid'] == $pid)
                {
                    foreach ($data as $v)
                    {
                        if($v['pid'] == $vo['id'])
                        {
                            $vo['level'] = 1;
                        }
                    };

                    $vo['html'] = str_repeat($html, $l);
                    $tree[] = $vo;
                    $tree = array_merge($tree, tree_Classify($data, $vo['id'], $html  = '|—　',$l + 1));
                }
            }
            return $tree;
        };

        $this->assign('list', tree_Classify($list));
        return view();
    }

    /**
     * Title:添加分类
     * Notes:add
     * @return model
     */
    public function add()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $validate = Loader::validate('category');

            if(!$validate->check($data))
            {
                return $validate->getError();
            }

            $cate = model('category') -> data($data, true);

            if( $cate->allowField(true)->save())
            {
                return jsdata(200, '分类添加成功……','/admin/category');
            } else {
                return '分类添加失败';
            }
        } else {
            input('id') == false ? $pid = 0 : $pid = input('id');
            $this->assign('pid', $pid);
            return view();
        }
    }

    /**
     * Title:更新商品分类
     * Notes:save
     * @return array|string
     */
    public function save()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $validate = Loader::validate('category');

            if(!$validate->check($data))
            {
                return $validate->getError();
            }

            if($data['catepic'] !== model('category')->get($data['id'])->catepic)
            {
                @unlink('.'.model('category')->get($data['id'])->catepic);   //如果分类展示图片改变，删除原图片
            }
            $data['hot'] = empty($data['hot']) ? 0 : 1;
            $data['color'] = empty($data['color']) ? 0 :1;
            if(model('category')->allowField(true)->save($data,$data['id']))
            {
                return jsdata(200,'商品分类更新成功……', '/admin/category');
            } else {
                return '更新失败';
            }
        } else {
            $this->assign('cate', model('category')->get(input('id')));
            return view();
        }
    }

    /**
     * Title:删除分类
     * Notes:del
     * @return array|string
     */
    public function del()
    {
        if(@unlink('.'.model('category')->get(input('id'))->catepic) && Db('category')->delete(input('id')))
        {
            return jsdata(200, '删除成功！','/admin/category/');
        }else{
            return '删除失败！';
        }
    }
}
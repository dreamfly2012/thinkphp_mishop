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
 * Time: 2018/4/16 17:00
 */

namespace app\admin\controller;
use think\Loader;

class Link extends Common
{
    /**
     * Title:友链列表
     * Notes:index
     * @return View
     */
    public function index()
    {
        $list = db('link')->order('sort, id')->paginate(12);
        $this->assign('list', $list);
        return view();
    }

    /**
     * Title:添加友链
     * Notes:add
     * @return array
     */
    public function add()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $validate = Loader::validate('link');

            if(!$validate->check($data))
            {
                return $validate->getError();
            }

            unset( $data['__token__']);

            if(Db('link')->insert($data)) {
                return jsdata(200, '友链添加成功……','/admin/link/');
            }else{
                return '友链添加失败！';
            }
        } else {
            return view();
        }
    }

    /**
     * Title:删除友链
     * Notes:del
     * @return array|string
     */
    public function del()
    {
        if( Db('link')->delete(input('id')))
        {
            return jsdata(200, '删除成功！','/admin/link/');
        }else{
            return '删除失败！';
        }
    }

    /**
     * Title:友链更新
     * Notes:save
     * @return array|string
     */
    public function save()
    {
        if(Db('link')->update(input('post.')))
        {
            return jsdata(200, '更新成功……','/admin/link');
        }else {
            return '更新失败！';
        }
    }
}
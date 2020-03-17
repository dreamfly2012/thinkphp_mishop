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
 * Time: 2018/4/22 19:33
 */

namespace app\admin\controller;
use think\Db;
use think\Loader;

class Ad extends Common
{
    /**
     * Title: 广告列表
     * Notes:index
     * @return
     */
    public function index()
    {
        $ad = model('ad')->order('id')->select();
        $this->assign('list', $ad);
        return view();
    }

    /**
     * Title: 新增广告
     * Notes:add
     */
    public function add()
    {
        if(request()->isPost())
        {
            $ad = input('post.');
            $validate = Loader::validate('ad');

            if(!$validate->check($ad))
            {
                return $validate->getError();
            }

            $ad = model('ad')->data($ad, true);

            if($ad->allowField(true)->save())
            {
                return jsdata('200', '广告添加成功……','/admin/ad');
            } else {
                return '广告添加失败 !';
            }

        } else {
            $list = Config('adposts');
            $this->assign('list', $list);
            return view();
        }
    }

    /**
     * Title: 编辑广告
     * Notes:save
     * @return
     */
    public function save()
    {
        if(request()->isPost() )
        {
            $ad = input('post.');
            $validate = Loader::validate('ad');

            if(!$validate->check($ad))
            {
                return $validate->getError();
            }

            if($ad['ad_code'] !== model('ad')->get($ad['id'])->ad_code)
            {
                @unlink('.'.model('ad')->get($ad['id'])->ad_code);   //如果品牌logo图片改变，删除原图片
            }
            $ad['enabled'] = empty($ad['enabled']) ? 0 : $ad['enabled'];
            if(model('ad')->allowField(true)->save($ad,$ad['id']))
            {
                return jsdata(200,'广告更新成功……', '/admin/ad');
            } else {
                return '更新失败';
            }

        } else {
            $id = input('id');
            $ad = model('ad')->get($id);
            $this->assign('ad', $ad);
            $list = Config('adposts');
            $this->assign('list', $list);
            return view();
        }
    }

}
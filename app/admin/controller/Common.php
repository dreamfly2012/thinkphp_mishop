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
 * Time: 2018/4/16 22:15
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\News;

class Common extends Controller
{
    protected function _initialize()
    {
        if(!Session('user')) {
            $this->redirect('/admin/login.shtml');
     	    exit();
     };
       $news = new News;
       $new = $news->get_news(5);
       $this->assign('new', $new);
       $this->base();
    }

    //公共变量
    public function base()
    {
        $config = db('config')->where('type', 'system')->select();

        foreach($config as $v)
        {
            //网站名称
            if($v['keyname'] == 'SiteaName') $SiteaName = $v['v'];
            //网站地址
            if($v['keyname'] == 'SiteaUrl') $SiteaUrl = $v['v'];
            //版权信息
            if($v['keyname'] == 'MetaCopyright') $MetaCopyright = '<a href="'. $SiteaUrl .'" class="bluer"> '. $SiteaName .'</a> '. $v['v'] . date('Y',time()) . ' 版权所有';
            //备案号
            if($v['keyname'] == 'RecordNo') $RecordNo = $v['v'];
            //网站logo
            if($v['keyname'] == 'SiteaLogo') $SiteaLogo = $v['v'];
        }

        $this->assign('SiteaName', $SiteaName);
        $this->assign('SiteaUrl', $SiteaUrl);
        $this->assign('MetaCopyright', $MetaCopyright);
        $this->assign('RecordNo', $RecordNo);
        $this->assign('SiteaLogo', $SiteaLogo);
    }
}

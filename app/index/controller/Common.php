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
 * Time: 2018/4/20 23:01
 */
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\index\model\CartLogic;

class Common extends Controller {

    public $session_id;
    public $user_id = 0;
	public function _initialize()
    {
        /*if(Request::instance()->isMobile())
        {
            $this->redirect('/m');
        }*/
        if(!empty(session('users'))) {
            $user = session('users');
            $this->assign('users', $user);
        }
        $this->base();
        $cart = new CartLogic;
        $user_id = empty(session('users')) ? 0 : session('users.id');
        $cart->setUserId($user_id);
	    $cartnum = $cart->getuserCartGoodsTypeNum();
        $this->assign('cartnum', $cartnum);     //购物车数量

	}
	//公共变量
	public function base()
	{
		$config = db('config')->select();
		foreach($config as $v)
		{	//网站名称
			if($v['keyname'] == 'SiteaName') $SiteaName = $v['v'];
			//网站地址
			if($v['keyname'] == 'SiteaUrl') $SiteaUrl = $v['v'];
			//网站关键字
			if($v['keyname'] == 'MetaKeywords') $MetaKeywords = $v['v'];
			//网站描述
			if($v['keyname'] == 'MetaDescription') $MetaDescription = $v['v'];
			//版权信息
			if($v['keyname'] == 'MetaCopyright') $MetaCopyright = $v['v'];
			//备案号
			if($v['keyname'] == 'RecordNo') $RecordNo = $v['v'];
		}
		$this->assign('SiteaName', $SiteaName);
		$this->assign('SiteaUrl', $SiteaUrl);
		$this->assign('MetaKeywords', $MetaKeywords);
		$this->assign('MetaDescription', $MetaDescription);
		$this->assign('MetaCopyright', $MetaCopyright);
		$this->assign('RecordNo', $RecordNo);
	}
}
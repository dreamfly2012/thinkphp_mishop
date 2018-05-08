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
 * Time: 2018/4/16 13:17
 */

namespace app\admin\controller;
use think\Loader;

class Mail extends Common
{
     /**
     * Title: 邮件设置
     * Notes:index
      */
    public function index()
    {
        $mail = config('mail');
        $this->assign('mail', $mail);
        return view();
    }

    /**
     * Title: 测试发送邮件
     * Notes:sendemail
     * @return array
     */
    public function sendemail()
    {
        $mail = config('mail');

        if($mail['unlock'] == false) return jsdata(300, '邮箱未启用……');

        $fromName = db('config')->where('keyname', 'SiteaName')->value('v');

        $html = '<div style="background:#f5f5f5;overflow:hidden"><div style="background:#fff;border:1px solid #e5e5e5;margin:2%;padding:0 30px"><div style="line-height:40px;height:40px"></div>'.
                '<p style="margin:0;padding:0;font-size:14px;line-height:30px;color:#333;font-family:arial,sans-serif;font-weight:bold">亲爱的用户：</p>'.
                '<div style="line-height:20px;height:20px"></div>'.
                '<p style="margin:0;padding:0;line-height:30px;font-size:14px;color:#333;font-family:\'宋体\',arial,sans-serif">您好！感谢您使用 '. $fromName . '系统服务，您正在进行后台邮箱验证测试，本次请求的测试码为：</p>'.
                '<p style="margin:0;padding:0;line-height:30px;font-size:14px;color:#333;font-family:\'宋体\',arial,sans-serif">'.
                '<b style="font-size:18px;color:#f90;"><span>'.mt_rand(100000,999999).'</span></b><span style="margin:0;padding:0;margin-left:10px;line-height:30px;font-size:14px;color:#979797;font-family:\'宋体\',arial,sans-serif">(本测试码为测试所用，无须验证！)</span>'.
                '</p>'.
                '<div style="line-height:80px;height:80px"></div>'.
                '<div style="border-top:1px dashed #dfdfdf;padding-bottom:20px;overflow:hidden"><p>本邮件为系统自动发送，请勿回复，感谢您的使用。</p></div>'.
                '</div></div>';

        $res = send_email($mail['test_eamil'],'后台邮箱测试',$html, $fromName);
        return $res;
    }

     /**
     * Title: 邮件配置更新
     * Notes:save
     * @return array
     */
    public function save()
    {
        $mail = input('post.');
        $validate  = Loader::validate('config');    //验证条件相同，复用

        if(!$validate->check($mail))
        {
            return $validate->getError();
        };

        unset($mail['__token__']);

        if(empty($mail['unlock'])) $mail['unlock'] = 0;

        @file_put_contents(CONF_PATH .'/extra/mail.php', "<?php \nreturn " . stripslashes(var_export($mail, true)) . ";", LOCK_EX);

        return jsdata(200, '邮件配置文件已保存……','/admin/mail',2);
    }
}
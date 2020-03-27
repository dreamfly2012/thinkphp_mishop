<?php

function jsdata($status, $msg, $url = '', $wait = 3)
{
    $return_arr = array(
        'status' => $status,
        'msg' => $msg,
        'wait' => $wait,
        'url' => $url,
    );
    return $return_arr;
}
//发送邮件
function email($to, $subject = '', $content = '')
{
    $mail = new \PHPMailer\PHPMailer;
    $Cmail = config('mail');
    if ($Cmail['unlock'] == false) {
        $mail->IsSMTP();
        //smtp服务器
        $mail->Host = $Cmail['SMTP'];
        //邮件发送端口
        $mail->Port = $Cmail['port'];
        //是否验证
        $mail->SMTPAuth = true;
        //字符集
        $mail->CharSet = 'UTF-8';
        //用户名和密码
        $mail->Username = $Cmail['email'];
        $mail->Password = $Cmail['pwd'];
        //邮件标题
        $mail->Subject = $subject;
        //收件人地址
        $mail->From = $Cmail['email'];
        //发件人名称
        $mail->FromName = '小米商城';

        // $mail->setFrom($Cmail['email']);

        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->Body = $content;

        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
//转码
function gbk($a)
{
    $utf = '';
    for ($i = 0; $i < strlen($a); $i++) {
        $utf .= sprintf("%%%02X", ord(substr($a, $i, 1)));
    }
    return $utf;
}

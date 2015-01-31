<?php
include_once("smtp.class.php");
//$smtpemailto = "shiyemin2@qq.com";//发送给谁
//$content = "http://www.baidu.com";

if(!isset($mailbody))
{
	$mailbody = "<h1> 本邮件由系统自动发送，请勿回复。 </h1> 请点击以下链接确认：<br/>".$content;//邮件内容
}
if(!isset($mailsubject))
{
	$mailsubject = "技术与创意设计大赛——账号确认邮件";//邮件主题
}

$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "smartcity_mlg@163.com";//SMTP服务器的用户邮箱
$smtpuser = "smartcity_mlg";//SMTP服务器的用户帐号
$smtppass = "mlg12344321";//SMTP服务器的用户密码
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

$smtp= new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
$smtp->debug = FALSE;//是否显示发送的调试信息
$send_result = $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);

?>


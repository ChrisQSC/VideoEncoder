<?php
	header("Content-Type: text/html;charset=utf-8");
	require_once("inject_check.php");
	inject_check($_GET['name']);
	
	if (!get_magic_quotes_gpc()) {
		$username = addslashes(trim($_GET['name'])); 
	}
	else
	{
		$username = trim($_GET['name']); 
	}   
	$key = trim($_GET['key']); 

	require_once('mysql_config.php');
	
	$sql = "SELECT id, name, password, email FROM User WHERE name='$username';"; 
	// 取得查询结果 
	$result = mysql_query( $sql ); 
	if (!$result) {
		mylog("Log WORNING [ mysql error. Query[$sql]");
		print "Error - login error!";
		exit;
	}
				
				
	$userInfo = mysql_fetch_array($result); 

	if (!empty($userInfo)) { 
		if ($userInfo["name"] == $username) { 
			if($key == MD5($username.$userInfo["password"].$userInfo["email"]."state:0"))
			{
				$smtpemailto = $userInfo["email"];//发送给谁
				$link = "http://124.207.250.83:8080/src_data/附件3：视频分析技术挑战赛评测数据集使用协议.docx";
				$mailbody = "<h1> 本邮件由系统自动发送。 </h1><a href=\"$link\">协议下载</a>  <br/>您好！欢迎参加大赛！请填写好协议，并扫描为电子版并发送到本邮箱，并请在邮件中注明要参加的比赛项目（视频分析技术挑战赛共分六个项目，可以选择一个或多个参加）。
				<br/>    审核通过后将根据您的参赛项目为您提供训练及测试数据集，请关注本邮箱发送的邮件，谢谢。";
				$mailsubject = "技术与创意设计大赛——协议签署";//邮件主题
				include_once("mail.php");
				if(!$send_result)
				{
					mylog("Log WORNING [ mail send error. Email[$smtpemailto]");
					die("<script type='text/javascript'>alert('邮件发送失败！请确认注册邮箱可用，并稍后重试。');</script>"); 
				}
				
				$sql = "UPDATE User set state=1 WHERE id=".$userInfo["id"].";"; 
				// 取得查询结果 
				$result = mysql_query( $sql ); 
				if (!$result) {
					mylog("Log WORNING [ mysql error. Query[$sql]");
					print "Error - mysql error!";
					exit;
				}
				echo "<script type='text/javascript'>alert('验证成功！请重新登录。相关资源已发送至注册邮箱，请查收。');location.href='login.php';</script>"; 
			}
			
		}
	} 
	
?>
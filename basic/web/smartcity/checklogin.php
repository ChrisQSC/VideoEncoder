<?php
	session_start();
    require_once('include.php');
?>
<html>
	<head> <title> 登录检查 </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<style type = "text/css">
			</style>
		</head>
	
	<body bgcolor="#FFFFFF" text="#000000" link="#0000FF"
		vlink="#000080" alink="#FF0000">
		
		<?php require_once('login.php'); ?> 
		<?php 
		
			if(!isset($_POST['username'])){
				exit('非法访问!');
			}

			// 表单提交后... 
            require_once("inject_check.php");
            inject_check($_REQUEST['username']);
            inject_check($_REQUEST['password']);
            
            if (!get_magic_quotes_gpc()) {
                $username = addslashes(trim($_REQUEST['username'])); 
                $password = md5(addslashes(trim($_REQUEST['password']))); 
            }
            else
            {
                $username = trim($_REQUEST['username']); 
                $password = md5(trim($_REQUEST['password'])); 
            }   

			require_once('mysql_config.php');
			
			$sql = "SELECT id, name, password, state, active FROM User WHERE name='$username' AND password='$password';"; 
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
					if($userInfo["active"] == 0)
					{
						mylog("Log WORNING [ id:".$userInfo['id']." user:".$userInfo["name"]." log in. Not active. [active == 0]]");
						die("账号已删除！"); 
					}
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
                    $_SESSION['id'] = md5($userInfo["id"]);
                    mylog("Log NOTICE [ id:".$_SESSION['id']." user:".$_SESSION['username']." log in.]");
					
					if($userInfo["state"] == 0)
					{
						mylog("Log WORNING [ id:".$userInfo['id']." user:".$userInfo["name"]." log in. Not active. [state == 0]]");
						$_SESSION['state'] = md5($username.$password.$_SESSION['id']);
						echo("<meta http-equiv=refresh content='0; url=regInfo.php'>"); 
					}
					else
					{
						echo("<meta http-equiv=refresh content='0; url=mainPage.php'>"); 
						// 注册登陆成功的 admin 变量，并赋值 true 
						exit;
					}
				} else { 
				    mylog("Log WORNING [ id:".$userInfo['id']." user:".$userInfo['name']." log in.]");
					die("用户名密码错误"); 
				} 
			} else { 
			     mylog("Log WORNING [ user:[".$_REQUEST['username']."] tried to log in with password:[".$_REQUEST['password']."]. log in failed.]");
				die("用户名密码错误"); 
			} 
		?> 
	</body>
</html>
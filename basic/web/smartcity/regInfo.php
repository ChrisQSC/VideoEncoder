<?php

/**
 * @author shiyemin
 * @copyright 2013
 */

	session_start(); 
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['id']) || !isset($_SESSION['state']))
	{
		echo("<meta http-equiv=refresh content='0; url=login.php'>"); 
		exit;
	}
	if($_SESSION['state'] != md5($_SESSION['username'].$_SESSION['password'].$_SESSION['id']))
	{
		echo("<meta http-equiv=refresh content='0; url=login.php'>"); 
		exit;
	}
	
	header("Cache-control: private"); 


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="js/func.js"></script> 
    
  <link rel="stylesheet" href="css/pure-min.css" type="text/css" />
  <link rel="stylesheet" href="css/global.css" type="text/css" />
    <title>完善资料</title> 
</head> 
<body > 
    <?php 
        //error_reporting(0); 
        //不让PHP报告有错语发生。如果不关闭好有类似这的错语 Warning: preg_match() 关闭就不出现了 
        require_once('mysql_config.php');
        mysql_query("set names utf8"); 
        if(isset($_POST['submit']))
        { 
            require_once("inject_check.php");
            inject_check($_SESSION['username']);
            inject_check($_SESSION['password']);
            inject_check($_POST['email']);
            inject_check($_POST['web']);
            
            if (!get_magic_quotes_gpc()) {
                $email = addslashes($_POST["email"]);
				$web = addslashes($_POST["web"]);
            }
            else
            {
                $email = $_POST["email"];
				$web = $_POST["web"];
            }
			$username = $_SESSION['username'];
			$pass = $_SESSION['password'];
			
            $sql="select name from user where name='$username' and password = '$pass';"; 
            // echo $sql; 
            $query = mysql_query($sql); 
            if (!$query) {
                mylog("Log WORNING [ mysql error. Query[$sql]");
    			print "Error - register error!";
    			exit;
    		}
            $rows = mysql_num_rows($query); 
            if($rows <= 0){ 
                echo "<script type='text/javascript'>alert('用户不存在');location='javascript:history.back()';</script>"; 
            }else{ 
                $user_update = "update user set email = '$email', web = '$web' where name = '$username' and password = '$pass';"; 
				$smtpemailto = $email;//发送给谁
				$link = "http://124.207.250.83:8080/mail_check.php?name=$username&key=".MD5($username.$pass.$email."state:0");
				$content = "<a href=\"$link\">$link</a>";
				include_once("mail.php");
				if(!$send_result)
				{
					mylog("Log WORNING [ mail send error. Query[$user_update]");
					echo "<script type='text/javascript'>alert('更新失败！请确认邮箱可用，并稍后重试。');</script>"; 
				}
				else
				{
					//echo $user_update; 
					$result = mysql_query($user_update); 
					if (!$result) {
						print "Error - register error!";
						mylog("Log WORNING [ mysql error. Query[$user_update]");
						exit;
					}
					echo "<script type='text/javascript'>alert('更新成功！请查看邮箱，进行验证，并重新登陆。');location.href='logout.php';</script>"; 
				}
            } 
            //javascript:history.go(-1) 
        } 
    ?> 
    <div class="pure-g-r main-content text-center">
  </div>
  <div class="pure-g-r text-center">
    <div class="pure-u">
    <form action="reginfo.php" name="reg_form" method="post" onsubmit="return check_reg()" class="pure-form pure-form-aligned "> 
		<fieldset>
		  <legend>完善在线评测系统资料</legend>
			
			<div class="pure-control-group">
				<label for="email">Email</label>
				<input id="email" name="email" type="text" placeholder="Email"  onblur="check_email(this)" />
			</div>
			<span id="show_e" style="color:red;"></span>
			
			<div class="pure-control-group">
				<label for="web">主页</label>
				<input id="web" name="web" type="text" placeholder="主页"  onblur="check_web(this)" />
			</div>
			<span id="show_web" style="color:red;"></span>

			<div class="pure-controls text-left">
				<button type="submit" name="submit" class="pure-button">Submit</button>
				<button type="reset" class="pure-button">Reset</button>
			</div>
			
		</fieldset>
    </form> 
    </div>
    </div>
</body> 
</html> 
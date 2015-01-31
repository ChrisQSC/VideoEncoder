<?php

/**
 * @author shiyemin
 * @copyright 2013
 */
    
    if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['id']))
    {
        echo("<meta http-equiv=refresh content='0; url=login.php'>"); 
        exit;
    }
    
    require_once("inject_check.php");
    inject_check($_SESSION['username']);
    inject_check($_SESSION['password']);
    inject_check($_SESSION['id']);
    
    if (!get_magic_quotes_gpc()) {
        $username = addslashes(trim($_SESSION['username'])); 
        $password = addslashes(trim($_SESSION['password'])); 
        $id = addslashes(trim($_SESSION['id']));
    }
    else
    {
        $username = trim($_SESSION['username']); 
        $password = trim($_SESSION['password']); 
        $id = trim($_SESSION['id']);
    }   

	require_once('mysql_config.php');
	
	$sql = "SELECT id, name, password, authority, state, active  FROM User WHERE name='$username' AND password='$password';"; 
	// 取得查询结果 
	$result = mysql_query( $sql ); 
	if (!$result) {
        mylog("Log WORNING [ mysql error. Query[$sql]");
		print "Error - login error!";
		exit;
	}
				
				
	$userInfo = mysql_fetch_array($result); 

	if (!empty($userInfo)) { 
		if (md5($userInfo["id"]) == $id) { 
			if($userInfo["active"] == 0)
			{
				mylog("Log WORNING [ id:".$_SESSION['id']." user:".$_SESSION['username']." log in. Not active. [active == 0]]");
				echo("<meta http-equiv=refresh content='0; url=logout.php'>"); 
				exit;
			}
			if($userInfo["state"] == 0)
			{
				mylog("Log WORNING [ id:".$userInfo['id']." user:".$userInfo["name"]." log in. Not active. [state == 0]]");
				$_SESSION['state'] = md5($username.$password.$id);
				echo("<meta http-equiv=refresh content='0; url=regInfo.php'>"); 
				exit;
			}
		} else { 
            echo("<meta http-equiv=refresh content='0; url=logout.php'>"); 
            exit;
		} 
	} else { 
        echo("<meta http-equiv=refresh content='0; url=logout.php'>"); 
        exit;
	} 

?>
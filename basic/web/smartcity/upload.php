<?php
	session_start();
    //禁用错误报告
	error_reporting(0);
	header("Content-type: text/html; charset=utf-8"); 
    require_once("check_status.php");
    require_once('include.php');
    require_once('enable_upload.php');
?>
<?php

/**
 * @author shiyemin
 * @copyright 2013
 */
    if(!isset($_SESSION['new_file_name']))
    {
        echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
        exit;
    }

    $res = insert_task($_SESSION['new_file_name'], $userInfo["id"]);
    
    unset($_SESSION['new_file_name']);
    
    function insert_task($file, $id)
    {
        if (!get_magic_quotes_gpc()) {
            $new_file_name = addslashes($_SESSION['new_file_name']);
        }
        else
        {
            $new_file_name = $_SESSION['new_file_name'];
        }
        
		$xml = simplexml_load_file($new_file_name); 
		if(!isset($xml->Info))
		{
			echo "<script>alert('文件结构错误，请检查后重新上传！')</script>";
			echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
			exit;
		}
		$attr = $xml->Info->attributes();
		$upload_index = (int)($attr['evaluateType']);
		$mediaFile = strval($attr['mediaFile']);
		
        require_once('mysql_config.php');
        $insert_res = true;
        mysql_query("BEGIN");
		
		$sql = "insert into task values(NULL, $id, $upload_index, \"$new_file_name\", NULL, 0, \"$mediaFile\");";
		$result = mysql_query( $sql ); 
		if (!$result) {
			mylog("Log WORNING [ mysql error. Query[$sql]");
			$insert_res = false;
		}
		
        if($insert_res)
        {
            global $user_count, $userInfo;
            $sql = "update upload_count set count=".($user_count["count"] + 1)." where id=".$userInfo["id"].";"; 
        	// 取得查询结果 
        	$result = mysql_query( $sql ); 
        	if (!$result) {
                mylog("Log WORNING [ mysql error. Query[$sql]");
        		print "Error - mysql error!";
        		exit;
        	}
            $result = mysql_query("COMMIT");
        	if (!$result) {
                mylog("Log WORNING [ mysql error. Query[$sql]");
        		print "Error - mysql error!";
        		exit;
        	}
            echo "<script>alert('Task is added successfully. Please wait for result.')</script>";
        }
        else
        {
            mysql_query("ROLLBACK");
   			print "Error - mysql error!";
            echo "<script>alert('Add task failed. Please try again, later.')</script>";
        }
        mysql_query("END");
        echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
    }

?>
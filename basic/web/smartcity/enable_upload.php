<?php

/**
 * @author shiyemin
 * @copyright 2013
 */

    $xml = simplexml_load_file(".\\conf\\config.ini"); 
    $start = strtotime($xml->enable->start);
    $end = strtotime($xml->enable->end);
    $max_upload = (int)($xml->max_upload_day);
    $now = time();
    if(!($now >= $start && $now <= $end))
    {
        echo "<script>alert('The system has shut down.')</script>";
        echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
        
        exit;
    }
    
    require_once('mysql_config.php');
	
	$sql = "SELECT * FROM upload_count WHERE id=".$userInfo["id"].";"; 
	// 取得查询结果 
	$result = mysql_query( $sql ); 
	if (!$result) {
        mylog("Log WORNING [ mysql error. Query[$sql]");
		print "Error - mysql error!";
		exit;
	}
				
	$user_count = mysql_fetch_array($result); 

    $today = date("Y/m/d", time());
	if (!empty($user_count)) { 
        if($today != $user_count["time"])
        {
            $sql = "update upload_count set count=0, time=\"$today\" where id=".$userInfo["id"].";"; 
        	// 取得查询结果 
        	$result = mysql_query( $sql ); 
        	if (!$result) {
                mylog("Log WORNING [ mysql error. Query[$sql]");
        		print "Error - mysql error!";
        		exit;
        	}
        }
		else if ($user_count["count"] >= $max_upload) {
            echo "<script>alert('The number of deliveries is exceeded.')</script>";
            echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
            
            exit;
		} 
	} else { 
        $sql = "insert into upload_count values (NULL, ".$userInfo["id"].", 0, \"".$today."\");"; 
    	// 取得查询结果 
    	$result = mysql_query( $sql ); 
    	if (!$result) {
            mylog("Log WORNING [ mysql error. Query[$sql]");
    		print "Error - mysql error!";
    		exit;
    	}
	} 

?>
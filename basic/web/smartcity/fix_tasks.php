<?php
	session_start();
	iconv_set_encoding("internal_encoding", "UTF-8");
	iconv_set_encoding("output_encoding", "UTF-8");
    
    require_once('include.php');
?>
<?php

/**
 * @author shiyemin
 * @copyright 2013
 */
 
    //ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
    set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
    
	$interval = 5;// 每隔5s运行
	
	require_once('mysql_config.php');
	
	$sql = "LOCK TABLES task WRITE"; //表的WRITE锁定，阻塞其他所有mysql查询进程 
	$query_result = mysql_query( $sql ); 
	if(!$query_result)
	{
		print "mysql error!";
		mylog("Log WORNING [ mysql error. Query[$query]");
		return;
	}
	
	$sql = "UPDATE task SET status=0 where status=1;";
	$result = mysql_query( $sql ); 
	if (!$result) {
		mylog("Log WORNING [ mysql error. Query[$sql]");
	}
	
	$sql = "UNLOCK TABLES"; 
	$query_result = mysql_query( $sql ); 
	if(!$query_result)
	{
		mylog("Log WORNING [ mysql error. Query[$query]");
	}
	

?>
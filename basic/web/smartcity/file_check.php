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
        echo("<meta http-equiv=refresh content='0; url=./mainPage.php'>");
        exit;
    }

    if(check_file($_SESSION['new_file_name']))
    {
        mylog("Log NOTICE [ id:".$_SESSION['id']." user:".$_SESSION['username']." uploaded file:".$_SESSION['new_file_name']." pass.]");
        echo("<meta http-equiv=refresh content='0; url=./upload.php'>");
    }
    else
    {
        mylog("Log NOTICE [ id:".$_SESSION['id']." user:".$_SESSION['username']." uploaded file:".$_SESSION['new_file_name']." check fail.]");
        
        echo "<script>alert('file check failed!XML is needed!')</script>";
        echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
        exit;
    }
    
    function check_file($filename)
    {
        $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if($fileType == "xml")
        {
            return true;
        }
        return false;
    }
    
?>
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

    if(isset($_FILES))
    {
        if(!isset($_FILES['name']))
        {
            echo("<meta http-equiv=refresh content='0; url=mainPage.php'>"); 
        }
        if(upfiles($_FILES['name'], "./files/"))
        {
            echo("<meta http-equiv=refresh content='0; url=file_check.php'>"); 
        }
        else
        {
            echo("<meta http-equiv=refresh content='0; url=mainPage.php'>"); 
        }
    }
    else
    {
        echo("<meta http-equiv=refresh content='0; url=mainPage.php'>"); 
    }
    
    function upfiles($files, $path)
    {
        $nowtimestamp = time();
        //$exname = strtolower(
        //    substr($files['name'], (strrpos($files['name'], '.') + 1)));
        $exname = strtolower(pathinfo($files['name'], PATHINFO_EXTENSION));
        if($exname != "xml")
        {
            mylog("Log ERROR [ id:".$_SESSION['id']." user:".$_SESSION['username']." upload file:".$files['name']." failed. extesion not correct]");
            echo "<script>alert('Upload failed. Type error. Please try again later.')</script>";
            return false;
        }
        $i = 1;
        if(!file_exists($path.md5($_SESSION['username'])."/"))
        {
            mkdir($path.md5($_SESSION['username'])."/", 0777);
        }
        if(!move_uploaded_file($files['tmp_name'], 
            $path.md5($_SESSION['username'])."/".$nowtimestamp.'.'.$exname))
        {
            mylog("Log ERROR [ id:".$_SESSION['id']." user:".$_SESSION['username']." upload file:".$files['name']." failed. move file failed]");
            echo "<script>alert('Upload failed. Please try again later.')</script>";
            return false;
        }
        else
        {
            $_SESSION['new_file_name'] = $path."/".md5($_SESSION['username'])."/".$nowtimestamp.'.'.$exname;
            mylog("Log NOTICE [ id:".$_SESSION['id']." user:".$_SESSION['username']." upload file:".$files['name']." rewrite:".$path.md5($_SESSION['username'])."/".$nowtimestamp.'.'.$exname." successfully.]");
        }
        return true;
    }

?>
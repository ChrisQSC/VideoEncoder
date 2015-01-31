<?php   
	session_start();   
    require_once('include.php');
    if(isset($_SESSION['id']))
    {
        mylog("Log NOTICE [ id:".$_SESSION['id']." user:".$_SESSION['username']." log out.]");
	   // 这种方法是将原来注册的某个变量销毁 
    }
    session_unset();
    session_destroy();
	echo("<meta http-equiv=refresh content='0; url=index.php'>"); 

?>
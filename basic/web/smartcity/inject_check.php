<?php

/**
 * @author shiyemin
 * @copyright 2013
 */
    require_once('include.php');
    function inject_check($sql_str) { 
        $check=preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);     // 进行过滤 
        if($check){ 
            echo "提交参数错误，请修改参数或重新登录！"; 
            mylog("Log WORNING [ inject_check failed. sql_str:[$sql_str]]");
            exit(); 
        }else{ 
            return true; 
        } 
    } 
 
?>
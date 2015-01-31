<?php

/**
 * @author shiyemin
 * @copyright 2013
 */
    date_default_timezone_set("PRC");
    function mylog($str)
    {
        $date = date("Ymd", time());
        $time_now = date("Ymd H:i:s", time());
        $filename = "./logs/log.".$date.".txt";
        $fp = fopen($filename, "a+");
        if($fp)
        {
            if(flock($fp, LOCK_EX))
            {
                fwrite($fp, $time_now." ".$str."\r\n");
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }
    }

?>
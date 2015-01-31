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
    
    $xml = simplexml_load_file(".\\conf\\config.ini"); 
    $eva_prog = trim(strval($xml->prog));
	print $eva_prog."\n";
    get_score($eva_prog);   
    
    function get_score($eva_prog)
    {
        $interval = 5;// 每隔5s运行
        $xml_parser = xml_parser_create(); 
        $script_path = dirname(__FILE__);
		
        require_once('mysql_config.php');
        do{
            $sql = "LOCK TABLES task WRITE"; //表的WRITE锁定，阻塞其他所有mysql查询进程 
            $query_result = mysql_query( $sql ); 
            if(!$query_result)
            {
                mylog("Log WORNING [ mysql error. Query[$sql]]");
                sleep($interval);// 等待5s??? 
				require_once('mysql_config.php');
                continue;
            }
            
            $toBeComp = array();
            $sql = "select * from task;";
            $query_result = mysql_query( $sql ); 
            $num_rows=mysql_num_rows($query_result);
            if($num_rows > 0)
            {
                $haveError = false;
                mysql_query("BEGIN");
                
                $input_count = 0;
                for($row_num = 0;$row_num < $num_rows; $row_num++)
    			{
                    $oneMission = array();
    				$row=mysql_fetch_array($query_result);
                    $oneMission["recordId"] = $row["recordId"];
    				$oneMission["id"] = $row["id"];
                    $oneMission["number"] = $row["number"];
                    $oneMission["file"] = $row["file"];
                    $oneMission["time"] = $row["time"];
                    $oneMission["status"] = $row["status"];
					$oneMission["mediafile"] = $row["mediafile"];
    				
                    
					if($oneMission["status"] == 0)
					{
						$sql = "UPDATE task SET status=1 where recordId=".$oneMission["recordId"].";";
						$result = mysql_query( $sql ); 
						if (!$result) {
							mylog("Log WORNING [ mysql error. Query[$sql]]");
							mysql_query("ROLLBACK");
							$haveError = true;
						}
						$toBeComp[] = $oneMission;
						$input_count++;
						if($input_count >= 3)
						{
							break;
						}
					}
                }
                if(!$haveError)
                {
                    mysql_query("COMMIT");
                }
                mysql_query("END");
            }
            $sql = "UNLOCK TABLES"; 
            $query_result = mysql_query( $sql ); 
            if(!$query_result)
            {
                mylog("Log WORNING [ mysql error. Query[$query]]");
                sleep($interval);// 等待5s??? 
                continue;
            }
            
            $num_rows = sizeof($toBeComp);
            if($num_rows <= 0)
            {
                echo "waiting\n";
            }
            else
            {
    			foreach($toBeComp as $row)
    			{
                    $recordId = $row["recordId"];
    				$id = $row["id"];
                    $number = $row["number"];
                    $file = $row["file"];
					$time = $row["time"];
					$mediafile = $row["mediafile"];
    				
					$name_temp = $id.time().$number.mt_rand(1,100000);
					echo $name_temp;
					$resFile_name = md5($name_temp).".txt";
                    $resFile = ".\\res\\".$resFile_name;
                    $command = "\"$eva_prog\" \"$file\" > \"$resFile\" 2>&1";
                    echo $command;
                    exec($command,$out1);
                    mylog("Process file ".$out1);
					
					$sql = "insert into todolist values(NULL, $id, $number, \"$file\", timestamp(\"$time\"), \"$resFile_name\", \"$mediafile\");";
                    echo $sql;
                    $result = mysql_query( $sql ); 
                    if (!$result) {
            			mylog("Log WORNING [ mysql error. Query[$sql]]");
                        print "[ERROR] run sql:".$sql."\n";
            		}
                    else
                    {
                        print "[LOG] run sql:".$sql."\n";
                    }
                }
            }
            sleep($interval);// 等待5s??? 
        }while(true);
		
		xml_parser_free($xml_parser); 
    }

?>


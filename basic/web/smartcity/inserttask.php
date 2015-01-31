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
 
    //ignore_user_abort();//�ص��������PHP�ű�Ҳ���Լ���ִ��.
    set_time_limit(0);// ͨ��set_time_limit(0)�����ó��������Ƶ�ִ����ȥ
    while(1)
    {
    	get_score();  
    }
    function get_score()
    {
        $interval = 5;// ÿ��5s����
        $xml_parser = xml_parser_create(); 
		
        require_once('mysql_config.php');
        do{
			$res_dir = "./res/";
            $resfiles = getFile($res_dir);
			
            $num_rows = sizeof($resfiles);
			echo $num_rows;
            if($num_rows <= 0)
            {
                echo "waiting\n";
            }
            else
            {
    			foreach($resfiles as $resFile)
    			{
					$sql = "Select * from todolist where resfile=\"$resFile\";";
					$query_result = mysql_query( $sql ); 
					if(!$query_result)
					{
						mysql_error();
						mylog("Log WORNING [ mysql error. Query[$sql]]");
						sleep($interval);// �ȴ�5s??? 
						continue;
					}
					$num_rows=mysql_num_rows($query_result);
					if($num_rows <= 0)
					{
						continue;
					}
					$row=mysql_fetch_array($query_result);
					
                    $recordId = $row["recordId"];
    				$id = $row["id"];
                    $number = $row["number"];
					$time = $row["time"];
                    $file = $row["file"];
					$mediafile = $row["mediafile"];
    				
                    $file_handle = fopen($res_dir.$resFile, "r");
                    if(!$file_handle)
                    {
                        echo "[ERROR] ".$res_dir.$resFile." open failed.";
                        mylog("Log WORNING [ File error. File[$res_dir $resFile]]");
                        continue;
                    }
                    $resStr = "";
					$line_no = 0;//�к�
                    while(!feof($file_handle))
                    {
						$line_no++;
                        $temp_line = fgets($file_handle, 150);
						if($line_no == 1) //������һ��
						{
							continue;
						}
                        $resStr .= $temp_line;
                    }
                    fclose($file_handle);
                    unlink($res_dir.$resFile);
					$resStr = utf8_encode($resStr);
					
					if(!xml_parse($xml_parser,$resStr,true))
					{
						$error_str = xml_error_string(xml_get_error_code ( $xml_parser ));
						echo "[ERROR] ".$res_dir.$resFile." parse failed. error_str[$error_str]";
                        mylog("Log ERROR [ File parse error. File[$res_dir $resFile] Content[$resStr] $error_str.]");
                        continue;
                    }
                    
					mysql_query("BEGIN");
					
                    $sql = "insert into judge_res values(NULL, $id, $number, \"$file\", \"$resStr\", timestamp(\"$time\"), \"$mediafile\");";
                    echo $sql;
                    $result = mysql_query( $sql ); 
                    if (!$result) {
            			mylog("Log WORNING [ mysql error. Query[$sql]]");
                        print "[ERROR] run sql:".$sql."\n";
						mysql_query("ROLLBACK");
            		}
                    else
                    {
                        print "[LOG] run sql:".$sql."\n";
                        
                        $sql = "delete from todolist where recordId = $recordId;";
                        $result = mysql_query( $sql ); 
                        if (!$result) {
                			mylog("Log WORNING [ mysql error. Query[$sql]]");
							mysql_query("ROLLBACK");
                		}
						else
						{
							$file = str_replace('\\', '\\\\\\\\', $file);
							$sql = "delete from task where file = \"$file\";";
							echo $sql;
							$result = mysql_query( $sql ); 
							if (!$result) {
								mylog("Log WORNING [ mysql error. Query[$sql]]");
								mysql_query("ROLLBACK");
							}
							else
							{
								$new_xml = simplexml_load_string($resStr);
								
								if(!(isset($new_xml->fscore) && (float)$new_xml->fscore < 0)  && !(isset($new_xml->score) && (float)$new_xml->score < 0) && !(isset($new_xml->motp) && (float)$new_xml->motp == 0))
								{
									$sql = "Select * from best_for_ranking where id=$id and number=$number and mediafile=\"$mediafile\";";
									$query_result = mysql_query( $sql ); 
									if(!$query_result)
									{
										mysql_error();
										mylog("Log WORNING [ mysql error. Query[$sql]]");
										mysql_query("ROLLBACK");
									}
									$num_rows=mysql_num_rows($query_result);
									if($num_rows <= 0)
									{
										$sql = "insert into best_for_ranking values(NULL, $id, $number, \"$file\", \"$resStr\", timestamp(\"$time\"), \"$mediafile\");";
										echo $sql;
										$result = mysql_query( $sql ); 
										if (!$result) {
											mylog("Log WORNING [ mysql error. Query[$sql]]");
											print "[ERROR] run sql:".$sql."\n";
											mysql_query("ROLLBACK");
										}
									}
									else
									{
										$row=mysql_fetch_array($query_result);
										$result = $row['result'];
										
										$old_xml = simplexml_load_string($result);
										
										if((isset($old_xml->fscore) && (float)$old_xml->fscore < (float)$new_xml->fscore) ||
											(isset($old_xml->score) && (float)$old_xml->score < (float)$new_xml->score) ||
											(isset($old_xml->mota) && (float)$old_xml->mota < (float)$new_xml->mota && (float)$new_xml->motp != 0))
										{
											$sql = "update best_for_ranking set file=\"$file\", result=\"$resStr\", time=timestamp(\"$time\") where id=$id and number=$number and mediafile=\"$mediafile\";";
											echo $sql;
											$result = mysql_query( $sql ); 
											if (!$result) {
												mylog("Log WORNING [ mysql error. Query[$sql]]");
												print "[ERROR] run sql:".$sql."\n";
												mysql_query("ROLLBACK");
											}
										}
									}
								}
								
								mysql_query("COMMIT");
							}
						}
                    }
					mysql_query("END");
                }
            }
            sleep($interval);// �ȴ�5s??? 
        }while(false);
		
		xml_parser_free($xml_parser); 
    }

	function getFile($dir) {
		$fileArray=array();
		if (false != ($handle = opendir ( $dir ))) {
			$i=0;
			while ( false !== ($file = readdir ( $handle )) ) {
				//ȥ��"��.������..���Լ�����.xxx����׺���ļ�
				if ($file != "." && $file != ".."&&strpos($file,".txt")) {
					$fileArray[$i]=$file;
					if($i==100){
						break;
					}
					$i++;
				}
			}
			//�رվ��
			closedir ( $handle );
		}
		return $fileArray;
	}
?>
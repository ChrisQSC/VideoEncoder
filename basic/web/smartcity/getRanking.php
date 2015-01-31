<?php
	session_start();
	//禁用错误报告
	error_reporting(0);
	
    //require_once("check_status.php");
    require_once("inject_check.php");
    
    if(!isset($_GET['index']))
    {
        exit;
    }
    inject_check($_GET['index']);
	if(isset($_GET['limit']))
	{
		inject_check($_GET['limit']);
		$limit = $_GET['limit'];
	}
	else
	{
		$limit = 200;
	}
?>

<?php
	$index = $_GET['index'];
	
	$query = "select id, name, email, web from user where exists  ";
	$mediafiles_array = array();
	
	$db = ".\Evaluation_tools\SystemDB";
	$table = "tb_evaluate";

	$sql = "select mediaFile from $table where type=$index;";
	$db = new SQLite3($db);

	$re = $db->query($sql);
	if (!$re) {
		mylog("Log WORNING [ SQLite3 error. Query[$sql]");
		return;
	}
	$temp_index = 1;
	while($row = $re->fetchArray()){
		if($temp_index != 1)
		{
			$query .= " and exists ";
		}
		$temp_index++;
		$mediafiles_array[$row[0]] = $row[0];
		$query .= "(select * from best_for_ranking where user.id=best_for_ranking.id and best_for_ranking.number=$index and best_for_ranking.mediafile=\"".$row[0]."\")";
	}
	$db->close();
	
	require_once('mysql_config.php');
	$result = mysql_query($query);
	
    if (!$result) {
		mylog("Log WORNING [ mysql error. Query[$query]");
	}
    else
    {
		$num_rows = mysql_num_rows($result);
	
        $line_number = 1;
		echo "<table id='finTable'>  ";
		echo "<thead><tr>";
		echo "<th scope=\"col\">
        <a href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number).", keepRelationships: true})\" 
            mce_href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number++).", keepRelationships: true})\" > 
            User name </a></th>";
        if(isset($userInfo) && isset($userInfo["authority"]))
        {
            if($userInfo["authority"] == 0 || $userInfo["authority"] == 1)
            {
        		echo "<th scope=\"col\"> 
                <a href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number).", keepRelationships: true})\" 
                    mce_href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number++).", keepRelationships: true})\" >
                    Email </a></th>";
            }
        }
        $printed = false;
        
		$beta = 0.8;
		
        $res_array = array();   
		for($row_num = 0; $row_num < $num_rows; $row_num++)
		{
			$row = mysql_fetch_array($result);
			
			$inner_query = "select * from best_for_ranking where best_for_ranking.id=".$row['id']." and best_for_ranking.number=$index;";
			
			$inner_result = mysql_query($inner_query);
			if (!$inner_result) {
				mylog("Log WORNING [ mysql error. Query[$inner_query]");
			}
			
			$temp_array = array();
					
			$inner_num_rows = mysql_num_rows($inner_result);
			$inner_counter = 0;
			for($inner_num = 0; $inner_num < $inner_num_rows; $inner_num++)
			{
				$inner_row = mysql_fetch_array($inner_result);
				if(isset($mediafiles_array[$inner_row['mediafile']]))
				{
					$inner_counter++;
					
					$xml = simplexml_load_string($inner_row["result"]);
					if(!$printed)
					{
						$mota_set = false;
						foreach($xml->children() as $key=>$value)
						{
							if($key == "Info")
							{
								continue;
							}
							if($key == 'mota')
							{
								$mota_set = true;
							}
							echo "<th scope=\"col\">
							<a href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number).",sortDesc: true, keepRelationships: true})\" 
								mce_href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number++).",sortDesc: true, keepRelationships: true})\" > 
								$key </a></th>";
						}
						if($mota_set)
						{
							echo "<th scope=\"col\">
							<a href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number).",sortDesc: true, keepRelationships: true})\" 
								mce_href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number++).",sortDesc: true, keepRelationships: true})\" > 
								score </a></th>";
						}
						$printed = true;
					}
					
					if($inner_counter == 1)
					{
						$temp_array['name'] = '<a href="'.$row['web'].'">'.$row['name'].'</a>';
						if(isset($userInfo) && isset($userInfo["authority"]))
						{
							if($userInfo["authority"] == 0 || $userInfo["authority"] == 1)
							{
								$temp_array['email'] = $row['email'];
							}
						}
						foreach($xml->children() as $key=>$value)
						{
							if($key == "Info")
							{
								continue;
							}
							$temp_array[$key] = (float)$value;
						}
					}
					else
					{
						foreach($xml->children() as $key=>$value)
						{
							if($key == "Info")
							{
								continue;
							}
							$temp_array[$key] += (float)$value;
						}
					}
				}
			}
			
			foreach($temp_array as $key => $value)
			{
				if($key != "name" && $key != "email")
				{
					$temp_array[$key] /= $inner_counter;
					$temp_array[$key] = round($temp_array[$key], 3);
				}
			}
			if(isset($temp_array['mota']))
			{
				if($temp_array['mota'] >= 0)
				{
					$temp_array['score'] = (1+$beta * $beta)*$temp_array['mota']*$temp_array['motp']/($beta*$beta*$temp_array['mota']+$temp_array['motp']);
				}
				else
				{
					$temp_array['mota'] = -$temp_array['mota'];
					$temp_array['score'] = -(1+$beta * $beta)*$temp_array['mota']*$temp_array['motp']/($beta*$beta*$temp_array['mota']+$temp_array['motp']);
					$temp_array['mota'] = -$temp_array['mota'];
				}
				$temp_array['score'] = round($temp_array['score'], 3);
			}
			
            $res_array[] = $temp_array;
		}
        if(isset($_GET['count']) && $_GET['count'] == 1)
		{
			echo 'COUNT:'.count($res_array).'<br\>';
		}
        usort($res_array, 'sortByKey');
        $count = 0;
        foreach($res_array as $row)
        {
            if($count >= $limit)
            {
                break;
            }
            $count++;
            echo "<tr>";
            foreach($row as $key=>$value)
            {
                if($key == 'email')
                {
                    if(isset($userInfo) && isset($userInfo["authority"]))
                    {
                        if($userInfo["authority"] == 0 || $userInfo["authority"] == 1)
                        {
                            echo "<td>".$value."</td>";
                        }
                    }
                }
                else
                {
                    echo "<td>".$value."</td>";
                }
            }
			echo "</tr>";
   }
        
		echo "</tbody></table>";
    }
    
    function sortByKey($a, $b) {
        if(isset($a['fscore']))
        {
            $key = 'fscore';
            if ($a[$key] == $b[$key]) {
                return 0;
            } else {
                return $a[$key] < $b[$key] ? 1 : -1;
            }
        }
		else if(isset($a['score']))
        {
            $key = 'score';
            if ($a[$key] == $b[$key]) {
				if(isset($a['mota']))
				{
					$key = 'mota';
					if ($a[$key] == $b[$key]) {
						return 0;
					} else {
						return $a[$key] > $b[$key] ? -1 : 1;
					}
				}
                return 0;
            } else {
                return $a[$key] < $b[$key] ? 1 : -1;
            }
        }
		else if(isset($a['mota']))
        {
            $key = 'mota';
            if ($a[$key] == $b[$key]) {
                return 0;
            } else {
                return $a[$key] > $b[$key] ? -1 : 1;
            }
        }
		else if(isset($a['motp']))
        {
            $key = 'motp';
            if ($a[$key] == $b[$key]) {
                return 0;
            } else {
                return $a[$key] > $b[$key] ? -1 : 1;
            }
        }
        else if(isset($a['time']))
        {
            $key = 'time';
            if ($a[$key] == $b[$key]) {
                return 0;
            } else {
                return $a[$key] < $b[$key] ? -1 : 1;
            }
        }
        else return 0;
    }
    
?>
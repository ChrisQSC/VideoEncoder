<?php
	session_start();
	//禁用错误报告
	error_reporting(0);
	
    require_once("check_status.php");
    require_once("inject_check.php");
    
    if(!isset($_GET['index']) || !isset($_GET['from']) || !isset($_GET['to']) || !isset($_GET['media']))
    {
        exit;
    }
    inject_check($_GET['index']);
    inject_check($_GET['from']);
    inject_check($_GET['to']);
    inject_check($_GET['media']);
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
	$from = $_GET['from']." 00:00:00";
	$to = $_GET['to']." 23:59:59";
	$index = $_GET['index'];
	require_once('mysql_config.php');
	$query = "select name,email,web,file,result, judge_res.time as time from User, judge_res where User.id = judge_res.id and number = $index and judge_res.time >= timestamp(\"$from\") and judge_res.time < timestamp(\"$to\") and mediafile = \"".$_GET['media']."\";";
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
        		echo "<th scope=\"col\">
                <a href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number).", keepRelationships: true})\" 
                    mce_href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number++).", keepRelationships: true})\" >
                     File </a></th>";
            }
        }
        $printed = false;
        
		$beta = 0.8;
		
        $res_array = array();   
		for($row_num = 0; $row_num < $num_rows; $row_num++)
		{
			$row = mysql_fetch_array($result);
            $xml = simplexml_load_string($row["result"]);
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
				echo "<th scope=\"col\">
                <a href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number).",sortDesc: true, keepRelationships: true})\" 
                    mce_href=\"javascript:$('#finTable').sortTable({onCol: ".($line_number++).",sortDesc: true, keepRelationships: true})\" > 
                    Time </a></th></tr></thead><tbody>";
                $printed = true;
            }
            
            $temp_array = array();
            $temp_array['name'] = '<a href="'.$row['web'].'">'.$row['name'].'</a>';
            if(isset($userInfo) && isset($userInfo["authority"]))
            {
                if($userInfo["authority"] == 0 || $userInfo["authority"] == 1)
                {
                    $temp_array['email'] = $row['email'];
                    $temp_array['file'] = $row['file'];
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
			if(isset($temp_array['mota']))
			{
				if($temp_array['mota'] >= 0)
				{
					$temp_array['score'] = round((1+$beta * $beta)*$temp_array['mota']*$temp_array['motp']/($beta*$beta*$temp_array['mota']+$temp_array['motp']), 3);
				}
				else
				{
					$temp_array['mota'] = -$temp_array['mota'];
					$temp_array['score'] = round(-(1+$beta * $beta)*$temp_array['mota']*$temp_array['motp']/($beta*$beta*$temp_array['mota']+$temp_array['motp']), 3);
					$temp_array['mota'] = -$temp_array['mota'];
				}
			}
			$temp_array['time'] = $row["time"];
            $res_array[] = $temp_array;
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
                if($key == 'file')
                {
                    if(isset($userInfo) && isset($userInfo["authority"]))
                    {
                        if($userInfo["authority"] == 0 || $userInfo["authority"] == 1)
                        {
                            echo "<td><a href=\"".$value."\">download</a></td>";
                        }
                    }
                }
                else if($key == 'email')
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
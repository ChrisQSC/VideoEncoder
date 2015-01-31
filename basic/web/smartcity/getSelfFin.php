<?php

/**
 * @author shiyemin
 * @copyright 2013
 */

    session_start();
	//禁用错误报告
	error_reporting(0);
	
    require_once("check_status.php");
    require_once("inject_check.php");

    if(!isset($_GET['index']) || !isset($_GET['media']))
    {
        exit;
    }
    inject_check($_GET['index']);
    inject_check($_GET['media']);
?>

<?php
	$query = "select name,email,number,file,result, judge_res.time as time from User, judge_res where User.name = '$username' and User.id = judge_res.id and number = ".$_GET['index']." and mediafile = \"".$_GET['media']."\";";
	$result = mysql_query($query);
    if (!$result) {
		mylog("Log WORNING [ mysql error. Query[$query]");
	}
    else
    {
		$num_rows = mysql_num_rows($result);
	
		echo "<table id='finTable'>  ";
		echo "<thead><tr>";
		echo "<th scope=\"col\">
        <a href=\"javascript:$('#finTable').sortTable({onCol: 1, keepRelationships: true})\" 
            mce_href=\"javascript:$('#finTable').sortTable({onCol: 1, keepRelationships: true})\" > 
            User name </a></th>";
		echo "<th scope=\"col\"> 
        <a href=\"javascript:$('#finTable').sortTable({onCol: 2, keepRelationships: true})\" 
            mce_href=\"javascript:$('#finTable').sortTable({onCol: 2, keepRelationships: true})\" >
            Email </a></th>";
		echo "<th scope=\"col\">
        <a href=\"javascript:$('#finTable').sortTable({onCol: 3, keepRelationships: true})\" 
            mce_href=\"javascript:$('#finTable').sortTable({onCol: 3, keepRelationships: true})\" >
             File </a></th>";
        $printed = false;
                        
        $res_array = array();        
		for($row_num = 0; $row_num < $num_rows; $row_num++)
		{
			$row = mysql_fetch_array($result);
            $xml = simplexml_load_string($row["result"]);
            if(!$printed)
            {
                $line_number = 4;
                foreach($xml->children() as $key=>$value)
                {
					if($key == "Info")
					{
						continue;
					}
                    echo "<th scope=\"col\">
                    <a href=\"javascript:$('#finTable').sortTable({onCol: $line_number,sortDesc: true, keepRelationships: true})\" 
                        mce_href=\"javascript:$('#finTable').sortTable({onCol: $line_number,sortDesc: true, keepRelationships: true})\" > 
                        $key </a></th>";
                    $line_number++;
                }
				echo "<th scope=\"col\">
                <a href=\"javascript:$('#finTable').sortTable({onCol: $line_number,sortDesc: true, keepRelationships: true})\" 
                    mce_href=\"javascript:$('#finTable').sortTable({onCol: $line_number,sortDesc: true, keepRelationships: true})\" > 
                    Time </a></th></tr></thead><tbody>";
                $printed = true;
            }
            
            $temp_array = array();
            $temp_array['name'] = $row['name'];
            $temp_array['email'] = $row['email'];
            $temp_array['file'] = $row['file'];
            foreach($xml->children() as $key=>$value)
            {
				if($key == "Info")
				{
					continue;
				}
                $temp_array[$key] = (float)$value;
            }
			$temp_array['time'] = $row["time"];
            $res_array[] = $temp_array;
		}
        
        usort($res_array, 'sortByKey');
        foreach($res_array as $row)
        {
            echo "<tr>";
            foreach($row as $key=>$value)
            {
                if($key == 'file')
                {
                    echo "<td><a href=\"".$value."\">download</a></td>";
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

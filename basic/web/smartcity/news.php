<?php
	session_start();
    //require_once("check_status.php");
    require_once("inject_check.php");
    
	if(!isset($_GET['method']))
	{
		exit;
	}
	inject_check($_GET['method']);
	$method = $_GET['method'];
?>

<?php
	require_once('mysql_config.php');
	if($method == 'GET')
	{
		if(isset($_GET['from']) && $_GET['from'] != "")
		{
			inject_check($_GET['from']);
			$FROM_ID = $_GET['from'];
			$query = "SELECT id, tag_time, time, msg from news where tag=1 and $FROM_ID < id ORDER BY id;";
		}
		else
		{
			$query = "SELECT id, tag_time, time, msg from news where tag=1 ORDER BY id;";
		}
		$result = mysql_query($query);
		
		if (!$result) {
			mylog("Log WORNING [ mysql error. Query[$query]");
		}
		else
		{
			$num_rows = mysql_num_rows($result);

			$res_array = array();
			
			for($row_num = 0; $row_num < $num_rows; $row_num++)
			{
				$row = mysql_fetch_array($result);
				if($num_rows - $row_num > 8)
				{
					continue;
				}
				$temp = array();
				$temp['id'] = $row['id'];
				$temp['tag_time'] = $row['tag_time'];
				$temp['time'] = $row['time'];
				$temp['msg'] = $row['msg'];
				$res_array[] = $temp;
			}
			echo json_encode($res_array);
		}
	}
	else 
	{
		require_once("check_status.php");
		if($userInfo["authority"] > 1)
		{
			mylog("Log WORNING [ Error - authority error!]");
			exit;
		}
		if($method == 'ADD')
		{
			if(!isset($_GET['time']) || !isset($_GET['msg']) 
				|| $_GET['time'] == "" || $_GET['msg'] == "")
			{
				exit;
			}
			inject_check($_GET['time']);
			inject_check($_GET['msg']);
			$time = $_GET['time'];
			$msg = $_GET['msg'];
			$name = $userInfo['name'];
			$query = "INSERT INTO news values(NULL, NULL, \"$time\", \"$msg\", \"$name\", 1);";
			echo $query;
			$result = mysql_query($query);
			
			if (!$result) {
				mylog("Log WORNING [ mysql error. Query[$query]");
			}
			else
			{
				mylog("Log NOTICE [ admin[$name] add new msg[$msg], time[$time], tag[1] ].");
			}
		}
		else if($method == 'DELETE')
		{
			if(!isset($_GET['id']) || $_GET['id'] == "")
			{
				exit;
			}
			inject_check($_GET['id']);
			$id = $_GET['id'];
			$query = "DELETE FROM news WHERE id=$id;";
		
			$result = mysql_query($query);
			
			if (!$result) {
				mylog("Log WORNING [ mysql error. Query[$query]");
			}
			else
			{
				mylog("Log NOTICE [ admin[".$userInfo['name']."] delete msg id[$id] ].");
				echo "true";
			}
		}
		else if($method == 'ADMINGET')
		{
			if(isset($_GET['from']) && $_GET['from'] != "")
			{
				inject_check($_GET['from']);
				$FROM_ID = $_GET['from'];
				$query = "SELECT id, tag_time, time, msg, owner from news where tag=1 and $FROM_ID < id;";
			}
			else
			{
				$query = "SELECT id, tag_time, time, msg, owner from news where tag=1;";
			}
			$result = mysql_query($query);
			
			if (!$result) {
				mylog("Log WORNING [ mysql error. Query[$query]");
			}
			else
			{
				$num_rows = mysql_num_rows($result);

				$res_array = array();
				for($row_num = 0; $row_num < $num_rows; $row_num++)
				{
					$row = mysql_fetch_array($result);
					$temp = array();
					$temp['id'] = $row['id'];
					$temp['tag_time'] = $row['tag_time'];
					$temp['time'] = $row['time'];
					$temp['msg'] = $row['msg'];
					$temp['owner'] = $row['owner'];
					$res_array[] = $temp;
				}
				echo json_encode($res_array);
			}
		}
    }
?>
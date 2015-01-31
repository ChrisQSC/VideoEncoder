<?php

/**
 * @author shiyemin
 * @copyright 2013
 */

    session_start();
    require_once("check_status.php");
    require_once("inject_check.php");

    if(!isset($_GET['index']))
    {
        exit;
    }
    inject_check($_GET['index']);
	$type = $_GET['index'];
?>

<?php
	$db = ".\Evaluation_tools\SystemDB";
	$table = "tb_evaluate";

	$sql = "select mediaFile from $table where type=$type;";
	$db = new SQLite3($db);

	$re = $db->query($sql);
	if (!$re) {
		mylog("Log WORNING [ SQLite3 error. Query[$sql]");
		return;
	}
	$index = 1;
	while($row = $re->fetchArray()){
		if($index == 1)
		{
			echo "<option value='".$row[0]."' selected='selected'>".$row[0]."</option>";
		}
		else
		{
			echo "<option value='".$row[0]."'>".$row[0]."</option>";
		}
		$index++;
	}

	$db->close();
	
?>

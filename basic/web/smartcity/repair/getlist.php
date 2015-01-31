<?php
	$resstr = "<Evaluation> <result>1</result><mota>0.00</mota><motp>0.00</motp><Info>单摄像头指定对象跟踪评测结果</Info></Evaluation> ";
	
	$new_xml = simplexml_load_string($resstr);
	echo (float)$new_xml->motp;
	if((float)$new_xml->motp - 0 < 0.0001)
	{
		echo "test";
	}
	
	return;
	require_once('../mysql_config.php');
	$query = "select * from judge_res where file REGEXP 1403959562";
	$result = mysql_query($query);
    
    if (!$result) {
		mylog("Log WORNING [ mysql error. Query[$query]");
	}
	$num_rows = mysql_num_rows($result);
	
	for($row_num = 0; $row_num < $num_rows; $row_num++)
	{
		$row = mysql_fetch_array($result);
		//echo '"./Evaluation_tools/MainEvaluate.exe" "'.$row['file'].'" > "./repair/'.basename($row['file'],".xml").'.txt"'."<br/>";
		echo $row['file'];
	}
?>
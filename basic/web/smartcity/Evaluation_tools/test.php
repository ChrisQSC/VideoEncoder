<?php

	$db = "SystemDB";
	$table = "tb_evaluate";

	$sql = "select mediaFile from $table where type=1;";
	$db = new SQLite3($db);

	$re = $db->query($sql);
	if (!$re) {
		mylog("Log WORNING [ SQLite3 error. Query[$sql]");
		return;
	}
	while($row = $re->fetchArray()){
		echo "<option value='7'>".$row[0]."</option>";
	}

	$db->close();

?>
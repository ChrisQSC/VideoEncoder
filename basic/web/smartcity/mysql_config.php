<?php

/**
 * @author shiyemin
 * @copyright 2013
 */

	$DB_NAME = "competition";
    $db = mysql_connect("localhost", "smartcity", "U*1^Bds_p=");
    if (!$db) {
        print "Error - Could not connect to MySQL";
		exit;
	}
	// Select the datbase
	$er = mysql_select_db($DB_NAME);
	if(!isset($installing))
	{
		if (!$er) {
			print "Error - Could not select the database";
			exit;
		}
	}
	
	mysql_query("set names 'utf8' ");

?>
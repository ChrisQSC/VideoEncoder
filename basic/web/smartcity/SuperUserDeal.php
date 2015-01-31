<?php
    session_start();
    require_once("check_status.php");
    if($userInfo["authority"] != 0)
    {
        print "Error - authority error!";
        echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
		exit;
    }
?>
<html>
	<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>超级用户</title>
	</head>
	<body>
				<?php
					$query="select * from User";
					$result=mysql_query($query);
                    
                    if (!$result) {
            			mylog("Log WORNING [ mysql error. Query[$query]");
            		}
                    
					$num_rows=mysql_num_rows($result);
					for($row_num=0;$row_num<$num_rows;$row_num++)
					{
						$row=mysql_fetch_array($result);
						if($row["authority"] != 0)
						{
							$name="usr".$row["name"];
							$value=$_POST[$name];						
							if($value=="3")
							{
								$query="update User set authority=3 where id=".$row["id"];
							}
							else if($value=="1")
							{
								$query="update User set authority=1 where id=".$row["id"];
							}
							mysql_query($query);
						}
					}
				?>
			<script language="javascript">
				self.location='SuperUserShow.php';
			</script>
	</body>
</html>
<?php
	session_start();
    require_once("check_status.php");
    if($userInfo["authority"] != 0 && $userInfo["authority"] != 1)
    {
        print "Error - authority error!";
        echo("<meta http-equiv=refresh content='0; url=mainPage.php'>");
		exit;
    }
?>
<html>
	<head>
		<title> 查看所有提交 </title>
        
        <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="./css/tables.css" type="text/css">
		<link href="style/css/goble.css" rel="stylesheet" type="text/css" />
		<link href="style/css/style.css" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" href="./css/csstg.css" type="text/css">-->
        
        <script type="text/javascript" src="./js/jquery-1.10.2.js"></script> 
        <script type="text/javascript" src="./js/tablesort.js"></script> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		 
		<link href="css/ui-darkness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
		<script src="js/jquery-ui-1.10.4.custom.js"></script>
		<script>
			$(function() {
				var pickerOpts = {
				 changeMonth: true,
				 changeYear: true,
				 dateFormat: "yy-mm-dd"
				};
				$( "#datepicker1" ).datepicker(pickerOpts);
				$( "#datepicker2" ).datepicker(pickerOpts);
			});
		</script>
	</head>
	<body>
		<div id="header" class="cbody">
			<h1 class="logo"><img src="style/images/img_logo02.png" alt="全国研究生智慧城市技术与创意设计大赛"></h1>
			<ul class="nav clearfix">
				<li><a href="mainPage.php">首页</a></li>
				<li><a href="intro.php">大赛介绍</a></li>
				<li><a href="#">上传与下载<i></i></a>
					<div>
						<span></span>
						<p><a href="filedownload.php">资源下载</a></p>
						<p><a href="fileupload.php">作品上传</a></p>
					</div>
				</li>
				<li><a href="#">作品排名<i></i></a>
					<div>
						<span></span>
						<p><a href="uploadList.php">查看提交记录</a></p>
						<p><a href="ranking.php">当前排名</a></p>
						<?php
                            if(isset($userInfo) && isset($userInfo["authority"]))
                            {
                                if($userInfo["authority"] <= 1)
                                {
                                    echo "<p><a class=\"on\" href='AllUserShow.php'>查看所有提交</a></p>\n";
                                }
                            }
                        ?>	
					</div>
				</li>
				<?php
					if(isset($userInfo) && isset($userInfo["authority"]))
					{
						if($userInfo["authority"] <= 1)
						{
							echo "<li><a href='SuperUserShow.php'>后台管理</a></li>\n";
						}
						echo "<li><a href='logout.php'>注销</a></li>\n";
					}
					else
					{
						echo "<li><a href='login.php'>登陆</a></li>\n";
					}
				?>	
			</ul><!--end/nav-->
		</div><!--end/header-->
		<div class="banner cbody"><img src="style/images/img_banner.jpg"></div>
		
		<div id="boundary">
            <div id="content" align=center>
                
                <div id="itsthetable" style="margin-top:10px;">
                    <h2 style="display:inline-block;*display: inline;*zoom: 1;"> 已评测任务 &nbsp;&nbsp;&nbsp;题目:&nbsp;
                    <select id='qNo' onchange='loadDataset(this.value)'>
                      <option value ='1' selected='selected'>1、单摄像头行人评测</option>
                      <option value ='2'>2、单摄像头多类对象检测评测</option>
                      <option value='3'>3、单摄像头指定对象跟踪</option>
                      <option value='4'>4、跨摄像头指定行人跟踪</option>
                      <option value='5'>5、人脸检测</option>
                      <option value='6'>6、人脸识别</option>
                    </select>
					
					数据集:&nbsp;
                    <select id='dataset' onchange='selectQes(this.value)'>
                      
                    </select>
					<br/>
					起始时间: <input type="text" id="datepicker1" onchange="selectQes()">
					结束时间: <input type="text" id="datepicker2" onchange="selectQes()">
					</h2>
                </div>
                <div id="itsthetable" style="overflow-y:auto;min-height:200px;max-height:80%">
                <div id="finTable">
				    <h1>loading</h1>
                </div>
                </div>
                <div id="itsthetable" style="overflow-y:auto; min-height:200px;max-height:800px">
                <?php
                    $query = "select name,email,number,file, task.time as time from User, task where User.id = task.id";
                    $result = mysql_query($query);
                    if (!$result) {
            			mylog("Log WORNING [ mysql error. Query[$query]");
            		}
                    else
                    {
    					$num_rows = mysql_num_rows($result);
    				
    					echo "<table border='3'><caption><h2> 未评测任务 </h2></caption>";
    					echo "<thead><tr align='center'>";
    					echo "<th> User name </th>";
    					echo "<th> Email </th>";
                        echo "<th> No. </th>";
    					echo "<th> File </th>";
    					echo "<th> Time </th></tr></thead>";
    					for($row_num = 0; $row_num < $num_rows; $row_num++)
    					{
    						$row = mysql_fetch_array($result);
    						echo "<tr align='center'>";
    						echo "<td>".$row["name"]."</td>";
    						echo "<td>".$row["email"]."</td>";
                            echo "<td>".$row["number"]."</td>";
    						echo "<td><a href=\"".$row["file"]."\">download</a></td>";
    						echo "<td>".$row["time"]."</td>";
    						echo "</tr>";
    					}
    					echo "</table>";
                    }

				?>
                </div>
                
                <?php
                    require_once("foot.php");
                ?>
            </div>
		</div>
        
        <script type="text/javascript">    
			document.getElementById("qNo").value = 1;
			function loadDataset(value)
			{
				$.get("getMediaFileList.php", { index:value },
				  function(data){
					$("#dataset").html(data);
					var sel_obj = document.getElementById("dataset");
					$("#finTable").html("<h1>loading</h1>");
					selectQes(sel_obj.options[0].value);
				  });
			}
             function selectQes(media_in)
             {
                $("#finTable").html("<h1>loading</h1>");
				var qes_in = document.getElementById("qNo").value;
				
                freshFinTable(qes_in, media_in);
             }
             function freshFinTable(qes_in, media_in)
             {
				start_time = document.getElementById("datepicker1").value;
				stop_time = document.getElementById("datepicker2").value;
                $.get("getAllFin.php", { index:qes_in, from:start_time, to:stop_time, media:media_in },
                      function(data){
                        $("#finTable").html(data);
                      });
             }
			var date = new Date();
			var month = date.getMonth() + 1;
			if(month <10)
			{
				month = "0" + month;
			}
			var day = date.getDate();
			if(day < 10)
			{
				day = "0" + day;
			}
			var start_str = date.getFullYear()+"-"+ month + "-01";
			var stop_str = date.getFullYear()+"-"+ month + "-" + day;
			document.getElementById("datepicker1").value = start_str;
			document.getElementById("datepicker2").value = stop_str;
			
            loadDataset(1);
         </script>
	<script type="text/javascript" src="style/js/common.js"></script>
	</body>
</html>
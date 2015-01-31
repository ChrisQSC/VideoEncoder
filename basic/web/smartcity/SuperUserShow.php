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
	<head><title>权限管理</title>
    
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
				$( "#datepicker" ).datepicker(pickerOpts);
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
                                    echo "<p><a href='AllUserShow.php'>查看所有提交</a></p>\n";
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
							echo "<li><a class=\"on\" href='SuperUserShow.php'>后台管理</a></li>\n";
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
		
		<div id="boundary" >
            <div id="content" align=center>
                
                
                <div style="margin-top:10px;width:1000;">
					<?php
					if($userInfo["authority"] == 0)
					{
						$html_head = <<<HTML1
					<div style="width:400;float:left;">
						<form action="SuperUserDeal.php" method="post">
							<div id="itsthetable" style="overflow-y:auto; height:90%;">
							<table border="3" id='userTable'>
							<caption>用户管理<input type="submit" value="提交"/>
							</caption>
							<thead>
								<tr align='center'>
									<th>&nbsp;&nbsp;&nbsp;
										<a href="javascript:$('#userTable').sortTable({onCol: 1, keepRelationships: true});" 
											mce_href="javascript:$('#userTable').sortTable({onCol: 1, keepRelationships: true});" >用户名</a>&nbsp;&nbsp;&nbsp;</th>
									<th>&nbsp;&nbsp;&nbsp;
										<a href="javascript:$('#userTable').sortTable({onCol: 2, keepRelationships: true});" 
											mce_href="javascript:$('#userTable').sortTable({onCol: 2, keepRelationships: true});" >EMAIL</a>&nbsp;&nbsp;&nbsp;</th>
									<th>&nbsp;&nbsp;&nbsp;权限&nbsp;&nbsp;&nbsp;</th>
								</tr>
							</thead>
							<tbody>
HTML1;
						print $html_head;
						$html_content = "";
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
								print "<tr align='center'>";
								print "<td>".$row["name"]."</td>";
								print "<td>".$row["email"]."</td>";
								print "<td><label><input type=\"radio\" name=\"usr".$row["name"]."\" value=\"3\" ";
								if($row["authority"] == 3)
									print "checked=\"checked\" ";
								print "/>普通用户</label><label><input type=\"radio\" name=\"usr".$row["name"]."\" value=\"1\" ";
								if($row["authority"] == 1)
									print "checked=\"checked\" ";
								print "/>管理员</label></td>";		
								print "</tr>\n";
							}
						}
						$html_foot = <<<HTML2
							</tbody>
							</table>
							</div>
							
						</form>
					</div>
HTML2;
						print $html_foot;
					}
					?>
					<div style="width:600;float:left;">
						<div align=left>
							<form action="news.php" method="post">
								时间: <input type="text" id="datepicker">
								<input type="button" value="提交" onclick="postMsg()" style="margin-left:250"/>
								<textarea id="msg" cols="70" placeholder="事件内容"  rows="4"   style="OVERFLOW:auto"></textarea>
								
							</form>
						</div>
							
						<div id="itsthetable" style="overflow-y:auto; width:100%;height:90%;">
							<table border="3" id='msgTable'>
							<caption>消息管理
							</caption>
							<thead>
								<tr align='center'>
									<th>&nbsp;&nbsp;&nbsp;生成时间&nbsp;&nbsp;&nbsp;</th>
									<th>&nbsp;&nbsp;&nbsp;事件时间&nbsp;&nbsp;&nbsp;</th>
									<th>&nbsp;&nbsp;&nbsp;事件内容&nbsp;&nbsp;&nbsp;</th>
									<th>&nbsp;&nbsp;&nbsp;发布者&nbsp;&nbsp;&nbsp;</th>
									<th>&nbsp;&nbsp;&nbsp;删除&nbsp;&nbsp;&nbsp;</th>
								</tr>
							</thead>
							<tbody id="msgList">
								
							</tbody>
							</table>
						</div>
						
					</div>
              </div>
              
                <?php
                    require_once("foot.php");
                ?>
            </div>
        </div>
	<script type="text/javascript" src="style/js/common.js"></script>
	<script type="text/javascript">
		var maxIdNow = -1;
		$(function() {
			$( "#datepicker" ).datepicker();
		});
		
		function postMsg()
		{
			time = document.getElementById("datepicker").value;
			msg = document.getElementById("msg").value;
			if(time != "" && msg != "")
			{
				$.get("news.php", { method:"ADD", time:time, msg:msg },
					function(data){
						document.getElementById("msg").value = "";
						freshMsgList(maxIdNow);
					});
			}
		}
		
		function addMsg(data)
		{
			data = eval(data);
			var str = $("#msgList").html();
			for(var i = 0; i < data.length; i++)
			{
				var temp = "<tr align='center'>";
				temp += "<td>" + data[i]["tag_time"] + "</td>";
				temp += "<td>" + data[i]["time"] + "</td>";
				temp += "<td>" + data[i]["msg"] + "</td>";
				temp += "<td>" + data[i]["owner"] + "</td>";
				temp += "<td><input type=button onclick=\"deleteMsg(this, " + data[i]["id"] + ");\" value=\"remove\" > </td>";
				temp += "</tr>";
				str = temp + str;
				if(data[i]["id"] > maxIdNow)
				{
					maxIdNow = data[i]["id"];
				}
			}
			$("#msgList").html(str);
		}
		
		function freshMsgList(id)
		{
			$.get("news.php", { method:"ADMINGET", from:id },
					function(data){
						//$("#msgList").html(data);
						addMsg(data);
					});
		}
		
		function deleteMsg(button, id)
		{
			$.get("news.php", { method:"DELETE", id:id },
					function(data){
						var tr = button.parentNode.parentNode;
						tr.parentNode.removeChild(tr);	
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
		var str = date.getFullYear()+"-"+ month + "-" + day;
		document.getElementById("datepicker").value = str;
		freshMsgList(maxIdNow);
	</script>
	</body>
	
</html>
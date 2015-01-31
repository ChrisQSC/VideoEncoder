<?php

/**
 * @author shiyemin
 * @copyright 2013
 */
	session_start();
    
    if(isset($_SESSION['username']))
    {
        require_once("check_status.php");
    }
    require_once('include.php');
?>

<html>
	<head>
		<title> 当前排名 </title>
        
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
						<p><a class="on" href="ranking.php">当前排名</a></p>
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
                
                
                <div style="margin-top:10px;">
                    <h2 style="display:inline-block;*display: inline;*zoom: 1;"> 已评测任务 &nbsp;&nbsp;&nbsp;题目:&nbsp;
                    <select id='qNo' onchange='selectQes()'>
                      <option value ='1' selected='selected'>1、单摄像头行人评测</option>
                      <option value ='2'>2、单摄像头多类对象检测评测</option>
                      <option value='3'>3、单摄像头指定对象跟踪</option>
                      <option value='4'>4、跨摄像头指定行人跟踪</option>
                      <option value='5'>5、人脸检测</option>
                      <option value='6'>6、人脸识别</option>
                    </select>
					&nbsp;Top&nbsp;<select id="limit" onchange='selectQes()'>
						<option value='20' selected='selected'>20</option>
						<option value='50'>50</option>
						<option value='100'>100</option>
						<option value='250'>250</option>
						<option value='1000'>1000</option>
					</select>
					</h2>
                </div>
                <div id="itsthetable" style="overflow-y:auto;min-height:200px;max-height:80%">
                <div id="finTable">
				    <h1>loading</h1>
                </div>
                </div>
                
                
                <?php
                    require_once("foot.php");
                ?>
            </div>
		</div>
        
        <script type="text/javascript">    
             function selectQes()
             {
                $("#finTable").html("<h1>loading</h1>");
				var index = document.getElementById("qNo").value;
				var limit = document.getElementById("limit").value;
				
                freshFinTable(index, limit);
             }
             function freshFinTable(index, limit)
             {
                $.get("getRanking.php", { index:index, limit:limit},
                      function(data){
                        $("#finTable").html(data);
                      });
             }
			
            selectQes();
         </script>
	<script type="text/javascript" src="style/js/common.js"></script>
	</body>
</html>
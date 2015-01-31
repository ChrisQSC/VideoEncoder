<?php
	session_start();
    require_once("check_status.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
	<!-- title -->
	<head> <title> 文件提交与下载 </title>
    
        <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
		<link href="style/css/goble.css" rel="stylesheet" type="text/css" />
		<link href="style/css/style.css" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" href="./css/tables.css" type="text/css">-->
        <!--<link rel="stylesheet" href="./css/csstg.css" type="text/css">-->
        <script type="text/javascript" src="./js/jquery-1.10.2.js"></script> 
        <script type="text/javascript" src="./js/tablesort.js"></script> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
						<p><a class="on" href="filedownload.php">资源下载</a></p>
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
		
		<div id="boundary" >
            <div id="content" align=center>
                
                <div id="itsthetable" style="overflow-y:auto;min-height:200px;max-height:90%;margin: auto;">
                    <table border='3'><caption><h2>文件下载</h2></caption>
                        <thead>
                    		<tr align='center'>
                        		<th scope="col"> 文件 </th>
                        		<th scope="col"> 链接 </th>
                        		<th scope="col"> 说明 </th>
                            </tr>
                        </thead>
                        <tbody>
                    		<tr align='center'>
                    			<td>附件1：选手资格确认函</td>
                    			<td><a href="./src_data/附件1：选手资格确认函.docx">download</a></td>
                                <td>附件1：选手资格确认函。</td>
                    		</tr>
                    		<tr align='center'>
                    			<td>附件2：视频分析技术挑战赛评测数据集</td>
                    			<td><a href="./src_data/附件2：视频分析技术挑战赛评测数据集.pdf">download</a></td>
                                <td>附件2：视频分析技术挑战赛评测数据集。</td>
                    		</tr>
                    		<tr align='center'>
                    			<td>附件3：视频分析技术挑战赛评测数据集使用协议</td>
                    			<td><a href="./src_data/附件3：视频分析技术挑战赛评测数据集使用协议.docx">download</a></td>
                                <td>附件3：视频分析技术挑战赛评测数据集使用协议。</td>
                    		</tr>
                    		<tr align='center'>
                    			<td>附件4、视频分析技术挑战赛数据管理的保密制度.pdf</td>
                    			<td><a href="./src_data/附件4、视频分析技术挑战赛数据管理的保密制度.pdf">download</a></td>
                                <td>附件4、视频分析技术挑战赛数据管理的保密制度。</td>
                    		</tr>
                    		<tr align='center'>
                    			<td>附件6：视频分析技术挑战赛评测指标</td>
                    			<td><a href="./src_data/附件6：视频分析技术挑战赛评测指标.pdf">download</a></td>
                                <td>附件6：视频分析技术挑战赛评测指标.pdf。</td>
                    		</tr>
							<tr align='center'>
                    			<td>视频分析技术挑战赛注册及比赛数据的获取方法</td>
                    			<td><a href="./src_data/视频分析技术挑战赛注册及比赛数据的获取方法.docx">download</a></td>
                                <td>视频分析技术挑战赛注册及比赛数据的获取方法。</td>
                    		</tr>
							<tr align='center'>
                    			<td>视频分析挑战赛评测方案</td>
                    			<td><a href="./src_data/视频分析挑战赛评测方案.docx">download</a></td>
                                <td>视频分析挑战赛评测方案说明</td>
                    		</tr>
                        </tbody>
            		</table>
                </div>
                
                
                <?php
                    require_once("foot.php");
                ?>
            </div>
        </div>
	<script type="text/javascript" src="style/js/common.js"></script>
    </body>
</html>
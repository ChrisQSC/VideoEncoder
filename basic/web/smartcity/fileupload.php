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
						<p><a href="filedownload.php">资源下载</a></p>
						<p><a class="on" href="fileupload.php">作品上传</a></p>
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
                <table width="900" border="0" cellspacing="0" cellpadding="0">
                    <tr>
						<td width="900" align="center" valign="top">
							<div id="textcontent">
								<form id="form1" name="form1" 
									enctype="multipart/form-data" method="post" action="file_upload.php">
									<label for="filefield"></label>
									<input type="file" name="name" id="filefield"/>
									<input type="submit" name="button" id="button" value="开始上传文件"/>
								</form>
							</div>
						</td>
					</tr>
					
					<tr>
						<td width="900" align="center" valign="top">
							<div id="textcontent">
								<table width="700" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td height="65" align="left" valign="middle" class="boldtitle">决赛通知</td>
                                    </tr>
                                <tr>
                                    <td align="left"><p>根据大家反馈的意见和实际情况，视频技术挑战赛决赛提供的软件环境和要求如下：
                                        </p>
                                    <ol>
                                        <li>操作系统为windows7 64位操作系统或Ubuntu 12.04系统；</li>
                                        <li>提供VS2008和Matlab2012b编译环境；</li>
										<li>不提供任何其他的依赖库；</li>
										<li>参赛队伍必须提供已编译好、无需安装即可独立运行的程序。</li>
                                        </ol>
                                    </td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
							
					<tr>
						<td width="900" align="left" valign="top">
							<div style="margin-left:30px; margin-right:30px;">
								<h2> <a></a>相关错误汇总</h2>
								<ol>
									<div class="introlist">
										<div class="introleft">imageName错误</div>
										<div class="introright">imageName代表图片文件名，提交的文件中imageName应与图片文件名相同,包括扩展名,如jpg不应写为JPG
										</div>
									</div>
									<div class="introlist">
										<div class="introleft">evaluateType错误</div>
										<div class="introright">evaluateType代表题号，提交的文件中evaluateType错误会导致采用其他评测程序进行评测，导致无法产生评测结果
										</div>
									</div>
									<div class="introlist">
										<div class="introleft">mediaFile错误</div>
										<div class="introright">mediaFile代表数据集名称，目前将所有mediaFile修改为中文拼音，所有提交中文mediaFile的均为错误
										</div>
									</div>
									<div class="introlist">
										<div class="introleft">不产生评测结果</div>
										<div class="introright">请检查您提交的文件格式是否正确,检查邮件是否有错误通知,新提交文件是否按照错误通知进行改进
										</div>
									</div>
									
								</ol>
							</div>
						</td>
                
                    </tr>
					
                    <tr>
						<td width="900" align="left" valign="top">
							<div style="margin-left:30px; margin-right:30px;">
								<h2> <a></a>相关说明</h2>
								<ol>
									<div class="introlist">
										<div class="introleft">1、单摄像头行人检测训练数据集（图片）</div>
										<div class="introright">hongsilounorth_13_1920x1080_30_R1<br/>
										hongsilouwest_14_1920x1080_30_R1<br/>
										weiminghubeieast_11_1920x1080_30_R1<br/>
										weiminghubeiwest_12_1920x1080_30_R1
										</div>
									</div>
									<div class="introlist">
										<div class="introleft">2、单摄像头多类对象检测（图片）</div>
										<div class="introright">dongcemen_6_1280x720_30_R1<br/>
dongnanmen_1_1280x720_30_R1<br/>
weiminghudong_7_1280x720_30_R1<br/>
yaoganqian_5_1280x720_30_R1
</div>
									</div>
									<div class="introlist">
										<div class="introleft">3、单摄像头指定对象跟踪（avs视频）</div>
										<div class="introright">
dongcemen_6_1280x720_30_R1<br/>
dongnanmen_1_1280x720_30_R1<br/>
weiminghudong_7_1280x720_30_R1<br/>
yaoganqian_5_1280x720_30_R1
</div>
									</div>
									<div class="introlist">
										<div class="introleft">4、跨摄像头指定行人跟踪（avs视频）</div>
										<div class="introright">
MultiPedestrianTracking1<br/>
MultiPedestrianTracking2<br/>
MultiPedestrianTracking3

</div>
									</div>
									<div class="introlist">
										<div class="introleft">5、6、人脸检测与识别（图片）</div>
										<div class="introright">
dongnanmeneast_15_1920x1080_30_R1<br/>
dongnanmenwest_16_1920x1080_30_R1

										</div>
									</div>
									
								</ol>
							</div>
						</td>
                
                    </tr>
                </table>
                <?php
                    require_once("foot.php");
                ?>
            </div>
        </div>
	<script type="text/javascript" src="style/js/common.js"></script>
    </body>
</html>
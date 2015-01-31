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
        <!--<link rel="stylesheet" href="./css/tables.css" type="text/css">-->
        <!--<link rel="stylesheet" href="./css/csstg.css" type="text/css">-->
          <script type="text/javascript" src="./js/jquery-1.10.2.js"></script> 
          <script type="text/javascript" src="./js/tablesort.js"></script> 
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
		<div id="boundary" >
            <div id="content" align=center>
                <table width="1000" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="images/banner.jpg" width="1000" height="230" alt="Banner" /></td>
                    </tr>
                </table>
                <table width="1000" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td background="images/bar.jpg" height="36" align="center">
                        <a href="mainPage.php" class="menu"><span class="menu">首页</span></a>　　 
                        <a href="intro.php" class="menu"><span class="menu">大赛介绍</span></a>　　 
                        <a href="sourceFiles.php" style='color:#ffffff' class="menu"><span class="menu">文件提交与下载</span></a>　 
                        <a href="uploadList.php" class="menu"><span class="menu">查看提交记录</span></a>　 
                        <a href="ranking.php" class="menu"><span class="menu">当前排名</span></a>　 
                        <?php
                            if($userInfo["authority"] <= 1)
                            {
                                echo "<a href=\"AllUserShow.php\" class=\"menu\"><span class=\"menu\">查看所有提交</span></a>\n";
                           
                                echo "<a href=\"SuperUserShow.php\" class=\"menu\"><span class=\"menu\">后台管理</span></a>";
                            }
                        ?>	
                        <a href="logout.php" class="menu"><span class="menu">注销</span></a>　 
                        </td>
                    </tr>
                </table>
                
                
                <div id="textcontent">
                	<form id="form1" name="form1" 
                        enctype="multipart/form-data" method="post" action="file_upload.php">
                        <label for="filefield"></label>
                        <input type="file" name="name" id="filefield"/>
                        <input type="submit" name="button" id="button" value="开始上传文件"/>
                    </form>
                </div>
                
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
                    			<td>训练素材</td>
                    			<td><a href="./src_data/data.rar">download</a></td>
                                <td>用于对训练模型，并提供相应的groundtruth。</td>
                    		</tr>
                    		<tr align='center'>
                    			<td>训练素材groundtruth</td>
                    			<td><a href="./src_data/groundtruth.txt">download</a></td>
                                <td>用于对训练模型进行改进的groundtruth。</td>
                    		</tr>
                    		<tr align='center'>
                    			<td>测试素材</td>
                    			<td><a href="./src_data/data.rar">download</a></td>
                                <td>比赛所需的视频素材，选手需要上传测试结果。</td>
                    		</tr>
                        </tbody>
            		</table>
                </div>
                
                
                <?php
                    require_once("foot.php");
                ?>
            </div>
        </div>
    </body>
</html>
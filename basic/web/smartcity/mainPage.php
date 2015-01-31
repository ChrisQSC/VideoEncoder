<?php
	session_start();
    if(isset($_SESSION['username']))
    {
        require_once("check_status.php");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
	<!-- title -->
	<head> <title> 首页 </title>
    
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
		<link href="style/css/goble.css" rel="stylesheet" type="text/css" />
		<link href="style/css/style.css" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" href="./css/tables.css" type="text/css">
        <link rel="stylesheet" href="./css/csstg.css" type="text/css">
        -->
        <script type="text/javascript" src="./js/jquery-1.10.2.js"></script> 
        <script type="text/javascript" src="./js/tablesort.js"></script> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
		<div id="header" class="cbody">
			<h1 class="logo"><img src="style/images/img_logo02.png" alt="全国研究生智慧城市技术与创意设计大赛"></h1>
			<ul class="nav clearfix">
				<li><a class="on" href="mainPage.php">首页</a></li>
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
                
                <table width="1000" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="270" align="center" valign="top" bgcolor="#EEEEEE">
                            
                                
							<table width="240" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="48" align="left" valign="bottom" class="boldtitle">通知公告</td>
								</tr>
								<tbody id="msgContent">
								
								</tbody>
                            </table>
                            <!--
                            <div class="split100"></div>
                            <table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="60" align="center"><img src="images/weibo.jpg" width="168" height="31" alt="关注新浪微博" /></td>
                                </tr>
                            </table>-->
                            <div class="split100"></div>
                            <?php
                                if(isset($userInfo))
                                {
                                    echo "<!--";
                                }
                            ?>
                            <form id="form1" name="form1" method="post" action="checklogin.php">
                                <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td height="65" colspan="2" align="left" valign="middle" class="boldtitle">参赛团队登录</td>
                                    </tr>
                                    <tr>
                                        <td width="50" height="30" align="left" valign="top">用户名</td>
                                        <td width="140" align="left" valign="top"><label for="txtUserName2"></label>
                                            <input name="username" type="text" id="txtUserName2" size="18" /></td>
                                    </tr>
                                    <tr>
                                        <td height="30" align="left" valign="top">密码</td>
                                        <td align="left" valign="top"><label for="txtPswd"></label>
                                            <input name="password" type="password" id="txtPswd" size="18" /></td>
                                    </tr>
                                    <tr>
                                        <td height="35" align="left">&nbsp;</td>
                                        <td align="left" valign="top"><input type="submit" name="login" id="login" value=" 登录 " />
										</td>
                                    </tr>
                                </table>
                            </form>
                            <?php
                                if(isset($userInfo))
                                {
                                    echo "-->";
                                }
                            ?>
                            
                                <div class="split100"></div>
                                <table width="240" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="40" align="left" valign="middle" class="boldtitle">主办单位</td>
                                    </tr>
                                    <tr>
                                        <td height="80" align="left" valign="top">
                                            <ul>
                                                <li class="timeschedule">教育部学位与研究生教育发展中心</li>
                                                <li class="timeschedule"> 中国科协青少年科技中心</li>
                                                <li class="timeschedule"> 中国智慧城市产业技术创新战略联盟</li>
                                                <li class="timeschedule"> 数字音视频编解码（AVS）产业技术创新战略联盟<strong><br />
                                                </strong></li>
                                            </ul>                                    
                                        </td>
                                    </tr>
                                </table>
                               <div class="split100"></div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px; background-image:url(images/index3_23.jpg); background-repeat:no-repeat; background-position:top">
                                    <tr>
                            	        <td height="30">&nbsp;</td>
                            	        <td>&nbsp;</td>
                        	        </tr>
                            	    <tr>
                            	        <td width="40" height="64">&nbsp;</td>
                            	        <td align="left" valign="top">联系人：包娱嫚<br/>
                            	            电话 ：010-82338852<br/></td>
                        	        </tr>
                	    </table>
                            </td>
                            <td align="center" valign="top" bgcolor="#FFFFFF"><table width="700" border="0" cellspacing="0" cellpadding="0">
								<tr>
                                    <td height="65" align="left" valign="middle" class="boldtitle">视频分析技术挑战赛决赛注意事项</td>
								</tr>
                                <tr>
                                    <td align="left">
                                    <ol>
                                        <li>总体要求：根据“全国研究生智慧城市技术与创意设计大赛之视频分析技术挑战赛”（以下简称“视频分析技术挑战赛”）的比赛指南，视频分析技术挑战赛的决赛采用现场评测方式，由主办方提供场地和硬件设施并组织专家评审团。参赛队伍在限定时间内将本队的算法程序在主办方提供的硬件平台上调试，并生成最终算法程序。最终算法程序将在决赛测试数据集上运行并得到评测结果。/li>
                                        <li>主办方为每个参赛队伍的每个任务提供1台8核浪潮7100D服务器和1台PC终端。服务器的操作系统和开发环境根据各参赛队伍要求安装。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;各参赛队伍若有GPU等自带设备的特殊要求，须事先申请并得到专家评审团的批准。获得批准后方可自带设备，且该设备只能配置操作系统及必要开发环境，同时比赛期间该设备须由主办方统一封存管理，比赛结束后由主办方工作人员统一清除该服务器上的各种决赛相关数据。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;为比赛公平起见，要求自带设备的团队在主办方提供的平台上同时运行其算法程序。在比赛截至时，由专家评审团对照两个输出结果，根据二者的一致性来判断自带设备输出结果是否有效。</li>
										<li>各参赛队伍应于2014年8月22日下午到“北航新主楼G座”抽取本队决赛所用机器账户及密码，配置所需的软件环境，并通过PC终端调试与编译所开发算法程序使其能在该服务器上稳定运行。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2014年8月22日晚上17:00，所有决赛用服务器及PC终端封存，组委会工作人员将决赛测试数据拷入服务器。</li>
										<li>决赛的起始时间是2014年8月22日晚20:00，结束时间是2014年8月23日晚21:00。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在比赛期间，参赛队伍只能提交一次结果参与决赛评测，该结果应包含该任务的所有决赛测试数据上的运行结果。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;若参赛队伍未能在指定时间内完成所参与任务，则对已完成部分进行评测，未完成部分计为“无输出”。</li>
										<li>比赛期间，各参赛队伍不得私自拷贝、转发、转存决赛测试数据。违者将取消比赛资格，并保留追究数据泄密责任的权利。</li>
										<li>比赛期间，专家评审团有权查看参赛队伍的源代码及一且中间及最终结果，并有权对参赛队伍的算法和结果进行质询。</li>
                                        </ol>
                                    </td>
								</tr>
								
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
								<tr>
                                    <td height="65" align="left" valign="middle" class="boldtitle">大赛概况</td>
                                    </tr>
                                <tr>
                                    <td align="left"><p>全国研究生智慧城市技术与创意设计大赛“视频分析技术挑战赛”的目标包括如下两方面：
                                        </p>
                                    <ol>
                                        <li>适应大数据时代对信息科学人才培养的特殊需求，通过比赛锻炼研究生的解决问题能力，培养社会急需的工程技术人才。</li>
                                        <li>提高智能视频分析技术的研究水平，推动人工智能及其相关（交叉）学科的发展，促进人工智能在智慧城市等中的应用。</li>
                                        </ol>
                                    </td>
                                    
                                    </tr>
                                <tr>
                                    <td height="65" align="left" class="boldtitle">赛事进程</td>
                                </tr>
                                <tr>
									<td height="65" align="left"><p>视频分析技术挑战赛分为技术擂台赛和决赛两个阶段。
                                        </p>
                                    <div class="calendar">
                                        <div class="calendarleft">2014年3月27日</div>
                                        <div class="calendarright">报名，擂台赛结束前随时报名参赛</div>
                                    </div>
                                    <div class="calendar">
                                        <div class="calendarleft">2014年3月30日</div>
                                        <div class="calendarright">训练数据集及算法平台发布</div>
                                    </div>
                                     <div class="calendar">
                                        <div class="calendarleft">2014年5月1日</div>
                                        <div class="calendarright">验证数据集发布，技术擂台赛启动</div>
                                    </div>
                                    <div class="calendar">
                                        <div class="calendarleft">2014年7月31日</div>
                                        <div class="calendarright">技术擂台赛结束，选择进入决赛的队伍并进行确认。各培养单位选手资格确认函寄出（附件1，以邮寄日期为准）。</div>
                                    </div>
									<div class="calendar">
                                        <div class="calendarleft">2014年8月下旬</div>
                                        <div class="calendarright">决赛及学术论坛（参赛者现场决赛、论坛、研讨、参观企业等）</div>
                                    </div>
        
        							</td>
                                </tr>
                                <tr>
                                    <td height="65" align="left" class="boldtitle">组织单位</td>
                                    </tr>
                                <tr>
                                    <td align="left"><p>&nbsp;&nbsp;&nbsp;&nbsp;本挑战赛由教育部学位与研究生教育发展中心、中国科协青少年科技中心、中国智慧城市产业技术创新战略联盟、数字音视频编解码（AVS）产业技术创新战略联盟共同主办，北京航空航天大学承办，北京大学数字视频编解码技术国家工程实验室、北京航空航天大学虚拟现实技术国家重点实验室提供技术支持。</p></td>
                                    </tr>
                                <tr>
                                    <td height="25" align="right">&nbsp;</td>
                                    </tr>
                            </table></td>
                        </tr>
                </table>
                
                <?php
                    require_once("foot.php");
                ?>
            </div>
        </div>
		
	<script type="text/javascript" src="style/js/common.js"></script>
	<script type="text/javascript">
		var maxIdNow_main = -1;
		function addMsg(data)
		{
			data = eval(data);
			var str = "";
			for(var i = 0; i < data.length; i++)
			{
				var temp = "<tr>";
				temp += "<td align=\"left\" valign=\"top\" width=\"80\">" + data[i]["time"] + "</td>";
				temp += "<td align=\"left\" valign=\"top\">" + data[i]["msg"] + "</td>";
				temp += "</tr>";
				str = temp + str;
				if(data[i]["id"] > maxIdNow_main)
				{
					maxIdNow_main = data[i]["id"];
				}
			}
			$("#msgContent").html(str);
		}
		function freshMsgList(id)
		{
			$.get("news.php", { method:"GET" },
					function(data){
						//$("#msgContent").html(data);
						addMsg(data);
					});
		}
		freshMsgList(maxIdNow_main);
	</script>
    </body>

</html>
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
	<head> <title> 大赛介绍 </title>
    
        <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
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
				<li><a href="mainPage.php">首页</a></li>
				<li><a class="on" href="intro.php">大赛介绍</a></li>
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
                        <td width="250" align="left" valign="top" bgcolor="#eeeeee">
                        <div class="whiteboldtitle">大赛介绍</div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#aim">目标</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#org">组织单位</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#ori">参赛对象</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#how">参赛方式</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#sec">赛事进程</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#mission">任务设置</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#pro">比赛方式</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#awards">奖项设置</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#proowner">知识产权和作品所有权</a></div>
                        <div class="splitright20"></div>
                        <div class="page2greymenu"><a href="#reminder">特别提示</a></div>
                        <div class="splitright20"></div>
                        </td>
                        <td width="750" align="left" valign="top"><div class="page2top">首页 -＞ 大赛介绍</div>
                        <div style="margin-left:30px; margin-right:30px;background:url(images/greydot.jpg); background-position:left; background-repeat:repeat-x; height:2px;"></div>
                        <div style="margin-left:30px; margin-right:30px;">
                            <h1>大赛介绍</h1>
                            <h2><a name="aim" id="aim"></a>目标</h2>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;全国研究生智慧城市技术与创意设计大赛“视频分析技术挑战赛”的目标包括如下两方面：
                                <ol>
                                    <li>适应大数据时代对信息科学人才培养的特殊需求，通过比赛锻炼研究生的解决问题能力，培养社会急需的工程技术人才。</li>
                                    <li>提高智能视频分析技术的研究水平，推动人工智能及其相关（交叉）学科的发展，促进人工智能在智慧城市等中的应用。</li>
                                </ol>
                            </p>
                            
                            <h2> <a name="org" id="org"></a>组织单位</h2>
							<ol>
								<p> &nbsp;&nbsp;&nbsp;&nbsp;本挑战赛由教育部学位与研究生教育发展中心、中国科协青少年科技中心、中国智慧城市产业技术创新战略联盟、数字音视频编解码（AVS）产业技术创新战略联盟共同主办，北京航空航天大学承办，北京大学数字视频编解码技术国家工程实验室、北京航空航天大学虚拟现实技术国家重点实验室提供技术支持。</p>
								<div class="namelist">
									<div class="namelistleft">组委会主席</div>
									<div class="namelistright">赵沁平（北京航空航天大学教授，中国工程院院士）</div>
								</div>
								<div class="namelist">
									<div class="namelistleft">专家委员会主任</div>
									<div class="namelistright">高  文（国家自然科学基金委副主任、中国工程院院士）</div>
								</div>
								<div class="namelist">
									<div class="namelistleft">主任委员</div>
									<div class="namelistright">李  军（教育部学位与研究生教育发展中心主任）<br/>
									李晓亮（中国科学技术协会青少年科技中心主任）<br/>
									张广军（北京航空航天大学副校长）</div>
								</div>
								<div class="namelist">
									<div class="namelistleft">执行主任委员</div>
									<div class="namelistright">张广军（北京航空航天大学副校长）</div>
								</div>
								<div class="namelist">
									<div class="namelistleft">副主任委员</div>
									<div class="namelistright">赵  瑜（教育部学位与研究生教育发展中心主任助理）<br/>
									王松光（中国科学技术协会青少年科技中心科普活动处处长）<br/>
									熊  璋（中国智慧城市产业技术创新战略联盟副理事长）<br/>
									黄铁军（数字音视频编解码（AVS）产业技术创新战略联盟秘书长）<br/>
									黄海军（北京航空航天大学研究生院常务副院长）<br/>
									</div>
								</div>
								
								<div class="namelist">
									<div class="namelistleft">委员</div>
									<div class="namelistright">大赛发起培养单位相关负责人</div>
								</div>
								
								<div class="namelist">
									<div class="namelistleft">秘书长</div>
									<div class="namelistright">雷晓锋（北京航空航天大学研究生工作部部长）</div>
								</div>
								
								<div class="namelist">
									<div class="namelistleft">副秘书长</div>
									<div class="namelistright">曹红波（教育部学位与研究生教育发展中心综合处副处长）</div>
								</div>
							</ol>
                            <h2 style="clear:both"> <a name="ori" id="ori"></a>参赛对象</h2>
                            <ol>
							<p>&nbsp;&nbsp;&nbsp;&nbsp;各培养单位正式注册的在读研究生以及已确定读研资格的本科生均可参赛。为确保参赛选手资格有效，各培养单位应填写全国研究生智慧城市技术与创意设计大赛选手资格确认函（附件1），按规定时间寄至组委会。</p>
                            </ol>
							
                            <h2> <a name="how" id="how"></a>参赛方式</h2>
							<ol>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;个人或团队，个人作品申报总人数不超过2人，集体作品申报总人数不超过4人。<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;大赛官网：<a href="http:\\www.smartcity-competition.com.cn">www.smartcity-competition.com.cn</a></p>
							</ol>
							
							<h2> <a name="sec" id="sec"></a>赛事进程</h2>
							<ol>
							<p>视频分析技术挑战赛分为技术擂台赛和决赛两个阶段。
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
							</ol>
                            <h2 style="clear:both"> <a name="mission" id="mission"></a>任务设置</h2>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;技术擂台赛和决赛均设置同样的比赛任务，包括：</p>
                            <ol>
                                <li>单摄像头行人检测：检测摄像头视域内的所有行人。</li>
                                <li> 单摄像头多类对象检测：检测摄像头视域内的所有行人、车、自行车/电动车等对象。 </li>
                                <li> 单摄像头指定对象跟踪：在摄像头视域内跟踪指定的对象。</li>
                                <li>跨摄像头指定行人跟踪：在多摄像机网络内指定行人的重现检测与跟踪。 </li>
                                <li>人脸检测：要求检测出摄像头视域内出现的所有人脸。</li>
                                <li>人脸识别：给定待识别的人脸库（含证件照），要求检测并识别出摄像头视域内出现的目标人脸。</li>
                            </ol>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;为在比赛的过程中有效提升研究生的科研能力，组织方将提供上述任务的参考算法代码及相关论文。</p>
                            <h2> <a name="pro" id="pro"></a>比赛方式</h2>
                            <ol>
                                <li>数据集</li>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;本次比赛的数据集来自某校园内若干个摄像头的监控视频。根据用途，比赛数据集分为训练数据集、验证数据集、决赛测试数据集三类。<br/>
								&nbsp;&nbsp;&nbsp;&nbsp;数据的详细内容及使用协议见附件2、3。<br/>
								&nbsp;&nbsp;&nbsp;&nbsp;为保证比赛的公平性，验证数据集和决赛测试数据集应遵循数据管理保密制度，见附件4。</p>
                                <li>技术擂台赛</li>
								<p>
								&nbsp;&nbsp;&nbsp;&nbsp;技术擂台赛采用在线评测、按性能排名的方式。组织方提供在线评测服务，参赛队伍可以按规定格式在线提交在验证数据集上本队算法运行的结果文件；在线评测系统将对参赛队伍提交的算法运行结果进行性能评测，并按性能高低分任务进行排名。评测方法和指标见附件6。<br/>
								&nbsp;&nbsp;&nbsp;&nbsp;技术擂台赛开始前，组织方将通过比赛网站发布训练数据集、算法平台（包括视频解码库、参考算法代码、API接口、结果文件生成等），以确保参赛队伍的算法运行结果能正确提交到在线评测系统上进行性能评测。参赛队伍须根据API接口集成本队研发的算法到算法平台。技术擂台赛开始后，组织方将通过比赛网站发布验证数据集。验证数据集与训练数据集采集自相同的监控摄像头及环境条件，与训练数据集不重叠，用于在线评测系统中客观评测参赛队伍的算法性能。<br/>
								&nbsp;&nbsp;&nbsp;&nbsp;评测结果的排名将以两周为单位公布在比赛的官方网站。在技术擂台赛期间，每个参赛队伍每周最多可以提交2次结果进行在线评测。<br/>
								&nbsp;&nbsp;&nbsp;&nbsp;组织方将根据参赛队伍数量及排名情况选择一定数量的队伍进入决赛，但每个任务参加决赛的队伍不超过6支。</p>
                                <li>决赛</li>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;技术擂台赛的优胜队伍将进入决赛。决赛采用现场评测方式，由组织方提供场地和硬件设施并组织专家评审团。参赛队伍在限定时间内将本队的算法程序在组织方提供的硬件平台上调试，并生成最终算法程序。最终算法程序将在决赛测试数据集上运行并得到评测结果，并以可视化方式实时显示。<br/>
								&nbsp;&nbsp;&nbsp;&nbsp;为确保比赛的公正性，决赛所有的参赛队伍须将参赛程序提交给组织方存档，并保证基于此程序可重复本队的比赛结果。该程序副本保存在教育部学位中心，仅供比赛结果存在争议时验证使用。组织方将根据知识产权协议维护参赛队伍的知识产权。</p>
                            </ol>
							<h2> <a name="awards" id="awards"></a>奖项设置</h2>
                            <ol>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;六项比赛任务，共设特等奖1名（可空缺），每项任务设一等奖1名，二等奖1名，三等奖1名，企业冠名奖若干。所有进入决赛的同学都获得优胜奖，同时参加智慧城市学术论坛。</p>
                            </ol>
							<h2> <a name="proowner" id="proowner"></a>知识产权和作品所有权</h2>
                            <ol>
                                <li>为保证比赛的公正性，决赛所有的参赛队伍须将算法SDK提交给组织方存档，并保证基于此算法SDK能使得本队提交的结果可重复。</li>
                                <li>比赛期间参赛队伍所有的方案、算法和SDK及相关的知识产权均属于参赛队伍所有，组织方承诺履行保密义务，并不用于除本比赛外的任何其他用途。</li>
                                <li>参赛队伍应保证所提供的方案、算法和SDK属于自有知识产权。组织方对参赛队伍因使用本队提供/完成的算法和源代码而产生的任何实际侵权或者被任何第三方指控侵权概不负责。一旦上述情况和事件发生参赛队伍必须承担一切相关法律责任和经济赔偿责任并保护组织方免于承担该等责任。</li>
                            </ol>
							<h2> <a name="reminder" id="reminder"></a>特别提示</h2>
							<ol>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;入围决赛的参赛选手都需提交与参赛作品相关的学术论文，参加全国研究生智慧城市学术论坛活动。</p>
							</ol>
                            <p>&nbsp;</p>
                        </div></td>
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
			var str = $("#msgContent").html();
			for(var i = 0; i < data.length; i++)
			{
				var temp = "<tr>";
				temp += "<td align=\"left\" valign=\"top\" width=\"75\">" + data[i]["time"] + "</td>";
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
			$.get("news.php", { method:"GET", from:id },
					function(data){
						//$("#msgContent").html(data);
						addMsg(data);
					});
		}
		freshMsgList(maxIdNow_main);
	</script>
    </body>
</html>
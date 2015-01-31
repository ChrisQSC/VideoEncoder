
<html>
	<head> <title> Login. </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<body bgcolor="#FFFFFF" text="#000000" link="#0000FF"
		vlink="#000080" alink="#FF0000">
		
		<FORM ACTION="checklogin.php" METHOD="POST"> 
			<TABLE height=159 cellSpacing=0 cellPadding=0 width=268 align=center 
				bgColor=#ffff99 border=0> 
				<TBODY> 
					<TR> 
						<TD align=middle width=234 height=43><IMG height=113 
							src="images/login.jpg" width=359>
						</TD>
					</TR> 
					<TR> 
						<TD align=middle background=images/loginbg.jpg 
							bgColor=#fafafa height=180> 
							<TABLE width=250 border=0> 
								<TBODY> 

									<TR> 
										<TD align=middle height=25>帐号：&nbsp; <INPUT tabIndex=1 
											maxLength=20 size=15 name=username>
										</TD>
									</TR> 
									<TR> 
										<TD align=middle>密码：&nbsp; <INPUT tabIndex=2 
											type=password maxLength=20 size=15 name=password></TD>
									</TR> 
									<TR> 
										<TD align=middle height=25>
											<INPUT id=login_manager value="登录" style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BACKGROUND-IMAGE: url(images/button1.png); BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px" type=submit value=" " name=login_manager> 
											<INPUT id=login_member2 value="注册" style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BACKGROUND-IMAGE: url(images/button2.png); BORDER-LEFT: 0px; WIDTH: 52px; CURSOR: hand; BORDER-BOTTOM: 0px; HEIGHT: 18px" type=button value=" " name=login_member2 onclick="javascript:window.location.href='register.php'">
										</TD>
									</TR> 
									<TR> 
										<TD align=middle> 
											<TABLE border=0> 
												<TBODY> 
													<TR> 
														<TD></TD> 
														<TD width=10></TD> 
														<TD></TD>
													</TR>
												</TBODY>
											</TABLE>
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</TD>
					</TR> 
				</TBODY>
			</TABLE>
		</FORM> 
	</body>
</html>
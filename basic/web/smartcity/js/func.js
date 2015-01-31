
/**
 * @author shiyemin
 * @copyright 2013
 */

//检查是否都符合 注册 要求 
function check_reg() 
{ 
    if(check_email(document.getElementById('email')) && check_web(document.getElementById('web'))) 
    { 
        return true; 
    }else{ 
        return false; 
    } 
} 
//检查密码长度不能少于6 
function check_len(thisObj){ 
    if(thisObj.value.length==0) 
    { 
        document.getElementById('show_pass').innerHTML="密码不能为空"; 
        return false; 
    }else{ 
        if (thisObj.value.length<6) 
        { 
            document.getElementById('show_pass').innerHTML="密码长度不少于6"; 
            return false; 
        } 
        document.getElementById('show_pass').innerHTML=""; 
        return true; 
    } 
} 
//检查俩次密码输入是否一致 
function check_pass(thisObj){ 
    var psw=document.getElementById('pass'); 
    if(psw.value.length==0) 
    { 
        document.getElementById('show_pass').innerHTML="密码不能为空"; 
        return false; 
    }else{ 
        document.getElementById('show_pass').innerHTML=""; 
        if (thisObj.value!=psw.value) 
        { 
            document.getElementById('show_repass').innerHTML="两次密码输入不正确"; 
            return false; 
        } 
        document.getElementById('show_repass').innerHTML=""; 
        return true; 
    } 
} 
//检查email是否正确 
function check_email(thisObj){ 
    var reg=/^([a-zA-Z\d][a-zA-Z0-9_]+@[a-zA-Z\d]+(\.[a-zA-Z\d]+)+)$/gi; 
    var rzt=thisObj.value.match(reg); 
    if(thisObj.value.length==0){ 
        document.getElementById('show_e').innerHTML="Email不能为空"; 
        return false; 
    }else{ 
        if (rzt==null) 
        { 
            document.getElementById('show_e').innerHTML="Email地址不正确"; 
            return false; 
        } 
        document.getElementById('show_e').innerHTML=""; 
        return true; 
    } 
} 
//检查web是否正确 
function check_web(thisObj){ 
    //var reg=/^\w+([\.\-]\w)*$/; 
    //var rzt=thisObj.value.match(reg); 
    if(thisObj.value.length==0){ 
        document.getElementById('show_web').innerHTML="主页不能为空"; 
        return false; 
    }else{ 
        /*if (rzt==null) 
        { 
            document.getElementById('show_web').innerHTML="主页地址不正确"; 
            return false; 
        } */
		var strRegex = "^((https|http|ftp|rtsp|mms)?://)"  
			+ "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" //ftp的user@  
			+ "(([0-9]{1,3}\.){3}[0-9]{1,3}" // IP形式的URL- 199.194.52.184  
			+ "|" // 允许IP和DOMAIN（域名） 
			+ "([0-9a-z_!~*'()-]+\.)*" // 域名- www.  
			+ "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\." // 二级域名  
			+ "[a-z]{2,6})" // first level domain- .com or .museum  
			+ "(:[0-9]{1,4})?" // 端口- :80  
			+ "((/?)|" // a slash isn't required if there is no file name  
			+ "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";  
		var re=new RegExp(strRegex);  
		if(!re.test(thisObj.value))
		{
			document.getElementById('show_web').innerHTML="主页地址不正确"; 
            return false;
		}
        document.getElementById('show_web').innerHTML=""; 
        return true; 
    } 
} 
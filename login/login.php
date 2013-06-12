<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="style/reset.css" />
<link type="text/css" rel="stylesheet" href="style/style.css" />
<script type="text/javascript" src="../js/xmlhttprequest.js"></script>
<script type="text/javascript" src="../js/login.js"></script>
<title>登陆-通信原理精品课程系统</title>
</head>

<body id="register">
	<div id="register-wrapper">
    	<h1>通信原理精品课程系统</h1>
        <table>
          <tr>
            <td><label for="regname">用户名：</label></td>
            <td><input type="text" id="lgname" name="lgname" /></td>
          </tr>
          <tr>
            <td><label for="regpwd1">密码：</label></td>
            <td><input type="password" id="lgpwd" name="lgpwd" /></td>
          </tr>
          <!--
          <tr>
            <td>验证码：</td>
            <td>
            	<img id="chkid" src="" width="55" height="25" />
                <input type="text" id="lgchk" name="lgchk" />
    			<a id="changea" >刷新验证码</a><br />
                <input type="hidden" id="chknm" name="chknm" value="" />
            </td>
          </tr>
          -->
          <tr>
            <td><a href="register.php">注册</a></td>
            <td><input id="lgbtn" type="submit" value="登陆" /></td>
          </tr>
        </table>
        <table id="reg-notice">
          <tr><td id="namediv"></td></tr>
          <tr><td id="pwddiv"></td></tr>   
          <tr><td id="chkdiv"></td></tr>      
        </table>

    </label>
</body>
</html>

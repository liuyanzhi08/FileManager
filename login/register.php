<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="style/reset.css" />
<link type="text/css" rel="stylesheet" href="style/style.css" />
<script type="text/javascript" src="../js/register.js"></script>
<script type="text/javascript" src="../js/xmlhttprequest.js"></script>
<title>注册-通信原理精品课程系统</title>
</head>

<body id="register">
	<div id="register-wrapper">
    	<h1>通信原理精品课程系统</h1>
        <table>
          <tr>
            <td><label for="regname">用户名：</label></td>
            <td><input type="text" id="regname" name="regname" /></td>
          </tr>
          <tr>
            <td><label for="regpwd1">密码：</label></td>
            <td><input type="password" id="regpwd1" name="regpwd1" /></td>
          </tr>
          <tr>
            <td><label for="regpwd2">确认密码：</label></td>
            <td><input type="password" id="regpwd2" name="regpwd2" /></td>
          </tr>
          <tr>
            <td><label for="email">邮件：</label></td>
            <td><input type="text" id="email" name="email" /></td>
          </tr>
          <tr>
            <td><label for="realname">真实姓名：</td>
            <td><input type="text" id="realname" name="realname" /></td>
          </tr>
          <tr>
          <tr>
            <td><label for="number">学号：</td>
            <td><input type="text" id="number" name="number" /></td>
          </tr>
          <tr>
            <td><label for="phone">手机号：</td>
            <td><input type="text" id="phone" name="phone" /></td>
          </tr>
          <tr>
            <td><a href="../index.php">返回首页</a></td>
            <td><input id="regbtn" type="submit" value="注册" disabled="disabled"/></td>
          </tr>
        </table>
        <table id="reg-notice">
          <tr><td id="namediv"></td></tr>
          <tr><td id="pwddiv1"></td></tr>
          <tr><td id="pwddiv2"></td></tr>
          <tr><td id="emaildiv"></td></tr>
          <tr><td id="realnamediv"></td></tr>
          <tr><td id="numdiv"></td></tr>
          <tr><td id="phonediv"></td></tr>          
        </table>

    </label>
</body>
</html>
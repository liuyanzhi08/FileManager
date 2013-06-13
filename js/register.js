function $(idValue){
	return document.getElementById(idValue);
}

window.onload = function(){
	$('regname').focus();	//焦点定位到注册用户名输入框
	//声明五个变量，分别表示要验证的五项数据
	var cname1, cname2, cpwd1, cpwd2, cemail, cnum, cphone, crealname;
	
	function chkreg(){
		if((cname2 == 'yes') && 
		   (cpwd1 == 'yes') && (cpwd2 == 'yes') && 
		   (cemail == 'yes') && (cnum == 'yes') &&
		   (cphone == 'yes') && (crealname == 'yes')){
			$('regbtn').disabled = false;
		}else{
			$('regbtn').disabled = true;
		}
	}
	
	//验证用户名
	$('regname').onkeyup = function(){
		var name = $('regname').value;
		cname2 = '';
		if(name.match(/^[a-zA-Z_]*/) == ''){
			cname1 = '';
			$('namediv').innerHTML = '用户名必须以字母或者下划线开头';
		}else if(name.length <= 3){
			cname1 = '';
			$('namediv').innerHTML = '用户必须大于三位';
		}else{
			cname1 = 'yes';
			$('namediv').innerHTML = '<font color=green>用户名符合标准</font>';
		}
		chkreg();	
	}
	
	//当用户名文本框失去焦点时检查用户名是否重复
	$('regname').onblur = function(){
		name = $('regname').value;
		if(cname1 == 'yes'){
			xmlhttp.open('get', 'chkname.php?name=' + name, true);
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4){
					if(xmlhttp.status == 200){
						var msg = xmlhttp.responseText;
						if(msg == '1'){
							$('namediv').innerHTML = '<font color=green>恭喜您，该用户名可以使用</font>';
							cname2 = 'yes';
						}else if(msg == '2'){
							$('namediv').innerHTML = '<font color=red>对不起，该用户名已被注册</font>';
							cname2 = '';
						}else{
							$('namediv').innerHTML = '<font color=red>' + msg + '</font>';
							cname2 = '';
						}
					}
				}
				chkreg();
			}
			xmlhttp.send();
		}
	}
	
	//验证密码
	$('regpwd1').onkeyup = function(){
		pwd = $('regpwd1').value;
		pwd2 = $('regpwd2').value;
		if(pwd.length < 6){
			$('pwddiv1').innerHTML = '密码长度至少需要六位';
			cpwd1 = '';
		}else if(pwd.length >= 6 && pwd.length < 12){
			$('pwddiv1').innerHTML = '<font color=green>密码符合要求。密码强度：弱</font>';
			cpwd1 = 'yes';
		}else if((pwd.match(/^[0-9]*$/) != null) || (pwd.match(/^[a-zA-Z]*$/) != null)){
			$('pwddiv1').innerHTML = '<font color=green>密码符合要求。密码度：中</font>';
			cpwd1 = 'yes';
		}else{
			$('pwddiv1').innerHTML = '<font color=green>密码符合要求。密码强度：高</font>';
			cpwd1 = 'yes';
		}
		
		if(pwd2 != '' && pwd != pwd2){
			cpwd2 = '';
			$('pwddiv2').innerHTML = '两次密码不一致';
		}else if(pwd2 != '' && pwd == pwd2){
			cpwd2 = 'yes';
			$('pwddiv2').innerHTML = '<font color=green>两次密码一致</font>';
		}
		chkreg();
	}
	
	//二次验证密码
	$('regpwd2').onkeyup = function(){
		pwd = $('regpwd1').value;
		pwd2 = $('regpwd2').value;
		if(pwd != pwd2){
			cpwd2 = '';
			$('pwddiv2').innerHTML = '两次密码不一致！';
		}else{
			cpwd2 = 'yes';
			$('pwddiv2').innerHTML = '<font color=green>两次密码一致</font>';
		}
		chkreg();
	}
	
	//验证邮件格式
	$('email').onblur = function(){
		var email = $('email').value;
		var emailreg = /^\w+(-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
		if(email.match(emailreg) != null){
			$('emaildiv').innerHTML = '<font color=green>Email格式正确</font>';
			cemail = 'yes';
		}else{
			$('emaildiv').innerHTML = 'Email格式错误';
			cemail = '';
		}
		chkreg();
	}
	
	//验证学号格式
	$('number').onblur = function(){
		var number = $('number').value;
		if(number == ''){
			$('numdiv').innerHTML = '学号不能为空';
			cnum = '';
		}else{
			cnum = 'yes'
			$('numdiv').innerHTML = '<font color=green>学号正确填写</font>';
		}
		chkreg();
	}
	
	//验证手机格式
	$('phone').onblur = function(){
		var phone = $('phone').value;
		if(phone == ''){
			$('phonediv').innerHTML = '手机号不能为空';
			cphone = '';
		}else{
			cphone = 'yes';
			$('phonediv').innerHTML = '<font color=green>手机号正确写</font>';
		}
		chkreg();
	}
	
	//验证姓名是否填写
	$('realname').onblur = function(){
		var realname = $('realname').value;
		if(realname == ''){
			$('realnamediv').innerHTML = '真实姓名不能为空';
			crealname = '';
		}else{
			crealname = 'yes';
			$('realnamediv').innerHTML = '<font color=green>姓名正确填写</font>';
		}
		chkreg();
	}
	
	//显示隐匿更多信息
	/*$('morebtn').onclick = function(){
		if($('morediv').style.display ==  ''){
			$('morediv').style.display = 'none';
			this.innerHTML = '更多信息';
		}else{
			$('morediv').style.display = '';
			this.innerHTML = '隐匿更多信息';
		}
		chkreg();
	}*/
	
	//正式注册
	$('regbtn').onclick = function(){
		url = 'register_check.php?name=' + $('regname').value + '&pwd=' +
				$('regpwd1').value + '&email=' + $('email').value;
		url += '&number=' + $('number').value + '&phone=' + $('phone').value;
		url += '&realname=' + encodeURIComponent($('realname').value);
		//url += '&question=' + $('question').value + '&answer=' + $('answer').value;
		//url += '&realname=' + $('realname').value + '&birthday=' + $('birthday').value;
		xmlhttp.open('get', url, true);
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4){
				if(xmlhttp.status == 200){
					msg = xmlhttp.responseText;
					if(msg == '1'){
						alert('注册成功');
						location = '../admin/index.php';
					}else{
						$('namediv').innerHTML = '<font color=red>' + msg + '</font>';
					}
					//$('imgdiv').style.visibility = 'hidden';	
				}
			}
		}
		xmlhttp.send();
		return false;
	}
}
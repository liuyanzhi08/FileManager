function $(idValue){
	return document.getElementById(idValue);
}

window.onload = function(){
	$('lgname').focus();
	$('lgbtn').onclick  = chklg;	//点击注册则验证输入
	//showval();						//生成验证码
	//$('changea').onclick = showval;//刷新验证码
	var cname, cpwd/*, cchk*/;
}

function chform(){
		//判断用户名是否合法
	if($('lgname').value.match(/^[a-zA-Z_]\w*$/) == null){
		$('namediv').innerHTML = '用户名不合法';
		$('lgname').select();
		cname = '';
	}else{
		$('namediv').innerHTML = '';
		cname = 'yes';
	}

	//密码是否为空
	if($('lgpwd').value == ''){
		$('pwddiv').innerHTML = "请输入密码";
		$('lgpwd').focus();
		cpwd = '';
	}else{
		cpwd = 'yes';
		$('pwddiv').innerHTML = "";
	}	
	//验证码是否正确
	/*
	if($('lgchk').value != $('chknm').value){
		$('chkdiv').innerHTML = "验证码输入错误";
		$('lgname').select();
		cchk = '';
	}else{
		cchk = 'yes';
		$('chkdiv').innerHTML = "<font color=green>验证码正确</font>";
	}		*/
}

function chklg(){
	chform();
	if((cname == '')||(cpwd == '')/*||(cchk == '')*/){
		return false; //组织提交
	}


	//将用户的信息传递给loin_chk.php进行处理
	url = 'login_chk.php?act=' + (Math.random()) + '&name=' + $('lgname').value
			+ '&pwd=' + $('lgpwd').value;
	xmlhttp.open('get', url, true);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){
				//获取login_chk.php的返回值
				var msg = xmlhttp.responseText;
				if(msg == '0'){
					alert('没用该用户。请检查用户名是否输入错误');
				}else if(msg == '1'){
					alert('您还没有激活，请你登陆邮箱进行激活操作。');
					$('lgname').select();
				}else if(msg == '2'){
					$('pwddiv').innerHTML = '密码错误';	
				}else if(msg == '3'){
					location = '../admin/index.php';
				}
			}
		}
	}
	xmlhttp.send();
}

//验证码生成
function showval(){
	num = '';
	for(var i=0; i< 4; i++){
		var tmp = Math.ceil((Math.random()*15));
		if(tmp > 9){
			switch(tmp){
				case(10):
					num += 'a';
					break;
				case(11):
					num += 'b';
					break;
				case(12):
					num += 'c';
					break;
				case(13):
					num += 'd';
					break;
				case(14):
					num += 'e';
					break;
				case(15):
					num += 'f';
					break;
			}
		}else{
				num += tmp;
		}
	}
	//$('chkid').src='valcode.php?num=' + num; //显示图文验证码
	//$('chknm').value = num;
}
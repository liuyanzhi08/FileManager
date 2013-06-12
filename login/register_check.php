<?php
	session_start();
	include_once "../conn/conn.php";
	$reback = "0";
	$sql = "select * from tb_member where name='" . trim($_GET['name']) . "'";
	//判断是否存在用户名，存在则不能注册
	$num = $conne->getRowsNum($sql);
	if($num == 1){		//如果有记录
		$reback = "对不起，该用户名已被注册";
		echo $reback;
	}else if($num == 0){ //如果没有记录
		//把新用户录入数据库
		$sql="insert into tb_member(name, password, email, number, phone, realname, active) values('".trim($_GET['name'])."','".md5(trim($_GET['pwd']))."','".$_GET['email']."','".$_GET['number']."','".$_GET['phone']."','".urldecode(trim($_GET['realname']))."', 1)";
		$num = $conne->uidRst($sql);
		if($num == 1){
			$reback = '1';
			$sql = "select id from tb_member where name ='".trim($_GET['name'])."'";
			$lgid = $conne->getFields($sql, 0);
			$conne->close_rst();
			//设置session
			$_SESSION['lgname'] = trim($_GET['name']);
			$_SESSION['admin'] = 0;
			$_SESSION['lgid'] = $lgid;
		}
		echo $reback;		
	}else{
		echo $conne.mysql_error();	//否则出错
	}	
?>
<?php
	session_start();
	include_once '../conn/conn.php';
	$name = $_GET['name'];
	$pwd = $_GET['pwd'];
	$reback = null;
	if(!empty($name) and !empty($pwd)){
		//等到数据库中的count和active字段
		$sql = "select id,name,active,admin from tb_member where name ='".$name."'";
		$user = $conne->getRowsRst($sql);
		$active = $user['active']; 
		$admin = $user['admin'];
		$lgid = $user['id'];
		$conne->close_conn();
		//判断用户是否存在
		if($active == ''){
			$reback = '0';			//用户名输入错误
		}else if($active == 0){			
			$reback = '1';			//用户是否激活
		}else{
			$sql .= " and password ='".md5($pwd)."'";
			$num = $conne->getRowsNum($sql);
			if($num == 0){		
				$reback = '2';		//密码错误
			}else{
				//设置session
				$_SESSION['lgname'] = $name;
				$_SESSION['admin'] = $admin;
				$_SESSION['lgid'] = $lgid;
				$reback = '3';		//通过验证
			}
		}
		
	}
	echo $reback;
?>
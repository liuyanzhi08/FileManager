<?php
	//载入数据库
	include_once "../conn/conn.php";
	$sql = "select * from tb_member where name='" . trim($_GET['name']) . "'";
	//获取查询记录数
	$num = $conne->getRowsNum($sql);
	if($num == 1){		//如果有记录
		echo '2';
	}else if($num == 0){
		echo '1';		//如果没有记录
	}else{
		echo $conne.mysql_error();	//否则出错
	}
?>
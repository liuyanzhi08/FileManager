<?php
	include_once "../conn/conn.php";
	include_once "../includes/lgchk.inc.php";
	adminrequired();
	$type = urldecode($_GET['type']);
	$description = urldecode($_GET['description']);
	$deadline = $_GET['deadline'];
	//往数据库里插入新添分类
	$sql = "insert into tb_uptype(genrename, description, deadline) values('".$type."','".$description."','".$deadline."');";
	$conne->mysql_query_rst($sql);
	//为新分类建立上传文件夹
	$sql = "select id from tb_uptype order by id DESC;";
	$typeid = $conne->getFields($sql, 0);
	$conne->close_rst();
	$foldpath = "../upfiles/".$typeid."/";
	mkdir($foldpath);
	//将分类文件夹路径记录入数据库
	$sql = "update tb_uptype set foldpath='".$foldpath."' where id=".$typeid;
	$conne->mysql_query_rst($sql);
	
	//更新html
	$txt = '';
	$txt .= '<tr><td>'.$type.'</td>';
	$txt .= '<td>'.$deadline.'</td></tr>';	
	echo $txt;
?>
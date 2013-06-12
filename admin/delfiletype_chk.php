<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";
	include_once "../includes/func.inc.php";
	adminrequired();
	$typeid = $_GET['id'];
	//查找分类文件夹路径
	$sql = "select foldpath from tb_uptype where id=".$typeid."";
	$foldpath = $conne->getFields($sql, 0);
	$conne->close_rst();
	//如果是用户是管理员分类
	if($admin){
		//删除分类文件夹以及它里面的所有文件
		delDir($foldpath);
		rmdir($foldpath);
		//删除分类以及分类下文件的数据库数据
		$sql = "delete from tb_upfile where filetype_id=".$typeid;
		$conne->mysql_query_rst($sql);
		$sql = "delete from tb_uptype where id=".$typeid;
		$conne->mysql_query_rst($sql);
	}
?>
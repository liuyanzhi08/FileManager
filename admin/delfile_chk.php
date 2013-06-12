<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";
	$fileid = $_GET['id'];
	//查找该文章
	$sql = "select upauthor, filepath from tb_upfile where id=".$fileid;
	$file = $conne->getRowsRst($sql);
	$upauthor = $file['upauthor'];
	$filepath = $file['filepath'];
	$conne->close_rst();
	//如果是用户是管理员则可以删除一切文章，否则只能删除自己上传的文章
	if($admin){
		//删除数据库数据和硬盘文件
		$sql = "delete from tb_upfile where id=".$fileid;
		$conne->mysql_query_rst($sql);
		unlink($filepath);	
	}else{
	//否则只能删除用户上传的文章
		$sql = "delete from tb_upfile where id=".$fileid." and upauthor='".$upauthor."'";
		$conne->mysql_query_rst($sql);
		unlink($filepath);
	}
?>
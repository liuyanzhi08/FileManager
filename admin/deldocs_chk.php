<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";
	adminrequired();
	$fileid = $_GET['id'];
	//查找该文章
	$sql = "select * from tb_docfile where id=".$fileid;
	$file = $conne->getRowsRst($sql);
	$filepath = $file['path'];
	$conne->close_rst();
	//如果是用户是管理员则可以删除一切文章，否则只能删除自己上传的文章

	//删除数据库数据和硬盘文件
	$sql = "delete from tb_docfile where id=".$fileid;
	$conne->mysql_query_rst($sql);
	unlink($filepath);	

?>
<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";
	adminrequired();
	$noticeid = $_GET['id'];
	$sql = "delete from tb_notice where id=".$noticeid;
	$conne->mysql_query_rst($sql);
?>
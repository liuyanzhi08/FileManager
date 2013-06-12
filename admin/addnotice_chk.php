<?php
	include_once "../conn/conn.php";
	include_once "../includes/lgchk.inc.php";
	adminrequired();
	$content = urldecode($_GET['content']);
	//往数据库里插入新添公告
	$now = getdate();
	$noticetime = $now['year'].'-'.$now['mon'].'-'.$now['mday'].' '.$now['hours'].':'.$now['minutes'].':'.$now['seconds'];
	$sql = "insert into tb_notice(content, time) values('".$content."', '".$noticetime."');";
	$conne->mysql_query_rst($sql);
	//查找新添加的id
	$sql = "select id from tb_notice order by id DESC limit 1";
	$lastid = $conne->getFields($sql, 0);
	$conne->close_conn();
	//更新html
	$txt = '';
	$txt .= '<tr><td>'.$content.'</td>';
	$txt .= '<td>'.$noticetime.'</td>';
	$txt .= '<td><a href="javascript:void(0)" class="delnotice" rel="'.$lastid.'">删除</a></td></tr>';	
	echo $txt;
?>
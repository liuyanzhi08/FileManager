<?php
	include_once "../conn/conn.php";
	include_once "../includes/lgchk.inc.php";
	
	$sql = "select * from tb_uptype order by id DESC";
	$types = $conne->getRowsArray($sql);
	$conne->close_rst();
	
	$txt = "";
	$txt .= '<ul>';
	if(count($types) != 0){
		foreach($types as $type){
			$txt .= '<li><a href="javascript:void(0)" class="upfile" rel="'.$type['id'].'">'.$type['genrename'].'</a></li>';
		}			
		$txt .= '</ul>';
	}else{
		$txt .= '作业列表';
	}
	echo $txt;
?>
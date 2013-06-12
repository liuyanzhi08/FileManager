<?php
	include_once "../conn/conn.php";
	include_once "../includes/lgchk.inc.php";
	
	//查找文件
	$typeid = $_GET['typeid'];
	if($admin){
		$sql = "select * from tb_upfile where filetype_id =".$typeid." order by id DESC";
	}else{
		$sql = "select * from tb_upfile where filetype_id =".$typeid." and upauthor='".$lgname."'"." order by id DESC";
	}
	$files = $conne->getRowsArray($sql);
	$conne->close_rst();
	$txt = "";
	if(count($files) == 0){
		$txt .= '没有文件';
	}else{
		$txt .= '<table width="100%">';
		$txt .= '<tr><th>文件名称</th><th>下载路径</th><th>文件大小</th><th>上传时间</th><th>上传者</th>';
		if($admin){
			$txt .= '<th>管理</th>';
		}
		$txt .= '</tr>';
		foreach($files as $file){
			$txt .= '<tr><td>'.$file['filename'].'</td>
					 <td><a href="'.$file['filepath'].'">下载</a></td>
					 <td>'.round($file['filesize']/1024).'KB'.'</td>
					 <td>'.$file['uptime'].'</td>';
			//根据上传者用户名查找他的真实姓名
			$sql = "select realname from tb_member where name='".$file['upauthor']."'";
			$realname = $conne->getFields($sql, 0);
			$conne->close_rst();
			$txt .= '<td>'.$realname.'</td>';
			//如果是管理员，怎显示删除文件功能
			if($admin){
				$txt .= '<td><a href="javascript:void(0)" class="delfile" rel="'.$file['id'].'">删除</a></td>';
			}
			$txt .= '</tr>';
		}
	$txt .= '</table>';
	}

	echo $txt;
?>
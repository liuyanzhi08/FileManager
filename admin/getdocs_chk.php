<?php
	include_once "../conn/conn.php";
	include_once "../includes/lgchk.inc.php";
	
	$typeid = $_GET['typeid'];
	$sql = "select * from tb_docfile where doctypeid =".$typeid." order by id DESC";
	$files = $conne->getRowsArray($sql);
	$conne->close_rst();
	$txt = "";
	if(count($files) == 0){
		$txt .= '没有文件';
	}else{
		$txt .= '<table width="100%">';
		$txt .= '<tr><th>文件名称</th><th>下载路径</th><th>文件大小</th><th>上传时间</th><th>所属分类</th>';
		if($admin){
			$txt .= '<th>管理</th>';
		}
		$txt .= '</tr>';
		foreach($files as $file){
			//按照资料分类id查询资料分类名
			$sql = "select name from tb_doctype where id=".$file['doctypeid'];
			$typename = $conne->getFields($sql, 0);
			//$conne->close_rst();
			$txt .= '<tr><td>'.$file['name'].'</td>
					 <td><a href="'.$file['path'].'">下载</a></td>
					 <td>'.round($file['size']/1024).'KB'.'</td>
					 <td>'.$file['uptime'].'</td>
					 <td>'.$typename.'</td>';
			if($admin){
				$txt .= '<td><a href="javascript:void(0)" class="deldoc" rel="'.$file['id'].'">删除</a></td>';
			}
			$txt .= '</tr>';
		}
	$txt .= '</table>';
	}

	echo $txt;
?>
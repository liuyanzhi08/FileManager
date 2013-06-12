<?php
	include_once "../conn/conn.php";
	include_once "../includes/lgchk.inc.php";

	//查询作业分类
	$typesql = "select id, genrename, deadline from tb_uptype order by id DESC";
	$types = $conne->getRowsArray($typesql);
	$conne->close_rst();
	
	$txt = "";
    //返回的上传文件表单html代码
	if(!$admin){
		$txt .= '<form enctype="multipart/form-data" method="post" action="upfile.php">';
		$txt .= '<input type="hidden" name="MAX_FILE_SIZE" value="50000000" />';
		$txt .= '<table width="49%" style="float:left;" >';
		$txt .= '<tr><th>上传作业：</th></tr>';
		$txt .= '<tr><td>上传作业到分类：<select id="filetypelist" name="filetype-ids[]">';
		$txt .= '<option>请选择</option>';
		foreach($types as $type){
			//判断是否到了分类提交截止时间，如果到了则不显示该分类
			$deadline = strtotime($type['deadline']);
			$now = @mktime();
			if($now <= $deadline){
				$txt .= '<option value="'.$type['id'].'">'.$type['genrename'].'</option>';
			}
		}
		$txt .= '</select></td>';
		$txt .= '<tr><td><input id="upfilefile" name="upname[]" type="file" /></td></tr>';
		$txt .= '<tr><td><input type="submit" id="upfilesub" value="上传作业"/></td></tr>';
		$txt .= "</table></form>";
	}
	//增添作业分类
	if($admin){
		$now = getdate();
		$deadline = $now['year'] . '-' . $now['mon'] . '-' .($now['mday']+7)." 00:00:00";
		$txt .= '<form id="addfiletype">';
		$txt .= '<table width="49%" style="float:left">';
		$txt .= '<tr><th>添加作业分类：</th></tr>';
		$txt .= '<tr><td>分类名称：<input type="text" name="type" id="type" /></td></tr>';
		$txt .= '<tr><td>分类描述：<input type="text" name="description" id="description" /></td></tr>';	
		$txt .= '<tr><td>截止时间：<input type="text" name="deadline" id="deadline" value="'.$deadline.'"/></td></tr>';		
		$txt .= '<tr><td><input type="submit" id="addfiletypesub" value="添加分类"/></td></tr></table></form>';
	}
	
	//作业分类提交截止时间列表
	$txt .= '<table width="50%" style="float:right" id="deadlinetb">';
	$txt .= '<tr><th>作业提交截止时间：</th></tr>';
	foreach($types as $type){
		//判断是否到达分类提交截止时间，高亮显示过期分类
		$deadline = strtotime($type['deadline']);
		$now = @mktime();
		if($now <= $deadline){
			$txt .= '<tr><td>'.$type['genrename'].'</td>';
			$txt .= '<td>'.$type['deadline'].'</td>';
		}else{
			$txt .= '<tr><td><font color="#CA0002">'.$type['genrename'].'</font></td>';
			$txt .= '<td><font color="#CA0002"><del>'.$type['deadline'].'</del> 已截止</font></td>';	
		}
		if($admin){ $txt .= '<td><a href="javascript:;" class="delfiletype" rel="'.$type['id'].'">删除</a>';}	
		$txt .= '</tr>';
	}
	$txt .= '</table>';

	echo $txt;
?>
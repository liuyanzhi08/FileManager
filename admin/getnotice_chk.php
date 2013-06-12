<?php
	include_once "../conn/conn.php";
	include_once "../includes/lgchk.inc.php";
	include_once "../includes/lgchk.inc.php";

	//查询公告
	$sql = "select * from tb_notice order by id DESC";
	$notices = $conne->getRowsArray($sql);
	$conne->close_rst();
	
	$txt = "";
    //返回的发布公告表单html代码
	if($admin){
		$txt .= '<form id="addnotice">';
		$txt .= '<table width="41%" style="float:left; position:absolute">';
		$txt .= '<tr><th>发布公告：</th></tr>';
		$txt .= '<tr><td><textarea name="content" id="notice-content" /></textarea></td></tr>';
		$txt .= '<tr><td><input type="submit" id="addnoticesub" value="发布"/></td></tr></table></form>';
	}
	
	//公告列表
	if($admin){
		$txt .= '<table width="49%" style="float:right" id="noticetb">';
		$txt .= '<tr><th>公告列表：</th></tr>';
		$txt .= '<tr><td>公告内容</td><td style="width:80px">发布时间</td><td d style="width:30px">管理</td></tr>';
		foreach($notices as $notice){	
			$txt .= '<tr><td>'.$notice['content'].'</td>';
			$txt .='<td>'.$notice['time'].'</td>';
			$txt .= '<td><a href="javascript:void(0)" class="delnotice" rel="'.$notice['id'].'">删除</a></td></tr>';	
		}
	}else{
		$txt .= '<table width="100%" id="noticetb">';
		$txt .= '<tr><td>公告内容</td><td>发布时间</td></tr>';
		foreach($notices as $notice){	
			$txt .= '<tr><td>'.$notice['content'].'</td>';
			$txt .= '<td>'.$notice['time'].'</td></tr>';	
		}
	}

	
	$txt .= '</table>';
	$txt .= '<div class="clear-fix"></div>';

	echo $txt;
?>
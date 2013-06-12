<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";
	include_once "../includes/func.inc.php";
	$typeid = $_GET['id'];
	adminrequired();
	delDocType($typeid, $conne);
	/***********返回更新的html************/
	
	//查询根分类
	$splits = "";
	$txt = "";
	$sql = "select * from tb_doctype where id = 1";
	$roottp = $conne->getRowsRst($sql);
	$conne->close_rst();
	$sql = "select * from tb_doctype where pretypeid =".$roottp['id'];
	$types = $conne->getRowsArray($sql);
	$conne->close_rst();
	
	//上传资料
	$txt .= '<form enctype="multipart/form-data" method="post" action="updoc.php">';
	$txt .= '<table width="49%" style="float:left;">';
	$txt .= '<tr><th>上传资料：</th></tr>';
	$txt .= '<tr><td>上传资料到分类：<select id="uptypelist" name="doctypeid">';
	$txt .= '<option>请选择</option>';
	$txt .= '<option value="1">根分类</option>';
	findTypes($conne, $types, $splits, $txt);
	$txt .= '</select></td>';
	$txt .= '<tr class="filerow"><td><input type="file" class="updocfile" name="updoc[]"/></td></tr>';
	$txt .= '<tr><td><input type="submit" id="updocsub" value="上传资料"/><a id="addmorefile" href="javascript:void(0)" style="float:right">增加一个上传</a></td></tr>';
	$txt .= "</table></form>";
	
	
	//增添资料分类
	$txt .= '<form id="addtype">';
	$txt .= '<table width="50%" style="float:right;">';
	$txt .= '<tr><th>添加分类：</th></tr>';
	$txt .= '<tr><td>上级分类：<select id="typelist">';
	$txt .= '<option>请选择</option>';
	$txt .= '<option value="1">根分类</option>';
	$splits = "";
	findTypes($conne, $types, $splits, $txt);
	$txt .= '</select></td></tr>';
	$txt .= '<tr><td>分类名称：<input type="text" id="typename""/></td></tr>';	
	$txt .= '<tr><td><input type="submit" id="addtypesub" value="添加分类"/></td></tr></table></form>';
	
	//删除资料分类
	$txt .= '<form id="deltype">';
	$txt .= '<table width="50%" style="float:right;">';
	$txt .= '<tr><th>删除分类：</th></tr>';
	$txt .= '<tr><td>删除该分类：<select id="deltypelist">';
	$txt .= '<option>请选择</option>';
	$txt .= '<option value="1">根分类</option>';
	$splits = "";
	findTypes($conne, $types, $splits, $txt);
	$txt .= '</select></td></tr>';
	$txt .= '</table></form>';
	
	echo $txt;
	
	//函数：递归查询分类，并且添加分类的前缀字符串（如：“|----|----分类1”）
	function findTypes(&$conne, $rsts, &$splits, &$txt){

		if(!is_array($rsts)){
		}else{
			$splits .= "|----";
			foreach($rsts as $rst){
				$txt .= '<option value="'.$rst['id'].'">'.$splits.$rst['name'].'</option>';
				$sql = "select * from tb_doctype where pretypeid =".$rst['id'];
				$result = $conne->getRowsArray($sql);
				$conne->close_rst();
				
				//记录split此时的状态
				$_splits = $splits;
				findTypes($conne, $result, $splits, $txt); 
				//回复split状态
				$splits = $_splits;
						
				
			}
		}
	}
	
	//函数：用于递归删除分类和移除文件
	function delDocType($id, &$conne){
		//查找分类文件夹路径
		$sql = "select path from tb_doctype where id=".$id;
		$foldpath = $conne->getFields($sql, 0);
		$conne->close_rst();
		//删除分类文件夹以及它里面的所有文件
		delDir($foldpath);
		rmdir($foldpath);
		//删除分类以及分类下文件的数据库数据
		$sql = "delete from tb_docfile where filetype_id=".$id;
		$conne->mysql_query_rst($sql);
		$sql = "delete from tb_doctype where id=".$id;
		$conne->mysql_query_rst($sql);
		//删除下属分类
		$sql = "select id from tb_doctype where pretypeid=".$id;
		$subtypes = $conne->getRowsArray($sql);
		$conne->close_rst();
		if(is_array($subtypes)){
			foreach($subtypes as $subtype){
				delDocType($subtype['id'], $conne);
			}
		}		
	}
?>
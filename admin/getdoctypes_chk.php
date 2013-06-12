<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";

	//查询根分类
	$splits = "";
	$txt = "";
	$sql = "select * from tb_doctype where id = 1";
	$roottp = $conne->getRowsRst($sql);
	$conne->close_rst();
	$sql = "select * from tb_doctype where pretypeid =".$roottp['id'];
	$types = $conne->getRowsArray($sql);
	$conne->close_rst();
	
	//增添资料分类
	$txt = '';
	$txt .= '<div style="float:left;line-height:40px;">资料列表</div>';
    $txt .= '<select id="doctypelist">';
	$txt .= '<option>请选择分类</option>';
	$txt .= '<option value="1">根分类</option>';
	$splits = "";
	findTypes($conne, $types, $splits, $txt);
	$txt .= '</select>';
	echo $txt;
	
	//递归查询分类，并且添加分类的前缀字符串（如：“|----|----分类1”）
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
	
?>
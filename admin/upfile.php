<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";
	$filename = $_FILES['upname']['name'];			
	$filetype_ids = $_POST['filetype-ids'];				
	$tmpname = $_FILES['upname']['tmp_name'];	
	$tmpsize = $_FILES['upname']['size'];						
	$lgname = $_SESSION['lgname'];
	$max = 0;
	
	//判断是否超过了作业分类提交时间
	$sql ="select deadline from tb_uptype where id = ".$filetype_ids[0];
	$deadline = $conne->getFields($sql, 0);
	$conne->close_rst();
	$deadline = strtotime($deadline);
	$now = @mktime();
	if($now > $deadline){
		echo('<script type="text/javascript">alert("对不起，提交截止时间已过");
		location="'.$_SERVER['HTTP_REFERER'].'"</script>');
		die();exit();
	}
	
	$filetype_ids[0];
	foreach($_FILES['upname']['error'] as $key => $error){
		if($error == UPLOAD_ERR_OK){
			 //查找数据库是否有相同同名文件
			 $sql = "select * from tb_upfile where filename ='"
			 		.trim($filename[$key])."' and filetype_id ='".$filetype_ids[$key]."' and upauthor='"
					.$lgname."'";
			 $num = $conne->uidRst($sql);
			 $conne->close_rst();

			 if($num == 0){
				 $dup = 0;
			 }else{
				 $dup = 1;
			 }
		}else if($error == UPLOAD_ERR_FORM_SIZE){
			echo '<script>alert("文件过大！");location="'.$_SERVER['HTTP_REFERER'].'";</script>';
		}
		
	}
	       
	if($dup == 1){
		echo '<script>alert("该文件已经上传到服务器，请重命名再上传！");location="'.$_SERVER['HTTP_REFERER'].'";</script>';
	}else{									   
		for ($i = 0; $i < count($filename); $i++)
		{	
			//在当前类别为用户生成上传文件夹
			$file_path = "../upfiles/".$filetype_ids[$i]."/".$lgname."/";
			if(!file_exists($file_path)){
				mkdir($file_path);
			}
			//使用“用户名”+”当前时间戳“+随机数 为每个文件生成一个随机文件
			$rand_name = $lgname.@mktime().mt_rand().".".pathinfo($filename[$i], PATHINFO_EXTENSION);
			move_uploaded_file($tmpname[$i], $file_path.$rand_name);
			//根据文件类型id查找文件类型名字
			$sql = "select genrename from tb_uptype where id='".$filetype_ids[$i]."';";
			$typename = $conne->getFields($sql, 0);
			$conne->close_rst();
			//将文件信息插入数据库
			$insertsql = 'insert into tb_upfile (filename,filepath,filetype,upauthor,filesize,filetype_id) values("'.trim($filename[$i]).'","'.$file_path.$rand_name.'","'.$typename.'","'.$lgname.'",'.$tmpsize[$i].','.$filetype_ids[$i].')';
		$conne->uidRst($insertsql);
		}	
		echo '<script>alert("上传成功");location="'.$_SERVER['HTTP_REFERER'].'";</script>';
	}	
?>

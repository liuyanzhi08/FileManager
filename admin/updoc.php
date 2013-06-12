<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php
	include_once "../includes/lgchk.inc.php";
	include_once "../conn/conn.php";
	adminrequired();
	
	$names = $_FILES['updoc']['name'];
	$temp_names = $_FILES['updoc']['tmp_name'];
	$sizes = $_FILES['updoc']['size'];
	$doctypeid = $_POST['doctypeid'];
	//将文件移到分类文件夹,并且将文件录入数据库
	if(is_array($names)){
		for($i = 0; $i < count($names); $i++){
			//重命名文件：取上传时的时间戳+随机数
			$rand_name = @mktime().mt_rand().".".pathinfo($names[$i], PATHINFO_EXTENSION);
			$path = "../updocs/".$doctypeid."/".$rand_name;
			move_uploaded_file($temp_names[$i], $path);
			//录入数据库
			$sql = "insert into tb_docfile(name, doctypeid, path, size)
					 values('".$names[$i]."',".$doctypeid.",'".$path."',".$sizes[$i].")";
			$conne->mysql_query_rst($sql);
			echo "<script>alert('上传成功');location='".$_SERVER['HTTP_REFERER']."';</script>";
		}
	}
?>
<body>
</body>
</html>
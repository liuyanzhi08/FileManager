<?php
	session_start();
	date_default_timezone_set('PRC'); 
	if(!isset($_SESSION['lgname'])){
		echo '<script>alert("请先登录！");location="'.$_SERVER['PHP_SELF'].'/../../login/login.php";</script>';
	}
	$lgname = $_SESSION['lgname'];
	$admin = $_SESSION['admin'];
	$lgid = $_SESSION['lgid'];
	
	function adminrequired(){
		if(!$_SESSION['admin']){
			echo('<script type="text/javascript">alert("对不起，您需要取得管理员权限才能进行该操作");
				 location="'.$_SERVER['HTTP_REFERER'].'"</script>');
			die();exit();
		}
	}
?>
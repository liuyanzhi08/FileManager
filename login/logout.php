<?php
	session_start();
	unset($_SESSION['lgname']); 
	unset($_SESSION['admin']);
	//echo $_SERVER['PHP_SELF']."/../login.php";
	echo "<script>location='".$_SERVER['PHP_SELF']."/../../login/login.php"."';</script>"; 
?>
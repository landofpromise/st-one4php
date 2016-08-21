<?php 
	session_start();
	include("common.php");
	logout();
	echo "<script language=\"javascript\">window.location.href=\"login.php\"</script>";
?>
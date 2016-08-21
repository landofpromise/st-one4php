<?php
$is_dzz=$_SESSION["IS_DZZ"];

if($is_dzz != 1){
	echo "<script language=\"javascript\">".
		"window.location.href=\"../one/login.php\"</script>";
}

?>
<?php
 include("islocal.php");
?>

<?php
if(!$islocal){
	include("login_validate.php");
	include("../audio/connect/config.php");
}else{
	include("connect/config.php");
}
?>

<?php
$current_id = $_GET[current_id];

if($current_id){
	
	$delete_sql = "delete from st2016 where id=$current_id";
	mysql_query($delete_sql);
}
//if (mysql_affected_rows() > 0){
	$rs = array("result"=>"1");
//}else{
//	$rs = array("result"=>"0");
//}

echo json_encode($rs);

?>

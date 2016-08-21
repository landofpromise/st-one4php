<?php
include("connect/config.php");
include("common.php");
include("sign_db.php");
?>

<?php 
session_start();
$name = $_POST["name"];
$phone = $_POST["phone"];
if(!$name){
	exit;
}

$trim_name = trim($name);
$trim_phone = trim($phone);

$found = hasSign($trim_name,$trim_phone);

if($found){
	$arr = array('result'=>2);
	echo json_encode($arr);
}else{
	insert($trim_name, $trim_phone);

	$arr = array('result'=>1,'token'=>$uid);
	echo json_encode($arr);
}

?>
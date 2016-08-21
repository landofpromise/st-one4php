<?php
include("connect/config.php");
include("common.php");
?>

<?php 
session_start();
$code = $_POST[code];
if(!$code){
	exit;
}

$trim_code = trim($code);
if(strlen($trim_code) != 6){
	exit;
}

// 从数据空中，获取到所有大组长的唯一标识，和手机号码
$phone_sql = "select id, name, phone, is_dzz, dzz_id from st2016 where substr(phone, 6,6)=$trim_code";
$rs = mysql_query($phone_sql);
$found = false;
$dzz_id = 0;
$uid = 0;
$is_dzz = 0;
$name="";
if($row=mysql_fetch_assoc($rs)){
	$uid = $row["id"];
	$is_dzz = $row["is_dzz"];
	$name = $row["name"];
	$phone = $row["phone"];
	$dzz_id = $row["dzz_id"];
	$found = true;
}

if($found){
	$arr = array('result'=>1,'token'=>$uid);
	login($uid, $is_dzz, $name, $phone, $dzz_id);	
	echo json_encode($arr);
}else{
	logout();
	$arr = array('result'=>-1);
	echo json_encode($arr);
}

?>
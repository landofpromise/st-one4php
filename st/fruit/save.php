
<?php
//include("connect/config.php");
include("../one/connect/config.php");
?>

<?php

$field_array = array("zz_id","yz_id", "area_id", "DTZGNumber", "YDNumber", "WZNumber", "JSNumber","ZDNumber");

$zz_id = $_POST[$field_array[0]];
$zy_id = $_POST[$field_array[1]];
$DTZGNumber = $_POST[$field_array[3]];
$YDNumber = $_POST[$field_array[4]];
$WZNumber = $_POST[$field_array[5]];
$JSNumber = $_POST[$field_array[6]];
$ZDNumber = $_POST[$field_array[7]];

$submitDate = date('Y-m-d H:i:s');

$week = date("w");

$user_sql = "select * from st2016_data where zy_id=$zy_id and day_num=$week";
$user_rs = mysql_query($user_sql);
$has_value =false;
if(mysql_fetch_assoc($user_rs)){
	$has_value = true;
}

if($has_value){
	$update_sql = "update st2016_data set dtzg_number=$DTZGNumber,".
		"yd_number=$YDNumber,wz_number=$WZNumber,js_number=$JSNumber,zd_number=$ZDNumber".
	   " where zy_id=$zy_id and day_num=$week";
	mysql_query($update_sql);
	echo "更新成功";

}else{
	//$user_sql = "select * from st2016_data where name='$username' and phone='$phone'";
	//$rs=mysql_query($user_sql);
	$insert_sql = "insert into st2016_data (zz_id, zy_id, dtzg_number , yd_number, wz_number, js_number, zd_number, submit_date, day_num)".
	 	" values ($zz_id, $zy_id, $DTZGNumber, $YDNumber, $WZNumber, $JSNumber, $ZDNumber, '$submitDate' , $week);";
	$insert_rs = mysql_query($insert_sql);

	$count_rs = mysql_query("select count(*) from st2016_data where zz_id=$zz_id and day_num=$week");
	if($row=mysql_fetch_row($count_rs))
		echo "添加成功，已经添加".$row[0]."/$DTZGNumber";
		
	echo "";
}

?>

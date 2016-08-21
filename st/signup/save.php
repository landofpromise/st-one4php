<?php
 include("islocal.php");
?>

<?php


if(!$islocal){
	header("Content-type: text/html; charset=utf-8");
	//include("login_validate.php");
	include("../audio/connect/config.php");
}else{
	include("connect/config.php");
}
?>

<?php
	function parseValue($value){
		return $value == "on" ? 1 : 0;
	}
?>

<?php
$dis_uid = $_POST[dis_uid];

$current_id = $_POST[current_id];

if(!$dis_uid)
  exit;
  
$admin=$dis_uid == 1 || $dis_uid == 109;
if($current_id && !$admin){
	$user_sql = "select * from st2016 where dis_uid=$dis_uid and id=$current_id";
	$user_rs = mysql_query($user_sql);
	if(mysql_num_rows($user_rs) < 1){
		exit;
	}
}

$dis_username = $_POST[dis_username];

$username = trim($_POST[username]);
$sex = $_POST[sex];
$islop = $_POST[islop];
$student = $_POST[student];
$muqu_name = trim($_POST[muqu_name]);
$jh_prov = trim($_POST[jh_prov]);
$jh_city = trim($_POST[jh_city]);
$jh_name = trim($_POST[jh_name]);
$prov = trim($_POST[prov]);
$city = trim($_POST[city]);
$dist = trim($_POST[dist]);
$town = trim($_POST[town]);
$birth_year = $_POST[birth_year];
$birth_month = $_POST[birth_month];
$size = trim($_POST[size]);
$phone = trim($_POST[phone]);
$zz_name = trim($_POST[zz_name]);
$zz_phone = trim($_POST[zz_phone]);
$is_dzz = $_POST[is_dzz];
$exp_st = $_POST[exp_st];
$exp_fishing = $_POST[exp_fishing];
$expect = addslashes($_POST[expect]);
$witness = addslashes($_POST[witness]);

$fishing = $_POST[fishing];
$st_fishing_days = $_POST[st_fishing_days];
$st_happy_days = $_POST[st_happy_days];

$add_date=date('Y-m-d H:i:s');

$field_array = array("name","sex","muqu_name","student","jh_prov","jh_city","jh_name","prov","city","dist","town",
	"dirth_year","dirth_month","size","phone","zz_name","zz_phone","is_dzz","exp_st","exp_fishing","islop","witness","expect",
	"fishing","st_fishing_days","st_happy_days");

$value_array = array("'$username'", $sex, "'$muqu_name'", $student, "'$jh_prov'","'$jh_city'","'$jh_name'","'$prov'",  
	"'$city'", "'$dist'", "'$town'", $birth_year, $birth_month, "'$size'", "'$phone'", "'$zz_name'",$zz_phone, $is_dzz,  
		$exp_st, $exp_fishing, $islop, "'$witness'", "'$expect'", $fishing, $st_fishing_days, $st_happy_days);
if($current_id){
	$update_content = "";
	for ($j=0;$j<count($field_array);$j++){
		$update_content = $update_content.$field_array[$j]."=".$value_array[$j].",";
	}
	$update_content = substr($update_content, 0, strlen($update_content)-1);
	$where_sql = " id=".$current_id;
	$update_sql = "update st2016 set ".$update_content." where".$where_sql;
	
	$result=mysql_query($update_sql);
	

	if($result){
		$array = array("code"=>200,"msg"=>"保存成功");
		echo json_encode($array);
	}
    else{
    	$array = array("code"=>500,"msg"=>"保存失败");
		echo json_encode($array);
    }
    	
    exit;
}

$user_sql = "select * from st2016 where name='$username' and phone='$phone'";
$rs=mysql_query($user_sql);

if(mysql_num_rows($rs) >= 1){
    $array = array("code"=>504,"msg"=>"保存失败");
	echo json_encode($array);
}else{
	$insert_field = "";
	for ($j=0;$j<count($field_array);$j++){
		$insert_field = $insert_field.$field_array[$j].",";
	}
	$insert_field = substr($insert_field, 0, strlen($insert_field)-1);

	$field_value = "";
	for ($j=0;$j<count($value_array);$j++){
		$field_value = $field_value.$value_array[$j].",";
	}
	$field_value = substr($field_value, 0, strlen($field_value)-1);

	$insert_sql = "insert into st2016 ($insert_field, add_date,dis_uid,dis_username)".
	 " values ($field_value, '$add_date', $dis_uid, '$dis_username');";
	
	$insert_rs = mysql_query($insert_sql);
	if(empty($insert_rs)){
		$array = array("code"=>500,"msg"=>"保存失败");
		echo json_encode($array);
	}else{
		$array = array("code"=>200,"msg"=>"保存成功");
		echo json_encode($array);
	}
}
?>

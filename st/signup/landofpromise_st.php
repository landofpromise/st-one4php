<?php
 	include("islocal.php");
?>

<?php
if(!$islocal){
	header("Content-type: text/html; charset=utf-8");
	include("login_validate.php");
	include("../audio/connect/config.php");
}else{
 	include("connect/config.php");
}
?>

<?php
$dis_uid = $_POST[dis_uid];

if(!$dis_uid)
  exit;
$dis_username = $_POST[dis_username];

$username = trim($_POST[username]);
$sex = $_POST[sex];
$muqu = trim($_POST[muqu]);
$student = $_POST[student];
$hometown = trim($_POST[hometown]);
$birth_year = $_POST[birth_year];
$birth_month = $_POST[birth_month];
$size = trim($_POST[size]);
$phone = trim($_POST[phone]);
$zz_name = trim($_POST[zz_name]);
$zz_phone = trim($_POST[zz_phone]);
$is_dzz = $_POST[is_dzz];
$full = $_POST[full];
$exp_st = $_POST[exp_st];
$exp_fishing = $_POST[exp_fishing];

$day0 = $_POST[day0];
$day1 = $_POST[day1];
$day2 = $_POST[day2];
$day3 = $_POST[day3];
$day4 = $_POST[day4];
$day5 = $_POST[day5];
$day6 = $_POST[day6];
$day6_2 = $_POST[day6_2];

$hotel_1 = $_POST[hotel_1];
$hotel0 = $_POST[hotel0];
$hotel1 = $_POST[hotel1];
$hotel2 = $_POST[hotel2];
$hotel3 = $_POST[hotel3];
$hotel4 = $_POST[hotel4];
$hotel5 = $_POST[hotel5];
$hotel6 = $_POST[hotel6];

$checkbox_array = array($day0, $day1, $day2, $day3, $day4, $day5, $day6, $day6_2,
	$hotel_1,$hotel0,$hotel1,$hotel2,$hotel3,$hotel4,$hotel5,$hotel6);

$num = count($checkbox_array);
$sql_day = "";
for($i=0;$i<$num;$i++){
  $value = $checkbox_array[$i];
  $sql_value = "0";
  if($value == "on"){
    $sql_value = "1";
  }
  if($i == 0)
    $sql_day = $sql_value;
  else
	$sql_day = $sql_day.",".$sql_value;
}

$add_date=date('Y-m-d H:i:s');

$user_sql = "select * from st2016 where name='$username' and phone='$phone'";
$rs=mysql_query($user_sql);
if(mysql_num_rows($rs) >= 1){
    echo '添加失败，添加的用户已经存在了，目前还不支持编辑敬请期待';
}else{
	$insert_sql = "insert into st2016 (name, sex, muqu, student, hometown , dirth_year, dirth_month, size,".
		"phone,zz_name,zz_phone, is_dzz, full, exp_st, exp_fishing, day0, day1, day2, day3, ".
		"day4, day5, day6, day6_2,hotel_1,hotel0,hotel1,hotel2,hotel3,hotel4,".
		"hotel5,hotel6,add_date,dis_uid,dis_username)".
	 " values ('$username', $sex, '$muqu', $student, '$hometown', $birth_year, $birth_month, $size, ".
		"'$phone', '$zz_name',$zz_phone, $is_dzz, $full, $exp_st, $exp_fishing, $sql_day, '$add_date', $dis_uid, '$dis_username');";
	
	$insert_rs = mysql_query($insert_sql);
	if(empty($insert_rs)){
		echo '添加失败';
	}else{
		echo '添加成功';
	}
}
?>

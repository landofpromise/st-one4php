<?php
include("config.php");
$hc_id = $_GET['hcid'];
$dzz_id = $_POST['selectdzz'];
$day = $_GET['day'];
$num = $_POST['num'];


$sql = "select * from $fieldarrangetable where hc_id=$hc_id and dzz_id=$dzz_id and day=$day;";
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
$oldnum = mysql_num_rows($result);
$cnt = 0;
if ($oldnum == 0){
	$cnt = $num;
	$sql = "insert into $fieldarrangetable(hc_id,dzz_id,day,teams) values($hc_id,$dzz_id,$day,$cnt);";
} else {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$cnt = $row['teams'];
	$cnt = $cnt + $num;
	$sql = "update $fieldarrangetable set teams=$cnt where hc_id=$hc_id and dzz_id=$dzz_id and day=$day;";
}
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
?>

<html>
<meta charset="<?php echo $charset; ?>">
<style type = "text/css">
body{

	background:#F5F5F5;
}
</style>
<body>
添加成功！
<input type = "button" name = add onclick = "javascript:window.location.href='st_team_hc.php?day=<?php echo $day;?>&hc_id=<?php echo $hc_id;?>'" ; value = "返回" >

</body>
</html>

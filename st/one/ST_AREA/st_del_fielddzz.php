<?php
include("config.php");
$hc_id = $_GET['hcid'];
$dzz_id = $_GET['dzzid'];
$day = $_GET['day'];


$sql = "delete from $fieldarrangetable where hc_id=$hc_id and dzz_id=$dzz_id and day=$day;";
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

删除成功！
<input type = "button" name = add onclick = "javascript:window.location.href='st_team_hc.php?day=<?php echo $day;?>&hc_id=<?php echo $hc_id;?>'" ; value = "返回" >
</body>
</html>

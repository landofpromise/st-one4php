
<?php
include("config.php");
$hc_id = $_GET['id'];
$sql = "delete from $datatable where id=$hc_id;";
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
mysql_close($conn);
?>
<html>
<meta charset="<?php echo $charset; ?>">
<style type = "text/css">
body{

	background:#F5F5F5;
}
</style>
<body>

删除成功!
<input type = "button" name = add onclick = "javascript:window.location.href='st_main.php'" ; value = "返回首页" >
</body>
</html>

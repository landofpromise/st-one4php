<?php
	include("config.php");
	$newbie = $_POST['newbie'];
	$id = $_POST['zuzhangid'];
	$duration = $_POST['duration'];
	$recordType = $_POST['recordtype'];
	$feedback = $_POST['feedback'];
	$logid = $_POST['logid'];
	$res = UpdateNewbieRecord($logid, $id, $newbie, $recordType, $duration, time(), $feedback);
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>果子跟进系统</title>
<script language = "javascript">
</script>
<style type = "text/css">
body{

	background:#FFF5EE;
}
</style>
</head>
<center>
<body>
<h1 align = "center" >添加跟进记录</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $id;?>'" ; value = "跟进系统首页" >
<?php
	echo "<br><br><br>";
	if($res)
		echo '添加成功';
	else
		echo "添加失败";
?>

</body>
</center>
</html>

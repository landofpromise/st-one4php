<?php
	include("config.php");
	$id = $_POST['id'];
	$newbie = $_POST['newbie'];
	$TOZUZHANG = $_POST['TOZUZHANG'];
	$arrangeTime = time();
	$res = UpdateNewbieArrange($newbie, $TOZUZHANG, $arrangeTime);
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
<h1 align = "center" >分配果子</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $id;?>'" ; value = "跟进系统首页" >
<?php
	echo "<br><br><br>";
	if($res)
		echo '分配成功';
	else
		echo "分配失败";
?>

</body>
</center>
</html>

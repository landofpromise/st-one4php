<?php
	include("config.php");
	$newbie = $_POST['newbie'];
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$muqu = $_POST['muqu'];
	$recordfrom = $_POST['recordfrom'];
	$phone = $_POST['phone'];
	$age = $_POST['age'];
	$wechat = $_POST['wechat'];
	$qq = $_POST['qq'];
	$studytype = $_POST['studytype'];
	$grade = $_POST['grade'];
	$hometown = $_POST['hometown'];
	$meetlocale = $_POST['meetlocale'];
	$writer = $_POST['writer'];
	$writetime = time();
	$deleted = $_POST['deleted'];
	$faithyear = $_POST['faithyear'];
	$descript = $_POST['descript'];
	$res = UpdateNewbieInfo($newbie,$name,$gender,$muqu,$recordfrom,$phone,$age,$wechat,$qq,$studytype,$grade,$hometown,$meetlocale,$writer,$writetime,$deleted,$faithyear,$descript);	
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
<h1 align = "center" >果子跟进系统</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $writer;?>'" ; value = "跟进系统首页" >
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

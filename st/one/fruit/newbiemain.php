
<?php
include("config.php");
$id=$_GET['id'];
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>新人跟进系统管理页面</title>
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
<h1 align = "center" >
<a href="newbie_add.php?id=<?php echo $id;?>">添加迎新果子</a>
<br><br>


<a href="newbie_arrange.php?id=<?php echo $id;?>">分配迎新果子</a>
<br><br>

<a href="newbie_list.php?id=<?php echo $id;?>">查看分配到的迎新果子</a>
<br><br>


</body>
</html>

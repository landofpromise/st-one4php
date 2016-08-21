<?php
include("config.php");

$name = $_POST['keyword_type'];
?>
<html>
<head>
	<meta charset="<?php echo $charset; ?>">
	<title>搜索处理</title>
	<style type = "text/css">
body{

	background:#F0FFFF;
}
</style>
</head>
<body>

<table>
<tr><td>

<?php

$sql = "select * from $datatable where type ='$name'";
$selectdb = @mysql_query($sql,$conn);
	if(!$sql){
		echo"SQL执行不成功";
	}
$count = @mysql_num_rows($selectdb);
	if($count<0){
		echo"没有记录";
	}

?>

<table width = "100%" border = "1" cellspacing = "1" cellpadding = "1">
<tr>
<td><div align = "center">ID</div></td>
<td><div align = "center">禾场</div></td>
<td><div align = "center">牧区</div></td>
<td><div align = "center">类型</div></td>
<td><div align = "center">地点</div></td>
<td><div align = "center">公交</div></td>
<td><div align = "center">禾场信息</div></td>
<td><div align = "center">联系人</div></td>
</tr>
<?php
   for($i=0;$i<$count;$i++){
	$row = @mysql_fetch_object($selectdb);
echo "<tr>";
echo '<td><div align = "center">'.$row->id."&nbsp;</div></td>";
echo '<td><div align = "center">'.$row->code."&nbsp;</div></td>";
echo '<td><div align = "center">'.$row->MQ."&nbsp;</div></td>";
echo '<td><div align = "center">'.$type2name[$row->type]."&nbsp;</div></td>";
echo '<td><div align = "center">'.$row->locale."&nbsp;</div></td>";
echo '<td><div align = "center">'.$row->traffic."&nbsp;</div></td>";
echo '<td><div align = "center">'.$row->info."&nbsp;</div></td>";
echo '<td><div align = "center">'.$row->contacts."&nbsp;</div></td>";
echo "	</tr>";
   }
?>
</table>
<?php
mysql_close($conn);
?>
<form>
        <table>

          <tr>
           <td height = "31">
			<input type = "button" name = "back" value = "返回主页面"
			onclick = "javascript:window.location.href = 'st_main.php'"></td>
			<td>&nbsp;</td>
            </tr>
		<table>
</form>
</body>
</html>

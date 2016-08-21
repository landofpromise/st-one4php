
<?php
include("config.php");
$hcid = $_GET['hcid'];
$dzz_id = $_GET['dzzid'];
$day = $_GET['day'];
$sql = "select id,type,code,mq,locale,traffic,info,contacts from $datatable where id=$hcid";
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>禾场管理</title>
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
<?php
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
?>
<h1 align = "center" ><?php echo $row['code']?>&nbsp;详细信息</h1>
<br>
<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84">
   <tr bgcolor = "8bbcc7">
	   <td><div align = "center"><strong>类型</strong></div></td>
	   <td><div align = "center"><strong>公交</strong></div></td>
	   <td><div align = "center"><strong>信息</strong></div></td>
	   <td><div align = "center"><strong>联系人</strong></div></td>
	</tr>
	<tr bgcolor = "#ffffff">
	   <td height = "22" >&nbsp;<?php echo $type2name[$row['type']]; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php echo $row['traffic']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php echo $row['info']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php echo $row['contacts']; ?>&nbsp;</td>
		
	</tr>
</table>
<br>
其他信息<br>
<?php
	$sql0 = "select * from $reporttable where hc_id=$hcid;";
	$result0 = mysql_query($sql0) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql0);
	while($row0 = mysql_fetch_array($result0,MYSQL_ASSOC)) {
		echo "<b>".$leaderInfo[$row0['dzz_id']]."组 ".$row0['tips']."</b><br>";
	}
}
mysql_close($conn);
?>

<div style="left:200px">
<input type = "button" name = "add" onclick = "javascript:window.location.href='st_info.php?day=<?php echo $day;?>&dzz_id=<?php echo $dzz_id;?>';" value = "返回" >
</div>
</body>
</center>
</html>

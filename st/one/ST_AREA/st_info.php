
<?php
include("config.php");

$dzz_id = $_GET['dzz_id'];
$day = $_GET['day'];

// $sql = "select * from $fieldarrangetable where day=$day and dzz_id=$dzz_id";
$sql = "select a.hc_id,a.dzz_id,a.day,a.teams,b.code,b.type,b.to_hc,b.to_lop,b.lop_to_hc from (select hc_id,dzz_id,`day`,teams from $fieldarrangetable where dzz_id=$dzz_id) as a left JOIN $datatable as b ON a.hc_id = b.id";

$day = $_GET['day'];
// $sql = "select * from $fieldarrangetable where day=$day and dzz_id=$dzz_id";
if($day) {
	$sql = "select a.hc_id,a.dzz_id,a.day,a.teams,b.code,b.type,b.to_hc,b.to_lop,b.lop_to_hc from (select hc_id,dzz_id,`day`,teams from $fieldarrangetable where dzz_id=$dzz_id and day=$day) as a left JOIN $datatable as b ON a.hc_id = b.id";
} 
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);


$dzzsql = "select * from $leadertable where id = $dzz_id";
$dzzresult = mysql_query($dzzsql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$dzzsql);
$dzzrecord = @mysql_fetch_object($dzzresult);
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
<h1 align = "center" ><?php echo $dzzrecord->name; ?>组第<?php if($day)  echo $day; ?>天禾场管理</h1>

<div style="left:200px">
<input type = "button" name = add onclick = "javascript:window.location.href='st_info.php?day=1&dzz_id=<?php echo $dzz_id;?>'" ; value = "查看DAY1分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_info.php?day=2&dzz_id=<?php echo $dzz_id;?>'" ; value = "查看DAY2分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_info.php?day=3&dzz_id=<?php echo $dzz_id;?>'" ; value = "查看DAY3分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_info.php?day=4&dzz_id=<?php echo $dzz_id;?>'" ; value = "查看DAY4分组" >
</div>


<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84">
   <tr bgcolor = "8bbcc7">
	   <td><div align = "center"><strong>禾场</strong></div></td>
	   <td><div align = "center"><strong>类型</strong></div></td>
	   <td><div align = "center"><strong>队伍数量</strong></div></td>
	   <td><div align = "center"><strong>从当前位置去禾场</strong></div></td>
	   <td><div align = "center"><strong>从当前位置回LOP</strong></div></td>
	   <td><div align = "center"><strong>从LOP到禾场</strong></div></td>
	   <td><div align = "center"><strong>禾场详细信息</strong></div></td>
	</tr>

<?php	
	
if($num = mysql_num_rows($result)){

while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
	// $sql2 = "select * from $datatable where id = ".$row['hc_id'].";";
	// $result2 = mysql_query($sql2) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql2);
	// $row2 = mysql_fetch_array($result2,MYSQL_ASSOC);	
?>
	<tr bgcolor = "#ffffff">
	   <td height = "22" >&nbsp;<?php echo $row['code']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php echo $type2name[$row['type']]; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php echo $row['teams']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php if($row['to_hc']) echo "<a href='".$row['to_hc']."' target='_blank'>出发</a>"; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php if($row['to_lop']) echo "<a href='".$row['to_lop']."' target='_blank'>回家</a>"; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php if($row['lop_to_hc']) echo "<a href='".$row['lop_to_hc']."' target='_blank'>从LOP出发到禾场</a>"; ?>&nbsp;</td>
	   <td height="22">&nbsp;
	   <?php if($row['hc_id']) echo "<a href='st_team_hc.php?hc_id=".$row['hc_id']."&day=$day' target='_blank'>禾场详细信息</a>"; ?>
	    &nbsp;</td>		
	</tr>
<?php
}
}
mysql_close($conn);
?>

</table>
</body>
</center>
</html>

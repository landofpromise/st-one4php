
<?php
include("config.php");

$day = $_GET['day'];
$hcid = $_GET['hc_id'];
$sql = "select id,type,code,mq,locale,traffic,info,contacts from $datatable where id=$hcid";
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
$hcrecord = @mysql_fetch_object($result);
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>禾场分组管理</title>
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
<h1 align = "center" >ST禾场管理系统</h1>

<div style="left:200px">
<input type = "button" name = add onclick = "javascript:window.location.href='st_main.php'" ; value = "返回首页" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_team_hc.php?day=1&hc_id=<?php echo $hcid;?>'" ; value = "查看DAY1分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_team_hc.php?day=2&hc_id=<?php echo $hcid;?>'" ; value = "查看DAY2分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_team_hc.php?day=3&hc_id=<?php echo $hcid;?>'" ; value = "查看DAY3分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_team_hc.php?day=4&hc_id=<?php echo $hcid;?>'" ; value = "查看DAY4分组" >
</div>
<br>
<br>
<form method = "post" action = "st_add_fielddzz.php?hcid=<?php echo $hcid;?>&day=<?php echo $day;?>">
<p align = "center"><b><?php echo $hcrecord->code; ?>：(选择大组长和分配的队伍数量)
<select id="selectdzz" name="selectdzz">
<?php foreach($leaderInfo as $id=>$name) { ?>
  <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
<?php } ?>
</select>
</b><input type = "text" name = "num" value=1 id = "num" size = 3>
</b><input type = "submit" value = "点击添加" name = "b1"></p>
</form>
<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84">
   <tr bgcolor = "8bbcc7">
       <td height = "33"><div align = "center"><strong>ID</strong></div></td>
	   <td><div align = "center"><strong>禾场</strong></div></td>
	   <td><div align = "center"><strong>类型</strong></div></td>
	   <td><div align = "center"><strong>队伍信息</strong></div></td>
	</tr>

	<tr bgcolor = "#ffffff">
	   <td height = "22" align = "center">&nbsp;<?php echo $hcrecord->id; ?>&nbsp;</td>
	   <td height = "22" align = "center">&nbsp;<?php echo $hcrecord->code; ?>&nbsp;</td>
	   <td height = "22" align = "center">&nbsp;<?php echo $type2name[$hcrecord->type]; ?>&nbsp;</td>
	   <td height = "22" align = "center">&nbsp;
<?php
	$sql0 = "select * from $fieldarrangetable where hc_id=$hcid and day=$day;";
	$result0 = mysql_query($sql0) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql0);
	while($row0 = mysql_fetch_array($result0,MYSQL_ASSOC)){
		echo 
	   		 "<a href='st_info.php?dzz_id=".$row0['dzz_id']."&day=$day' target='_blank'>".$leaderInfo[$row0['dzz_id']]."</a>" ;
		     
		echo '<a onclick="javascript:if(confirm(\'确定要删除用户信息吗?\')) return true; else return false;" href="st_del_fielddzz.php?hcid='.$hcid."&day=".$day."&dzzid=".$row0['dzz_id'].'">删除</a>';
		echo "<br>";
	}

?></td>
	</tr>
</table>
<br>
<?php

mysql_close($conn);
?>

</body>
</center>
</html>

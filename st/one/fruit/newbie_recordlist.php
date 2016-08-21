<?php
	include("config.php");
	$id = $_GET['id'];
	$newbie = $_GET['newbie'];
	$newbieInfo = GetNewbieInfoById($newbie);
	$list = GetRecordByNewbie($newbie);
	$visitors = GetAllVisitorsIdName();
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>查看跟进记录</title>
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
<h1 align = "center" >查看跟进记录信息</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $id;?>'" ; value = "跟进系统首页" >
<h2 align = "center" >被探访人：<?php echo $newbieInfo->NAME;?> </h2>
<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84" style="font-size:20;">
   <tr bgcolor = "8bbcc7">
		<td height = "29"><div align = "center"><strong>探访人</strong></div></td>
		<td height = "29"><div align = "center"><strong>类型</strong></div></td>
		<td height = "29"><div align = "center"><strong>时长</strong></div></td>
		<td height = "29"><div align = "center"><strong>时间</strong></div></td>
		<td height = "29"><div align = "center"><strong>反馈</strong></div></td>
		<td height = "29"><div align = "center"><strong>修改</strong></div></td>
	</tr>
<?php
	foreach($list as $i=>$recordInfo) {
?>
	<tr bgcolor = "#ffffff">
		<td><?php echo $visitors[$recordInfo->ZUZHANGID];?></td>
		<td><?php echo $recordTypeList[$recordInfo->RECORDTYPE];?></td>
		<td><?php echo $durationList[$recordInfo->DURATION];?></td>
		<td><?php echo date('Y-m-d',$recordInfo->VISITTIME);?></td>
		<td><?php echo $recordInfo->FEEDBACK;?></td>
		<td><a onclick="javascript:if(confirm('确定要修改吗?')) return true; else return false;" href="newbie_record.php?id=<?php echo $id; ?>&newbie=<?php echo $newbie;?>&logid=<?php echo $recordInfo->ID;?>">修改</a></td>
	</tr>
<?php
	}
?>
</body>
</center>
</html>

<?php
	include("config.php");
	$id = $_GET['id'];
	$list = GetAllMembersByZuZhang($id);
	$visitors = GetAllVisitorsIdName();
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>查看分配到的果子列表</title>
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
<h1 align = "center" >查看分配的果子信息</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $id;?>'" ; value = "跟进系统首页" >
<h2 align = "center" >你好！<?php echo $visitors[$id];?> </h2>
<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84" style="font-size:20;">
   <tr bgcolor = "8bbcc7">
		<td height = "29"><div align = "center"><strong>名字</strong></div></td>
		<td height = "29"><div align = "center"><strong>性别</strong></div></td>
		<td height = "29"><div align = "center"><strong>所属牧区</strong></div></td>
		<td height = "29"><div align = "center"><strong>来源</strong></div></td>
		<td height = "29"><div align = "center"><strong>手机号</strong></div></td>
		<td height = "29"><div align = "center"><strong>年龄</strong></div></td>
		<td height = "29"><div align = "center"><strong>QQ</strong></div></td>
		<td height = "29"><div align = "center"><strong>微信</strong></div></td>
		<td height = "29"><div align = "center"><strong>学位</strong></div></td>
		<td height = "29"><div align = "center"><strong>年级</strong></div></td>
		<td height = "29"><div align = "center"><strong>家乡</strong></div></td>
		<td height = "29"><div align = "center"><strong>遇到地点</strong></div></td>
		<td height = "29"><div align = "center"><strong>是否流失</strong></div></td>
		<td height = "29"><div align = "center"><strong>信主年限</strong></div></td>
		<td height = "29"><div align = "center"><strong>备注</strong></div></td>
		<td height = "29"><div align = "center"><strong>修改</strong></div></td>
		<td height = "29"><div align = "center"><strong>跟进记录</strong></div></td>
	</tr>
<?php
	foreach($list as $newbieId=>$newbieInfo) {
?>
	<tr bgcolor = "#ffffff">
		<td><?php echo $newbieInfo->NAME;?></td>
		<td><?php echo $genderList[$newbieInfo->GENDER];?></td>
		<td><?php echo $muquList[$newbieInfo->MUQU];?></td>
		<td><?php echo $recordfromList[$newbieInfo->RECORDFROM];?></td>
		<td><?php echo $newbieInfo->PHONE;?></td>
		<td><?php echo $newbieInfo->AGE;?></td>
		<td><?php echo $newbieInfo->QQ;?></td>
		<td><?php echo $newbieInfo->WECHAT;?></td>
		<td><?php echo $studytypeList[$newbieInfo->STUDYTYPE];?></td>
		<td><?php echo $newbieInfo->GRADE;?></td>
		<td><?php echo $newbieInfo->HOMETOWN;?></td>
		<td><?php echo $newbieInfo->MEETLOCALE;?></td>
		<td><?php echo $truefalseList[$newbieInfo->DELETED];?></td>
		<td><?php echo $faithyearList[$newbieInfo->FAITHYEAR];?></td>
		<td><?php echo $newbieInfo->DESCRIPT;?></td>
		<td><a onclick="javascript:if(confirm('确定要修改吗?')) return true; else return false;" href="newbie_add.php?id=<?php echo $id; ?>&newbie=<?php echo $newbieInfo->ID;?>">修改</a></td>
		<td>
			<a href="newbie_record.php?id=<?php echo $id;?>&newbie=<?php echo $newbieInfo->ID;?>">添加</a>&nbsp;
			<a href="newbie_recordlist.php?id=<?php echo $id;?>&newbie=<?php echo $newbieInfo->ID;?>">查看</a>
		</td>
	</tr>
<?php
	}
?>
</body>
</center>
</html>

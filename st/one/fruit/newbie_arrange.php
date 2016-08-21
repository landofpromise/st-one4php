<?php
	include("config.php");
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
<?php	
	$id = $_GET['id'];
	if(!CheckAllowed2Arrange($id)) {
		die("没有权限");
	}
	$list = GetAllMembersByQuZhang($id);
	$zzList = GetAllZuZhangByQuZhang($id);
	$visitors = GetAllVisitorsIdName();
?>
<h1 align = "center" >分配果子</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $id;?>'" ; value = "跟进系统首页" >
<h2 align = "center" >你好！<?php echo $visitors[$id];?> </h2>
<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84" style="font-size:20;">
   <tr bgcolor = "8bbcc7">
		<td height = "29"><div align = "center"><strong>名字</strong></div></td>
		<td height = "29"><div align = "center"><strong>性别</strong></div></td>
		<td height = "29"><div align = "center"><strong>牧区</strong></div></td>
		<td height = "29"><div align = "center"><strong>来源</strong></div></td>
		<td height = "29"><div align = "center"><strong>手机</strong></div></td>
		<td height = "29"><div align = "center"><strong>年龄</strong></div></td>
		<td height = "29"><div align = "center"><strong>QQ</strong></div></td>
		<td height = "29"><div align = "center"><strong>微信</strong></div></td>
		<td height = "29"><div align = "center"><strong>学位</strong></div></td>
		<td height = "29"><div align = "center"><strong>年级</strong></div></td>
		<td height = "29"><div align = "center"><strong>家乡</strong></div></td>
		<td height = "29"><div align = "center"><strong>遇到</strong></div></td>
		<td height = "29"><div align = "center"><strong>流失</strong></div></td>
		<td height = "29"><div align = "center"><strong>信主</strong></div></td>
		<td height = "29"><div align = "center"><strong>组长</strong></div></td>
		<td height = "29"><div align = "center"><strong>备注</strong></div></td>
		<td height = "29"><div align = "center"><strong>分配</strong></div></td>
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
		<td><?php echo $visitors[$newbieInfo->TOZUZHANG];?></td>
		<td><?php echo $newbieInfo->DESCRIPT;?></td>
		<td>
			<form method = "post" action="ArrangeNewbie.php">
				<select name="TOZUZHANG">
					<?php for($i=0;$i<count($zzList);$i++) { ?>
						<option value="<?php echo $zzList[$i]->ID;?>" ><?php echo $zzList[$i]->NAME;?></option>
					<?php } ?>
				</select>
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="newbie" value="<?php echo $newbieInfo->ID; ?>" />
				<input type = "submit" value = "分配" name = "b4">
			</form>
		</td>
	</tr>
<?php
	}
?>
</body>
</center>
</html>

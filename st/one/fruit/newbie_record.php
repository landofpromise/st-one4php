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
	if(!CheckAllowed2Record($id)) {
		die("没有权限");
	}
	$newbie = $_GET['newbie'];
	$logid = $_GET['logid'];
	$recordInfo = GetNewbieRecordInfo($newbie, $logid);
	$visitors = GetAllVisitorsIdName();
	$newbieInfo = GetNewbieInfoById($newbie);
?>
<h1 align = "center" >添加/修改跟进记录信息</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $id;?>'" ; value = "跟进系统首页" >
<form method = "post" action = "RecordNewbie.php">
<table width = "100%" border = "0" cellpadding = "0" cellspacing = "2" align = "center">
	<tr>
		<td width = "24%" height = "29" align = "center">跟进人</td>
		<td width = "76%"><?php echo $visitors[$id];?></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">被跟进人姓名</td>
		<td width = "76%"><?php echo $newbieInfo->NAME;?></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">跟进方式</td>
		<td width = "76%">
			<select name="recordtype">
				<?php foreach($recordTypeList as $rid=>$name) {
						if($rid==$recordInfo->RECORDTYPE)
							echo "<option value='$rid' selected=true>$name</option>";
						else
							echo "<option value='$rid' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">时长</td>
		<td width = "76%">
			<select name="duration">
				<?php foreach($durationList as $did=>$name) {
						if($did==$recordInfo->DURATION)
							echo "<option value='$did' selected=true>$name</option>";
						else
							echo "<option value='$did' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">反馈和备注</td>
		<td width = "76%">
<textarea name = "feedback" type = "textarea" maxlength = "1000" rows="5"><?php echo $recordInfo->FEEDBACK; ?></textarea>
		</td>
	</tr>
</table>
<input type="hidden" name="logid" value="<?php echo $logid; ?>" />
<input type="hidden" name="zuzhangid" value="<?php echo $id; ?>" />
<input type="hidden" name="newbie" value="<?php echo $newbie; ?>" />
<input type = "submit" value = "确定" name = "b4">
</form>
</body>
</center>
</html>

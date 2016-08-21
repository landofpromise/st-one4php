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
	$newbieid = $_GET['newbie'];
	$newbieInfo = GetNewbieInfoById($newbieid);
?>
<h1 align = "center" >添加/修改果子信息</h1>
<input type = "button"  name = add onclick = "javascript:window.location.href = 'newbiemain.php?id=<?php echo $id;?>'" ; value = "跟进系统首页" >
<form method = "post" action = "AddNewbie.php">
<table width = "100%" border = "0" cellpadding = "0" cellspacing = "2" align = "center">
	<tr>
		<td width = "24%" height = "29" align = "center">名字</td>
		<td width = "76%"><input name = "name" id="name" type = "text" size = "40" value="<?php echo $newbieInfo->NAME;?>"></td>
	</tr>
	
	<tr>
		<td width = "24%" height = "29" align = "center">性别</td>
		<td width = "76%">
			<select name="gender" id="gender">
				<?php foreach($genderList as $id=>$name) {
					if($id==$newbieInfo->GENDER)
						echo "<option value='$id' selected=true>$name</option>";
					else
						echo "<option value='$id'>$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">所属牧区</td>
		<td width = "76%">
			<select name="muqu">
				<?php foreach($muquList as $id=>$name) {
						if($id==$newbieInfo->MUQU)
							echo "<option value='$id' selected=true>$name</option>";
						else
							echo "<option value='$id' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">来源</td>
		<td width = "76%">
			<select name="recordfrom">
				<?php foreach($recordfromList as $id=>$name) {
						if($id==$newbieInfo->recordfrom)
							echo "<option value='$id' selected=true>$name</option>";
						else
							echo "<option value='$id' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">手机号</td>
		<td width = "76%"><input name = "phone" type = "text" size = "40" value="<?php echo $newbieInfo->PHONE;?>"></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">年龄</td>
		<td width = "76%"><input name = "age" type = "text" size = "40" value="<?php echo $newbieInfo->AGE;?>"></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">QQ</td>
		<td width = "76%"><input name = "qq" type = "text" size = "40" value="<?php echo $newbieInfo->QQ;?>"></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">微信</td>
		<td width = "76%"><input name = "wechat" type = "text" size = "40" value="<?php echo $newbieInfo->WECHAT;?>"></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">学位</td>
		<td width = "76%">
			<select name="studytype">
				<?php foreach($studytypeList as $id=>$name) {
						if($id==$newbieInfo->STUDYTYPE)
							echo "<option value='$id' selected=true>$name</option>";
						else
							echo "<option value='$id' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">年级</td>
		<td width = "76%">
			<select name="grade">
				<?php foreach($gradeList as $id=>$name) {
						if($id==$newbieInfo->GRADE)
							echo "<option value='$id' selected=true>$name</option>";
						else
							echo "<option value='$id' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">家乡</td>
		<td width = "76%"><input name = "hometown" type = "text" size = "40" value="<?php echo $newbieInfo->HOMETOWN;?>"></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">遇到地点</td>
		<td width = "76%"><input name = "meetlocale" type = "text" size = "40" value="<?php echo $newbieInfo->MEETLOCALE;?>"></td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">是否流失</td>
		<td width = "76%">
			<select name="deleted">
				<?php foreach($truefalseList as $id=>$name) {
						if($id==$newbieInfo->DELETED)
							echo "<option value='$id' selected=true>$name</option>";
						else
							echo "<option value='$id' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	<tr>
		<td width = "24%" height = "29" align = "center">信主年限</td>
		<td width = "76%">
			<select name="faithyear">
				<?php foreach($faithyearList as $id=>$name) {
						if($id==$newbieInfo->FAITHYEAR)
							echo "<option value='$id' selected=true>$name</option>";
						else
							echo "<option value='$id' >$name</option>";
				}?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td width = "24%" height = "29" align = "center">备注</td>
		<td width = "76%">
<textarea name = "DESCRIPT" type = "textarea" maxlength = "1000" rows="5"><?php echo $newbieInfo->DESCRIPT; ?></textarea>
		</td>
	</tr>
</table>
	<input type="hidden" name="writer" value="<?php echo $id ?>" />
	<input type="hidden" name="newbie" value="<?php echo $newbieInfo->ID ?>" />

<input type = "submit" value = "确定" name = "b4">
</form>
</body>
</center>
</html>

<?php	
	include("config.php");
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>修改</title>
<style type = "text/css">
body{

	background:#F5F5F5;
}
</style>
</head>

<body>
<?php 
$id = $_GET['id'];
$sql = "select * from $datatable where id ='$id'";
$selectdb = @mysql_query($sql,$conn);
$records = @mysql_fetch_object($selectdb);
?>

<form name = "form" method = "post" action = "st_change_ok.php">
    
	<table width = "75%" border = "0" cellpadding = "0" cellspacing = "2">
		<tr>
			<td width = "24%" height = "29">ID</td>
			<td width = "76%"><?php echo $id; ?><input name = "hc_id" type = "hidden"  value = "<?php echo $id; ?>"
			id = "hc_id" size = "20"></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">禾场 </td>
			<td width = "76%"><?php echo $records->code; ?></td>
		</tr>
		
		<tr>
			<td width = "24%" height = "29">牧区</td>
			<td width = "76%">
<select name="hc_mq" id="hc_mq" value = "<?php echo $records->MQ; ?>">
<?php
	foreach($mqs as $id=>$name) {
		if($id == $records->MQ)
			echo "<option value='$id' selected='selected'>$name</option>";
		else
			echo "<option value='$id'>$name</option>";
	}

?>
</select>
</td>
		</tr>
		
		<tr>
			<td width = "24%" height = "29">类型 </td>
			<td width = "76%">
<select name="hc_type" id="hc_type">
	<?php
		foreach($type2name as $type=>$name) {
			if($type==$records->type)
				echo "<option value=$type selected='selected'>$name</opton>";
			else
				echo "<option value=$type>$name</opton>";
		}
	?>
</select>
</td>
		</tr>
		
	    <tr>
			<td width = "24%" height = "29">地点 </td>
			<td width = "76%"><input name = "hc_locale" type = "text" maxlength = "40" value = "<?php echo $records->locale; ?>"
			id = "hc_locale" size = "20"></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">LOP到禾场时间(公里)</td>
			<td width = "76%"><input name = "hc_time" type = "text"  maxlength = "40"  value="<?php echo $records->time; ?>"></input></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">LOP到禾场距离(分钟)</td>
			<td width = "76%"><input name = "hc_distance" type = "text"  maxlength = "40" value="<?php echo $records->distance; ?>"></input></td>
		</tr>
	    <tr>
			<td width = "24%" height = "29">公交</td>
			<td width = "76%"><textarea name = "hc_traffic" type = "textarea"  maxlength = "1000" rows="5"><?php echo $records->traffic; ?></textarea></td>
		</tr>	
	    <tr>
			<td width = "24%" height = "29">禾场信息</td>
			<td width = "76%"><textarea name = "hc_info" type = "textarea" maxlength = "1000" rows="5"><?php echo $records->info; ?></textarea></td>
		</tr>	
	    <tr>
			<td width = "24%" height = "29">联系人</td>
			<td width = "76%"><textarea name = "hc_contacts" type = "textarea" maxlength = "1000" rows="5"><?php echo $records->contacts; ?></textarea></td>
		</tr>	

  <tr>
			<td width = "24%" height = "29">去LOP</td>
			<td width = "76%"><textarea name = "to_lop" type = "textarea" maxlength = "1000" rows="5"><?php echo $records->to_lop; ?></textarea></td>

		</tr>	

  <tr>
			<td width = "24%" height = "29">到这里</td>
			<td width = "76%"><textarea name = "to_hc" type = "textarea" maxlength = "1000" rows="5"><?php echo $records->to_hc; ?></textarea></td>

		</tr>	
  <tr>
			<td width = "24%" height = "29">从LOP出发到禾场</td>
			<td width = "76%"><textarea name = "lop_to_hc" type = "textarea" maxlength = "1000" rows="5"><?php echo $records->lop_to_hc; ?></textarea></td>

		</tr>		
		
		
		<tr>
		    <td height = "31">
			<input type = "submit" name = "Submit" value = "确认修改"></td>
			<td>&nbsp;</td>
		</tr>
		
	
		 
		<tr>
		    <td height = "31">
			<input type = "button" name = "back" value = "返回"
			onclick = "javacript:window.location.href='st_main.php'"></td>
			<td>&nbsp;</td>
		</tr>
		
	<table>
</form>
</body>
</html>

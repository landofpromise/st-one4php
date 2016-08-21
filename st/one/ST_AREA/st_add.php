<?php
	include("config.php");
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>add</title>
<style type = "text/css">
body{

	background:#FFF5EE;
}
</style>
</head>

<body>
<form name = "form" method = "post" action = "st_add_ok.php">
	<table width = "100%" border = "0" cellpadding = "0" cellspacing = "2" align = "center">
		<tr>
			<td width = "24%" height = "29" align = "center">类型</td>
			<td width = "76%">
<select name="hc_type" id="hc_type">
	<?php
		foreach($type2name as $type=>$name) {
echo "<option value=$type>$name</option>";
		}
	?>
</select></td>
		</tr>
		
		<tr>
			<td width = "24%" height = "29" align = "center">牧区 </td>
			<td width = "76%">
<select name="hc_mq" id="hc_mq">
<?php
	foreach($mqs as $id=>$name) {
		echo "<option value='$id'>$name</option>";
	}

?>
</select></td>
		</tr>
		
		<tr>
			<td width = "24%" height = "29" align = "center">地点</td>
			<td width = "76%"><input name = "hc_locale" type = "text" 
			id = "hc_locale" size = "40"></td>
		</tr>
		
	        <tr>
			<td width = "24%" height = "29" align = "center">公交 </td>
			<td width = "76%"><textarea name = "hc_traffic"
			id = "hc_traffic" size = "1000" rows="5" TextMode="multiline"></textarea></td>
		</tr>
 <tr>
			<td width = "24%" height = "29" align = "center">禾场情况</td>
			<td width = "76%"><textarea name = "hc_info"
			id = "hc_info" maxlength = "1000" rows="5"></textarea></td>
		</tr>
 		<tr>
			<td width = "24%" height = "29" align = "center">联系人</td>
			<td width = "76%"><textarea name = "hc_contacts"
			id = "hc_contacts" maxlength = "1000" rows="5"></textarea></td>
		</tr>

 		<tr>
			<td width = "24%" height = "29" align = "center">到禾场</td>
			<td width = "76%"><textarea name = "to_hc"
			id = "to_hc" maxlength = "1000" rows="5"></textarea></td>
		</tr>

 		<tr>
			<td width = "24%" height = "29" align = "center">到LOP</td>
			<td width = "76%"><textarea name = "to_lop"
			id = "to_lop" maxlength = "1000" rows="5"></textarea></td>
		</tr>

 		<tr>
			<td width = "24%" height = "29" align = "center">从LOP到禾场</td>
			<td width = "76%"><textarea name = "lop_to_hc"
			id = "lop_to_hc" maxlength = "1000" rows="5"></textarea></td>
		</tr>
		
		<tr>
		    <td height = "31">
			<input type = "submit" name = "Submit" value = "提交"></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
		    <td height = "31">
			<input type = "button" name = "back" value = "返回"
			onclick = "javascript:window.location.href='st_main.php'"></td>
			<td>&nbsp;</td>
		</tr>
		
	</table>
</form>
</body>
</html>

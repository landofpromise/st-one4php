<?php
include("config.php");
?>

<html>
<meta charset="<?php echo $charset; ?>">
<style type = "text/css">
body{

	background:#F5F5F5;
}
</style>
<body>
<?php

$hc_type = $_POST['hc_type'];
$hc_mq = strtoupper($_POST['hc_mq']);
$hc_locale = $_POST['hc_locale'];
$hc_traffic = $_POST['hc_traffic'];
$hc_contacts = $_POST['hc_contacts'];
$hc_info = $_POST['hc_info'];
$hc_code = $hc_mq."-".$hc_locale;
$id = $_POST['hc_id'];
$to_hc = $_POST['to_hc'];
$to_lop = $_POST['to_lop'];
$lop_to_hc = $_POST['lop_to_hc'];
$hc_distance = $_POST['hc_distance'];
$hc_time = $_POST['hc_time'];

$sqll = "update $datatable set traffic='$hc_traffic',contacts='$hc_contacts',MQ='$hc_mq',type=$hc_type,locale ='$hc_locale',info='$hc_info',code ='$hc_code',to_hc='$to_hc',to_lop='$to_lop',lop_to_hc='$lop_to_hc',time='$hc_time',distance='$hc_distance' where id=$id";
mysql_query($sqll) OR die("<br/>ERROR: <b>".mysql_error()."</b><br/>SQL:".$sqll);
mysql_close($conn);

echo'修改成功！！！';
?>
<form>
    <table>
		<tr>
		    <td height = "31">
			<input type = "button" name = "back" value = "返回"
			onclick = "javascript:window.location.href='st_main.php'"></td>
			<td>&nbsp;</td>
		</tr>
		
	<table>
</form>
</body>
</html>

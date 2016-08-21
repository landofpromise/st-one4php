<?php
include("config.php");
?>
<html>
<meta charset="<?php echo $charset; ?>">
<style type = "text/css">
body{

	background:#FFF5EE;
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
$to_hc = $_POST['to_hc'];
$to_lop = $_POST['to_lop'];
$lop_to_hc = $_POST['lop_to_hc'];


$sqll = "insert into $datatable(code,mq,type,locale,traffic,contacts,info,to_hc,to_lop,lop_to_hc) values('$hc_code','$hc_mq','$hc_type','$hc_locale','$hc_traffic','$hc_contacts','$hc_info','$to_hc','$to_lop','$lop_to_hc');";

mysql_query($sqll) OR die("<br/>ERROR: <b>".mysql_error()."</b><br/>SQL:".$sqll);
mysql_close($conn);

echo'数据库插入成功！！';		
?>
<form>
        <table>

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

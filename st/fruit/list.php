<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
//include("connect/config.php");
include("../one/connect/config.php");
include("check.php");
//include("connect/config.php");
?>
<body style="font-family: sans-serif;">
<?php
	$week = date("w");
	$dzz_id=$_SESSION["TOKEN"];

	$data_sql = "SELECT u.name as zy, d.yd_number as yd, d.wz_number as wz, d.js_number as js, d.zd_number as zd, d.day_num num". 
		" FROM st2016 u, st2016_data d where d.zy_id=u.id and d.zz_id=$dzz_id order by day_num"; 
	$rs=mysql_query($data_sql);
	
	$data_total_sql = "select u.name as zz, d.dtzg_number as dtzg from st2016 u,".
		"st2016_data d where d.zz_id=u.id and u.id=$dzz_id order by d.submit_date desc limit 1;";
	$total_rs=mysql_query($data_total_sql);
	
	$sum_sql = "select sum(yd_number) yd, sum(wz_number) wz, sum(js_number) js, sum(zd_number) zd".
			" from st2016_data where zz_id=$dzz_id"; 
	
	$sum_rs=mysql_query($sum_sql);
?>
<?php
	while($total=mysql_fetch_assoc($total_rs)){
?>
	<div>ZZ:<?php echo $total["zz"]?></div>
<?php
	}
?>
<table border="1px" style="position:absolute;top:50px;border-style: none;
	border-collapse:collapse; margin:auto;text-align:left;font-size:1em">
  <tr>
	<td bgcolor="#E0E0E0">
		  第几天
	   </td>
	<td bgcolor="#E0E0E0">
		 ZY
	   </td>
		<td bgcolor="#E0E0E0">
		 HC
	   </td>
		<td bgcolor="#E0E0E0">
		  YD
	   </td>
		<td bgcolor="#E0E0E0">
		 WZ
	   </td>
		<td bgcolor="#E0E0E0">
		  JS
	   </td>
		<td bgcolor="#E0E0E0">
		  ZD
	   </td>
	  
  </tr>
<?php
	while($myrow=mysql_fetch_assoc($rs)){
?>
　　<tr>
	  <td><?php echo $myrow["num"]?></td>
　　　<td><?php echo $myrow["zy"]?></td>
　　　<td><?php echo $myrow["area"]?></td>
　　　<td><?php echo $myrow["yd"]?></td>
　　　<td><?php echo $myrow["wz"]?></td>
　　　<td><?php echo $myrow["js"]?></td>
　　　<td><?php echo $myrow["zd"]?></td>
	  
　　</tr>
<?php
}
?>
<tr style="font-family: sans-serif; color:#19A2FA">
　　　<td>总计</td>
　　　<td></td>
<?php
	if($sum=mysql_fetch_assoc($sum_rs)){
?>
	<td></td>
	<td><?php echo $sum["yd"]?></td>
　　<td><?php echo $sum["wz"]?></td>
　　<td><?php echo $sum["js"]?></td>
　　<td><?php echo $sum["zd"]?></td>
<?php
	}
?>
　　</tr>
</table>
</body>
</html>
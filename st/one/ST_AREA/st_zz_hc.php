
<?php
include("config.php");
// $mq = $_POST['hc_mq'];
$day = $_GET['day'];
if(!$day) {
	$day = $_POST['day'];
}
// $hctype = $_POST['hc_type'];


$leadersql = "select * from $leadertable where is_dzz = 1 order by sex asc, name asc";

// $sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable";
// if($mq && $hctype) {
// 	$sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable where mq = '$mq' and type = $hctype" ; 	
// } elseif ($mq) {
// 	$sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable where mq = '$mq'" ; 	
// 	# code...
// } elseif($hctype) {
// 	$sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable where type = $hctype" ; 	
// }	
$leaderresult = mysql_query($leadersql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$leadersql);
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>DZZ禾场管理</title>
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
<h1 align = "center" >
<?php
		if($day) {
			?>
	   		第<?php echo $day; ?>天
	    <?php
	    }
		?>
ST-DZZ-禾场管理
</h1>

<!-- <form method = "post" action = "st_main.php">
	<input type="hidden" name="day" value="<?php echo $day ?>" />
	<p align = "center">
		<b>牧区：</b>
		<select name="hc_mq" id="hc_mq" value = "<?php echo $mq ?>">
		<?php
			foreach($mqs as $id=>$name) {
				if($id == $mq)
					echo "<option value='$id' selected='selected'>$name</option>";
				else
					echo "<option value='$id'>$name</option>";
			}
		?>
		</select>
		<b> &nbsp;禾场类型：</b>
		<select name="hc_type" id="hc_type" value="<?php echo $hctype ?>">
			<?php
				foreach($type2name as $type=>$name) {
					if($type==$hctype )
						echo "<option value=$type selected='selected'>$name</opton>";
					else
						echo "<option value=$type>$name</opton>";
				}
			?>
		</select>
		<input type = "submit" value = "查询" name = "b4">
	</p>
</form> -->

<div width = "100%" >
<input type = "button"  name = add onclick = "javascript:window.location.href = 'tongji_main.php'" ; value = "统计首页" >
<input type = "button"  name = add onclick = "javascript:window.location.href = 'st_add.php'" ; value = "添加禾场" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_zz_hc.php?day=1'" ; value = "查看DAY1分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_zz_hc.php?day=2'" ; value = "查看DAY2分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_zz_hc.php?day=3'" ; value = "查看DAY3分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_zz_hc.php?day=4'" ; value = "查看DAY4分组" >
</div>


<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84" style="font-size:20;">
   <tr bgcolor = "8bbcc7">
       <td height = "33"><div align = "center"><strong>ID</strong></div></td>
	   <td><div align = "center"><strong>DZZ名称</strong></div></td>
	   <td><div align = "center"><strong>mq</strong></div></td>
	   <td><div align = "center"><strong>预禾场</strong></div></td>
	   <td><div align = "center"><strong>实际禾场</strong></div></td>
	   <td><div align = "center"><strong>报名组员</strong></div></td>
	    <td><div align = "center"><strong>实际组员</strong></div></td>
	   <td><div align = "center"><strong>路程(公里)</strong></div></td>
	   <td><div align = "center"><strong>时间(分钟)</strong></div></td>
	</tr>

<?php	
	
if($num = mysql_num_rows($leaderresult)){

while($row = mysql_fetch_array($leaderresult,MYSQL_ASSOC)){
?>
	<tr bgcolor = "#ffffff">
	 <td height = "100" align = "right"><?php echo $row['id']; ?>&nbsp;</td> 	
	 <td height = "100" >	   
	    &nbsp;&nbsp;<?php echo 
	   		 "<a href='st_info.php?dzz_id=".$row['id']."&day=$day' target='_blank'>".$row['name']."-".$row['phone']."</a>";	 ?>
	   &nbsp;
	  </td>
	   <td><div align = "center"><strong> <?php echo $row['muqu']; ?>&nbsp;</strong></div></td>
	   		<td><div align = "center"><strong> 
	   		<?php
			$rangesql = "select a.hc_id,a.dzz_id,b.code,b.distance,b.time from (select * from $fieldarrangetable where day=$day) as a LEFT JOIN $datatable as b ON a.hc_id = b.id  where dzz_id =".$row['id']."";	
			$rangeresult = mysql_query($rangesql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$rangesql);
			$totaldistance = 0.0;
			$totaltime = 0.0;
			if($rangenum = mysql_num_rows($rangeresult)){
			while($rangerow = mysql_fetch_array($rangeresult,MYSQL_ASSOC)){
				$totaldistance = $totaldistance + $rangerow['distance'];
				$totaltime = $totaltime + $rangerow['time'];
			?>
	   		<p>
	   		 &nbsp;<?php if($day) echo "<a href='st_team_hc.php?day=$day&hc_id=".$rangerow['hc_id']."' target='_blank'>".$rangerow['code']."</a>";
	                else echo  $row['rangerow'];?> 			
	   		
	   		</p>
	    <?php
	
		}
		}
		?>
	   </strong></div>
	   		<div align = "center"><strong>&nbsp;总计<?php echo $rangenum; ?>&nbsp;</strong></div>
	   </td>
	   <td><div align = "center"><strong> 
	   		<?php
			$realrangesql = "select a.area_id,b.code from (select * from $stdatatable where day_num=$day) as a LEFT JOIN $datatable as b ON a.area_id = b.id  where zz_id =".$row['id']."";	
			$realrangeresult = mysql_query($realrangesql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$realrangesql);
			
			if($realrangenum = mysql_num_rows($realrangeresult)){
			while($realrangerow = mysql_fetch_array($realrangeresult,MYSQL_ASSOC)){
			?>
	   		<p>
	   		 &nbsp;<?php if($day) echo "<a href='st_team_hc.php?day=$day&hc_id=".$realrangerow['hc_id']."' target='_blank'>".$realrangerow['code']."</a>";
	                else echo  $realrangerow['code'];?> 			
	   		
	   		</p>
	    <?php
	
		}
		}
		?>
	   </strong></div>

	     <div align = "center"><strong>&nbsp;总计<?php echo $realrangenum; ?>&nbsp;</strong></div>
	   </td>

	   
	   <td><div align = "center"><strong>
	   <?php
		
			$zysql = "select * from $leadertable where  dzz_id =".$row['id']." and come = 1 and day$day = 1";	
			$zyresult = mysql_query($zysql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$zysql);
			
			if($zynum = mysql_num_rows($zyresult)){
			while($zyrow = mysql_fetch_array($zyresult,MYSQL_ASSOC)){	
			?>
	   		<p>
	   		 &nbsp;<?php echo "<a href='http://www.landofpromise.co/st/index.php?current_id=".$zyrow['id']."' target='_blank'>".$zyrow['name']."-".$zyrow['phone']."</a>";
	                ?> 			
	   		
	   		</p>
	    <?php
		}
		}
		?>
	   </strong></div>
	   	<div align = "center"><strong>
	   		 总计<?php echo $zynum;?>
	   	</strong></div>
	   </td>

	     <td><div align = "center"><strong>
	   <?php
		
			$realzysql = "select a.zy_id, b.name, b.phone from (select * from $stdatatable where  zz_id =".$row['id']."  and day_num = $day) as a left join $leadertable as b on a.zy_id = b.id";	
			$realzyresult = mysql_query($realzysql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$realzysql);
			
			if($realzynum = mysql_num_rows($realzyresult)){
			while($realzyrow = mysql_fetch_array($realzyresult,MYSQL_ASSOC)){	
			?>
	   		<p>
	   		 &nbsp;<?php  echo "<a href='http://www.landofpromise.co/st/index.php?current_id=".$realzyrow['id']."' target='_blank'>".$realzyrow['name']."-".$realzyrow['phone']."</a>";
	               ?> 				   		
	   		</p>
	    <?php
		}
		}
		?>
	   </strong></div>
	   	<div align = "center"><strong>
	   		总计<?php echo $realzynum;?>
	   	</strong></div>
	   </td>


	 
	   <td height = "100" >&nbsp;<?php echo $totaldistance; ?>&nbsp;</td>
	    <td height = "100" >&nbsp;<?php echo $totaltime; ?>&nbsp;</td>
	</tr>
<?php
}
}
mysql_close($conn);
?>

</table>
</body>
</center>
</html>

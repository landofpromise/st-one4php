
<?php
include("config.php");
$mq = $_POST['hc_mq'];
$day = $_GET['day'];
if(!$day) {
	$day = $_POST['day'];
}
$hctype = $_POST['hc_type'];

$sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable";
if($mq && $hctype) {
	$sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable where mq = '$mq' and type = $hctype" ; 	
} elseif ($mq) {
	$sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable where mq = '$mq'" ; 	
	# code...
} elseif($hctype) {
	$sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc,distance,time from $datatable where type = $hctype" ; 	
}	
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>禾场管理</title>
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
ST禾场管理系统
</h1>

<form method = "post" action = "st_main.php">
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
</form>

<div width = "100%" >
<input type = "button"  name = add onclick = "javascript:window.location.href = 'tongji_main.php'" ; value = "统计首页" >
<input type = "button"  name = add onclick = "javascript:window.location.href = 'st_add.php'" ; value = "添加禾场" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_main.php?day=1'" ; value = "查看DAY1分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_main.php?day=2'" ; value = "查看DAY2分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_main.php?day=3'" ; value = "查看DAY3分组" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_main.php?day=4'" ; value = "查看DAY4分组" >
</div>


<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84" style="font-size:20;">
   <tr bgcolor = "8bbcc7">
       <td height = "33"><div align = "center"><strong>ID</strong></div></td>
	   <td><div align = "center"><strong>禾场</strong></div></td>
	 <!--  <td><div align = "center"><strong>牧区</strong></div></td>
	   <td><div align = "center"><strong>类型</strong></div></td>
	   <td><div align = "center"><strong>地点</strong></div></td>
	 <  <td><div align = "center"><strong>公交</strong></div></td> 
	   <td><div align = "center"><strong>信息</strong></div></td>
	   <td><div align = "center"><strong>联系人</strong></div></td>-->
	  <?php
		if($day) {
			?>
	   <td><div align = "center"><strong>参与队伍</strong></div></td>
	   <td><div align = "center"><strong>队伍数</strong></div></td>
	    <?php
	    }
		?>

	   <td><div align = "center"><strong>公交线路</strong></div></td>
	   <!-- <td><div align = "center"><strong>路程(公里)</strong></div></td>
	   <td><div align = "center"><strong>时间(分钟)</strong></div></td> -->
	   <td><div align = "center"><strong>反馈</strong></div></td>
	   <td><div align = "center"><strong>操作</strong></div></td>
	  <!-- <td><div align = "center"><strong>操作</strong></div></td>-->
	</tr>

<?php	
	
if($num = mysql_num_rows($result)){

while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
?>
	<tr bgcolor = "#ffffff">
	 <td height = "100" align = "right"><?php echo $row['id']; ?>&nbsp;</td> 
	   <td height = "100" >	   
	    &nbsp;<?php if($day) echo "<a href='st_team_hc.php?day=$day&hc_id=".$row['id']."' target='_blank'>".$row['code']."</a>";
	                else echo  $row['code'];?>
	   &nbsp;
	   </td>

		<?php
		if($day) {
			?>
	   		<td><div align = "center"><strong> 
	   		<?php
		if($day) {
			$hc_id = $row['id'];
			$rangesql = "select a.hc_id,a.dzz_id,b.name,b.phone from (select * from $fieldarrangetable where day=$day) as a LEFT JOIN $leadertable as b ON a.dzz_id = b.id  where hc_id =".$row['id']."";	
			$rangeresult = mysql_query($rangesql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
			 
			if($rangenum = mysql_num_rows($rangeresult)){
			while($rangerow = mysql_fetch_array($rangeresult,MYSQL_ASSOC)){
			?>
	   		<p>
	   		&nbsp;<?php echo 
	   		 "<a href='st_info.php?dzz_id=".$rangerow['dzz_id']."&day=$day' target='_blank'>".$rangerow['name']."-".$rangerow['phone']."</a>";	   			
	   		?>
	   		</p>
	    <?php
	    }
		}
		}
		?>

	   </strong></div></td>
	   <td><div align = "center"><strong>&nbsp;<?php echo $rangenum; ?>&nbsp;</strong></div></td>
	    <?php
	    }
		?>


	   <td height = "100" >
		<p/>
	   &nbsp;<?php if($row['to_hc']) echo "<a href='".$row['to_hc']."' target='_blank'>当前位置到禾场(需要安装百度地图)</a>"; ?>&nbsp;
	   <p/>
	   &nbsp;<?php if($row['to_lop']) echo "<a href='".$row['to_lop']."' target='_blank'>当前位置回LOP(需要安装百度地图)</a>"; ?>&nbsp;
	   <p/>
	   &nbsp;<?php if($row['lop_to_hc']) echo "<a href='".$row['lop_to_hc']."' target='_blank'>LOP到禾场</a>"; ?>&nbsp;
 		<p/>
	   </td>

	   <td height = "100" width="20%">
	   		&nbsp;<?php 
	   		
	   			$feedbacksql = "select a.hc_id,a.tips,a.day,b.name from (select * from $reporttable where hc_id = ".$row['id'].") as a left join $leadertable as b on a.dzz_id = b.id ";
				$feedbackresult = mysql_query($feedbacksql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$feedbacksql);
				
				if($feedbacknum = mysql_num_rows($feedbackresult)){
					while($feedbackrow = mysql_fetch_array($feedbackresult,MYSQL_ASSOC)){
					
			   		
			   		 	echo "<p>D".$feedbackrow['day']."-".$feedbackrow['name'].":".$feedbackrow['tips']."</p>";
			   		}
		   		}


	   		?>&nbsp;
	   	</td>

	  <!--  <td height = "100" >&nbsp;<?php echo $row['distance']; ?>&nbsp;</td>
	    <td height = "100" >&nbsp;<?php echo $row['time']; ?>&nbsp;</td> -->
	   <td height="22">
	   		&nbsp;<a onclick="javascript:if(confirm('确定要删除用户信息吗?')) return true; else return false;" href="st_delete.php?id=<?php echo $row['id']; ?>">删除</a>
			&nbsp;<a onclick="javascript:if(confirm('确定要修改用户信息吗?')) return true; else return false;" href="st_change.php?id=<?php echo $row['id']; ?>">修改</a>&nbsp;
	   </td> 
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

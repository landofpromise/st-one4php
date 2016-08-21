
<?php
include("config.php");

$day = $_GET['day'];
$todaysql = "select count(zy_id) as zy_count,sum(yd_number) as total_yd,sum(wz_number) as total_wz,sum(js_number) as total_js,sum(zd_number) as total_zd from $stdatatable where day_num=$day";
$todayresult = mysql_query($todaysql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
$todayrecords = @mysql_fetch_object($todayresult);

$day1sql = "select count(zy_id) as zy_count,sum(yd_number) as total_yd,sum(wz_number) as total_wz,sum(js_number) as total_js,sum(zd_number) as total_zd from $stdatatable where day_num=1";
$day1result = mysql_query($day1sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$day1sql);
$day1records = @mysql_fetch_object($day1result);

$day2sql = "select count(zy_id) as zy_count,sum(yd_number) as total_yd,sum(wz_number) as total_wz,sum(js_number) as total_js,sum(zd_number) as total_zd from $stdatatable where day_num=2";
$day2result = mysql_query($day2sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$day2sql);
$day2records = @mysql_fetch_object($day2result);

$day3sql = "select count(zy_id) as zy_count,sum(yd_number) as total_yd,sum(wz_number) as total_wz,sum(js_number) as total_js,sum(zd_number) as total_zd from $stdatatable where day_num=3";
$day3result = mysql_query($day3sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$day3sql);
$day3records = @mysql_fetch_object($day3result);

$day4sql = "select count(zy_id) as zy_count,sum(yd_number) as total_yd,sum(wz_number) as total_wz,sum(js_number) as total_js,sum(zd_number) as total_zd from $stdatatable where day_num=4";
$day4result = mysql_query($day4sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$day4sql);
$day4records = @mysql_fetch_object($day4result);


$totaldzzsql = "select count(*) as total_dzz from $leadertable where is_dzz=1";
$totaldzzresult = mysql_query($totaldzzsql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$totaldzzsql);
$totaldzzrecords = @mysql_fetch_object($totaldzzresult);

$dzzsql = "select count(*) as real_dzz from (select count(*) as dzz_count, dtzg_number from $stdatatable where day_num=$day  group by zz_id ) as b WHERE b.dzz_count = b.dtzg_number;";
$dzzresult = mysql_query($dzzsql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$dzzsql);
$dzzrecords = @mysql_fetch_object($dzzresult);

$zysql = "select count(*) as real_zy from $stdatatable where day_num=$day";
$zyresult = mysql_query($zysql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$zysql);
$zyrecords = @mysql_fetch_object($zyresult);


$totalzysql = "select count(*) as total_zy from $leadertable where day$day=1 and come =1";
$totalzyresult = mysql_query($totalzysql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$totalzysql);
$totalzyrecords = @mysql_fetch_object($totalzyresult);


$undonesql = "select a.id,a.name,a.sex,a.phone, b.zy_count,dtzg_number from ((select * from $leadertable where is_dzz=1 ) as a LEFT join 
(select zz_id,count(zy_id) as zy_count,dtzg_number from $stdatatable where day_num = $day group by zz_id ) as b on a.id = b.zz_id)  
where (zy_count is null or zy_count != dtzg_number) ORDER BY zy_count ASC";
$undoneresult = mysql_query($undonesql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$undonesql);

?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>数据分析</title>
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

<input type = "button"  name = add onclick = "javascript:window.location.href = 'tongji_main.php'" ; value = "统计首页" >
<h1 align = "center" >当前数据统计区</h1>

	<h2 align = "center" >D<?php echo $day; ?>数据汇总</h2>
	<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2">
		<tr>
			<td width = "24%" height = "29">接触人数 </td>
			<td width = "76%"><?php echo $todayrecords->total_yd; ?></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">分享人数 </td>
			<td width = "76%"><?php echo $todayrecords->total_wz; ?></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">接受人数 </td>
			<td width = "76%"><?php echo $todayrecords->total_js; ?></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">找到人数 </td>
			<td width = "76%"><?php echo $todayrecords->total_zd; ?></td>
		</tr>	
	<table>
	<h2 align = "center" >D<?php echo $day; ?>未完成统计大组</h2>
	<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2">
	 <tr bgcolor = "8bbcc7">
       <td><div align = "center"><strong>组长姓名</strong></div></td>
	   <td><div align = "center"><strong>性别(1男0女)</strong></div></td>
	   <td><div align = "center"><strong>联系方式</strong></div></td>
	   <td><div align = "center"><strong>上传组员数</strong></div></td>
	   <td><div align = "center"><strong>总组员数</strong></div></td>
	  <!-- <td><div align = "center"><strong>操作</strong></div></td>-->
	</tr>
	<?php	
	
if($num = mysql_num_rows($undoneresult)){

while($row = mysql_fetch_array($undoneresult,MYSQL_ASSOC)){
?>
	<tr >
	 	<td><div align = "center"><?php echo $row['name']; ?></div></td>
	 	<td><div align = "center">
	 		<?php echo $row['sex']; ?>
	    </div></td>
	    <td><div align = "center"><?php echo $row['phone']; ?></div></td>
	    <td><div align = "center"><?php echo $row['zy_count']; ?></div></td>
	    <td><div align = "center"><?php echo $row['dtzg_number']; ?></div></td>
	</tr>
<?php
}
}
?>
	<table>
	<h2 align = "center" >D<?php echo $day; ?>大组完成统计</h2>
	<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2">
		<tr>
			<td width = "24%" height = "29">完成大组数 </td>
			<td width = "76%"><?php echo $dzzrecords->real_dzz; ?></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">大组总数 </td>
			<td width = "76%"><?php echo $totaldzzrecords->total_dzz; ?></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">大组完成率 </td>
			<td width = "76%"><?php echo $dzzrecords->real_dzz / $totaldzzrecords->total_dzz; ?></td>
		</tr>

		
	<table>
	<h2 align = "center" >D<?php echo $day; ?>组员完成统计</h2>
	<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2">
		<tr>
			<td width = "24%" height = "29">完成组员数 </td>
			<td width = "76%"><?php echo $zyrecords->real_zy; ?></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">组员总数 </td>
			<td width = "76%"><?php echo $totalzyrecords->total_zy; ?></td>
		</tr>
		<tr>
			<td width = "24%" height = "29">组员完成率 </td>
			<td width = "76%"><?php echo $zyrecords->real_zy / $totalzyrecords->total_zy; ?></td>
		</tr>
		
	<table>



	<h1 align = "center" >今年数据常规分析区</h1>
	<h2 align = "center" >D1-D4每天汇总</h2>

<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2" >
<thead bgcolor = "8bbcc7">
	<th >
	   <td width = "15%"><div align = "center"><strong>D1</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>D2</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>D3</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>D4</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>汇总</strong></div></td>
	</th>
</thead>
<tbody>
		<tr>
			<td  >接触人数 </td>
			<td ><?php echo $day1records->total_yd; ?></td>
			<td ><?php echo $day2records->total_yd; ?></td>
			<td ><?php echo $day3records->total_yd; ?></td>
			<td ><?php echo $day4records->total_yd; ?></td>
			<td ><?php echo $day1records->total_yd + $day2records->total_yd + $day3records->total_yd + $day4records->total_yd  ; ?></td>
		</tr>
		<tr>
			<td >分享人数 </td>
			<td ><?php echo $day1records->total_wz; ?></td>
			<td ><?php echo $day2records->total_wz; ?></td>
			<td ><?php echo $day3records->total_wz; ?></td>
			<td ><?php echo $day4records->total_wz; ?></td>
			<td ><?php echo $day1records->total_wz + $day2records->total_wz + $day3records->total_wz + $day4records->total_wz  ; ?></td>
		
		</tr>
		<tr>
			<td >接受人数 </td>
			<td ><?php echo $day1records->total_js; ?></td>
			<td ><?php echo $day2records->total_js; ?></td>
			<td ><?php echo $day3records->total_js; ?></td>
			<td ><?php echo $day4records->total_js; ?></td>
			<td ><?php echo $day1records->total_js + $day2records->total_js + $day3records->total_js + $day4records->total_js  ; ?></td>
		</tr>
		<tr>
			<td >找到人数 </td>
			<td ><?php echo $day1records->total_zd; ?></td>
			<td ><?php echo $day2records->total_zd; ?></td>
			<td ><?php echo $day3records->total_zd; ?></td>
			<td ><?php echo $day4records->total_zd; ?></td>
			<td ><?php echo $day1records->total_zd + $day2records->total_zd + $day3records->total_zd + $day4records->total_zd  ; ?></td>
		</tr>
		<tr>
			<td >参与人数 </td>
			<td ><?php echo $day1records->zy_count; ?></td>
			<td ><?php echo $day2records->zy_count; ?></td>
			<td ><?php echo $day3records->zy_count; ?></td>
			<td ><?php echo $day4records->zy_count; ?></td>
			<td ><?php echo $day1records->zy_count + $day2records->zy_count + $day3records->zy_count + $day4records->zy_count  ; ?></td>
		</tr>
		<tr>
			<td  >人均接触 </td>
			<td ><?php echo $day1records->total_yd / $day1records->zy_count; ?></td>
			<td ><?php echo $day2records->total_yd / $day2records->zy_count; ?></td>
			<td ><?php echo $day3records->total_yd / $day3records->zy_count; ?></td>
			<td ><?php echo $day4records->total_yd / $day4records->zy_count; ?></td>
			<td ><?php echo ($day1records->total_yd + $day2records->total_yd + $day3records->total_yd + $day4records->total_yd )/ ($day1records->zy_count + $day2records->zy_count + $day3records->zy_count + $day4records->zy_count ); ?></td>
		</tr>
		<tr>
			<td >人均分享 </td>
			<td ><?php echo $day1records->total_wz / $day1records->zy_count; ?></td>
			<td ><?php echo $day2records->total_wz / $day2records->zy_count; ?></td>
			<td ><?php echo $day3records->total_wz / $day3records->zy_count; ?></td>
			<td ><?php echo $day4records->total_wz/ $day4records->zy_count; ?></td>
			<td ><?php echo ($day1records->total_wz + $day2records->total_wz + $day3records->total_wz + $day4records->total_wz) /  ($day1records->zy_count + $day2records->zy_count + $day3records->zy_count + $day4records->zy_count ); ?></td>
		</tr>
		<tr>
			<td >人均接受 </td>
			<td ><?php echo $day1records->total_js/ $day1records->zy_count; ?></td>
			<td ><?php echo $day2records->total_js/ $day2records->zy_count;?></td>
			<td ><?php echo $day3records->total_js/ $day3records->zy_count;?></td>
			<td ><?php echo $day4records->total_js/ $day4records->zy_count;?></td>
			<td ><?php echo ($day1records->total_js + $day2records->total_js + $day3records->total_js + $day4records->total_js ) /  ($day1records->zy_count + $day2records->zy_count + $day3records->zy_count + $day4records->zy_count ); ?></td>
		</tr>
		<tr>
			<td >人均找到 </td>
			<td ><?php echo $day1records->total_zd/ $day1records->zy_count; ?></td>
			<td ><?php echo $day2records->total_zd/ $day2records->zy_count;?></td>
			<td ><?php echo $day3records->total_zd/ $day3records->zy_count;?></td>
			<td ><?php echo $day4records->total_zd/ $day4records->zy_count;?></td>
			<td ><?php echo ($day1records->total_zd + $day2records->total_zd + $day3records->total_zd + $day4records->total_zd ) /  ($day1records->zy_count + $day2records->zy_count + $day3records->zy_count + $day4records->zy_count ); ?></td>
		</tr>
		<tr>
			<td >分享/接触 </td>
			<td ><?php echo $day1records->total_wz / $day1records->total_yd; ?></td>
			<td ><?php echo $day2records->total_wz / $day2records->total_yd; ?></td>
			<td ><?php echo $day3records->total_wz / $day3records->total_yd; ?></td>
			<td ><?php echo $day4records->total_wz/ $day4records->total_yd; ?></td>
			<td ><?php echo (($day1records->total_wz + $day2records->total_wz + $day3records->total_wz + $day4records->total_wz) )/ ($day1records->total_yd + $day2records->total_yd + $day3records->total_yd + $day4records->total_yd ); ?></td>

		</tr>
		<tr>
			<td >接受/接触 </td>
			<td ><?php echo $day1records->total_js/ $day1records->total_yd; ?></td>
			<td ><?php echo $day2records->total_js/ $day2records->total_yd;?></td>
			<td ><?php echo $day3records->total_js/ $day3records->total_yd;?></td>
			<td ><?php echo $day4records->total_js/ $day4records->total_yd;?></td>
			<td ><?php echo ($day1records->total_js + $day2records->total_js + $day3records->total_js + $day4records->total_js)/ ($day1records->total_yd + $day2records->total_yd + $day3records->total_yd + $day4records->total_yd );?></td>
			
		</tr>
		<tr>
			<td >找到/接触 </td>
			<td ><?php echo $day1records->total_zd/ $day1records->total_yd; ?></td>
			<td ><?php echo $day2records->total_zd/ $day2records->total_yd;?></td>
			<td ><?php echo $day3records->total_zd/ $day3records->total_yd;?></td>
			<td ><?php echo $day4records->total_zd/ $day4records->total_yd;?></td>
			<td ><?php echo ($day1records->total_zd + $day2records->total_zd + $day3records->total_zd + $day4records->total_zd )/($day1records->total_yd + $day2records->total_yd + $day3records->total_yd + $day4records->total_yd );?></td>
			
		</tr>
		</tbody>
		
	<table>




</body>
</center>
</html>

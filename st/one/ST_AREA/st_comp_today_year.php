<?php
include("config.php");
///////////////////////////////今年总计
$totalsql = "select count(yd_number) as cnt, sum(yd_number) as total_yd, sum(wz_number)/sum(yd_number) as rate_wz, sum(wz_number) as total_wz,sum(js_number) as total_js,sum(js_number)/sum(yd_number) as rate_js,sum(zd_number) as total_zd,sum(zd_number)/sum(yd_number) as rate_zd,sum(yd_number)/count(yd_number) as avg_yd, sum(wz_number)/count(yd_number) as avg_wz, sum(js_number)/count(yd_number) as avg_js,sum(zd_number)/count(yd_number) as avg_zd from $stdatatable;";
$totalresult = mysql_query($totalsql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$totalsql);
$totalrecords = @mysql_fetch_array($totalresult);
///////////////////////////////今年单天统计
$daysql = "select day_num as day, count(yd_number) as cnt, sum(yd_number) as total_yd, sum(wz_number)/sum(yd_number) as rate_wz, sum(wz_number) as total_wz,sum(js_number) as total_js,sum(js_number)/sum(yd_number) as rate_js,sum(zd_number) as total_zd,sum(zd_number)/sum(yd_number) as rate_zd,sum(yd_number)/count(yd_number) as avg_yd, sum(wz_number)/count(yd_number) as avg_wz, sum(js_number)/count(yd_number) as avg_js,sum(zd_number)/count(yd_number) as avg_zd from $stdatatable group by day_num;";
$dayresult = mysql_query($daysql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$daysql);
$num = @mysql_num_rows($dayresult);
$dayrecords = array();
for($i=0;$i<$num;$i++) {
	$records = @mysql_fetch_array($dayresult,MYSQL_ASSOC);
	$dayrecords[$records['day']] = $records;
}
///////////////////////////////历史总数数据
$historytotalsql = "select year, sum(yd) as total_yd, sum(wz) as total_wz, sum(js) as total_js, sum(zd) as total_zd, sum(attendance) as cnt, sum(wz)/sum(yd) as rate_wz, sum(js)/sum(yd) as rate_js, sum(zd)/sum(yd) as rate_zd, sum(yd)/sum(attendance) as avg_yd, sum(wz)/sum(attendance) as avg_wz, sum(js)/sum(attendance) as avg_js, sum(zd)/sum(attendance) as avg_zd from $historytable group by year;";
$historytotalresult = mysql_query($historytotalsql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$historytotalsql);
$num = @mysql_num_rows($historytotalresult);
$historytotalrecords = array();
for($i=0;$i<$num;$i++){
	$records = @mysql_fetch_array($historytotalresult,MYSQL_ASSOC);
	$historytotalrecords[$records['year']] = $records;
}
//print_r($historytotalrecords);
///////////////////////////////历史单天数据
$historysql = "select day_num as day, year, yd as total_yd, wz as total_wz, js as total_js, zd as total_zd, attendance as cnt, wz/yd as rate_wz, js/yd as rate_js, zd/yd as rate_zd, yd/attendance as avg_yd, wz/attendance as avg_wz, js/attendance as avg_js, zd/attendance as avg_zd from $historytable;";
$historyresult = mysql_query($historysql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$historysql);
$num = @mysql_num_rows($historyresult);
$historyrecords = array();
for($i=0;$i<$num;$i++){
	$records = @mysql_fetch_array($historyresult,MYSQL_ASSOC);
	if($historyrecords[$records['year']] == NULL)
		$historyrecords[$records['year']] = array();
	$historyrecords[$records['year']][$records['day']] = $records;
}
//print_r($historyrecords);
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
	<h1 align = "center" >历年数据对比分析区</h1>
	<h2 align = "center" >历年D1-D4每天分享、接受、找到/接触汇总</h2>

<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2" >
<thead bgcolor = "8bbcc7">
	<th >
	   <td width = "15%"><div align = "center"><strong>D1</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>D2</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>D3</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>D4</strong></div></td>
	   <td width = "15%"><div align = "center"><strong>总数</strong></div></td>
	</th>
</thead>
<tbody>
		<tr>
			<td ><?php echo $current_year;?>年分享/接触 </td>
			<td ><?php echo $dayrecords[1]['rate_wz']; ?></td>
			<td ><?php echo $dayrecords[2]['rate_wz']; ?></td>
			<td ><?php echo $dayrecords[3]['rate_wz']; ?></td>
			<td ><?php echo $dayrecords[4]['rate_wz']; ?></td>
			<td ><?php echo $totalrecords['rate_wz']; ?></td>
		</tr>
<?php
for($year=$history_end;$year>=$history_start;$year--) {
?>
		<tr>
			<td  ><?php echo $year;?>年分享/接触 </td>
			<td ><?php echo $historyrecords[$year][1]['rate_wz']; ?></td>
			<td ><?php echo $historyrecords[$year][2]['rate_wz']; ?></td>
			<td ><?php echo $historyrecords[$year][3]['rate_wz']; ?></td>
			<td ><?php echo $historyrecords[$year][4]['rate_wz']; ?></td>
			<td ><?php echo $historytotalrecords[$year]['rate_wz']; ?></td>
		</tr>
<?php
}
?>
		<tr></tr>
		<tr>
			<td  ><?php echo $current_year;?>年接受/接触 </td>
			<td ><?php echo $dayrecords[1]['rate_js']; ?></td>
			<td ><?php echo $dayrecords[2]['rate_js']; ?></td>
			<td ><?php echo $dayrecords[3]['rate_js']; ?></td>
			<td ><?php echo $dayrecords[4]['rate_js']; ?></td>
			<td ><?php echo $totalrecords['rate_js']; ?></td>
		</tr>
<?php
for($year=$history_end;$year>=$history_start;$year--) {
?>
		<tr>
			<td  ><?php echo $year;?>年接受/接触 </td>
			<td ><?php echo $historyrecords[$year][1]['rate_js']; ?></td>
			<td ><?php echo $historyrecords[$year][2]['rate_js']; ?></td>
			<td ><?php echo $historyrecords[$year][3]['rate_js']; ?></td>
			<td ><?php echo $historyrecords[$year][4]['rate_js']; ?></td>
			<td ><?php echo $historytotalrecords[$year]['rate_js']; ?></td>
		</tr>
<?php
}
?>
		</tr>
		<tr></tr>
		<tr>
			<td  ><?php echo $current_year;?>年找到/接触 </td>
			<td ><?php echo $dayrecords[1]['rate_zd']; ?></td>
			<td ><?php echo $dayrecords[2]['rate_zd']; ?></td>
			<td ><?php echo $dayrecords[3]['rate_zd']; ?></td>
			<td ><?php echo $dayrecords[4]['rate_zd']; ?></td>
			<td ><?php echo $totalrecords['rate_zd']; ?></td>
		</tr>
<?php
for($year=$history_end;$year>=$history_start;$year--) {
?>
		<tr>
			<td  ><?php echo $year;?>年找到/接触 </td>
			<td ><?php echo $historyrecords[$year][1]['rate_zd']; ?></td>
			<td ><?php echo $historyrecords[$year][2]['rate_zd']; ?></td>
			<td ><?php echo $historyrecords[$year][3]['rate_zd']; ?></td>
			<td ><?php echo $historyrecords[$year][4]['rate_zd']; ?></td>
			<td ><?php echo $historytotalrecords[$year]['rate_zd']; ?></td>
		</tr>
<?php
}
?>
		<tr>
		</tr>

</tbody>
		
	<table>
<!-- 历年DX 数据对比 -->
<?php
for($day=1;$day<=4;$day++) {
?>
	<h2 align = "center" >历年D<?php echo $day;?>每天分享对比</h2>
<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2" >
<thead bgcolor = "8bbcc7">
	<th >
	   <td width = "15%"><div align = "center"><strong><?php echo $current_year;?></strong></div></td>
<?php
	for($year=$history_end;$year>=$history_start;$year--){
?>
	   <td width = "15%"><div align = "center"><strong><?php echo $year;?></strong></div></td>
<?php
}
?>

	</th>
</thead>
<tbody>
		<tr>
			<td>接触人数</td>
			<td><?php echo $dayrecords[$day]['total_yd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['total_yd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>分享人数</td>
			<td><?php echo $dayrecords[$day]['total_wz'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['total_wz'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>接受人数</td>
			<td><?php echo $dayrecords[$day]['total_js'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['total_js'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>找到人数</td>
			<td><?php echo $dayrecords[$day]['total_zd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['total_zd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>人均接触</td>
			<td><?php echo $dayrecords[$day]['avg_yd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['avg_yd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>人均分享</td>
			<td><?php echo $dayrecords[$day]['avg_wz'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['avg_wz'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>人均找到</td>
			<td><?php echo $dayrecords[$day]['avg_zd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['avg_zd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>分享/接触</td>
			<td><?php echo $dayrecords[$day]['rate_wz'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['rate_wz'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>接受/接触</td>
			<td><?php echo $dayrecords[$day]['rate_js'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['rate_js'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>找到/接触</td>
			<td><?php echo $dayrecords[$day]['rate_zd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['rate_zd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>参与人数</td>
			<td><?php echo $dayrecords[$day]['cnt'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historyrecords[$year][$day]['cnt'];?></td>
<?php } ?>
		</tr>

</tbody>
		
<table>
<?php
}
?>

<!-- 历史D1-D4总计 -->
<h2 align = "center" >历年D1-D4每天分享对比</h2>
<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2" >
<thead bgcolor = "8bbcc7">
	<th >
	   <td width = "15%"><div align = "center"><strong><?php echo $current_year;?></strong></div></td>
<?php
	for($year=$history_end;$year>=$history_start;$year--){
?>
	   <td width = "15%"><div align = "center"><strong><?php echo $year;?></strong></div></td>
<?php
}
?>

	</th>
</thead>
<tbody>
		<tr>
			<td>接触人数</td>
			<td><?php echo $totalrecords['total_yd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['total_yd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>分享人数</td>
			<td><?php echo $totalrecords['total_wz'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['total_wz'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>接受人数</td>
			<td><?php echo $totalrecords['total_js'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['total_js'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>找到人数</td>
			<td><?php echo $totalrecords['total_zd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['total_zd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>人均接触</td>
			<td><?php echo $totalrecords['avg_yd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['avg_yd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>人均分享</td>
			<td><?php echo $totalrecords['avg_wz'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['avg_wz'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>人均找到</td>
			<td><?php echo $totalrecords['avg_zd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['avg_zd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>分享/接触</td>
			<td><?php echo $totalrecords['rate_wz'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['rate_wz'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>接受/接触</td>
			<td><?php echo $totalrecords['rate_js'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['rate_js'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>找到/接触</td>
			<td><?php echo $totalrecords['rate_zd'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['rate_zd'];?></td>
<?php } ?>
		</tr>
		<tr>
			<td>参与人数</td>
			<td><?php echo $totalrecords['cnt'];?></td>
<?php for($year=$history_end;$year>=$history_start;$year--){  ?>
	  		<td><?php echo $historytotalrecords[$year]['cnt'];?></td>
<?php } ?>
		
</tr>

</tbody>
		
<table>
</center>
</html>

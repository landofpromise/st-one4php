
<?php
include("config.php");
$day = $_GET['day'];
$fieldcompsql = "select count(A.yd_number) as cnt, sum(A.yd_number) as total_yd, sum(A.wz_number) as total_wz, B.sex as gender,sum(A.js_number) as total_js,sum(A.zd_number) as total_zd, sum(A.yd_number)/count(A.yd_number) as avg_yd, sum(A.wz_number)/count(A.yd_number) as avg_wz, sum(A.js_number)/count(A.yd_number) as avg_js,sum(A.zd_number)/count(A.yd_number) as avg_zd  from $stdatatable A, $leadertable B where A.zy_id=B.id group by B.sex;";
//echo $fieldcompsql;
$fieldcompresult = mysql_query($fieldcompsql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$fieldcompsql);
$num = @mysql_num_rows($fieldcompresult);
$comprecords = array();
for($i=0;$i<$num;$i++){
	$fieldcomprecords = @mysql_fetch_array($fieldcompresult,MYSQL_ASSOC);
	$comprecords[$fieldcomprecords['gender']] = $fieldcomprecords;
}
$totalsql = "select count(A.yd_number) as cnt, sum(A.yd_number) as total_yd, sum(A.wz_number) as total_wz,sum(A.js_number) as total_js,sum(A.zd_number) as total_zd,sum(A.yd_number)/count(A.yd_number) as avg_yd, sum(A.wz_number)/count(A.yd_number) as avg_wz, sum(A.js_number)/count(A.yd_number) as avg_js,sum(A.zd_number)/count(A.yd_number) as avg_zd from $stdatatable A;";
$totalresult = mysql_query($totalsql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$totalsql);
$totalrecords = @mysql_fetch_array($totalresult);
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
	<h1 align = "center" >今年数据对比分析区</h1>
	<h2 align = "center" >D1-D4总性别分析</h2>

<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2" >
<thead bgcolor = "8bbcc7">
	<th >
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[0];?></strong></div></td>
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[1];?></strong></div></td>
	   <td width = "15%"><div align = "center"><strong>总数</strong></div></td>
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[0];?>/总数</strong></div></td>
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[1];?>/总数</strong></div></td>
	</th>
</thead>
<tbody>
		<tr>
			<td  >接触人数 </td>
			<td ><?php echo $comprecords[0]['total_yd']; ?></td>
			<td ><?php echo $comprecords[1]['total_yd']; ?></td>
			<td ><?php echo $totalrecords['total_yd']; ?></td>
			<td ><?php echo round($comprecords[0]['total_yd']/$totalrecords['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_yd']/$totalrecords['total_yd'],2); ?></td>
		</tr>
		<tr>
			<td >分享人数 </td>
			<td ><?php echo $comprecords[0]['total_wz']; ?></td>
			<td ><?php echo $comprecords[1]['total_wz']; ?></td>
			<td ><?php echo $totalrecords['total_wz']; ?></td>
			<td ><?php echo round($comprecords[0]['total_wz']/$totalrecords['total_wz'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_wz']/$totalrecords['total_wz'],2); ?></td>
		</tr>
		<tr>
			<td >接受人数 </td>
			<td ><?php echo $comprecords[0]['total_js']; ?></td>
			<td ><?php echo $comprecords[1]['total_js']; ?></td>
			<td ><?php echo $totalrecords['total_js']; ?></td>
			<td ><?php echo round($comprecords[0]['total_js']/$totalrecords['total_js'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_js']/$totalrecords['total_js'],2); ?></td>
		</tr>
		<tr>
			<td >找到人数 </td>
			<td ><?php echo $comprecords[0]['total_zd']; ?></td>
			<td ><?php echo $comprecords[1]['total_zd']; ?></td>
			<td ><?php echo $totalrecords['total_zd']; ?></td>
			<td ><?php echo round($comprecords[0]['total_zd']/$totalrecords['total_zd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_zd']/$totalrecords['total_zd'],2); ?></td>
		</tr>
		<tr>
			<td >参与人数 </td>
			<td ><?php echo $comprecords[0]['cnt']; ?></td>
			<td ><?php echo $comprecords[1]['cnt']; ?></td>
			<td ><?php echo $totalrecords['cnt']; ?></td>
			<td ><?php echo round($comprecords[0]['cnt']/$totalrecords['cnt'],2); ?></td>
			<td ><?php echo round($comprecords[1]['cnt']/$totalrecords['cnt'],2); ?></td>
		</tr>
		<tr>
			<td  >人均接触 </td>
			<td ><?php echo round($comprecords[0]['avg_yd'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_yd'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_yd'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >人均分享 </td>
			<td ><?php echo round($comprecords[0]['avg_wz'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_wz'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_wz'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >人均接受 </td>
			<td ><?php echo round($comprecords[0]['avg_js'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_js'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_js'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >人均找到 </td>
			<td ><?php echo round($comprecords[0]['avg_zd'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_zd'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_zd'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >分享/接触 </td>
			<td ><?php echo round($comprecords[0]['total_wz']/$comprecords[0]['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_wz']/$comprecords[1]['total_yd'],2); ?></td>
			<td ><?php echo round($totalrecords['total_wz']/$totalrecords['total_yd'],2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >接受/接触 </td>
			<td ><?php echo round($comprecords[0]['total_js']/$comprecords[0]['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_js']/$comprecords[1]['total_yd'],2); ?></td>
			<td ><?php echo round($totalrecords['total_js']/$totalrecords['total_yd'],2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >找到/接触 </td>
			<td ><?php echo round($comprecords[0]['total_zd']/$comprecords[0]['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_zd']/$comprecords[1]['total_yd'],2); ?></td>
			<td ><?php echo round($totalrecords['total_zd']/$totalrecords['total_yd'],2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		</tbody>
		
	<table>

<?php
$fieldcompsql = "select count(A.yd_number) as cnt, sum(A.yd_number) as total_yd, sum(A.wz_number) as total_wz, B.sex as gender,sum(A.js_number) as total_js,sum(A.zd_number) as total_zd, sum(A.yd_number)/count(A.yd_number) as avg_yd, sum(A.wz_number)/count(A.yd_number) as avg_wz, sum(A.js_number)/count(A.yd_number) as avg_js,sum(A.zd_number)/count(A.yd_number) as avg_zd  from $stdatatable A, $leadertable B where A.zy_id=B.id and day_num=$day group by B.sex;";
//echo $fieldcompsql;
$fieldcompresult = mysql_query($fieldcompsql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$fieldcompsql);
$num = @mysql_num_rows($fieldcompresult);
$comprecords = array();
for($i=0;$i<$num;$i++){
	$fieldcomprecords = @mysql_fetch_array($fieldcompresult,MYSQL_ASSOC);
	$comprecords[$fieldcomprecords['gender']] = $fieldcomprecords;
}
$totalsql = "select count(A.yd_number) as cnt, sum(A.yd_number) as total_yd, sum(A.wz_number) as total_wz,sum(A.js_number) as total_js,sum(A.zd_number) as total_zd,sum(A.yd_number)/count(A.yd_number) as avg_yd, sum(A.wz_number)/count(A.yd_number) as avg_wz, sum(A.js_number)/count(A.yd_number) as avg_js,sum(A.zd_number)/count(A.yd_number) as avg_zd from $stdatatable A where day_num=$day;";
$totalresult = mysql_query($totalsql) OR die("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$totalsql);
$totalrecords = @mysql_fetch_array($totalresult);
?>

	<h2 align = "center" >D<?php echo $day;?>性别分析</h2>

<table width = "75%" border = "1" cellpadding = "0" cellspacing = "2" >
<thead bgcolor = "8bbcc7">
	<th >
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[0];?></strong></div></td>
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[1];?></strong></div></td>
	   <td width = "15%"><div align = "center"><strong>总数</strong></div></td>
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[0];?>/总数</strong></div></td>
	   <td width = "15%"><div align = "center"><strong><?php echo $gender2name[1];?>/总数</strong></div></td>
	</th>
</thead>
<tbody>
		<tr>
			<td  >接触人数 </td>
			<td ><?php echo $comprecords[0]['total_yd']; ?></td>
			<td ><?php echo $comprecords[1]['total_yd']; ?></td>
			<td ><?php echo $totalrecords['total_yd']; ?></td>
			<td ><?php echo round($comprecords[0]['total_yd']/$totalrecords['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_yd']/$totalrecords['total_yd'],2); ?></td>
		</tr>
		<tr>
			<td >分享人数 </td>
			<td ><?php echo $comprecords[0]['total_wz']; ?></td>
			<td ><?php echo $comprecords[1]['total_wz']; ?></td>
			<td ><?php echo $totalrecords['total_wz']; ?></td>
			<td ><?php echo round($comprecords[0]['total_wz']/$totalrecords['total_wz'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_wz']/$totalrecords['total_wz'],2); ?></td>
		</tr>
		<tr>
			<td >接受人数 </td>
			<td ><?php echo $comprecords[0]['total_js']; ?></td>
			<td ><?php echo $comprecords[1]['total_js']; ?></td>
			<td ><?php echo $totalrecords['total_js']; ?></td>
			<td ><?php echo round($comprecords[0]['total_js']/$totalrecords['total_js'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_js']/$totalrecords['total_js'],2); ?></td>
		</tr>
		<tr>
			<td >找到人数 </td>
			<td ><?php echo $comprecords[0]['total_zd']; ?></td>
			<td ><?php echo $comprecords[1]['total_zd']; ?></td>
			<td ><?php echo $totalrecords['total_zd']; ?></td>
			<td ><?php echo round($comprecords[0]['total_zd']/$totalrecords['total_zd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_zd']/$totalrecords['total_zd'],2); ?></td>
		</tr>
		<tr>
			<td >参与人数 </td>
			<td ><?php echo $comprecords[0]['cnt']; ?></td>
			<td ><?php echo $comprecords[1]['cnt']; ?></td>
			<td ><?php echo $totalrecords['cnt']; ?></td>
			<td ><?php echo round($comprecords[0]['cnt']/$totalrecords['cnt'],2); ?></td>
			<td ><?php echo round($comprecords[1]['cnt']/$totalrecords['cnt'],2); ?></td>
		</tr>
		<tr>
			<td  >人均接触 </td>
			<td ><?php echo round($comprecords[0]['avg_yd'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_yd'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_yd'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >人均分享 </td>
			<td ><?php echo round($comprecords[0]['avg_wz'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_wz'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_wz'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >人均接受 </td>
			<td ><?php echo round($comprecords[0]['avg_js'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_js'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_js'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >人均找到 </td>
			<td ><?php echo round($comprecords[0]['avg_zd'], 2); ?></td>
			<td ><?php echo round($comprecords[1]['avg_zd'], 2); ?></td>
			<td ><?php echo round($totalrecords['avg_zd'], 2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >分享/接触 </td>
			<td ><?php echo round($comprecords[0]['total_wz']/$comprecords[0]['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_wz']/$comprecords[1]['total_yd'],2); ?></td>
			<td ><?php echo round($totalrecords['total_wz']/$totalrecords['total_yd'],2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >接受/接触 </td>
			<td ><?php echo round($comprecords[0]['total_js']/$comprecords[0]['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_js']/$comprecords[1]['total_yd'],2); ?></td>
			<td ><?php echo round($totalrecords['total_js']/$totalrecords['total_yd'],2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >找到/接触 </td>
			<td ><?php echo round($comprecords[0]['total_zd']/$comprecords[0]['total_yd'],2); ?></td>
			<td ><?php echo round($comprecords[1]['total_zd']/$comprecords[1]['total_yd'],2); ?></td>
			<td ><?php echo round($totalrecords['total_zd']/$totalrecords['total_yd'],2); ?></td>
			<td ></td>
			<td ></td>
		</tr>
		</tbody>
		
	<table>
</body>
</center>
</html>

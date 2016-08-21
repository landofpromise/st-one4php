<?php
include("config.php");
$sort = $_GET['sort'];
$day = $_GET['day'];
if($sort == NULL)
	$sort = 'default';
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>禾场分组管理</title>
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
<h1 align = "center" >ST禾场管理系统</h1>

<div style="left:200px">
<input type = "button" name = add onclick = "javascript:window.location.href='st_main.php'" ; value = "返回首页" >
<input type = "button" name = add onclick = "javascript:window.location.href='tongji_main.php'" ; value = "统计首页" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_count.php?sort=yd&year=2014'" ; value = "2014年统计" >
<input type = "button" name = add onclick = "javascript:window.location.href='st_count.php?sort=yd&year=2015'" ; value = "2015年统计" >
</div>
<br>
<?php
for($day=1;$day<5;$day++) {
$sql = "select id,type,code,mq from $datatable;";
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
$fieldTbl = array();
while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
	$fieldTbl[$row['id']] = array($row['id'],$row['code'],$row['type'],$row['mq']);
}
$datasql = "select area_id as id, count(zd_number) as num, sum(yd_number) as yd, sum(wz_number) as wz, sum(js_number) as js, sum(zd_number) as zd from st2015_data where day_num=$day group by area_id;";
$dataresult = mysql_query($datasql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$datasql);
//$dataTbl = array();
$totalYd = 0;
$totalWz = 0;
$totalJs = 0;
$totalZd = 0;
$totalNum = 0;
$haveDataList = array();
while($row = mysql_fetch_array($dataresult,MYSQL_ASSOC)){
	//$dataTbl[] = array($row->id, $row->yd,$row->wz,$row->js,$row->zd);
	if($fieldTbl[$row['id']] != NULL) {
		$arr = array();
		$arr['yd'] = $row['yd'];
		$arr['wz'] = $row['wz'];
		$arr['js'] = $row['js'];
		$arr['zd'] = $row['zd'];
		$arr['num'] = $row['num'];//人次
		switch($sort){
			case 'yd':$arr['comp'] = $row['yd']; break;
			case 'wz':$arr['comp'] = $row['wz']; break;
			case 'js':$arr['comp'] = $row['js']; break;
			case 'zd':$arr['comp'] = $row['zd']; break;
			case 'wzyd':$arr['comp'] = 100*$row['wz']/$row['yd']; break;
			case 'jsyd':$arr['comp'] = 100*$row['js']/$row['yd']; break;
			case 'zdyd':$arr['comp'] = 100*$row['zd']/$row['yd']; break;
			case 'num':$arr['comp'] = $row['num']; break;
			case 'rjyd':$arr['comp'] = 100*$row['yd']/$row['num']; break;
			case 'rjwz':$arr['comp'] = 100*$row['wz']/$row['num']; break;
		}
		
		$fieldTbl[$row['id']]["data"] = $arr;
	}
	$totalYd += $row['yd'];
	$totalWz += $row['wz'];
	$totalJs += $row['js'];
	$totalZd += $row['zd'];
	$totalNum += $row['num'];
	$haveDataList[$row['id']] = 1;
}
$avgYd_num = round($totalYd/$totalNum,2);
$avgWz_num = round($totalWz/$totalNum,2);
$avgJs_num = round($totalJs/$totalNum,2);
$avgZd_num = round($totalZd/$totalNum,2);
$avgWz = round(100*$totalWz/$totalYd,2);
$avgJs = round(100*$totalJs/$totalYd,2);
$avgZd = round(100*$totalZd/$totalYd,2);
$haveDataCount = count($haveDataList);
$avgYd_Mq = round($totalYd/$haveDataCount,2);
$avgWz_Mq = round($totalWz/$haveDataCount,2);
$avgJs_Mq = round($totalJs/$haveDataCount,2);
$avgZd_Mq = round($totalZd/$haveDataCount,2);
$avgNum_Mq = round($totalNum/$haveDataCount,2);

for($i=0;$i<count($fieldTbl);$i++) {
	for($j=$i+1;$j<count($fieldTbl);$j++) {
		if($fieldTbl[$j]['data']['comp']>$fieldTbl[$i]['data']['comp']) {
			$tmp = $fieldTbl[$i];
			$fieldTbl[$i] = $fieldTbl[$j];
			$fieldTbl[$j] = $tmp;
		}
	}
}
?>
<br>第<?php echo $day; ?>天<br>
<table width = "100%" border = "0" cellpadding ="0" cellspacing = "1" bgcolor = "#7b7b84">
   <tr bgcolor = "8bbcc7">
       <td height = "33"><div align = "center"><strong>ID</strong></div></td>
	   <td><div align = "center"><strong>禾场</strong></div></td>
	   <td><div align = "center"><strong>类型</strong></div></td>
	   <td><div align = "center"><strong>牧区</strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=yd">接触</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=wz">完整分享</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=js">接受</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=zd">找到</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=wzyd">分享率(%)</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=jsyd">接受率(%)</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=zdyd">找到率(%)</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=num">人次</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=rjyd">人均接触</a></strong></div></td>
	   <td><div align = "center"><strong><a href="st_newcount.php?sort=rjwz">人均完整</a></strong></div></td>
	</tr>
	<tr bgcolor = "8bbcc7">
       <td height = "33"><div align = "center"><strong>—</strong></div></td>
	   <td><div align = "center"><strong>—</strong></div></td>
	   <td><div align = "center"><strong>—</strong></div></td>
	   <td><div align = "center"><strong>—</strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgYd_Mq; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgWz_Mq; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgJs_Mq; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgZd_Mq; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgWz; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgJs; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgZd; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgNum_Mq; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgYd_num; ?></strong></div></td>
	   <td><div align = "center"><strong><?php echo $avgWz_num; ?></strong></div></td>
	</tr>
<?php
	for($i=0;$i<count($fieldTbl);$i++) {
		$info = $fieldTbl[$i];
		$dt = $info['data'];
		if($dt == NULL )
			continue;
		$pre = '<font color="red">';
		$post = '</font>';

?>

	<tr bgcolor = "#ffffff">
	   <td height = "22" align = "right"><?php echo $info[0]; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php  echo "<a href='st_team_hc.php?day=$day&hc_id=".$info[0]."' target='_blank'>".$info[1]."</a>"; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php echo $type2name[$info[2]]; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php echo $info[3]; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php if($dt['yd']<$avgYd_Mq) echo $pre.$dt['yd'].$post; else echo $dt['yd']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php if($dt['wz']<$avgWz_Mq) echo $pre.$dt['wz'].$post; else echo $dt['wz']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php if($dt['js']<$avgJs_Mq) echo $pre.$dt['js'].$post; else echo $dt['js']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php if($dt['zd']<$avgZd_Mq) echo $pre.$dt['zd'].$post; else echo $dt['zd']; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php $t = round($dt['wz']*100/$dt['yd'],2); 
			if($t<$avgWz) echo $pre.$t.$post; else echo $t; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php $t = round($dt['js']*100/$dt['yd'],2); 
			if($t<$avgJs) echo $pre.$t.$post; else echo $t; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php $t = round($dt['zd']*100/$dt['yd'],2); 
			if($t<$avgZd) echo $pre.$t.$post; else echo $t; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php $t = $dt['num'];
			if($t<$avgNum_Mq) echo $pre.$t.$post; else echo $t; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php $t = round($dt['yd']/$dt['num'],2); 
			if($t<$avgYd_num) echo $pre.$t.$post; else echo $t; ?>&nbsp;</td>
	   <td height = "22" >&nbsp;<?php $t = round($dt['wz']/$dt['num'],2);
			if($t<$avgWz_num) echo $pre.$t.$post; else echo $t; ?>&nbsp;</td>
	</tr>
<?php
}
?>
</table>
<br>
<?php
}
mysql_close($conn);
?>
</body>
</center>
</html>

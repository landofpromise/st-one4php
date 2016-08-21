
<?php
include("config.php");
?>
<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>统计导航页面</title>
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
统计页面导航
</h1>
<!-- <a href='st_map.php?day=1'>st_map 异步加载地图</a> -->
数据战报 <a href='st_map.php?day=1'>第1天</a> <a href='st_map.php?day=2'>第2天</a> <a href='st_map.php?day=3'>第3天</a> <a href='st_map.php?day=4'>第4天</a> 
<br><br>
禾场维度分配禾场：<a href='st_main.php?day=1'>第1天</a> <a href='st_main.php?day=2'>第2天</a> <a href='st_main.php?day=3'>第3天</a> <a href='st_main.php?day=4'>第4天</a>
<br><br>
组长维度分配禾场：<a href='st_zz_hc.php?day=1'>第1天</a> <a href='st_zz_hc.php?day=2'>第2天</a> <a href='st_zz_hc.php?day=3'>第3天</a> <a href='st_zz_hc.php?day=4'>第4天</a>
<br><br>
ST实时数据<a href='st_echarts.php?day=1'>第1天</a> <a href='st_echarts.php?day=2'>第2天</a> <a href='st_echarts.php?day=3'>第3天</a>  <a href='st_echarts.php?day=4'>第4天</a>
<br><br>

<a href='st_count.php'>2014年统计</a> <a href='st_count.php?year=2015'>2015年统计</a>
<br><br>
<a href='st_newcount.php'>2015每天的统计</a>
<br><br>
数据统计<a href='st_data_today.php?day=1'>第1天</a> <a href='st_data_today.php?day=2'>第2天</a> <a href='st_data_today.php?day=3'>第3天</a> <a href='st_data_today.php?day=4'>第4天</a> 
<br><br>
今年战场数据对比<a href='st_comp_today_field.php?day=1'>第1天</a> <a href='st_comp_today_field.php?day=2'>第2天</a> <a href='st_comp_today_field.php?day=3'>第3天</a> <a href='st_comp_today_field.php?day=4'>第4天</a> 
<br><br>
今年性别数据对比<a href='st_comp_today_gender.php?day=1'>第1天</a> <a href='st_comp_today_gender.php?day=2'>第2天</a> <a href='st_comp_today_gender.php?day=3'>第3天</a> <a href='st_comp_today_gender.php?day=4'>第4天</a> 
<br><br>
<a href='st_comp_today_year.php'>历史数据对比</a>
<br><br>
</body>
</html>

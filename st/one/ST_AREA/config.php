<?php
$host = "121.41.230.253";//'121.41.230.253';
$user_name = "st2015";//'st2015';
$password = "lovelop2015";//'lovelop2015';
$database = "zp20v1_db";//"zp20v1_db";
$datatable = "st2015_field";//"st2015_hc";
$datatabletype = "st2015_fieldtype";
$fieldarrangetable = "st2015_field_arrange";
$leadertable = "st2016";//大组长信息所在的表
$reporttable = "st2015_hc_feedback";//组长统计数据的表
$stdatatable = "st2016_data";//数据统计的表
$historytable = "st_history";//历史数据统计表
$charset = "utf-8";//"gb2312";
$conn = mysql_connect($host, $user_name, $password);
if(!$conn)
{
	die('失败'.mysql_error());
}
mysql_select_db($database);
//mysql_query("set names ".$charset.";");
mysql_query("set names utf8;");
/////////////////////////////////////////////////////
$sql = "select * from $datatabletype;";
$queryType = @mysql_query($sql,$conn);
if(!$queryType){
	die("SQL执行不成功".mysql_error());
}
$type2name = array();
$count = @mysql_num_rows($queryType);
for($i=0;$i<$count;$i++){
	$records = @mysql_fetch_object($queryType);
	$type2name[$records->id] = $records->name;
}
//////////////////////////////////////////////////////
//大组长的姓名，ID关系
$leaderInfo = array();
$sql = "select id, name from $leadertable where is_dzz=1 order by name asc;";
$queryType = @mysql_query($sql,$conn);
$count = @mysql_num_rows($queryType);
for($i=0;$i<$count;$i++){
	$records = @mysql_fetch_object($queryType);
	$leaderInfo[$records->id] = $records->name;
}
///////////////////////////////////////////////////////
$mqs = array();
$mqs["XS"]="XS";
$mqs["ZJG"]="ZJG";
$mqs["GZD"]="GZD";
$mqs["GZX"]="GZX";
$mqs["SQ"]="SQ";
$mqs["BJ"]="BJ";
///////////////////////////////////////////////////////
$gender2name = array();
$gender2name[0]="女";
$gender2name[1]="男";
//////////////////////////////////////////////////////
$history_start = 2011;
$history_end = 2014;
$current_year = 2015;
?>

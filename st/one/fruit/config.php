<?php
header("Content-type: text/html; charset=utf-8");

$host = "121.41.230.253";//'121.41.230.253';
$user_name = "st2015";//'st2015';
$password = "lovelop2015";//'lovelop2015';
$database = "zp20v1_db";//"zp20v1_db";
$charset = "gb2312";//"gb2312";
$visitortable = "LOP_NEWBIE_VISITORS";
$membertable = "LOP_NEWBIE_MEMBERS";
$recordtable = "LOP_NEWBIE_RECORDS";
$conn = mysql_connect($host, $user_name, $password);
if(!$conn)
{
	die('失败'.mysql_error());
}
mysql_select_db($database);
mysql_query("set names utf8;");
///////////////以下是常规参数///////////////////////////
$muquList = array( "XS"=>"下沙", "SQ"=>"市区", "GZX"=>"工作西", "GZD"=>"工作东","ZJG"=>"紫金港","BJ"=>"滨江");
$genderList = array( 1=>"男", 0=>"女");
$recordfromList = array( "迎新"=>"迎新", "ST"=>"ST", "FISH"=>"FISH", "其他"=>"其他");
$studytypeList = array("本科"=>"本科","硕士"=>"硕士","博士"=>"博士","专科"=>"专科","高中"=>"高中","初中"=>"初中","其他"=>"其他");
$gradeList = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8);
$truefalseList = array(0=>"否", 1=>"是");
$faithyearList = array(0=>"非基督徒",1=>"1年以内",2=>"2年以内",3=>"2年以上");
$recordTypeList = array("1对1吃饭"=>"1对1吃饭","1对1自习"=>"1对1自习","1对1探访"=>"1对1探访","1对1运动"=>"1对1运动","集体吃饭"=>"集体吃饭","集体运动"=>"集体运动","集体自习"=>"集体自习","集体探访"=>"集体探访","小组"=>"小组","主日"=>"主日","其他"=>"其他");
$durationList = array(10=>"10分钟",20=>"20分钟",30=>"30分钟",40=>"40分钟",50=>"50分钟",60=>"60分钟以上");
//////////////////////////以下是工具函数
//是否是活跃状态的Visitor
function CheckAllowed2Record($id) {
	global $conn;
	global $visitortable;
	$sql = "select name from $visitortable where ZUZHANG=1 and DELETED=0 and id=$id;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	if($count>0)
		return true;
	else
		return false;
}
function CheckAllowed2Arrange($id) {
	global $conn;
	global $visitortable;
	$sql = "select name from $visitortable where QUZHANG=1 and DELETED=0 and id=$id;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	if($count>0)
		return true;
	else
		return false;
}
//添加到迎新果子表
function UpdateNewbieInfo($newbie,$name,$gender,$muqu,$recordfrom,$phone,$age,$wechat,$qq,$studytype,$grade,$hometown,$meetlocale,$writer,$writetime,$deleted,$faithyear,$descript) {
	global $conn;
	global $membertable;
	$sql = "";
	if($newbie != NULL)
		$sql = "update $membertable set name='$name',gender=$gender,muqu='$muqu',recordfrom='$recordfrom',phone='$phone',age=$age,wechat='$wechat',qq='$qq',studytype='$studytype',grade=$grade,hometown='$hometown',meetlocale='$meetlocale',writer='$writer',writetime='$writetime',deleted='$deleted',faithyear='$faithyear',descript='$descript' where id=$newbie;";
	else
		$sql = "insert into $membertable(name,gender,muqu,recordfrom,phone,age,wechat,qq,studytype,grade,hometown,meetlocale,writer,writetime,deleted,faithyear,descript) values('$name',$gender,'$muqu','$recordfrom','$phone',$age,'$wechat','$qq','$studytype',$grade,'$hometown','$meetlocale',$writer,$writetime,$deleted,$faithyear,'$descript');";
	$queryType = @mysql_query($sql,$conn);
	return $queryType == 1;
}
//获得某个果子信息
function GetNewbieInfoById($id) {
	global $conn;
	global $membertable;
	$sql = "select * from $membertable where id=$id;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	if($count>0)
		return @mysql_fetch_object($queryType);
	else
		return NULL;
}
//获得所有组长(活跃状态)
function GetAllZuZhangByQuZhang($id){
	global $conn;
	global $visitortable;
	$ZuZhangList = array();
	$sql = "select * from $visitortable where ZUZHANG=1 and DELETED=0 and MUQU in (select muqu from $visitortable where id=$id);";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	for($i=0;$i<$count;$i++){
		$records = @mysql_fetch_object($queryType);
		$ZuZhangList[] = $records;
	}
	return $ZuZhangList;
}
///////////////////////////////////////////////////////
//获得所有的人员信息(包含已经不在了的组长)
function GetAllVisitorsIdName() {
	global $conn;
	global $visitortable;
	$ZuZhangList = array();
	$sql = "select id, name from $visitortable;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	for($i=0;$i<$count;$i++){
		$records = @mysql_fetch_object($queryType);
		$ZuZhangList[$records->id] = $records->name;
	}
	return $ZuZhangList;
}
//获得所有的果子信息
function GetAllMembers() {
	global $conn;
	global $membertable;
	$List = array();
	$sql = "select * from $membertable where DELETED=0;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	for($i=0;$i<$count;$i++){
		$records = @mysql_fetch_object($queryType);
		$List[$records->id] = $records;
	}
	return $List;
}
//获得所有分配的果子信息
function GetAllMembersByZuZhang($id) {
	global $conn;
	global $membertable;
	$List = array();
	$sql = "select * from $membertable where DELETED=0 and TOZUZHANG=$id order by DELETED desc;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	for($i=0;$i<$count;$i++){
		$records = @mysql_fetch_object($queryType);
		$List[] = $records;
	}
	return $List;
}
//获得所有果子信息
function GetAllMembersByQuZhang($id){
	global $conn;
	global $membertable;
	global $visitortable;
	$List = array();
	$sql = "select * from $membertable where MUQU in (select muqu from $visitortable where id=$id) order by DELETED desc;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	for($i=0;$i<$count;$i++){
		$records = @mysql_fetch_object($queryType);
		$List[] = $records;
	}
	return $List;
}
//分配
function UpdateNewbieArrange($newbie, $zzid, $t) {
	global $conn;
	global $membertable;
	$sql = "update $membertable set TOZUZHANG=$zzid,ARRANGETIME=$t where id=$newbie;";
	$queryType = @mysql_query($sql,$conn);
	return $queryType>0;
}
function GetNewbieRecordInfo($newbie, $id) {
	if($id==NULL)
		return NULL;
	global $conn;
	global $recordtable;
	$sql = "select * from $recordtable where NEWBIEID=$newbie and ID=$id;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	if($count>0)
		return @mysql_fetch_object($queryType);
	return NULL;
}
function UpdateNewbieRecord($logid, $id, $newbie, $recordType, $duration, $time, $feedback) {
	global $conn;
	global $recordtable;
	$sql = "";
	if($logid == NULL)
		$sql = "insert into $recordtable(ZUZHANGID,NEWBIEID,RECORDTYPE,DURATION,VISITTIME,FEEDBACK) values($id,$newbie,'$recordType',$duration,$time,'$feedback');";
	else
		$sql = "update $recordtable set ZUZHANGID=$id, NEWBIEID=$newbie, RECORDTYPE='$recordType', DURATION=$duration, VISITTIME=$time, FEEDBACK='$feedback');";
	echo $sql;
	$queryType = @mysql_query($sql,$conn);
	return $queryType>0;
}
function GetRecordByNewbie($newbie) {
	global $conn;
	global $recordtable;
	$sql = "select * from $recordtable where NEWBIEID=$newbie;";
	$queryType = @mysql_query($sql,$conn);
	$count = @mysql_num_rows($queryType);
	$List = array();
	for($i=0;$i<$count;$i++){
		$records = @mysql_fetch_object($queryType);
		$List[] = $records;
	}
	return $List;
}
?>

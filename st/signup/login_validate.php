<?php  
require '../bbs/source/class/class_core.php';  
$discuz = & discuz_core::instance();  
$discuz->cachelist = $cachelist;  
$discuz->init();  
global $_G;  
$uid = $_G['uid'];
if(!$uid){
	echo "<script language=\"javascript\">alert(\"您还未登录论坛，请先登录。如果您已登录，请更换浏览器试试。\");".
		"window.location.href=\"http://www.landofpromise.co/bbs\";</script>";
	exit;
}

$leader_array = array(1,1240,1202,433,92,142,169,1294,249,1554,444,2655,77,570,963,1176,1873,424,31,2234,1254,171,
	262,506,1434,1875,1273,8,334,730,30,67,484,362,1412,1136,11,487,389,430,48,147,368,175,87,95,109,18,398,172,361,125,
	139,43,115,863,297,1084,116,1374,122,5,4,540,148,252,47,14,700,440,1268,119,211,103,1410,1284,758,456,552,729,1446,55,
	1180,1468,134,1635,54,150,174);
$num = count($leader_array);
$isleader = false;
for($i = 0; $i < $num; $i++){
    if($uid == $leader_array[$i]){
    	$isleader = true;
    	break;
    }
}
if(!$isleader){
	echo "<script language=\"javascript\">alert(\"您不是小组长，无权限访问。如果您是小组长，请给landofpromise留言！\");".
		"window.location.href=\"http://www.landofpromise.co/bbs\";</script>";
	exit;
}
?>
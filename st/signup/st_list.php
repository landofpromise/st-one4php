
<?php  
require '../bbs/source/class/class_core.php';  
$discuz = & discuz_core::instance();  
$discuz->cachelist = $cachelist;  
$discuz->init();  
global $_G;  
$islogin = $_G['uid'];  
if($islogin){
	echo $islogin;
}else{
	echo "false";
}
?> 
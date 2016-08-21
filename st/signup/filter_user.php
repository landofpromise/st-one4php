<?php
 include("islocal.php");
?>

<?php
if(!$islocal){
	include("login_validate.php");
	include("../audio/connect/config.php");
}else{
	include("connect/config.php");
}
?>

<?php
$real_name = $_POST[real_name];
$result = array();
if($real_name){
	$select_user_sql = "select * from st_user where real_name like '$real_name%'";
	$rs = mysql_query($select_user_sql);
	$count=count($rs);
	if($count != 1)
		exit;
	$items = array();
	while($row = mysql_fetch_object($rs)){
         array_push($items, $row);
    }
    
    $result["rows"] = $items;
}

echo json_encode($result);

?>

<?php
include("connect/config.php");
?>

<?php 
	function hasSign($name, $phone){
		$phone_sql = "select id from st2016_user_pre where name='$name' and phone='$phone'";
		$rs = mysql_query($phone_sql);
		$found = false;
		if(mysql_fetch_assoc($rs)){
			$found = true;
		}
		return $found;
	}

	function insert($name, $phone){
		$insert_sql = "insert into st2016_user_pre(name, phone, add_time) values('$name', '$phone', now())";
		$rs = mysql_query($insert_sql);
	}

?>
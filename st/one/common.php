<?php

function login($uid, $is_dzz, $name, $phone, $dzz_id){
	$field_array = array("TOKEN","IS_DZZ", "NAME", "PHONE", "DZZ_ID", "USER_ID");
	$field_value = array($uid, $is_dzz, $name, $phone, $dzz_id, $uid);

	$field_count = count($field_array); 
	for($i=0;$i<$field_count;++$i){
		$_SESSION[$field_array[$i]] = $field_value[$i];
		setcookie($field_array[$i], $field_value[$i], time()+3600*24*10);
	}

}

function logout(){
	$field_array = array("TOKEN","IS_DZZ", "NAME", "PHONE", "DZZ_ID", "USER_ID");
	$field_value = array($uid, $is_dzz, $name, $phone, $dzz_id, $uid);

	$field_count = count($field_array); 
	for($i=0;$i<$field_count;++$i){
		unset($_SESSION[$field_array[$i]]);
		setcookie($field_array[$i], '', 0);
	}

}

function checkLogin(){
	if(isset($_SESSION["TOKEN"])){
		return true;
	}else if(isset($_COOKIE["TOKEN"])){
		return true;
	}else{
		return false;
	}
}

function setSessionFromCookies(){
	if(!isset($_COOKIE["TOKEN"])){
		return;
	}

	$field_array = array("TOKEN","IS_DZZ", "NAME", "PHONE", "DZZ_ID", "USER_ID");
	$field_count = count($field_array);
	for($i=0;$i<$field_count;++$i){
		$_SESSION[$field_array[$i]] = $_COOKIE[$field_array[$i]];
	}

}

?>
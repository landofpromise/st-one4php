<?php
	session_start();
	include("common.php");
 ?>

<?php 

	if(checkLogin()){
		echo "<script language=\"javascript\">window.location.href=\"one\"</script>";
		exit;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>LOP ST-登录</title>

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
input {
	font-size: 1.2em;
	min-height: 2.2em;
	text-align: left;
	border-style: none;
	margin: 0;
	background: transparent none;
	border-radius: inherit;
	padding: .4em;
	line-height: 1.4em;
	display: block;
	width: 100%;
	box-sizing: border-box;
	font-family: sans-serif;
	-webkit-rtl-ordering: logical;
	-webkit-user-select: text;
	cursor: auto;
	border-color: #bbb;
	text-shadow: #F3F3F3 0px 1px 0px;
}


div {
	background-color: #fff;
	border-color: #ddd;
	margin: 0;
	-webkit-border-radius: .3125em;
	border-width: 1px;
	border-style: solid;
	margin-top: 5px;
	box-shadow: inset 0 1px 3px rgba(0, 0, 0, .2);
}

.submit_button {
	line-height: 1.3;
	font-family: sans-serif;
	-webkit-border-radius: .3125em;
	background-color: #3385ff;
	width: 100%;
	min-height: 2.2em;
	border-style: none;
	cursor: pointer;
	font-size: 1.2em;
	font-family: sans-serif;
	color: #fff;
}

.popup {
	background: rgba(0, 0, 0, 0.5);
	color: #ffffff;
	left: 50%;
	opacity: 0;
	padding: 15px;
	position: fixed;
	text-align: justify;
	top: 40%;
	visibility: hidden;
	z-index: 10;
	border-style: none;
	-webkit-transform: translate(-50%, -50%);
	-moz-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	-o-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	-ms-border-radius: 10px;
	-o-border-radius: 10px;
	-webkit-transition: opacity .5s, top .5s;
	-moz-transition: opacity .5s, top .5s;
	-ms-transition: opacity .5s, top .5s;
	-o-transition: opacity .5s, top .5s;
	transition: opacity .5s, top .5s;
}

.overlay:target+.popup {
	top: 50%;
	opacity: 1;
	visibility: visible;
}
</style>
<script language="Javascript" src="js/form.js"></script>

</head>
<?php

?>
<body style="background-color: #f9f9f9;">
	<form method="post" onsubmit="return validate()" style="padding-left: 10px;padding-right: 10px;padding-top:20px;">
		<div>
			<input id="phoneNumber"  placeholder="你懂的"/>
		</div>
		<p></p>
		<button id="publish_btn" class="submit_button" type="submit">登 录</button>
	</form>
	<p></p>
	<div id="popup_div" class="popup" style="height:60px;min-width:140px;max-width:240px;">
		<p id="popup_tip" style="font-size:1em;text-align: center;">不能为空</p>
	</div>
</body>
</html>

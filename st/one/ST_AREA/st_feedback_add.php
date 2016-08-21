<?php
include("config.php");
?>
<html>
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

.div_select {
	background-color: #f6f6f6;
	border-color: #ddd;
	color: #333;
	text-shadow: 0 1px 0 #f3f3f3;
	border-radius: .3125em;
	display: block;
	position: relative;
	text-align: center;
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;
	cursor: pointer;
	-webkit-user-select: none;
	box-shadow: 0 1px 3px rgba(0, 0, 0, .15);
	border-width: 1px;
	border-style: solid;
	line-height: 1.3;
	font-family: sans-serif;
}

select {
	font-size: 1.2em;
	min-height: 2.2em;
	text-align: left;
	border-style: none;
	margin: 0;
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
	background-color: #373737;
	width: 100%;
	min-height: 2.2em;
	border-style: none;
	cursor: pointer;
	font-size: 1.2em;
	font-family: sans-serif;
	color: #fff;
	text-align: center;
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
<body>
<?php

$hc_id = $_POST['hc_id'];
$dzz_id = $_POST['dzz_id'];
$day = $_POST['day'];
$tips = $_POST['tips'];

$sqll = "insert into $reporttable(hc_id,dzz_id,day,tips) values('$hc_id','$dzz_id','$day','$tips');";

mysql_query($sqll) OR die("<br/>ERROR: <b>".mysql_error()."</b><br/>SQL:".$sqll);
mysql_close($conn);

echo'反馈成功!!!';		
?>

<input type = "button" class="submit_button" name = "back" value = "返回"
			onclick = "javascript:window.location.href='st_group.php?dzz_id=<?php echo $dzz_id;?>'"></td>

</body>
</html>

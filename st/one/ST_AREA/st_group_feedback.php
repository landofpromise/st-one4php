
<?php
include("config.php");
$hcid = $_GET['hcid'];
$dzzid = $_GET['dzzid'];
$day =  $_GET['day'];
$sql = "select id,type,code,mq,locale,traffic,info,contacts from $datatable where id=$hcid";
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>禾场管理</title>
<script language = "javascript">
</script>

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

</head>
<center>
<body style="background-color: #f9f9f9;">
<?php
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
?>
<!-- <h1 align = "center" ><?php echo $row['code']?>&nbsp;</h1> -->
<form name = "form" method = "post" action = "st_feedback_add.php?dzz_id=<?php echo $dzzid;?>">
<input type="hidden" name="hc_id" value="<?php echo $hcid; ?>"/>
<input type="hidden" name="dzz_id" value="<?php echo $dzzid; ?>"/>
<input type="hidden" name="day" value="<?php echo $day; ?>"/>
<table style="font-size: 1.2em;" width = "100%" border = "0" cellpadding ="0" cellspacing = "1" >
    <tr align="center">
   	  <td width="20%" align="right"><strong>禾场：</strong></div></td>
   	   <td width="80%" >&nbsp;<?php echo $row['code']; ?>&nbsp;</td>
   </tr>	
   <tr align="center">
   	  <td width="20%" align="right"><strong>反馈：</strong></td>
   	   <td width="80%" >&nbsp;<input placeholder="填写禾场反馈信息" name="tips" type="textarea" maxlength = "1000" rows="5" />&nbsp;</td>
   	   </tr>
</table>

	<input type = "submit" class="submit_button" name = "submit" value = "提交反馈">
	</form>
<?php
}
mysql_close($conn);
?>

</body>
</center>
</html>

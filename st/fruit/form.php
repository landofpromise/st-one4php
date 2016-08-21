<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>LOP 数据录入</title>

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
<script language="Javascript">
	function list(){
		window.location.href = "list.php";
	}
</script>

</head>
<?php
//include("connect/config.php");
include("../one/connect/config.php");

$token = $_SESSION["TOKEN"];

include("check.php");

$dzz_sql = "select id, name real_name,(case when is_dzz=1 then 'v' else '' end) dzz from st2016 where is_dzz=1";
$dzz_list = mysql_query($dzz_sql);

$cur_yz_sql = "select id, name real_name, dzz_id dzz from st2016 where dzz_id=$token";

$yz_sql = "select id, name real_name, dzz_id dzz from st2016";
$yz_list = mysql_query($yz_sql);

// $area_sql = "select id, code from st2016_field order by code";
// $area_list = mysql_query($area_sql);

// $area_bak_list = mysql_query($area_sql);

$cur_yz_list = mysql_query($cur_yz_sql);
//include("../audio/connect/config.php");
?>
<body style="background-color: #f9f9f9;">
	<form method="post" onsubmit="return validate()" style="padding-left: 10px;padding-right: 10px">
		<div class="div_select">
			<select id="zzname_select" name="zz_id" onchange="zz_select_change();">
				<option value="-1">请选择DZZ</option>
                <?php 
                	while($dzz=mysql_fetch_assoc($dzz_list)){
						$selected = $dzz["id"] == $token ? "selected=\"selected\"" : "";

			    		echo '<option value="'.$dzz["id"].'" '.$selected.'>'.$dzz["real_name"].'</option>';
                	}
                ?>	
			</select> 
		</div>
		<div style="display: none">
			<?php 
                while($yz=mysql_fetch_assoc($yz_list)){
			    	echo '<option name="yz'.$yz["dzz"].'" value="'.$yz["id"].'">'.$yz["real_name"].'</option>';
                }
            ?>	
		</div>
		<div style="display: none">
            <input type="text" id="dzz_id" value="<?php echo $dzz_id?>"/>
		</div>
		
		<!--
		<div style="display: none">
			<?php 
                while($area=mysql_fetch_assoc($area_list)){
			    	echo '<option name="area_option" value="'.$area["id"].'">'.$area["code"].'</option>';
                }
            ?>	
		</div>
		-->

		<div>
			<input id="DTZGNumber" name="DTZGNumber" placeholder="出去组员数(填数字)" /> 
		</div>
		<div class="div_select">
			<select id="yzname_select" name="yz_id">	
				<?php 
					while($cur_yz=mysql_fetch_assoc($cur_yz_list)){
						echo '<option name="yz'.$cur_yz["dzz"].'" value="'.$cur_yz["id"].'">'.$cur_yz["real_name"].'</option>';
					}
				?>	
			</select> 
		</div>

		<!--
		<div style="width:70%;font-size:1em;">
			<input style="font-size:1em;" id="area_filter" type="search" 
				name="area_filter" placeholder="禾场过滤" oninput="area_filter_change()"/> 
		</div>
		<div class="div_select">
			<select id="area_select" name="area_id">
                <?php 
	                while($area_bak=mysql_fetch_assoc($area_bak_list)){
				    	echo '<option value="'.$area_bak["id"].'">'.$area_bak["code"].'</option>';
                	}
            	?>
			</select> 
		</div>

		-->
		<div>
		<input id="YDNumber" name="YDNumber" placeholder="遇到数(填数字)" /> 
		</div>
		<div>
		<input id="WZNumber" name="WZNumber" placeholder="完整数(填数字)" /> 
		</div>
		<div>
		<input id="JSNumber" name="JSNumber" placeholder="接受数(填数字)" /> 
		</div>
		<div>
		<input id="ZDNumber" name="ZDNumber" placeholder="找到数(填数字)" />
		</div>
		<p></p>
		<button id="publish_btn" class="submit_button" type="submit">提 交</button>
		
	</form>
	<p></p>
	<button class="submit_button" style="margin-left:30%;width:120px;font-size:1em;background-color: #cccccc;color:#000000;" 
		onclick="list()">查看已添加</button>
	<div id="popup_div" class="popup" style="height:60px;min-width:140px;max-width:240px;">
		<p id="popup_tip" style="font-size:1em;text-align: center;">不能为空</p>
	</div>
</body>
</html>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<?php
include("config.php");

$dzz_id = $_GET['dzz_id'];
if(!$dzz_id) {
	$dzz_id = 0;
}

$sql = "select a.hc_id,a.dzz_id,a.day,a.teams,b.code,b.type,b.to_hc,b.to_lop,b.lop_to_hc from (select hc_id,dzz_id,`day`,teams from $fieldarrangetable where dzz_id=$dzz_id) as a left JOIN $datatable as b ON a.hc_id = b.id";
$result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);

$dzzsql = "select * from $leadertable where id = $dzz_id";
$dzzresult = mysql_query($dzzsql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$dzzsql);
$dzzrecord = @mysql_fetch_object($dzzresult);


$week = date("w"); // 星期天算0天 - 6
$weeksql = "select a.hc_id,a.dzz_id,a.day,a.teams,b.code,b.type,b.to_hc,b.to_lop,b.lop_to_hc from (select hc_id,dzz_id,`day`,teams from $fieldarrangetable where day=$week and dzz_id=$dzz_id) as a left JOIN $datatable as b ON a.hc_id = b.id";
$weekresult = mysql_query($weeksql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$weeksql);


// $sql = "select id,type,code,mq,locale,traffic,info,contacts,to_hc,to_lop,lop_to_hc from $datatable";
// $result = mysql_query($sql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<!-- <script language="Javascript" src="js/form.js"></script> -->
<script language="Javascript">
	function detail(hcid){
		window.location.href = "st_group_detail.php?hcid="+hcid;
	}

	function map(url){
		window.location.href = url;
	}

	function hc_select_change(){

		var day_select = document.getElementById("day_select");
		var day_value = day_select.options[day_select.selectedIndex].value; // 选中值

		var hcname = document.getElementById("hcname_select");
		var hc_value = hcname.options[hcname.selectedIndex].value; // 选中值
		var text = hcname.options[hcname.selectedIndex].text; // 选中显示值


		var hcdetail = document.getElementById("hc_detail");
		if(hc_value == -1){
			hcdetail.disabled = true;
			return;
		}

	

		hcdetail.onclick = Function("window.location.href = 'st_group_detail.php?hcid="+ hc_value+"&day="+day_value+"'");  
		hcdetail.disabled = false;

		var hcfeedback = document.getElementById("hc_feedback");
		if(hc_value == -1){
			hcfeedback.disabled = true;
			return;
		}

		var dzzid = document.getElementById("dzzid").value;
		hcfeedback.onclick = Function("window.location.href = 'st_group_feedback.php?hcid="+ hc_value+"&dzzid="+ dzzid+"&day="+day_value+"'");  
		hcfeedback.disabled = false;

		oldvalue = document.getElementById("oldValue").value;

		var oldbus = document.getElementById(oldvalue);
		if(oldbus) {
			oldbus.style.display = "none";
		}
		
		var newvalue = "hc_"+day_value+"_"+hc_value;
		var bus = document.getElementById(newvalue);
		
			bus.style.display = "";
		
		document.getElementById("oldValue").value = newvalue;


	}

	function day_select_change(){
		var day_select = document.getElementById("day_select");
		var value = day_select.options[day_select.selectedIndex].value; // 选中值
		var text = day_select.options[day_select.selectedIndex].text; // 选中显示值

		var hc_name = document.getElementById("hcname_select");
		hc_name.innerHTML = "";

		if(value == -1){
			hc_name.disabled = true;
			var hcdetail = document.getElementById("hc_detail");
			hcdetail.disabled = true;
			return;
		}




		oldvalue = document.getElementById("oldValue").value;

		var oldbus = document.getElementById(oldvalue);
		if(oldbus) {
			oldbus.style.display = "none";
		}
		dzzname = document.getElementById("dzzname").value;
		
		
		hc_name.disabled = false;
		var hc_name_array = document.getElementsByName("hc"+value);
		hc_name.options.add(new Option( dzzname +"组" + "覆盖" + hc_name_array.length + "禾场,请选择:","-1"));
	
		for(var i=0;i<hc_name_array.length;i++){
			var option = hc_name_array[i];
			var option_value = option.value;
			var option_text = option.text;
			hc_name.options.add(new Option(option_text,option_value));
		}
	}
</script>

</head>
<body style="background-color: #f9f9f9;">
	<!-- <form method="post" onsubmit="return validate()" style="padding-left: 10px;padding-right: 10px"> -->
		<input type="hidden" id="oldValue" value="" />
		<input type="hidden" id="dzzname" value="<?php echo $dzzrecord->name; ?>" />
		<input type="hidden" id="dzzid" value="<?php echo $dzzrecord->id; ?>" />
		<div class="div_select" align="center">
			<select id="day_select" name="day_id" onchange="day_select_change();">
				<option value="-1">请选择日期</option>
				<option name="day_option" <?php if($week == 1){?> selected <?php }?>  value="1">第一天 </option>
				<option name="day_option" <?php if($week == 2){?> selected <?php }?> value="2">第二天 </option>
				<option name="day_option" <?php if($week == 3){?> selected <?php }?> value="3">第三天 </option>
				<option name="day_option" <?php if($week == 4){?> selected <?php }?> value="4">第四天 </option>
        	</select> 
		</div>

		<div style="display:none">
			<?php	
			     if($num = mysql_num_rows($result)){
		        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){?>
		            <option name="hc<?php echo $row['day']; ?>" value="<?php echo $row['hc_id']; ?>"> <?php echo $row['code']; ?> </option>
		            
		        <?php
		         }
		         }
		        ?>
		</div>
		<div class="div_select">
			<select id="hcname_select" name="hc_id" onchange="hc_select_change();">
				<option value="-1"><?php echo $dzzrecord->name; ?> 组覆盖<?php echo mysql_num_rows($weekresult) ?>禾场,请选择:</option>	
				<?php	
			     if($weeknum = mysql_num_rows($weekresult)){
		        while($weekrow = mysql_fetch_array($weekresult,MYSQL_ASSOC)){?>
		            <option name="hcname" value="<?php echo $weekrow['hc_id']; ?>"> <?php echo $weekrow['code']; ?> </option>
		        <?php
		         }
		         }
		        ?>
        	</select> 
		</div>

		      <?php	
			   if($num = mysql_num_rows($result)){
			   	mysql_data_seek($result,0);   //指针复位 
		        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){?>
		           
		         <div id="hc_<?php echo $row['day']; ?>_<?php echo $row['hc_id']; ?>" style="display: none">
		         	<p/>
		             <?php if($row['to_hc']) echo  "<button class='submit_button' type='button' onclick='window.location.href = \"".$row['to_hc']."\";'>当前位置到禾场(需要安装百度地图)</button>"; ?>
           			<p/>
           			<?php if($row['to_lop']) echo  "<button class='submit_button' type='button' onclick='window.location.href = \"".$row['to_lop']."\";'>当前位置回LOP(需要安装百度地图)</button>"; ?>
           			<p/>
           			<?php if($row['lop_to_hc']) echo  "<button class='submit_button' type='button' onclick='window.location.href =\"".$row['lop_to_hc']."\";'>LOP到禾场"; ?>
           			
           		</div>

		        <?php
		         }
		         }
		        mysql_close($conn);
		        ?>

		<p></p>
	<button id ="hc_detail" class="submit_button" style="background-color: #cccccc;color:#000000;" 
		>禾场详情</button>
		<p></p>
		<button id ="hc_feedback" class="submit_button" style="background-color: #cccccc;color:#000000;" 
		>禾场反馈</button>
		<p></p>
		<button  class="submit_button" style="width:49.5%;background-color:#3385ff;color:#fff;" onclick="window.location.href = 'http://www.landofpromise.co/st15/fruit/form.php';">数据统计</button>
		<button  class="submit_button" style="width:49.5%;background-color:#3385ff;color:#fff;" onclick="window.location.href = 'http://112.124.32.20:8080/fr/fruit/FruitInfo.jsp?token=3';">果子统计</button>
	<!-- </form> -->	
</body>
</html>

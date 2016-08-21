<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/form.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
.STYLE2 {
	font-size: 18px;
	font-weight: bold;
	color: #0080C0;
	width: 750px;
	margin: auto;
	padding-top: 10px;
	padding-bottom: 0px;
}

td{
	padding-bottom: 3px;
}

hr {
	width: 550px;
	margin: auto;
	margin-bottom: 10px;
}

table {
	width: 550px;
	margin: auto;
	text-align: left;
}


.jh_div{
	float: left;
	width:250px;
}
</style>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/form_validate.js"></script>
<script type="text/javascript" src="js/jquery.cityselect.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>

<script type="text/javascript" src="js/jquery.tips.js"></script>


<script language="Javascript">

var isAdd = window.location.href.indexOf("current_id") == -1;

function validate(){
  var username = landofpromise_st.username.value.trim();
  var jh_name = landofpromise_st.jh_name.value.trim();
  var phone = landofpromise_st.phone.value.trim();
  var zz_name = landofpromise_st.zz_name.value.trim();
  var zz_phone = landofpromise_st.zz_phone.value.trim();
  var witness = landofpromise_st.witness.value.trim();
  var expect = landofpromise_st.expect.value.trim();
  var islop = $("#islop").val();

  var fishing = $("#fishing").val();
  var st_fishing_days = $("#st_fishing_days").val();
  if(fishing == 0 && st_fishing_days == 0){
  	showTip("fishing","两个fishing至少要参加一个");
  	return false;
  }

  if(!validateName() || !validatePhone() || !validateZZName() || !validateZZPhone()){
  	return false;
  }
  
  if(islop==0){
	if(!validateJHName()){
		return false;
	}

	if(witness.length < 100 || witness.length > 1000){
		msg = '得救见证需要填写100到1000字，请认真填写';
		showTip("witness", msg);
		return false;
	}
	if(expect.length < 30 || expect.length > 400){
		msg = '期待和目标需要填写30到400字，请认真填写';
		showTip("expect", msg);
		return false;
	}
  }

  saveForm();

  return false;
}


function setSelectCityValue(data, field){
	var value = data[field];
	if(value && !(typeof value == "string"))
		data[field] = value[value.length - 1];
}

function saveForm(){
	var form_data = serializeArray("st_form");
	form_data.st_happy_days = $("#st_happy_days").val();
	form_data.fishing = $("#fishing").val();
	form_data.st_fishing_days = $("#st_fishing_days").val();
	
	setSelectCityValue(form_data, "prov");
	setSelectCityValue(form_data, "city");
	if(!form_data.is_dzz){
		form_data.is_dzz = $("#is_dzz").val();
	}
	if(form_data.islop == 0){
		setSelectCityValue(form_data, "jh_prov");
		setSelectCityValue(form_data, "jh_city");
		form_data.muqu_name = "";
	}else{
		form_data.jh_prov = "";
		form_data.jh_city = "";
		form_data.jh_name = "";
	}

	$.ajax({
		url : "save.php",
		dataType : "json",
		type : "post",
		async : false,
		data: form_data,
		success : function(response) {
			if(response.code == 200){
				bootbox.alert("保存成功");
				if(isAdd){
					$("#st_form")[0].reset();
					initInput();
				}
			}else if(response.code == 504){
				bootbox.alert("该人员已经添加。如果是您添加的，你可以点击\"您添加的人员\"查看");
			}else{
				bootbox.alert("保存失败");
			}
		},
		error: function(message){
			bootbox.alert("服务器出现异常，保存失败" + message.responseText);
		}
	});
}

function serializeArray(form)
{
    var o = {};
    var a = $("#" + form).serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

// function name_change_handle(){
// 	var name = landofpromise_st.username.value.trim();
// 	if(name == '')
// 		return;
	
// 	$.ajax({
// 		url : "filter_user.php",
// 		dataType : "json",
// 		type : "post",
// 		async : false,
// 		data: {"real_name":name},
// 		success : function(json) {
// 			if(json.rows && json.rows[0]){
// 				change_input(json.rows[0]);
// 			}
				
// 		},
// 		error: function(){
// 			location.reload();
// 		}
// 	});
// }

// function change_input(user){
// 	$("#sex").val(user.sex == "女" ? 0 : 1);
// 	$("#muqu").val(user.muqu);
// 	$("#student").val(user.student == "学生" ? 1: 0);
// 	$("#hometown").val(user.hometown);
// 	$("#birth_year").val(user.date);
// 	$("#phone").val(user.phone);
// 	$("#zz_name").val(user.zz_name);
// 	$("#zz_phone").val(user.zz_phone);
// }

function change_islop(){
	var islop = $("#islop").val();
	if(islop == 1){
		$("#witness_tr").hide();
		$("#expect_tr").hide();
		$("#muqu_name").show();
		$("#jh_div").hide();
		$("#jh_name_tip").hide();
		$("#fishing_item").show();
		$("#fishing").val(0);
	}else{
		$("#witness_tr").show();
		$("#expect_tr").show();
		$("#muqu_name").hide();
		$("#jh_div").show();
		$("#jh_name_tip").show();
		$("#fishing_item").hide();
		$("#fishing").val(0);
	}
}

function change_isdzz(){
	var is_dzz = $("#is_dzz").val();
	if(is_dzz == 1){
		$("#fishing").val("1");
		$("#fishing").attr("disabled", "disabled");
		$("#st_fishing_days").val("4");
		$("#st_happy_days").val("3");
		$("#st_fishing_days").attr("disabled", "disabled");
	}else{
		$("#fishing").removeAttr("disabled");
		$("#st_fishing_days").removeAttr("disabled");
	}

	change_fishing();
}

function change_fishing(){
	var fishing = $("#fishing").val();
	var st_fishing_days = $("#st_fishing_days").val();
	if(fishing == 0 && st_fishing_days == 0){
		$("#st_happy_days").attr("disabled", "disabled");
		$("#st_happy_days").val("0");
	}else{
		$("#st_happy_days").removeAttr("disabled");
	}
}

function change_st_fishing(){
	change_fishing();
}

function initInput(){
	change_islop();
	change_isdzz();
	$("#jh_div").citySelect({prov:"浙江", city:"温州", nodata:"none"});
	$("#hometown").citySelect({prov:"浙江", city:"温州", dist:"苍南县", nodata:"none"});
}

$(function(){
	initInput();
});

</script>

<?php
include("islocal.php");
?>

<?php
if(!$islocal){
	header("Content-type: text/html; charset=utf-8");
	include("login_validate.php");
	include("../audio/connect/config.php");
}else{
	include("connect/config.php");
}
?>
<?php
$current_id = $_GET[current_id];
$agree = $_POST[agree];

$uid = $_G['uid'];
$username = $_G['username'];

if($islocal){
	$uid = 1;
	$username = "test";
}

if($current_id){
	if($uid != 1){
		$select_rs = " select * from st2016 where id=$current_id and dis_uid=$uid";
	}else{
		$select_rs = " select * from st2016 where id=$current_id";
	}
	$rs=mysql_query($select_rs);

	if($row=mysql_fetch_assoc($rs)){
		$name = $row["name"];
		$sex = $row["sex"];
		$muqu_name = $row["muqu_name"];
		$jh_name = $row["jh_name"];
		$jh_prov = $row["jh_prov"];
		$jh_city = $row["jh_city"];
		$prov = $row["prov"];
		$city = $row["city"];
		$dist = $row["dist"];
		$town = $row["town"];
		$student = $row["student"];
		$dirth_year = $row["dirth_year"];
		$dirth_month = $row["dirth_month"];
		$size = $row["size"];
		$phone = $row["phone"];
		$zz_name = $row["zz_name"];
		$zz_phone = $row["zz_phone"];
		$is_dzz = $row["is_dzz"];
		$exp_st = $row["exp_st"];
		$exp_fishing = $row["exp_fishing"];
		$islop = $row["islop"];
		$witness = $row["witness"];
		$expect = $row["expect"];
		$fishing = $row["fishing"];
		$st_fishing_days = $row["st_fishing_days"];
		$st_happy_days = $row["st_happy_days"];
		
		$selected = "selected=\"selected\"";
		$checked = "checked=\"checked\"";
	}
}else if(!$islocal && $agree != "1"){
	echo "<script language=\"javascript\">window.location.href=\"http://www.landofpromise.co/st2016/information.php\";</script>";
	exit;
}

$selected = "selected=\"selected\"";
$checked = "checked=\"checked\"";
$hide = "style=\"display:none;\"";

$size_array = array("S","M","L","XL","XXL","XXXL");
$size_array_length = count($size_array);

?>
<?php

$citySelectString = "";
if($jh_prov){
	$citySelectString=$citySelectString.'$("#jh_div").citySelect({prov:"'.$jh_prov.'", city:"'.$jh_city.'", nodata:"none"});'; 
}else{
	$citySelectString=$citySelectString.'$("#jh_div").citySelect({prov:"浙江", city:"温州", nodata:"none"});'; 
}
if($prov){
	$citySelectString=$citySelectString.'$("#hometown").citySelect({prov:"'.$prov.'", city:"'.$city.'", dist:"'.$dist.'", nodata:"none"});'; 
}else{
	$citySelectString=$citySelectString.'$("#hometown").citySelect({prov:"浙江", city:"温州", dist:"苍南县", nodata:"none"});'; 
}

?>

<script type="text/javascript">
	$(function(){
		<?php echo $citySelectString ?>
		$("#username").focus();
	});
</script>
</head>
<body>
<p class="STYLE2">基本信息</p>
<hr />
<form id="st_form" name="landofpromise_st" method="post" action="save.php"
	onsubmit="return validate();">
<table border="0" cellpadding="5" cellspacing="0">
	<tr style="display: none">
		<td><input type="text" id="current_id" name="current_id"
			value="<?php echo $current_id?>" /></td>
		<td><input type="text" id="dis_uid" name="dis_uid"
			value="<?php echo $uid?>" /></td>
		<td><input type="text" id="dis_username" name="dis_username"
			value="<?php echo $username?>" /></td>
	</tr>

	<tr>
		<td class="text_td">姓名</td>
		<td class="input_td"><input id="username" type="text" name="username"
			value="<?php echo $name?>" /></td>
	</tr>
	<tr>
		<td class="text_td">性别</td>
		<td><select id="sex" name="sex">
			<option value="1">男</option>
			<option value="0" <?php echo (!$sex ? $selected : "")?>>女</option>
		</select></td>
	</tr>
	<tr>
		<td class="text_td">来自</td>
		<td class="input_td">
			<select id="islop" name="islop" onchange="change_islop()">
				<option value="1"  >LOP</option>
				<option value="0" <?php echo (!is_null($islop) && $islop == 0 ? $selected : "")?> >非LOP</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="text_td">MuQu/所在团契</td>
		<td class="input_td">
			<select id="muqu_name" name="muqu_name" >
				<option <?php echo ($muqu_name == 'XS' ? $selected : "")?> >XS</option>
				<option <?php echo ($muqu_name == 'SQ' ? $selected : "")?> >SQ</option>
				<option <?php echo ($muqu_name == 'BJ' ? $selected : "")?> >BJ</option>
				<option <?php echo ($muqu_name == 'ZJG' ? $selected : "")?> >ZJG</option>
				<option <?php echo ($muqu_name == 'GZX' ? $selected : "")?> >GZX</option>
				<option <?php echo ($muqu_name == 'GZD' ? $selected : "")?> >GZD</option>
			</select>
			<div id="jh_div" class="jh_div" <?php echo ($islop ? "" : $hide)?>>
				<select id="jh_prov" name="jh_prov" class="prov" style="width:75px;" ></select> 
		    	<select id="jh_city" name="jh_city" class="city" style="width:75px;" disabled="disabled"></select>
				<input type="text" id="jh_name" name="jh_name" placeholder="团契名称"
				value="<?php echo $jh_name ?>"  />
			</div>
			
		</td>
	</tr>
	<tr>
		<td class="text_td">学生/工作</td>
		<td><select id="student" name="student">
			<option value="1" >学生</option>
			<option value="0" <?php echo (!is_null($student) && $student == 0 ? $selected : "")?> >工作</option>
		</select></td>
	</tr>
	<tr>
		<td class="text_td">家乡</td>
		<td>
			<div id="hometown" style="float: left;width:250px">
				<select id="prov" name="prov" class="prov" style="width:75px;"></select> 
		    	<select id="city" name="city" class="city" style="width:75px;" disabled="disabled"></select>
		        <select id="dist" name="dist" class="dist" style="width:75px;" disabled="disabled"></select>
		        <input  type="text" id="town" name="town" placeholder="所在镇(没有可不填)"
				value="<?php echo $town ?>"  />
	    	</div>
		<td>
	</tr>
	<tr>
		<td class="text_td">出生年份</td>
		<td class="input_td"><select id="birth_year" name="birth_year" style="width: 100px">
		<?php
		for ($i=2000; $i>1900; $i--){
			$year_selected = "";
			if($dirth_year && $dirth_year == $i){
				$year_selected = $selected;
			}
			echo "<option value=\"$i\" $year_selected>".$i."</option>";
		}
		?>
		</select> <select id="birth_month" name="birth_month" style="width: 80px;visibility: hidden">
		<?php
		for ($j=-1; $j<13; $j++){
			$month_selected = "";
			if($dirth_month && $dirth_month == $j){
				$month_selected = $selected;
			}
			echo "<option value=\"$j\" $month_selected>".$j."</option>";
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td class="text_td">穿衣大小</td>
		<td><select id="size" name="size">
		<?php
		for ($k=0; $k<$size_array_length; $k++){
			$size_selected = "";
			$cur_value = $size_array[$k];
			if($size && $size == $cur_value){
				$size_selected = $selected;
			}
			echo "<option value=\"$cur_value\" $size_selected>".$cur_value."</option>";
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td class="text_td">手机号</td>
		<td class="input_td"><input type="text" id="phone" name="phone"
			value="<?php echo $phone ?>" /></td>
	</tr>
</table>

<p class="STYLE2">报名信息</p>
<hr />
<table border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td class="text_td">zz/推荐人</td>
		<td ><input type="text" id="zz_name" name="zz_name"
			value="<?php echo $zz_name ?>" /></td>
	</tr>
	<tr>
		<td class="text_td">zz/推荐人手机</td>
		<td ><input type="text" id="zz_phone" name="zz_phone"
			value="<?php echo $zz_phone ?>" /></td>
	</tr>
	<tr >
		<td class="text_td">报名大组长</td>
		<td>
			<select id="is_dzz" name="is_dzz" onchange="change_isdzz()" disabled>
				<option value="1">是</option>
				<option value="0" <?php echo ($is_dzz == 0 ? $selected : "")?>>否</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="text_td">是否参加过ST</td>
		<td>
			<select id="exp_st" name="exp_st">
				<option value="1">是</option>
				<option value="0" <?php echo ($exp_st == 0 ? $selected : "")?>>否</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="text_td">fishing经验</td>
		<td>
			<select id="exp_fishing" name="exp_fishing">
				<option value="1">有</option>
				<option value="0" <?php echo ($exp_fishing == 0 ? $selected : "")?>>无</option>
			</select>
		</td>
	</tr>

	<tr id="witness_tr" <?php echo (!$islop || $islop==1 ? $hide : "")?>>
		<td class="text_td">得救见证<br>(100-1000字)<br>请认真填写</td>
		<td ><textarea id="witness" name="witness" style="width:280px;height:140px;"><?php echo $witness ?></textarea></td>
	</tr>
	<tr id="expect_tr" <?php echo (!$islop || $islop==1 ? $hide : "")?>>
		<td class="text_td">期待和目标<br>(30-400字)<br>请认真填写</td>
		<td ><textarea id="expect" name="expect" style="width:280px;height:70px;"><?php echo $expect ?></textarea></td>
	</tr>	
</table>

<p class="STYLE2">ST期间安排</p>
<hr />
<table border="0" cellpadding="5" cellspacing="0">
	<tr id="fishing_item">
		<td class="text_td">4、5、6月fishing</td>
		<td>
			<select id="fishing" name="fishing" onchange="change_fishing()">
				<option value="1">参加</option>
				<option value="0" <?php echo ($fishing == 0 ? $selected : "")?> >不参加</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="text_td">8月底fishing天数</td>
		<td>
			<select id="st_fishing_days" name="st_fishing_days" onchange="change_st_fishing()">
				<option value="0">不参加</option>
				<option value="1" <?php echo ($st_fishing_days == 1 ? $selected : "")?> >1天</option>
				<option value="2" <?php echo ($st_fishing_days == 2 ? $selected : "")?> >2天</option>
				<option value="3" <?php echo ($st_fishing_days == 3 ? $selected : "")?> >3天</option>
				<option value="4" <?php echo ($st_fishing_days == 4 ? $selected : "")?> >全程</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="text_td">ST嘉年华</td>
		<td>
			<select id="st_happy_days" name="st_happy_days">
				<option value="0">不参加</option>
				<option value="1" <?php echo ($st_happy_days == 1 ? $selected : "")?> >1天</option>
				<option value="2" <?php echo ($st_happy_days == 2 ? $selected : "")?> >2天</option>
				<option value="3" <?php echo ($st_happy_days == 3 ? $selected : "")?> >全程</option>
			</select>

		</td>

	</tr>
	<tr>
		<td colspan="3" style="padding-top:15px;">
			<button type="submit" class="btn btn-primary" style="width:160px;margin-right:20px;">提交</button>
			<a class="btn btn-info" href="list.php" target="_blank">查看已添加</a>
		</td>
	</tr>

	<tr>
		<td colspan="4" style="padding-top:15px;">有什么问题请发消息给管理员 <a
			href="http://www.landofpromise.co/bbs/home.php?mod=spacecp&ac=pm" target="_blank">landofpromise</a></td>
	</tr>
</table>

</form>

<!--
<table border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td colspan="3" style="padding-top:15px;">
			<button type="submit" class="btn btn-primary" style="width:160px;margin-right:20px;">报名已关闭</button>
			<a class="btn btn-info" href="list.php" target="_blank">查看已添加</a>
		</td>
	</tr>

	<tr>
		<td colspan="4" style="padding-top:15px;">有什么问题请发消息给管理员 <a
			href="http://www.landofpromise.co/bbs/home.php?mod=spacecp&ac=pm" target="_blank">landofpromise</a></td>
	</tr>
</table>
-->
</body>
</html>

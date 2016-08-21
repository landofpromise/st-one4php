<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">

.table_td{
	padding: 1px;
}
</style>

<SCRIPT src="js/jquery-1.10.2.min.js" type=text/javascript></SCRIPT>
<SCRIPT src="js/bootstrap.min.js" type=text/javascript></SCRIPT>
<SCRIPT src="layer/layer.min.js" type=text/javascript></SCRIPT>
<script type="text/javascript" >
	function delete_user(current_id){
		$.layer({
		    shade: [0],
		    area: ['auto','auto'],
		    dialog: {
		        msg: '你确定要删除吗？',
		        btns: 2,                    
		        type: 4,
		        btn: ['确定','取消'],
		        yes: function(){
					$.ajax({
						url : "delete_user.php",
						dataType : "json",
						type : "post",
						async : false,
						data: {"current_id":current_id},
						success : function(json) {
							if (json.result == "1"){
								layer.msg('删除成功');
								location.reload();
							}else{
								layer.msg('删除失败');
							}
							location.reload();
						},
						error: function(){
							location.reload();
						}
					});
		        }, no: function(){
		            
		        }
		    }
		});
		
		
	}
</script>
</head>
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
<body>
<?php
  //$rs=mysql_query('select count(*) from st2016',$conn);
  //$myrow= mysql_fetch_array($rs);
  
  $uid = $_G['uid'];
  
  if($islocal){
  	$uid = 1;
  }
  
  if(!$uid)
  	exit;
  
  $uid_sql = " where dis_uid=$uid";
  $admin = false;
  if($uid == 1 || $uid==109 || $uid==92 || $uid==171 || $uid==1873 || $uid==362 || $uid==8){
	$admin = true;
    $uid_sql = "";
  }
  $rs=mysql_query("select * from st2016 ".$uid_sql." order by add_date desc",$conn);
?>
<div style="text-align:center;">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">统  计</button>
</div>
<table border="1px" class="table table-striped" style="font-size:12px;position:absolute;top:40px;left:5px;border-style: none;
	border-collapse:collapse; margin:auto;text-align:left;padding:0px;min-width:1000px;">
  <tr>
	<td bgcolor="#E0E0E0" class="table_td" style="display:none">id</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">姓名</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">性别</td>
	<td bgcolor="#E0E0E0" style="padding:1px;width:160px;">MuQu/所在团契</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">学生?</td>
	<td bgcolor="#E0E0E0" style="padding:1px;width:160px;">家 乡</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">出生</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">穿衣</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">电话</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">推荐人</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">推荐人电话</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">DZZ?</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">ST经验?</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">fishing?</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">fishing</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">8月fishing</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">嘉年华</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">添加时间</td>
	<td bgcolor="#E0E0E0" style="padding:1px;">操作</td>
  </tr>
<?php
    $count_total = 0;
    $count_male = 0;
    $count_famale = 0;
    $count_islop = 0;
    $count_notlop = 0;
    $count_exp_st = 0;
    $count_exp_fishing = 0;
    $count_st_fishing_full = 0;
    $count_st_fishing_not_full = 0;
    $count_st_happy_day_full = 0;
    $count_st_happy_day_notfull = 0;
	while($myrow=mysql_fetch_assoc($rs)){
		$count_total++;
		if($myrow["sex"]){
			$count_male++;
		}else{
			$count_famale++;
		}
		if($myrow["islop"]){
			$count_islop++;
		}else{
			$count_notlop++;
		}
		if($myrow["exp_st"]){
			$count_exp_st++;
		}
		if($myrow["exp_fishing"]){
			$count_exp_fishing++;
		}
		if($myrow["st_fishing_days"] == 4){
			$count_st_fishing_full++;
		}else if($myrow["st_fishing_days"] > 0){
			$count_st_fishing_not_full++;
		}
		if($myrow["st_happy_days"] == 3){
			$count_st_happy_day_full++;
		}else if($myrow["st_happy_days"] > 0){
			$count_st_happy_day_notfull++;
		}

?>
　　<tr>
　　　<td style="display:none"><?php echo $myrow["id"]?></td>
　　　<td style="padding:1px;"><?php echo $myrow["name"]?></td>
　　　<td style="padding:1px;"><?php echo ($myrow["sex"] == 1 ? "男" : "女"); ?></td>
　　　<td style="padding:1px;"><?php echo $myrow["islop"] ? $myrow["muqu_name"] : $myrow["jh_prov"].$myrow["jh_city"].$myrow["jh_name"]; ?></td>
　　　<td style="padding:1px;"><?php echo ($myrow["student"] == 1 ? "学生" : "工作"); ?></td>
　　　<td style="padding:1px;"><?php echo $myrow["prov"].$myrow["city"].$myrow["dist"].$myrow["town"]?></td>
　　　<td style="padding:1px;"><?php echo $myrow["dirth_year"]?></td>
　　　<td style="padding:1px;"><?php echo $myrow["size"]?></td>
　　　<td style="padding:1px;"><?php echo $myrow["phone"]?></td>
　　　<td style="padding:1px;"><?php echo $myrow["zz_name"]?></td>
　　　<td style="padding:1px;"><?php echo $myrow["zz_phone"]?></td>
　　　<td style="padding:1px;"><?php echo ($myrow["is_dzz"] == 1 ? "√" : "×");?></td>
　　　<td style="padding:1px;"><?php echo ($myrow["exp_st"] == 1 ? "√" : "×");?></td>
　　　<td style="padding:1px;"><?php echo ($myrow["exp_fishing"] == 1 ? "√" : "×");?></td>
	  <td style="padding:1px;"><?php echo ($myrow["fishing"] == 1 ? "√" : "×");?></td>
	  <td style="padding:1px;"><?php echo $myrow["st_fishing_days"] == 4 ? "全程" : $myrow["st_fishing_days"] ;?></td>
	  <td style="padding:1px;"><?php echo $myrow["st_happy_days"] == 3 ? "全程" : $myrow["st_happy_days"] ?></td>
	  <td style="padding:1px;"><?php echo substr($myrow["add_date"], 2, 8) ;?></td>
　　　<td style="padding:1px;"><a href="index.php?current_id=<?php echo ($myrow["id"]);?>">编辑</a> 
		  <a href="#" onclick="delete_user(<?php echo ($myrow["id"]);?>)">删除</a>
		  <?php
			if($admin){
		  ?>
		  <a href="http://www.landofpromise.co/bbs/home.php?mod=space&uid=<?php echo ($myrow["dis_uid"]);?>&do=profile">论坛号</a>
		  <?php
			}
          ?>
	  </td>
　　</tr>
<?php
}
?>
</table>
	
	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">报名统计</h4>
	        </div>
	        <div class="modal-body">
	          <p>总数：<?php echo $count_total ?>；男：<?php echo $count_male ?>，女：<?php echo $count_famale ?>，
				LOP：<?php echo $count_islop ?>；非LOP：<?php echo $count_notlop ?></p>
				<p>参加过ST：<?php echo $count_exp_st ?>；参加过fishing：<?php echo $count_exp_fishing ?></p>
				<p>全程：<?php echo $count_st_fishing_full ?>；半程：<?php echo $count_st_fishing_not_full ?></p>
				<p>嘉年华全程：<?php echo $count_st_happy_day_full ?>；非全程：<?php echo $count_st_happy_day_notfull ?></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	        </div>
	      </div>
	    </div>
	  </div>
</body>
</html>

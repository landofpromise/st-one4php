<?php 
session_start();
include("common.php") ?>

<?php 
	$is_dzz=$_SESSION["IS_DZZ"];
	$user_id=$_SESSION["USER_ID"];

	setSessionFromCookies();

	if(!checkLogin()){
		echo "<script language=\"javascript\">".
			"window.location.href=\"login.php\"</script>";
		exit;	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>LOP ST-菜单</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

p {
	text-align:center;
	font-size:1.5em;

}

.ul_class{
	-webkit-background-clip: border-box;
	-webkit-background-origin: padding-box;
	-webkit-background-size: auto;
	background-attachment: scroll;
	background-clip: border-box;
	background-color: rgba(0, 0, 0, 0);
	background-origin: padding-box;
	background-size: auto;
	color: rgb(102, 102, 102);
	display: block;
	font-family: '微软雅黑 Light', 微软雅黑, arial, sans-serif;
	font-size: 0px;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	line-height: 24px;
	list-style-image: none;
	list-style-position: outside;
	list-style-type: none;
	margin-bottom: 0px;
	margin-top: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 15px;
	text-align:center;
}

.li_class{
	color: rgb(102, 102, 102);
	display: inline-block;
	line-height: 24px;
	list-style-image: none;
	list-style-position: outside;
	list-style-type: none;
	margin-bottom: 10px;
	margin-top: 0px;
	opacity: 1;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	position: relative;
	text-align: left;
	width: 122px;
	z-index: 0;
	
}

.h3_class{
	color: rgb(102, 102, 102);
	cursor: pointer;
	display: block;
	font-family: '微软雅黑 Light', 微软雅黑, arial, sans-serif;
	font-size: 20px;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	height: 120px;
	line-height: 28px;
	list-style-image: none;
	list-style-position: outside;
	list-style-type: none;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	text-align: left;
	width: 122px;
}

.a_class{
	color: rgb(65, 65, 65);
	cursor: auto;
	display: block;
	font-family: '微软雅黑 Light', 微软雅黑, arial, sans-serif;
	font-size: 20px;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	left: 0px;
	line-height: 28px;
	list-style-image: none;
	list-style-position: outside;
	list-style-type: none;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	outline-color: rgb(65, 65, 65);
	outline-style: none;
	outline-width: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 15px;
	position: absolute;
	text-align: center;
	text-decoration: none;
	top: 0px;
	width: 122px;
	z-index: 100;
}

.img_class{
	-webkit-background-clip: border-box;
	-webkit-background-origin: padding-box;
	-webkit-background-size: auto;
	background-attachment: scroll;
	background-clip: border-box;
	background-color: rgb(204, 204, 204);
	background-image: none;
	background-origin: padding-box;
	background-size: auto;
	border-bottom-color: rgb(65, 65, 65);
	border-bottom-left-radius: 43px;
	border-bottom-right-radius: 43px;
	border-bottom-style: none;
	border-bottom-width: 0px;
	border-image-outset: 0px;
	border-image-repeat: stretch;
	border-image-slice: 100%;
	border-image-source: none;
	border-image-width: 1;
	border-left-color: rgb(65, 65, 65);
	border-left-style: none;
	border-left-width: 0px;
	border-right-color: rgb(65, 65, 65);
	border-right-style: none;
	border-right-width: 0px;
	border-top-color: rgb(65, 65, 65);
	border-top-left-radius: 43px;
	border-top-right-radius: 43px;
	border-top-style: none;
	border-top-width: 0px;
	color: rgb(65, 65, 65);
	cursor: auto;
	display: inline;
	font-family: '微软雅黑 Light', 微软雅黑, arial, sans-serif;
	font-size: 20px;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	height: 86px;
	line-height: 28px;
	list-style-image: none;
	list-style-position: outside;
	list-style-type: none;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	text-align: center;
	width: 66px;
	height: 65px;
}

.span_class{
	color: rgb(65, 65, 65);
	cursor: auto;
	display: block;
	font-family: '微软雅黑 Light', 微软雅黑, arial, sans-serif;
	font-size: 20px;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	height: 28px;
	line-height: 28px;
	list-style-image: none;
	list-style-position: outside;
	list-style-type: none;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	text-align: center;
	width: 122px;
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

</style>

<script language="Javascript" >
	function logout(){
		window.location.href="logout.php";
	}
</script>

</head>

<body style="background-color: #f9f9f9;">
	<?php 
		$token=$_SESSION["TOKEN"];
		$isDzz=$_SESSION["IS_DZZ"];
		$phone=$_SESSION["PHONE"];
		$dzzId=$_SESSION["DZZ_ID"];

		$currentDay=date("w");
		$currentDay=$currentDay > 4 ? 1 : $currentDay;

		$dzz_display = $isDzz == 1 ? "" : "display:none";
	?>

	<ul class="ul_class">
<!--
		<li class="li_class">
			<h3 class="h3_class">
				<a class="a_class" href="http://www.landofpromise.co/st15/one/sign.php" title="2016ST报名" rel="#overlay">
					<img src="images/guozi.jpg" alt="2016ST报名" class="img_class">
					<span class="span_class">2016ST报名</span>
				</a>
			</h3>
		</li>

		<li class="li_class">
			<h3 class="h3_class">
				<a class="a_class" href="http://112.124.32.20:8080/fr/fruit/FruitInfo.jsp?token=<?php echo $token ?>" title="果子统计" rel="#overlay">
					<img src="images/guozi.jpg" alt="果子统计" class="img_class">
					<span class="span_class">果子统计</span>
				</a>
			</h3>
		</li>

		
		<li class="li_class">
			<h3 class="h3_class">
				<a class="a_class" href="http://www.landofpromise.co/st15/one/ST_AREA/st_group.php?dzz_id=<?php echo $dzzId ?>" title="禾场查看" rel="#overlay">
					<img src="images/hechang.jpg" alt="禾场查看" class="img_class">
					<span class="span_class">禾场查看</span>
				</a>
			</h3>
		</li>
-->
		
		<li class="li_class">
			<h3 class="h3_class">
				<a class="a_class" href="http://www.landofpromise.co:8080/petstore" title="报销系统" rel="#overlay">
					<img src="images/baoxiao.jpg" alt="报销系统" class="img_class">
					<span class="span_class">报销系统</span>
				</a>
			</h3>
		</li>

		
		<li class="li_class">
			<h3 class="h3_class">
				<a class="a_class" href="http://www.landofpromise.co:8080/blog/browse/gallery" title="日志系统" rel="#overlay">
					<img src="images/rizhi.jpg" alt="日志系统" class="img_class">
					<span class="span_class">日志系统</span>
				</a>
			</h3>
		</li>

		<li class="li_class" style="<?php echo $dzz_display ?>">
			<h3 class="h3_class">
				<a class="a_class" href="../fruit/form.php" title="数据统计" rel="#overlay">
					<img src="images/shuju.jpg" alt="数据统计" class="img_class">
					<span class="span_class">数据统计</span>
				</a>
			</h3>
		</li>
		
	</ul>



	<p style="text-align:center;width:100%;">
		<button class="submit_button" style="width:80%;font-size:1em;background-color: #cccccc;color:#000000;" 
			onclick="logout()">退出登录</button>	
	</p>
<!--
	<p style="<?php echo $dzz_display ?>"><a href="../fruit/form.php">数据统计</a></p>
	<p ><a href="http://112.124.32.20:8080/fr/fruit/FruitInfo.jsp?token=<?php echo $token ?>">果子统计</a></p>
	<p style="<?php echo $dzz_display ?>"><a href="http://www.landofpromise.co/st15/one/ST_AREA/st_info.php?day=1&dzz_id=4">禾场查看</a></p>
	<p ><a href="http://112.124.32.20:8080/lopbx">报销系统</a></p>
	<p ><a href="http://112.124.32.20:8080/blog">日志系统</a></p>
	<p></p>

	-->
</body>
</html>

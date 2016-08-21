<?php
	include("config.php");
?>
<html>
<head>
	<meta charset="<?php echo $charset; ?>">
	<title>搜索</title>
	<style type = "text/css">
body{

	background:#FFF5EE;
}
</style>
</head>
<body>
<h1 align = "center" >关键字查询</h1>

<form method = "post" action = "st_find_ok.php">
<p align = "center"><b>模糊关键字：
</b><input type = "text" name = "keyword" id = "keyword" size = 20>
</b><input type = "submit" value = "查询" name = "b1"></p>
</form>

<form method = "post" action = "st_find_name_ok.php">
<p align = "center"><b>按名字查询：
</b><input type = "text" name = "keyword_name" id = "keyword_name" size = 20>
</b><input type = "submit" value = "查询" name = "b2"></p>
</form>

<form method = "post" action = "st_find_district_ok.php">
<p align = "center"><b>按区域查询：
</b><input type = "text" name = "keyword_district" id = "keyword_district" size = 20>
</b><input type = "submit" value = "查询" name = "b3"></p>
</form>

<form method = "post" action = "st_find_locale_ok.php">
<p align = "center"><b>按牧区查询：
</b><input type = "text" name = "keyword_locale" id = "keyword_locale" size = 20>
</b><input type = "submit" value = "查询" name = "b4"></p>
</form>

<form method = "post" action = "st_find_type_ok.php">
<p align = "center"><b>按类型查询：
</b><input type = "text" name = "keyword_type" id = "keyword_type" size = 20>
</b><input type = "submit" value = "查询" name = "b5"></p>
</form>
<form>
        <table>

          <tr>
           <td height = "51" align = "center">
			<input type = "button" name = "back" value = "返回"
			onclick = "javascript:window.location.href='st_main.php'"></td>
			<td>&nbsp;</td>
            </tr>
		<table>
</form>
</body>
</html>












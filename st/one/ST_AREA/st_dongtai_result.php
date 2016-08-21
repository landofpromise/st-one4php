<?php
			include("config.php");

			
			$day = $_GET['day'];
			$dzz_id = $_GET['dzz_id'];
			
			$todaysql = "select count(zy_id) as zy_count,sum(yd_number) as total_yd,sum(wz_number) as total_wz,sum(js_number) as total_js,sum(zd_number) as total_zd from $stdatatable where day_num=$day and zz_id=$dzz_id ";	
			
			$todayresult = mysql_query($todaysql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
			$todayrecords = @mysql_fetch_object($todayresult);

			header('Content-type: text/json');
			// $fruits = array (
			//     "fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
			//     "numbers" => array(1, 2, 3, 4, 5, 6),
			//     "holes"   => array("first", 5 => "second", "third")
			// );
			echo json_encode($todayrecords);

?>

	
<?php
			include("config.php");


			
			$curSql = "select * from $st2016_user_pre";	
			
			$curResult = mysql_query($curSql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$sql);
			$todayrecords = @mysql_fetch_object($curResult);

			header('Content-type: text/json');
			// $fruits = array (
			//     "fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
			//     "numbers" => array(1, 2, 3, 4, 5, 6),
			//     "holes"   => array("first", 5 => "second", "third")
			// );
			echo json_encode($todayrecords);

?>

	
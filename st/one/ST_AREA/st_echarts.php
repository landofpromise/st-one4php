<?php
include("config.php");
$day = $_GET['day'];

?>

<html>
<head>
<meta charset="<?php echo $charset; ?>">
<title>ST实时数据</title>
<script language = "javascript">
</script>
</head>
<center>
<body>
	<div id="chart" style="height:800px"></div>
	
	
        <!-- JQuery 引入-->
	<script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js"></script>
	<!-- ECharts单文件引入 -->

	 <script src="http://echarts.baidu.com/build/dist/echarts-all.js"></script>
   
    	<script type="text/javascript"> 
			var xmlhttp; 
			$(document).ready(function () {
				setInterval("startRequest()",5000);
			//setInterval这个函数会根据后面定义的1000既每隔1秒执行一次前面那个函数
			//如果你用局部刷新，要用AJAX技术
			});

			window.onload=function(){  
  			   startRequest();  
			} 
			function startRequest(){ 
				

				 $.getJSON('st_echarts_result.php?day=<?php echo $day ?>', function(stdata) {
				   
				    // 基于准备好的dom，初始化echarts图表
		           var myChart = echarts.init(document.getElementById('chart')); 
		        
		  	// 		myChart.showLoading({
					//     text: '正在努力的读取数据中...',    //loading话术
					// });
					var option = {
			            tooltip: {
			                show: true
			            },
			            animation:false,

			            legend: {
			                data:['2015D<?php echo $day; ?>']
			            },
			            xAxis : [
			                {
			                    type : 'category',
			                    data : ["接触","分享","接受","找到"]
			                }
			            ],
			            yAxis : [
			                {
			                    type : 'value',
			                    show:false
			                }
			            ],
			            series : [
			                {
			                    "name":"2015D<?php echo $day; ?>",
			                    "type":"bar",
			                    "data":[stdata['total_yd'], stdata['total_wz'], stdata['total_js'],stdata['total_zd']]
			                }
			            ]
		        	};

		        	// 为echarts对象加载数据 
		        	myChart.setOption(option); 

				   // $('#resText').empty();
				   // var html = '';
				   // $.each(data  , function(commentIndex, comment) {
				   //  html += '<div class="comment"><h6>' + comment['username'] + ':</h6><p class="para">' + comment['content'] + '</p></div>';
				    })	 
			} 
        
    </script>
</body>
</center>
</html>

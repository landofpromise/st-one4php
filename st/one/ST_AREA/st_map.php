<?php

$day = $_GET['day'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ECharts">
	<title>LOP ST 2016-D<?php echo $day; ?> 数据战报</title>

	<link rel="shortcut icon" href="http://echarts.baidu.com/doc/asset/ico/favicon.png">

    <link href="http://echarts.baidu.com/doc/asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/bootstrap.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/carousel.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/echartsHome.css" rel="stylesheet">

    <link href="http://echarts.baidu.com/doc/asset/css/codemirror.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/monokai.css" rel="stylesheet">
	
</head>
<body>


	<div id="main" style="height:400px" />

	<!-- <div id="graphic" class="col-md-8">
                <div id="main" class="main" style="height: 530px;"></div>
                <div>
                    <button type="button" class="btn btn-sm btn-success" onclick="refresh(true)">刷 新</button>
                    <span class="text-primary">切换主题</span>
                    <select id="theme-select"></select>

                    <span id='wrong-message' style="color:red"></span>
                </div>
            </div>
    
    <script type="text/javascript" src="http://requirejs.org/docs/release/2.1.11/minified/require.js"></script>
    <script type="text/javascript" src="./js/dist/echarts.js"></script>
    <script type="text/javascript" src="http://echarts.baidu.com/extension/BMap/doc/BMap.js"></script>
     --><!-- 
    <script  type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=cEpVm86srs5Xqkx5DQwppihj&callback=init"></script> 
     -->
    <script src="http://echarts.baidu.com/build/dist/echarts-all.js"></script>
       <!-- JQuery 引入-->
	<script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js"></script>
   
    <script>
    	
    	var myChart = echarts.init(document.getElementById('main')); 


        option = {
		    title : {
		        text: 'LOP ST 2016',
		        subtext: 'D1 数据分析'
		    },
		    tooltip : {
		        trigger: 'axis'
		    },
		    legend: {
		        data:['接触人数', '分享人数']
		    },
		    toolbox: {
		        show : true,
		        feature : {
		            mark : {show: true},
		            dataView : {show: true, readOnly: false},
		            magicType : {show: true, type: ['line', 'bar']},
		            restore : {show: true},
		            saveAsImage : {show: true}
		        }
		    },
		    dataZoom : {
		        show : false,
		        start : 0,
		        end : 100
		    },
		    xAxis : [
		        {
		            type : 'category',
		            boundaryGap : true,
		            data : (function (){
		                var now = new Date();
		                var res = [];
		                var len = 10;
		                while (len--) {
		                    res.unshift(now.toLocaleTimeString().replace(/^\D*/,''));
		                    now = new Date(now - 2000);
		                }
		                return res;
		            })()
		        },
		        {
		           type : 'category',
		            boundaryGap : true,
		            data : (function (){
		                var now = new Date();
		                var res = [];
		                var len = 10;
		                while (len--) {
		                    res.unshift(now.toLocaleTimeString().replace(/^\D*/,''));
		                    now = new Date(now - 2000);
		                }
		                return res;
		            })()
		        }
		    ],
		    yAxis : [
		        {
		            type : 'value',
		            scale: true,
		            name : '人数',
		            boundaryGap: [0.2, 0.2]
		        },
		        {
		            type : 'value',
		            scale: true,
		            name : '人数',
		            boundaryGap: [0.2, 0.2]
		        }
		    ],
		    series : [
		        {
		            name:'接触人数',
		            type:'bar',
		            xAxisIndex: 1,
		            yAxisIndex: 1,
		            data:(function (){
		                var res = [];
		                var len = 10;
		                while (len--) {
		                    res.push(0);
		                }
		               
		                return res;
		            })()
		        },
		        {
		            name:'分享人数',
		            type:'line',
		            xAxisIndex: 0,
		            yAxisIndex: 1,
		            data:(function (){
		                var res = [];
		                var len = 10;
		                while (len--) {
		                    res.push(0);
		                }
		                
		                return res;
		            })()
		        }
		    ]
		};
		var axisData;
		var timeTicket;
		clearInterval(timeTicket);
		timeTicket = setInterval(function (){
		    
		    axisData = (new Date()).toLocaleTimeString().replace(/^\D*/,'');
		    
		     $.getJSON('st_echarts_result.php?day=<?php echo $day ?>', function(stdata) {
				   
							        
			    // 动态数据接口 addData
			    myChart.addData([
			        [
			            0,        // 系列索引
			            stdata['total_yd'], // 新增数据
			            false,     // 新增数据是否从队列头部插入
			            false,     // 是否增加队列长度，false则自定删除原有数据，队头插入删队尾，队尾插入删队头
			        	axisData
			        ],
			        [
			            1,        // 系列索引
			            stdata['total_wz'], // 新增数据
			            false,    // 新增数据是否从队列头部插入
			            false,    // 是否增加队列长度，false则自定删除原有数据，队头插入删队尾，队尾插入删队头
			            axisData  // 坐标轴标签
			        ]
			    ]);
			});
		}, 2000);


		myChart.setOption(option); 

		
    	 
	
                    
    </script>
    
</body>
</html>


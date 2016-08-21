<?php

include("config.php");
$leadersql = "select * from $leadertable where is_dzz = 1 order by sex asc, name asc";


$st2016UserTable = "st2016_user_pre";
$st2016UserQuerySql = "select * from $st2016UserTable order by add_time desc";
$st2016UserCountQuerySql = "select count(*) from $st2016UserTable"
$st2016UserQueryResult = mysql_query($st2016UserQuerySql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$st2016UserQuerySql);
$st2016UserQueryCountResult  mysql_query($st2016UserCountQuerySql) OR die ("<br/>error:<b>".mysql_error()."</b><br/>产生问题SQL:".$st2016UserCountQuerySql);



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ECharts">
	<title>LOP ST 2016-D<?php echo $day; ?> 2016年ST报名数据</title>

	<link rel="shortcut icon" href="http://echarts.baidu.com/doc/asset/ico/favicon.png">

    <link href="http://echarts.baidu.com/doc/asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/bootstrap.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/carousel.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/echartsHome.css" rel="stylesheet">

    <link href="http://echarts.baidu.com/doc/asset/css/codemirror.css" rel="stylesheet">
    <link href="http://echarts.baidu.com/doc/asset/css/monokai.css" rel="stylesheet">
	
</head>
<body>

	<div id="report" style=""> </div>
	<div id="main" style="height:700px" />

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

    	var   s   =   "2016-08-24 18:00:00";   
		var   date  =  new  Date(Date.parse(s.replace(/-/g,"/")));  

        option = {
		    // title : {
		    //     text: 'LOP ST 2016',
		    //     textStyle:{
		    //     	show:false,
		    //     	fontSize:24,
		    //     	fontWeight:'bolder'
		    //     }
		    // },
		    tooltip : {
		        trigger: 'axis'
		    },
		    legend: {
		        data:['报名人数'],
		        x:'right',
		        itemWith:40,
		        itemHight:28,
		        textStyle:{
		        	fontSize:24,
		        	fontWeight:'bolder'
		        }

		    },
		    toolbox: {
		        show : false,
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
		             axisLabel:{
		             	show:false,
		            	textStyle:{
			        	fontSize:40,
			        	fontWeight:'bolder'
			        	}

		            },
		            data : (function (){
		                var now = new Date();
		                var res = [];
		                var len = 4;
		                while (len--) {
		                    res.unshift(now.toLocaleTimeString().replace(/^\D*/,''));
		                    now = new Date(now - 1000);
		                }
		                return res;
		            })()
		        },
		        {
		           type : 'category',
		            boundaryGap : true,
		            axisLabel:{
		            	textStyle:{
			        	fontSize:40,
			        	fontWeight:'bolder'
			        	}

		            },
		            data : (function (){
		                var now = new Date();
		                var res = [];
		                var len = 4;
		                while (len--) {
		                    res.unshift(now.toLocaleTimeString().replace(/^\D*/,''));
		                    now = new Date(now - 1000);
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
		            axisLabel:{
		            	textStyle:{
			        	fontSize:24,
			        	fontWeight:'bolder'
			        	}

		            },
		            
		            boundaryGap: [0.1, 0.1]
		        },
		        {
		            type : 'value',
		            scale: true,
		            name : '人数',
		            axisLabel:{
		            	textStyle:{
			        	fontSize:24,
			        	fontWeight:'bolder'
			        	}

		            },
		            boundaryGap: [0.1, 0.1]
		        }
		    ],
		    series : [
		        {
		            name:'报名人数',
		            type:'bar',
		            barCategoryGap:'50%',
		            itemStyle:{
		            	normal:{
		            		label:{
			            		show:true,
			            		textStyle:{
						        	fontSize:60,
						        	fontWeight:'bolder'
						        }

		            		}
		            	}
		            },
		            xAxisIndex: 0,
		            yAxisIndex: 1,
		            data:(function (){
		                var res = [];
		                var len = 4;
		                while (len--) {
		                    res.push(0);
		                }
		               
		                return res;
		            })()
		        }
		        ,
		        {
		            name:'分享人数',
		            type:'line',
		            itemStyle:{
		            	normal:{
		            		label:{
			            		show:false,
			            		textStyle:{
						        	fontSize:60,
						        	fontWeight:'bolder'
						        }

		            		}
		            	}
		            },
		            xAxisIndex: 1,
		            yAxisIndex: 1,
		            data:(function (){
		                var res = [];
		                var len = 4;
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
		
		var resName = [];
		var resId = [];
		var i = 0;
		var length = 0;
		
		
		<?php
		if($num = mysql_num_rows($st2016UserQueryResult)){	
			while($row = mysql_fetch_array($st2016UserQueryResult,MYSQL_ASSOC)){
		?>
				
			resId.push(  <?php echo $row['id'] ?>);
			resName.push('<?php echo $row['name'] ?>');
			length = length +1;

			
		<?php
			}
		?>
			
			var totalBM = 0

					timeTicket = setInterval(function (){

						
						if(i < length) {
					    
						    axisData = (new Date()).toLocaleTimeString().replace(/^\D*/,'');
						    
						     var name = "+" + resName[i];
						     var id = resId[i];
						     $.getJSON('st_dongtai_st2016user_result.php?day=<?php echo $day ?>&dzz_id='+id, function(stdata) {
								   
							<?php
								 totalBM = $num;
						 		?>

								var report = document.getElementById("report");
								report.text = "当前报名数:" +totalBM;

							    // 动态数据接口 addData
							    myChart.addData([
							        [
							            0,        // 系列索引
							            totalBM, // 新增数据
							            false,     // 新增数据是否从队列头部插入
							            false,     // 是否增加队列长度，false则自定删除原有数据，队头插入删队尾，队尾插入删队头
							        	name
							        ],
							        
							        [
							            1,        // 系列索引
							            totalBM, // 新增数据
							            false,    // 新增数据是否从队列头部插入
							            false,    // 是否增加队列长度，false则自定删除原有数据，队头插入删队尾，队尾插入删队头
							            name  // 坐标轴标签
							        ]
							    ]);
							});

						i = i +1;
							

						} else {
							clearInterval(timeTicket);
						}

						

						
						
					}, 900);

		<?php

		}
		?>

		


		myChart.setOption(option); 

		
    	 
	
                    
    </script>
    
</body>
</html>


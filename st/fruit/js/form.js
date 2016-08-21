
	var xmlHttp;
	var is_submit=false;  
	var timeout = null;
	
	window.onload = function(){
		document.onclick = close_tip;
		
		var dzz_obj = document.getElementById("dzz_id");
		var dzz_id = dzz_obj.value;
		var changed = change_zz_select(dzz_id);
		if(changed){
			zz_select_change();
		}
	};
	function createXMLHttpRequest() {
		if (window.ActiveXObject) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}  
		else if (window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		}
	}

	function sumbitForm(params){
		is_submit = true;
		popup_tip("添加中...", true);
		var url = "save.php";
		var send_string = encodeURI(params); 
		createXMLHttpRequest();
		xmlHttp.open("POST",url,true );   
		xmlHttp.onreadystatechange = handleStateChange;   
		xmlHttp.setRequestHeader("Content-Type" ,"application/x-www-form-urlencoded");
		xmlHttp.send(send_string);
	}
	
	function handleStateChange() {
		if (xmlHttp.readyState == 4 ) {
			if (xmlHttp.status == 200 ) {
				is_submit = false;
				var result = xmlHttp.responseText;
				if(result){
					popup_tip(result, true);
					initInput();
				}else{
					popup_tip("添加失败，请重新添加", true);
				}
			}
		}
	}
	
	function initInput(){
		var requestArray = new Array("YDNumber","WZNumber", "JSNumber", "ZDNumber");
		for(var i=0;i<requestArray.length;i++){
			var inputId = requestArray[i];
			document.getElementById(inputId).value = "";
		}
		
//		var zzname_select = document.getElementById("zzname_select");
//		zzname_select.selectedIndex = 0;
//		
//		var yzname_select = document.getElementById("yzname_select");
//		yzname_select.innerHTML = "";
//		yzname_select.disabled = true;
//		yzname_select.options.add(new Option("请先选择DZZ",-1));
	}
	
	function change_zz_select(zz_id){
		var zz_select = document.getElementById("zzname_select");
		var found = false;
		for (i=0; i< zz_select.options.length; i++){
		    var option=zz_select.options[i];
		    var option_value=option.value;
		    if(option_value == zz_id){
		    	option.selected=true;
		    	found = true;
		    	break;
		    }
		}

		return found;
	}
	
	function zz_select_change(){
		var zzname = document.getElementById("zzname_select");
		var value = zzname.options[zzname.selectedIndex].value; // 选中值
		var text = zzname.options[zzname.selectedIndex].text; // 选中显示值

		var yz_name = document.getElementById("yzname_select");
		yz_name.innerHTML = "";

		if(value == -1){
			yz_name.disabled = true;
			return;
		}
		
		yz_name.options.add(new Option(text,value));
		yz_name.disabled = false;
		var yz_name_array = document.getElementsByName("yz"+value);
		for(var i=0;i<yz_name_array.length;i++){
			var option = yz_name_array[i];
			var option_value = option.value;
			if(value == option_value){
				continue;
			}

			var option_text = option.text;
			yz_name.options.add(new Option(option_text,option_value));
		}
	}

	function validate(){
		var DTZGNumber = getTrimValue("DTZGNumber");	
		var YDNumber = getTrimValue("YDNumber");	
		var WZNumber = getTrimValue("WZNumber");	
		var JSNumber = getTrimValue("JSNumber");	
		var ZDNumber = getTrimValue("ZDNumber");
		
		var requestArray = new Array(DTZGNumber,YDNumber,WZNumber, JSNumber, ZDNumber);
		var requestArrayName = new Array("ZY","YD","WZ","JS","ZD");
		for(var i=0;i<requestArray.length;i++){
			var value = requestArray[i];
			var name = requestArrayName[i];
			var requestResult = requiredInput(value, name);
			if(requestResult != true){
				popup_tip(requestResult);
				return false;
			}
			if(value.length > 20){
				popup_tip(name + "不可能大于10000");
				return false;
			}
	
			var requestNumber = requestNumberInput(value, name);
			if(requestNumber != true){
				popup_tip(requestNumber);
				return false;
			}
		}

		var message = "";
		var zzname_value = get_select_value("zzname_select");
		if(zzname_value == -1){
			message = "请选择DZZ";
		}else if(small_gt_big(YDNumber,WZNumber) || small_gt_big(YDNumber,JSNumber) || small_gt_big(YDNumber,ZDNumber)){
			message = "数据填写有误,YD肯定是最多的";
		}else if(small_gt_big(WZNumber,JSNumber)){
			message = "数据填写有误,WZ肯定是大于JS的";
		}

		if(message != ""){
			popup_tip(message);
			return false;
		}
		
		var area_value = get_select_value("area_select");
		var yzname_value = get_select_value("yzname_select");
		var yzname_value = get_select_value("yzname_select");

		var params = "zz_id="+zzname_value+"&area_id="+area_value+"&yz_id="+yzname_value+"&DTZGNumber="+
				DTZGNumber+"&YDNumber="+YDNumber+"&WZNumber="+WZNumber+"&JSNumber="+JSNumber+"&ZDNumber="+ZDNumber;
		sumbitForm(params);
		
	  	return false;
	}
	
	function get_select_value(id){
		var select = document.getElementById(id);
		if(select == null)
			return -1;
		return select.options[select.selectedIndex].value;
	}
	
	function getTrimValue(idname){
		return document.getElementById(idname).value.trim();
	}
	
	function requiredInput(value, name){
		if (value == null || value == "") {
			return name + "不能为空";
		}
		
		return true;
	}
	
	function requestNumberInput(value, name){
		if (isNaN(value)) {
			return name + "必须是数字";
		}
		return true;
	}

	function isChinese(str){
		var reg = /^[\u4E00-\u9FA5]+$/;
		return reg.test(str);
	}

	function popup_tip(tip, un_close)
	{
		var popup_div = document.getElementById("popup_div");
		var tip_div = document.getElementById("popup_tip");
		tip_div.innerHTML = tip;
		popup_div.style.visibility = "visible";
		popup_div.style.opacity = 1;
		if(!un_close){
			clearTimeout(timeout);
			timeout = setTimeout(close_tip, 1500);
		}
	}
	
	function area_filter_change()
	{
		var area_filter = document.getElementById("area_filter");
		var value = area_filter.value;
		
		var area_select = document.getElementById("area_select");
		area_select.innerHTML = "";
		
		var area_option_array = document.getElementsByName("area_option");
		for(var i=0;i<area_option_array.length;i++){
			var option = area_option_array[i];
			var option_value = option.value;
			var option_text = option.text;
			if(option_text.indexOf(value.toUpperCase()) != -1)
				area_select.options.add(new Option(option_text,option_value));
		}
	}

	function small_gt_big(big, small){
		return Number(small) > Number(big);
	}

	function close_tip()
	{
		if(is_submit)
			return;
		var popup_div = document.getElementById("popup_div");
		popup_div.style.visibility = "hidden";
		popup_div.style.opacity = 0;

	}
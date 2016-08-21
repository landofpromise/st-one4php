
	var xmlHttp;
	var is_submit=false;  
	var timeout = null;
	
	// 当页面加载完成后执行
	window.onload = function(){
		//添加事件监听，当点击页面的任意位置时，关闭页面
		document.onclick = close_tip;
		
	};
	function createXMLHttpRequest() {
		if (window.ActiveXObject) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}  
		else if (window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		}
	}

	/**
	 * 异步提交表单
	 * @param params
	 * @return
	 */
	function sumbitForm(params){
		is_submit = true;
		popup_tip("提交中...", true);
		var url = "sign_save.php";
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
				
				try{
					var result = xmlHttp.responseText;
					var json = eval("("+result+")");
					if(json.result == 1){
						popup_tip("报名成功", true);
						resetInput("nameInput");
						resetInput("phoneInput");
					}else if(json.result == 2){
						popup_tip("你已报名，请勿重复提交", true);
					}
				}catch(e){
					popup_tip("提交失败，请重新输入", true);
				}
			}
		}
	}
	
	function validate_data(){
		var name = getTrimValue("nameInput");	
		var phone = getTrimValue("phoneInput");
		var requestResult = requiredInput(name, "姓名");
		if(requestResult != true){
			popup_tip(requestResult, true);
			return false;
		}

		requestResult = requiredInput(phone, "手机号");
		if(requestResult != true){
			popup_tip(requestResult, true);
			return false;
		}

		if(name.length > 5){
			popup_tip("请输入真实姓名", true);
			return false;
		}
		if(phone.length != 11){
			popup_tip("手机号的长度应该为11位", true);
			return false;
		}

		var params = "name="+ name + "&phone=" + phone;
		sumbitForm(params);
	  	return false;
	}

	function resetInput(idname){
		var item = document.getElementById(idname);
		item.value = "";
	}
	
	/**
	 * 去掉输入信息前后的空格（如果存在空格的话）
	 * @param idname
	 * @return
	 */
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

	/**
	 * 弹出信息方法，原理很简单，修改页面可见性，将原来隐藏的对话框设置为可见。
	 * @param tip 需要弹出的内容
	 * @param un_close 是否自动关闭
	 * @return
	 */
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
	
	/**
	 * 关闭提示框
	 * @return
	 */
	function close_tip()
	{
		if(is_submit)
			return;
		var popup_div = document.getElementById("popup_div");
		popup_div.style.visibility = "hidden";
		popup_div.style.opacity = 0;

	}
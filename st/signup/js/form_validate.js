$(function() {
	$('#username').blur(validateName);
	$('#jh_name').blur(validateJHName);
	$('#phone').blur(validatePhone);
	$('#zz_name').blur(validateZZName);
	$('#zz_phone').blur(validateZZPhone);
//	$('#is_dzz').blur(muquBlurHandle);
//	$('#full').blur(muquBlurHandle);
});

function validateName(){
	return validateChineseName("username");
}

function validateJHName(){
	var value = $.trim($('#jh_name').val());
	if(!requiredInput("jh_name", value))
		return false;

	return true;
}

function validatePhone(){
	return validateMobile("phone");
}

function validateZZName(){
	return validateChineseName("zz_name");
}

function validateZZPhone(){
	return validateMobile("zz_phone");
}

function validateChineseName(field){
	var value = $.trim($('#' + field).val());

	if(!requiredInput(field, value))
		return false;
	if(!mustGtInput(field, value, 1))
		return false;
	if(!mustLtInput(field, value, 5))
		return false;
	if(!mustChineseInput(field, value))
		return false;

	return true;
}

function validateMobile(field){
	var value = $.trim($('#' + field).val());

	if(!requiredInput(field, value))
		return false;
	if(!mustNumberInput(field, value))
		return false;
	if(!mustEqInput(field, value, 11))
		return false;

	return true;
}

function showTip(field, message){
	$("#" + field).tips({
		side:2,
        msg:message,
        bg:'#B90A0A',
        time:2
    });
	// $("#" + field).focus();
}

function isChn(str) {
	var reg = /^[\u4E00-\u9FA5]+$/;
	
	return reg.test(str);
}

function requiredInput(field, value){
	if (value == null || value == "") {
		showTip(field, "请输入！");
		return false;
	}
	
	return true;
}

function mustNumberInput(field, value){
	if (isNaN(value)) {
		showTip(field, "必须输入数字");
		return false;
	}
	return true;
}

function mustChineseInput(field, value){
	if (!isChn(value)) {
		showTip(field, "必须输入中文");
		return false;
	}
	return true;
}

function mustGtInput(field, value, number){
	if (value.length <= number) {
		showTip(field, '输入长度必须大于' + number);
		return false;
	}
	return true;
}

function mustLtInput(field, value, number){
	if (value.length > number) {
		showTip(field, '输入长度必须小于' + number);
		return false;
	}
	return true;
}

function mustEqInput(field, value, number){
	if (value.length != number) {
		showTip(field, '输入长度必须等于' + number);
		return false;
	}
	return true;
}


$(function(){

	var phone = false;
	var imgyanz = false;
	var phoneyanz = false;
	$("input[name='phone']").focus(function(){
		$(this).css('border-color','blue')
	}).blur(function(){
		var len = $(this).val().length;
		if(len == 11){
			$(this).css('border-color','#e0e0e0');
			phone = true;
		}else if($(this).val() == ''||len!=11){
			$(this).css('border-color','#910');
		}
	});
	$("input[name='imgyanz']").focus(function(){
		$(this).css('border-color','blue')
	}).blur(function(){
		var len = $(this).val().length;
		if($(this).val() == ''){
			$(this).css('border-color','#910');
		}else{
			$(this).css('border-color','#e0e0e0');
		}
	});
	$(".pop_sub").on('click',function(){
		if(imgyanz){}
	})
	$(".verification_btn").on('click',function(){
		var wait = 60;
		var _this = $(this);
		var time = function(){
			if(wait == 0){
				_this.removeAttr("disabled");
				_this.val("获取验证码");
				wait = 60;
			}else{
				_this.attr("disalbed",true);
				_this.val("重新发送(" + wait + ")");
				wait--;
			}
		setTimeout(function(){
			time()
		},1000)
		}
		time()
	})
})
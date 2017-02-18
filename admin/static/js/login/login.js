
$(document).ready(function(){

	var login = $('#loginform');
	var recover = $('#recoverform');
	var speed = 400;

	$('#to-recover').click(function(){
		
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
		
		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
	
	
	$('#to-login').click(function(){
	
	});
    
    if($.browser.msie == true && $.browser.version.slice(0,3) < 10) {
        $('input[placeholder]').each(function(){ 
       
            var input = $(this);

            $(input).val(input.attr('placeholder'));

            $(input).focus(function(){
                 if (input.val() == input.attr('placeholder')) {
                     input.val('');
                 }
            });

            $(input).blur(function(){
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.val(input.attr('placeholder'));
                }
            });
        });
    }

    $('#loginform').submit(function(e){
        e.preventDefault();
        var name = $('input[name="user_id"]').val();
        var passwd = $('input[name="passwd"]').val();
        var uri = $('input[name="uri"]').val();
        var url = $(this).attr('action');
        $.ajax({
            data:{user_id: name, passwd: passwd, uri: uri},
            url: url,
            dataType: 'json',
            type: 'post',
            success: function(res){
                if(typeof res['code'] === 'undefined' || res['code'] !== 0) {
                    alert(res['msg']);
                } else {
                    window.location = res['data']['url'];
                }
            },
            error: function(res){
                console.log(res);
            }
        })

    });
});
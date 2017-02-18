if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_modify = (function() {
    function _init(){
        $('body').addClass('has-js');
        _upload();
        $('.label_check,.label_radio').click(function(){
            setupLabel();
        });
        setupLabel();
    }

    function setupLabel(){
        if($('.label_radio input').length) {
            $('.label_radio').each(function(){
                $(this).removeClass('r_on');
            });
            $('.label_radio input:checked').each(function(){
                $(this).parent('label').addClass('r_on');
            });
        };
    }

    function _upload()
    {
        $('#image_path').Huploadify({
            auto:true,
            fileTypeExts:'*.*',
            uploader:baseUrl+'/uploadfile/uploadFile/img',//请求路径
            onUploadComplete:function(file, data){
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="image_path"]').val(data.file_data);
                    $('#image_path').siblings('.js-img-show').attr('src', data.file_data).show();
                } else {
                    HZ.Dialog.showMsg({title: data.msg});
                }
            }
        });
        $('#annex_path').Huploadify({
            auto:true,
            fileTypeExts:'*.*',
            uploader:baseUrl+'/uploadfile/uploadFile/img',//请求路径
            onUploadComplete:function(file, data){
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="annex_path"]').val(data.file_data);
                    $('#annex_path').siblings('.js-img-show').attr('src', data.file_data).show();
                } else {
                    HZ.Dialog.showMsg({title: data.msg});
                }
            }
        })
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Account_modify.init();
})
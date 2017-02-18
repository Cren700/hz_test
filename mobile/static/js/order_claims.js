if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Order_claims = (function() {
    function _init(){
        $('body').addClass('has-js');
        _upload();
    }

    function _upload()
    {
        $('#letter_auth_path').Huploadify({
            auto:true,
            fileTypeExts:'*.*',
            uploader:baseUrl+'/uploadfile/uploadFile/img',//请求路径
            onUploadComplete:function(file, data){
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="letter_auth_path"]').val(data.file_data);
                    $('#letter_auth_path').siblings('.js-img-show').attr('src', data.file_data).show();
                } else {
                    HZ.Dialog.showMsg({title: data.msg});
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Order_claims.init();
})
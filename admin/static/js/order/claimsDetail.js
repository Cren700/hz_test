if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ClaimsDetail = (function() {
    function _init(){

        _upload();

        $('input, textarea').placeholder();
    }

    function _upload()
    {
        $('#file_upload').uploadify({
            'buttonClass' : 'some-class',
            'buttonText' : '选择文件',
            'progressData' : 'percentage',
            'swf'         : '/admin/static/js/uploadify/uploadify.swf',
            'uploader'    : '/admin/uploadfile/uploadFile',//请求路径
            'debug':false,//调试模式是否开启
            'fileObjName':'file_name',//文件对象的名称
            'fileTypeExts': '*.jpg;*.jpeg;*.gif;*.png',//可上传的文件类型
            'removeCompleted':true,//是否将已完成任务从队列中删除
            'width': 60,
            'height': 26,
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="letter_auth_path"]').val(data.file_data);
                    $('#js-img-show').attr('src', data.file_data).show();
                    $('.js-btn-del-cover').show();
                } else {
                    HZ.Dialog.showMsg({
                        title: '温馨提示',
                        msg: data.msg,
                        type: 'warm'
                    });
                }
            }
        });
        $('.js-btn-del-cover').on('click', function(){
            $('input[name="letter_auth_path"]').val('');
            $('#js-img-show').attr('src', '').hide();
            $('.js-btn-del-cover').hide();
        })
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.ClaimsDetail.init();
})
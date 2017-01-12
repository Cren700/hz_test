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
        $('#file_upload').uploadify({
            'buttonClass' : 'some-class',
            'buttonText' : '选择文件',
            'progressData' : 'percentage',
            'swf'         : '/mobile/static/js/uploadify/uploadify.swf',
            'uploader'    : '/mobile/uploadfile/uploadFile',//请求路径
            'debug':false,//调试模式是否开启
            'fileObjName':'file_name',//文件对象的名称
            'fileTypeExts': '*.jpg;*.jpeg;*.gif;*.png',//可上传的文件类型
            'removeCompleted':true,//是否将已完成任务从队列中删除
            'width': 60,
            'height': 26,
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="logo_path"]').val(data.file_data);
                    $('#file_upload').parents('.control-group').find('img').attr('src', data.file_data).show();
                    $('#file_upload').parents('.control-group').find('.js-btn-del-cover').show();
                } else {
                    HZ.Dialog.showMsg({title: data.msg});
                }
            }
        });

        $('#file_upload2').uploadify({
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
                    $('input[name="annex_path"]').val(data.file_data);
                    $('#file_upload2').parents('.control-group').find('img').attr('src', data.file_data).show();
                    $('#file_upload2').parents('.control-group').find('.js-btn-del-cover').show();;
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
            var $parent = $(this).parents('.control-group');
            $parent.find('.js-img-path').val('');
            $parent.find('img').attr('src', '').hide();
            $parent.find('.js-btn-del-cover').hide();
        })
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Account_modify.init();
})
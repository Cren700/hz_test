if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.UserInfo = (function() {
    function _init(){
        $('input, textarea').placeholder();

        _form();

        _upload();

        $('.js-btn-return').on('click', function(){
            window.location.href = history.go(-1);
        })

        // 禁止操作
        if ($('#js-do-val').val() == 1) {
            $('body textarea, body select, body input').attr('disabled', true);
        }
    }

    function _form()
    {
        $('#form').validate({
            submitHandler:function(form){
                $('.js-btn-submit').attr('disabled', true);
                HZ.Form.btnSubmit({
                    t: 'post',
                    u: $(form).attr('action'),
                    e: $(form),
                    callback: function(){
                        $('.js-btn-submit').attr('disabled', false);
                    }
                })
            }
        });
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
            'onFallback' :function(){ //Flash无法加载错误
                alert("您未安装FLASH控件，无法上传！请安装FLASH控件后再试。");
            },
            'onSelectError' : function(file,errorCode){  //选择文件出错
                alert('图片类型出错,请选择jpg,jpeg,gif,png图片上传');
            },
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="image_path"]').val(data.file_data);
                    $('#file_upload').parents('.control-group').find('img').attr('src', data.file_data).show();
                    $('#file_upload').parents('.control-group').find('.js-btn-del-cover').show();
                } else {
                    HZ.Dialog.showMsg({
                        title: '温馨提示',
                        msg: data.msg,
                        type: 'warm'
                    });
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
            'onFallback' :function(){ //Flash无法加载错误
                alert("您未安装FLASH控件，无法上传！请安装FLASH控件后再试。");
            },
            'onSelectError' : function(file,errorCode){  //选择文件出错
                alert('图片类型出错,请选择jpg,jpeg,gif,png图片上传');
            },
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="annex_path"]').val(data.file_data);
                    $('#file_upload2').parents('.control-group').find('img').attr('src', data.file_data).show();
                    $('#file_upload2').parents('.control-group').find('.js-btn-del-cover').show();
                } else {
                    HZ.Dialog.showMsg({
                        title: '温馨提示',
                        msg: data.msg,
                        type: 'warm'
                    });
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.UserInfo.init();
})
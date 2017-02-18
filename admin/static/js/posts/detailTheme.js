if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.DetailTheme = (function() {
    function _init(){
        $('input, textarea').placeholder();

        _form();

        _upload();
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
            },
            rules:{
                theme_title:{
                    required:true,
                    minlength: 10,
                    maxlength: 200
                }
            },
            messages: {
                theme_title : {required:'请输入专题的标题', minlength: '标题至少10个字符', maxlength: '标题不超过200个字符'},
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
            }
        });
    }

    function _upload()
    {
        $('#file_upload').uploadify({
            'buttonClass' : 'some-class',
            'buttonText' : '选择文件',
            'progressData' : 'percentage',
            'swf'         : baseUrl+'/static/js/uploadify/uploadify.swf',
            'uploader'    : baseUrl+'/uploadfile/uploadFile',//请求路径
            'debug':false,//调试模式是否开启
            'fileObjName':'file_name',//文件对象的名称
            'fileTypeExts': '*.jpg;*.jpeg;*.gif;*.png',//可上传的文件类型
            'removeCompleted':true,//是否将已完成任务从队列中删除
            'width': 60,
            'height': 26,
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="theme_coverimage"]').val(data.file_data);
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
            'swf'         : baseUrl+'/static/js/uploadify/uploadify.swf',
            'uploader'    : baseUrl+'/uploadfile/uploadFile',//请求路径
            'debug':false,//调试模式是否开启
            'fileObjName':'file_name',//文件对象的名称
            'fileTypeExts': '*.jpg;*.jpeg;*.gif;*.png',//可上传的文件类型
            'removeCompleted':true,//是否将已完成任务从队列中删除
            'width': 60,
            'height': 26,
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="banner_path"]').val(data.file_data);
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
    HZ.DetailTheme.init();
})
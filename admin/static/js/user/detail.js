if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.User = (function() {
    function _init(){
        $('input, textarea').placeholder();

        _form();

        _upload();
    }

    function _form()
    {
        $('#form').validate({
            submitHandler:function(form){
                // 手动判断证件照片是否上传
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
                real_name:{
                    required:true
                },
                industry:{
                    required:true
                },
                cert_type:{
                    required:true,
                    digits: true
                },
                cert_no:{
                    required:true,
                    digits: true
                },
                email:{
                    required:true,
                    email: true
                },
                phone:{
                    required:true
                },
                address:{
                    required:true
                }
            },
            messages: {
                real_name : {required:'请输入门店名或者企业名'},
                industry : {required:'请输入企业所处行业'},
                cert_type : {required:'请选择证件类型',digits: '证件类型必须是整数'},
                cert_no : {required:'请输入证件号码',digits: '证件号码必须是整数'},
                email : {required:'请输入资讯内容', email: '邮箱错误'},
                phone: '请输入电话号码',
                address : '请输入个人或者企业地址'
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
                    $('input[name="logo_path"]').val(data.file_data);
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
    HZ.User.init();
})
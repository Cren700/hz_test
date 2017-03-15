if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PromoDetail = (function() {
    function _init(){
        $('input, textarea').placeholder();

        _upload();

        // 禁止操作
        if ($('#js-do-val').val() == 1) {
            $('body textarea, body select, body input').attr('disabled', true);
        }

        $('#form').validate({
            submitHandler:function(form){
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
                active_name:{
                    required:true
                },
                category_id:{
                    required:true,
                    digits: true
                },
                image_path:{
                    required:true,
                    /*min: 0,*/
                    digits: true
                },
                active_url:{
                    required:true
                }
            },
            messages: {
                active_name : '请输入广告名称',
                category_id : {required:'请选择广告分类',digits: '必须是整数'},
                image_path : {required:'请添加图片'},
                active_url : {required:'请输入正确链接地址'}
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
                    $('input[name="image_path"]').val(data.file_data);
                    $('#js-img-cover').attr('src', data.file_data).show();
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
            $('input[name="post_coverimage"]').val('');
            $('#js-img-cover').attr('src', '').hide();
            $('.js-btn-del-cover').hide();
        })
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.PromoDetail.init();
})
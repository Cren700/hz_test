if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostsDetail = (function() {
    function _init(){
        $('input, textarea').placeholder();

        _form();

        _upload();

        _ueditir();
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
                post_title:{
                    required:true,
                    minlength: 10,
                    maxlength: 200
                },
                post_author:{
                    required:true
                },
                category_id:{
                    required:true,
                    digits: true
                },
                post_content:{
                    required:true
                }
            },
            messages: {
                post_title : {required:'请输入资讯的标题', minlength: '标题至少十个字符', maxlength: '标题不超过200个字符'},
                post_author : {required:'请输入资讯的作者'},
                category_id : {required:'请选择资讯分类',digits: '资讯分类必须是整数'},
                post_content : '请输入资讯内容'
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
                    $('input[name="post_coverimage"]').val(data.file_data);
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

    function _ueditir()
    {
        var $content = $('#ud-content');
        var ue = UE.getEditor('ud-content', {
            autoHeightEnabled: true,
            autoFloatEnabled: true,
        });

        // 初始化数据
        ue.ready(function() {
            ue.setContent($content.val());
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.PostsDetail.init();
})
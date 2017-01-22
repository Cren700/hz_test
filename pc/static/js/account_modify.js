if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_modify = (function() {
    function _init(){
        $('body').addClass('has-js');
        _upload();

        _submit();

        var atte_status = $('input[name="atte_status"]').val();
        if (atte_status!=0) {
            $('#form').find('input, select').attr('disabled', true);
        }
    }

    function _submit()
    {
        $('#form').submit(function (e) {
            e.preventDefault();
            var url = $('#form').attr('action');
            $.ajax({
                data: $(this).serialize(),
                dataType: "json",
                type: 'post',
                url: url,
                success: function () {
                    HZ.Dialog.showMsg({
                        title: '提交成功'
                    });
                }
            })
        });
    }

    function _upload()
    {
        $('#image_path').uploadify({
            'buttonClass' : 'some-class',
            'buttonText' : '上传图片',
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
                    $('input[name="image_path"]').val(data.file_data);
                    $('#image_path').parents('li').find('img').attr('src', data.file_data).show();
                    var url = baseUrl + "/account/modifyHdImg";
                    var getData = {hdImg: data.file_data};
                    $.get(url, getData, function(res){
                        if(res.code != 0) {
                            HZ.Dialog.showMsg({
                                title: data.msg
                            });
                        }
                    }, 'json')
                } else {
                    HZ.Dialog.showMsg({
                        title: data.msg
                    });
                }
            }
        });

        $('#annex_path').uploadify({
            'buttonClass' : 'some-class',
            'buttonText' : '上传图片',
            'progressData' : 'percentage',
            'swf'         : baseUrl+'/static/js/uploadify/uploadify.swf',
            'uploader'    : baseUrl+'/uploadfile/uploadFile',//请求路径
            'debug':false,//调试模式是否开启
            'fileObjName':'file_name',//文件对象的名称
            'fileTypeExts': '*.jpg;*.jpeg;*.gif;*.png',//可上传的文件类型
            'removeCompleted':true,//是否将已完成任务从队列中删除
            'width': 80,
            'height': 26,
            'onUploadSuccess' : function(file, data, response) {
                data = JSON.parse(data);
                if(data.code == 0){
                    $('input[name="annex_path"]').val(data.file_data);
                    $('#annex_path').parents('li').find('img').attr('src', data.file_data).show();
                } else {
                    HZ.Dialog.showMsg({
                        title: data.msg
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
    HZ.Account_modify.init();
})
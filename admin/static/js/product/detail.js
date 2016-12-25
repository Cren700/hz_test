if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductDetail = (function() {
    function _init(){

        _upload();

        var _index_rule = $('.js-txt-rule-count').length,
            _index_process = $('.js-txt-process-count').length,
            _index_qa = $('.js-txt-qa-count').length,
            _index_pledge = $('.js-txt-pledge-count').length;
        $('input, textarea').placeholder();

        _ueditir($('#ud-content'), 'ud-content');

        $('.ueditor-box').find('textarea').each(function(){
            var _id = $(this).attr('id');
            _ueditir($('#'+_id), _id);
        });

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
                product_name:{
                    required:true
                },
                category_id:{
                    required:true,
                    digits: true
                },
                product_num:{
                    required:true,
                    min: 0,
                    digits: true
                },
                product_price:{
                    required:true
                }
            },
            messages: {
                product_name : '请输入产品名称',
                category_id : {required:'请选择产品分类',digits: '必须是整数'},
                product_num : {required:'请输入库存数量', min:'库存不小于0',digits: '库存数量必须是整数'},
                product_price : '请输入产品价格'
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

        // 添加计划规则
        $('#js-btn-rule-add').on('click', function(){
            var tpl = '\
                <div class="span10" style="margin: 10px 0 0 0" >\
                <textarea type="text" class="span5" name="rule_title['+_index_rule+']" placeholder="标题"></textarea>\
                <textarea type="text" class="span7" name="rule_description['+_index_rule+']" placeholder="描述"></textarea>\
                </div>\
                <input type="hidden" class="js-txt-rule-count">';
            $('#js-box-rule').append(tpl);
            _index_rule++;
        });

        // 添加申请流程
        $('#js-btn-process-add').on('click', function(){
            var tpl = '\
                <div class="span10" style="margin: 10px 0 0 0" >\
                <textarea type="text" class="span5" name="process_title['+_index_process+']" placeholder="标题"></textarea>\
                <textarea type="text" class="span7" name="process_description['+_index_process+']" placeholder="描述"></textarea>\
                </div>\
                <input type="hidden" class="js-txt-process-count">';
            $('#js-box-process').append(tpl);
            _index_process++;
        });

        // 添加常见问题
        $('#js-btn-qa-add').on('click', function(){
            var content_id = 'qa-content-'+_index_qa;
            var tpl = '\
                <div style="margin-top: 10px">\
                <input type="text" class="span10" name="question['+_index_qa+']" placeholder="问题">\
                </div>\
                <div class="span10" style="margin-left: 0" >\
                <textarea id="'+content_id+'" name="answer['+_index_qa+']"></textarea>\
                </div>\
                <input type="hidden" class="js-txt-qa-count">';
            $('#js-box-qa').append(tpl);
            _ueditir($('#'+content_id), content_id);
            _index_qa++;
        });

        // 添加公约内容
        $('#js-btn-pledge-add').on('click', function(){
            var content_id = 'pledge-content-'+_index_pledge;
            var tpl = '\
                <div style="margin-top: 10px">\
                <input type="text" class="span10" name="pledge_title['+_index_rule+']" placeholder="标题">\
                </div>\
                <div class="span10" style="margin-left: 0" >\
                <textarea id="'+content_id+'" name="pledge_content['+_index_rule+']"></textarea>\
                </div>\
                <input type="hidden" class="js-txt-pledge-count">';
            $('#js-box-pledge').append(tpl);
            _ueditir($('#'+content_id), content_id);
            _index_pledge++;
        })
    }

    function _ueditir(content, el)
    {
        var ue = UE.getEditor(el, {
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            initialFrameHeight: 100,
            toolbars: [[
            	'undo', 'redo' , '|',
            	'bold','italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat',  'forecolor' , 'autotypeset', 'pasteplain' , '|', '|',
            	'justifyleft', 'justifycenter' , 'fontfamily', 'fontsize', '|',
            	'link', 'unlink' ,  '|',
                'simpleupload', 'insertvideo' , '|',
            	'wordimage', '|' ,
            	'inserttable', 'insertrow' , 'deleterow', 'insertcol', 'deletecol' , 'mergecells', 'splittocells'
            ]]
        });

        // 初始化数据
        if ( typeof content != "undefined" && content.val()) {
            ue.ready(function() {
                ue.setContent(content.val());
            });
        }
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
                    $('input[name="coverimage"]').val(data.file_data);
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
    HZ.ProductDetail.init();
})
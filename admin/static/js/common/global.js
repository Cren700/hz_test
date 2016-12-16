if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Global = (function() {
    // 退出登录
    function _logout(){
        HZ.Dialog.showMsg({
            title: '温馨提示',
            msg: '是否退出登录?',
            type: 'confirm',
            yesText: "确 定",
            closeText: "关 闭",
            btnConfirm: function(){
                $.ajax({
                    url: baseUrl + '/login/logout.html',
                    dataType: 'JSON',
                    success: function(res){
                        window.location.href = res.data.url;
                    }
                })
            }
        })
    }
    return {
        logout: _logout
    }
})();


HZ.Form = (function () {
    /**
     * 表单提交
     * @param e 表单元素
     * @param u URL
     * @param t type
     */
    function btnSubmit(f){
        var t = {
            t: 'get',
            e: null,
            u: null,
            d: null,
            callback: null,
        };
        $.extend(t, f); // 传递参数
        $.ajax({
            data: t.d ? t.d : t.e.serialize(),
            dataType: 'json',
            type: t.t,
            url: t.u,
            success: function (res) {
                if(res.code != 0) {
                    HZ.Dialog.showMsg({
                        title: '温馨提示',
                        msg: res.msg,
                        type: 'warm'
                    })
                } else {
                    if (typeof(res.data) !== 'undefined' && typeof(res.data.url) !== 'undefined' && res.data.url != '') {
                        HZ.Dialog.showMsg({
                            title: '温馨提示',
                            msg: "操作成功",
                            type: 'msg',
                            url: res.data.url
                        });
                    } else {
                        HZ.Dialog.showMsg({
                            title: '温馨提示',
                            msg: "操作成功",
                            type: 'msg'
                        });
                    }
                }
                t.callback && t.callback();
            },
            error: function () {
                HZ.Dialog.showMsg({
                    title: '温馨提示',
                    msg: '操作有误',
                    type: 'warm'
                });
                t.callback && t.callback();
            }
        });
    }

    return {
        btnSubmit: btnSubmit
    }
})();

/**
 * 弹窗API
 * @type {{init, showMsg, closeMsg}}
 */
HZ.Dialog = (function() {

    var closeUrl ;
    function init() {
        $(document).on( 'click', '.js-dialog-btn-cancel', function(){
            closeMsg();
        })
    }
    function showMsg(f) {
        var t = {
            title: '温馨提示',
            msg: '',
            type: 'msg',// msg, confirm, warm
            yesText: "确 定",
            closeText: "关 闭",
            url: null,  // 跳转URL
            btnConfirm: null, // 确定按钮
            btnCancel: null // 取消按钮
        };
        $.extend(t, f);
        closeUrl = t.url;

        var tmpDialogStart = '\
        <div class="js-window-dialog modal-backdrop  in"></div>\
        <div class="js-window-dialog modal hide in" aria-hidden="false" style="display: block;">\
            <div class="modal-header">\
            <button data-dismiss="modal" class="close js-dialog-btn-cancel" type="button">×</button>\
        <h3>{title}</h3>\
        </div>\
        <div class="modal-body">\
            <p class="text-center">{showMsg}</p>\
        </div>';
        var btnDialog = '<div class="modal-footer"><a data-dismiss="modal" class="btn btn-primary js-dialog-btn-sure" href="#">{yesText}</a> <a data-dismiss="modal" class="btn js-dialog-btn-cancel" href="#">{closeText}</a> </div>';
        var tmpDialogEnd = '</div>';

        // 处理弹窗
        tmpDialogStart = tmpDialogStart.replace('{title}', t.title).replace('{showMsg}', t.msg);
        if(t.type == 'confirm') {
            btnDialog = btnDialog.replace('{yesText}', t.yesText).replace('{closeText}', t.closeText);
            tmpDialogStart += btnDialog; // 弹窗按钮
        }
        $(document).find('body').append(tmpDialogStart+tmpDialogEnd); // 完成了弹窗的样式

        if(t.type == 'warm') {
            $('.js-window-dialog').find('.modal-header').find('h3').css('color', 'red');
            $('.js-window-dialog').find('.modal-body').css('color', 'red');
        }

        $('.js-dialog-btn-sure').on('click', function () {
            closeMsg();
            t.btnConfirm();
        });
        $('.js-dialog-btn-cancel').on('click', function () {
            if(t.btnCancel){
                t.btnCancel();
            }
            closeMsg();
        });
    }

    function closeMsg() {
        $(document).find('body').find('.js-window-dialog').remove();
        if(closeUrl) {
            window.location.href = closeUrl;
        }
    }
    return {
        init: init,
        showMsg: showMsg,
        closeMsg: closeMsg
    }
})();
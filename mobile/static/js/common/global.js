if (typeof (YPAPP) == "undefined" || !YPAPP) {
    var YPAPP = {}
}

YPAPP.Global = (function() {


})();

YPAPP.Dialog = (function() {

    var closeUrl ;
    function init() {
        $(document).on( 'click', '#js-dialog-close', function(){
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
        var tmpDialogStart = '<div class="window-dialog window-show dialog-msg" style="width: 440px;">\
                            <div class="window-dialog-head">\
                                <div class="window-dialog-title" style="text-align: center;">{title}</div>\
                                <a href="javascript:;" class="window-dialog-close" id="js-dialog-close" title="关闭对话框">×</a>\
                            </div>\
                            <div class="window-dialog-content">\
                                <div class="dialog-show-msg">{showMsg}</div>\
                            </div>';
        var tmpDialogEnd = '</div>\
                                <div class="window-mask header_login_windows_mask" style="display: block;">\
                            </div>';
        var btnDialog = '<div class="window-dialog-btn">\
                            <button class="dialog-btn" id="js-dialog-btn-sure">{yesText}</button>\
                            <button class="dialog-btn" id="js-dialog-btn-cancel">{closeText}</button>\
                        </div>';
        tmpDialogStart = tmpDialogStart.replace('{title}', t.title).replace('{showMsg}', t.msg);
        if(t.type == 'confirm') {
            btnDialog = btnDialog.replace('{yesText}', t.yesText).replace('{closeText}', t.closeText);
            tmpDialogStart += btnDialog; // 弹窗按钮
        }
        $(document).find('body').append(tmpDialogStart+tmpDialogEnd); // 完成了弹窗的样式
        if(t.type == 'warm') {
            $(document).find('.dialog-show-msg').css('color', '#D00');
        }
        $('#js-dialog-btn-sure').on('click', function () {
            t.btnConfirm();
        });
        $('#js-dialog-btn-cancel').on('click', function () {
            t.btnCancel();
            closeMsg();
        });
    }

    function closeMsg() {
        $(document).find('body').find('.window-dialog').remove();
        $(document).find('body').find('.window-mask').remove();
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

YPAPP.Form = (function () {
    /**
     * 表单提交
     * @param e 元素
     * @param u URL
     */
    function btnSubmit(e, u){
        $.ajax({
            data: e.serialize(),
            dataType: 'json',
            type: 'post',
            url: u,
            success: function (res) {
                console.log(res);
                if(res.code != 0) {
                    YPAPP.Dialog.showMsg({
                        title: '温馨提示',
                        msg: res.msg,
                        type: 'warm'
                    })
                } else {
                    if (typeof(res.data.url) !== 'undefined' && res.data.url != '') {
                        console.log(res.data.url);
                        YPAPP.Dialog.showMsg({
                            title: '温馨提示',
                            msg: "操作成功",
                            type: 'msg',
                            url: res.data.url
                        });
                    } else {
                        YPAPP.Dialog.showMsg({
                            title: '温馨提示',
                            msg: "操作成功",
                            type: 'msg'
                        });
                    }

                }
            },
            error: function () {
                console.log('submit error');
            }
        })
    }

    return {
        btnSubmit: btnSubmit
    }
})();
$(document).ready(function () {
    YPAPP.Dialog.init();
})
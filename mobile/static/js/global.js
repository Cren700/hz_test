if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Global = (function() {
    function _init(){
        // 格式化时间
        $('.js-date-dif').each(function(){
            var u_time = $(this).attr('rel');
            $(this).text(getDateDiff(u_time)).removeClass('js-date-dif');
        });
        
        var items = document.querySelectorAll('.menuItem');

        for(var i = 0, l = items.length; i < l; i++) {
            items[i].style.left = (50 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";

            items[i].style.top = (50 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
        }

        $('.menu_nav').on('click', function(e){
            e.preventDefault();
            $('.circle').addClass('open');
            $('.circle_box').addClass('show');
        });

        $('.center').on('click', function(e){
            e.preventDefault();
            $('.circle').removeClass('open');
            $('.circle_box').removeClass('show');
        });
    }

    return {
        init: _init
    }
})();

HZ.ISLOGIN = (function(){
    function _init()
    {
        if (typeof _uid == 'undefined' || typeof _username == 'undefined') {
            // 未登录
            HZ.Dialog.showMsg({title:"还没登录哦,请先登录"});
            return false;
        }
        return true;
    }
    return {init: _init}
})();

/**
 * 弹窗API
 * @type {{init, showMsg, closeMsg}}
 */
HZ.Dialog = (function() {

    function init() {
        $(document).on( 'click', '.js-dialog-btn-cancel', function(){
            closeMsg();
        })
    }
    function showMsg(f) {
        var t = {
            title: '温馨提示'
        };
        $.extend(t, f);

        var tmpDialog = '\
            <div id="layermbox" class="layermbox layermbox0 layermshow" ><div class="laymshade"></div><div class="layermmain"><div class="section"><div class="layermchild layermanim"><div class="layermcont">{title}</div></div></div></div></div>';

        // 处理弹窗
        tmpDialog = tmpDialog.replace('{title}', t.title);
        $(document).find('body').append(tmpDialog); // 完成了弹窗的样式

        setTimeout(closeMsg, 3000);
    }
    function closeMsg() {
        if ($('#layermbox').length > 0) {
            $('#layermbox').remove();
        }
    }
    return {
        init: init,
        showMsg: showMsg,
    }
})();

$(document).ready(function(){
    HZ.Global.init();
});
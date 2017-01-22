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

        $('.search_btn').on('click', function(){
            var keyword = $(this).parent().find('.search_txt').val();
            if(!$.trim(keyword)) {
                HZ.Dialog.showMsg({title: '请输入搜索关键词'});
            } else {
                $(this).parent('form[name="search_form"]').submit();
            }
        })

    }

    return {
        init: _init
    }
})();

HZ.DateFormat = (function(){
    var minute = 1000 * 60;
    var hour = minute * 60;
    var day = hour * 24;
    var halfamonth = day * 15;
    var month = day * 30;

    function getDateDiff(dateTimeStamp) {
        var now = new Date().getTime();
        var diffValue = now - dateTimeStamp*1000;
        if (diffValue < 0) {
            //若日期不符则弹出窗口告之
            //alert("结束日期不能小于开始日期！");
        }
        var monthC = diffValue / month;
        var weekC = diffValue / (7 * day);
        var dayC = diffValue / day;
        var hourC = diffValue / hour;
        var minC = diffValue / minute;
        if (monthC >= 6) {
            var date = new Date(dateTimeStamp*1000);
            var d_str = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate();
            result = d_str;
        } else if( monthC >= 1 && monthC < 6) {
            result = parseInt(monthC) + "个月前";
        }
        else if (weekC >= 1) {
            result = parseInt(weekC) + "周前";
        }
        else if (dayC >= 1) {
            result = parseInt(dayC) + "天前";
        }
        else if (hourC >= 1) {
            result = parseInt(hourC) + "个小时前";
        }
        else if (minC >= 1) {
            result = parseInt(minC) + "分钟前";
        } else
            result = "刚刚";
        return result;
    }

    return {time: getDateDiff}
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
        <div id="layermbox">\
            <div class="xubox_shade" style="z-index:19891020; background-color:#000; opacity:0.3; filter:alpha(opacity=30);"></div>\
            <div style="z-index: 19891025; width: auto; height: auto; top: 208px; margin-left: -69px;" id="xubox_layer11" class="xubox_layer" type="dialog"><div style="z-index: 19891025; height: 45px; background-color: rgb(255, 255, 255);" class="xubox_main"><div class="xubox_dialog"><span class="xubox_msg xubox_text" style="padding-left: 20px; margin-top: 12px;">{title}</span></div></div><div id="dialog_border" class="xubox_border" style="z-index: 19891024; opacity: 0.3; top: -8px; left: -8px; height: 61px; background-color: rgb(0, 0, 0);"></div></div></div>';

        // 处理弹窗
        tmpDialog = tmpDialog.replace('{title}', t.title);
        $(document).find('body').append(tmpDialog); // 完成了弹窗的样式
        var border_width = $('.xubox_main').width();
        $('#dialog_border').width(border_width+16);
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
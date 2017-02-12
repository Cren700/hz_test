if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Medium = (function() {
    var p = 1;
    var flag = true;
    function _init(){
        // 获取列表
        _getList(p);
        p++;

        $(window).scroll(function () {
            _scroll();
        })
    }

    function _getList(p){
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/info/mediumQuery',
            data: {p: p},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if(res === '') {
                    flag = false;
                    return false;
                }
                flag = true;
                $('.nav_list').append(res);
                $('.js-date-dif').each(function(){
                    var u_time = $(this).attr('rel');
                    $(this).text(getDateDiff(u_time)).removeClass('js-date-dif');
                })
            }
        });
    }

    function _scroll()
    {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        var re_hegith = 80;
        if (scrollTop + windowHeight + re_hegith * 2 > scrollHeight) {
            if (flag) {
                flag = false;
                _getList(p);
                p++;
            }
        }
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Medium.init();
})
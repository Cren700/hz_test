if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostsDetail = (function() {
    function _init(){
        // 格式化时间
        $('.js-date-dif').each(function(){
            var u_time = $(this).attr('rel');
            $(this).text(getDateDiff(u_time)).removeClass('js-date-dif');
        });

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

$(document).ready(function(){
    HZ.PostsDetail.init();
})
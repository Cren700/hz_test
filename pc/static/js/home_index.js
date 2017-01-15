if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Home = (function() {
    var p = 1;
    function _init(){

        // 获取列表
        _getList(p);

        $('#js-btn-more').on('click', function(e) {
            e.preventDefault();
            _getList(++p);
        });

        $(document).on('scroll resize',function(){
            var docTop = $(document).scrollTop();
            var contL = $(".content_left").offset().left;
            var sidebarL = $(".sidebar").offset().left;
            var tab = $(".tab_list_item").attr('style','display:block');
            var tab_top = tab.offset().top;
            if(docTop >= tab_top-80){
                $(".nav_tab").addClass("fixed").css({
                    'top' : 0,
                    left : contL
                })
            }else if(docTop<365){
                $(".nav_tab").removeClass("fixed").css({
                    left : contL
                })
            };
        });
    }

    function _getList(p){

        var cate_id = $('input[name="cate_id"]').val();
        $.ajax({
            url: baseUrl+'/home/getPostsList',
            data: {p: p, post_category_id: cate_id, status: status},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if ($.trim(res)) {
                    $('#js-news-box').append(res);
                    $('.js-date-dif').each(function () {
                        var u_time = $(this).attr('rel');
                        $(this).text(HZ.DateFormat.time(u_time)).removeClass('js-date-dif');
                    });
                    var num = res.split('<li>').length-1;
                    if(num < 10) {
                        $("#js-btn-more").remove();
                    }
                } else {
                    $("#js-btn-more").remove();
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Home.init();
})
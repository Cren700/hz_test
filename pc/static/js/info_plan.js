if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.InfoPlan = (function() {
    function _init(){

        $('.js-btn-my-order').on('click', function(){
            $(this).addClass("active");
            $('.js-btn-my-collect').removeClass('active');
            $('#js-my-order').show();
            $('#js-my-collect').hide();
        });

        $('.js-btn-my-collect').on('click', function(){
            $(this).addClass("active");
            $('.js-btn-my-order').removeClass('active');
            $('#js-my-order').hide();
            $('#js-my-collect').show();
        });


        $(".pro_info_dd").find("a").on('mouseover',function(){
            $(this).parent().hide().siblings().show()
        })
        $(".pro_info_jj").children(".pro_info_jj_img").on('mouseleave',function(){
            $(this).parent().hide().siblings().show()
        });
        
        // 我的订单
        $('.js-my-order').on('click', function () {
            $('#js-my-collect-box').hide();
            $('#js-my-order-box').show();
        });
        // 我的收藏
        $('.js-my-collect').on('click', function () {
            $('#js-my-order-box').hide();
            $('#js-my-collect-box').show();
        });

    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.InfoPlan.init();
})
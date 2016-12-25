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

$(document).ready(function(){
    HZ.Global.init();
})
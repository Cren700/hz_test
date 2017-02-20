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

        $('.js-btn-my-order').click();
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.InfoPlan.init();
})
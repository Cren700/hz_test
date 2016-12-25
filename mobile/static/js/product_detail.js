if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductDetail = (function() {
    function _init(){
        $('#js-checkProblem').on('click', function(){
            $('.problem_section').show();
            $('.general').hide();
        });

        $('.return_btn').on('click', function(){
            $('.problem_section').hide();
            $('.general').show();
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.ProductDetail.init();
})
if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.OrderStat = (function() {
    function _init(){
        // 获取列表
        _getData();

        $('.datepicker').datepicker();

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getData();
        });

    }

    function _getData(){
        var date = $('input[name="date"]').val();
        $.ajax({
            url: baseUrl+'/finance/queryOrderStat.html',
            data: {date:date},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#orderStat').length)
                {
                    $('#orderStat').remove();
                }
                $('#content .container-fluid').append(res);
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.OrderStat.init();
});
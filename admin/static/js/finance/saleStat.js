if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.SaleStat = (function() {
    function _init(){
        // 获取列表
        _getList();
        
        $('.datepicker').datepicker();

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var p = $(this).attr('data-ci-pagination-page');
            _getList(p);
        });

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getList();
        });

    }

    function _getList(p){

        var min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val();
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/finance/querySaleStat.html',
            data: {p: p, min_date: min_date, max_date: max_date},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#sale-list-content').html()) {
                    $('#sale-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.SaleStat.init();
})
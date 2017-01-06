if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.FinanceAccount = (function() {
    function _init(){
        // 获取列表
        _getList();

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

        var user_type = $('select[name="user_type"]').val(),
            user_id = $('input[name="user_id"]').val(),
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/finance/queryAccount.html',
            data: {p: p, user_type: user_type, user_id:user_id},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#account-list-content').html()) {
                    $('#account-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.FinanceAccount.init();
})
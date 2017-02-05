if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Comment = (function() {
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

        var post_id = $('input[name="post_id"]').val(),
            user_id = $('input[name="user_id"]').val(),
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/posts/queryPraise.html',
            data: {p: p, post_id: post_id, user_id:user_id},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#praise-list-content').html()) {
                    $('#praise-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Comment.init();
})
if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Theme = (function() {
    var p = 1;
    var flag = true;
    function _init(){

        // 获取列表
        _getList(p);
        p++;

        $('.js-next-page').on('click', function(){
            _getList(p);
            p++;
        })

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getList();
        });
    }

    function _getList(p){

        var cate_id = $('input[name="cate_id"]').val();
        $.ajax({
            url: baseUrl+'/theme/getPostsList',
            data: {p: p, post_category_id: cate_id, status: status},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if(res === '') {
                    flag = false;
                    return false;
                }
                flag = true;
                $('.new_item_shape').append(res);
                $('.js-date-dif').each(function(){
                    var u_time = $(this).attr('rel');
                    $(this).text(getDateDiff(u_time)).removeClass('js-date-dif');
                })
            }
        });
    }

    function _scroll()
    {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        var re_hegith = 80;
        if (scrollTop + windowHeight + re_hegith * 2 > scrollHeight ) {
            if (flag) {
                flag = false;
                _getList(p);
                p++;
            }
        }
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Theme.init();
})
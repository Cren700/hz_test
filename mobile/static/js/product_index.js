if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductIndex = (function() {
    var p = 1;
    var flag = true;
    function _init(){

        // 获取列表
        _getList(p);

        p++;

        $(window).scroll(function () {
            _scroll();
        });
    }

    function _getList(p){

        var cate_id = $('input[name="cate_id"]').val();
        $.ajax({
            url: baseUrl+'/product/getProductList.html',
            data: {p: p, category_id: cate_id, status: status},
            dataType: 'HTML',
            type: 'GET',
            async: false,
            success: function(res){
                if(res === '') {
                    flag = false;
                    return false;
                }
                $('.new_item').append(res);
                flag = true;
            }
        });
    }

    function _scroll()
    {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        var re_hegith = 80;
        if (scrollTop + windowHeight + re_hegith * 2 > scrollHeight) {
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
    HZ.ProductIndex.init();
})
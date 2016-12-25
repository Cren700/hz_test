if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductIndex = (function() {
    var p = 1;
    function _init(){

        // 获取列表
        _getList(p);
        p++;

        $('.js-next-page').on('click', function(){
            _getList(p);
            p++;
        });
    }

    function _getList(p){

        var cate_id = $('input[name="cate_id"]').val();
        $.ajax({
            url: baseUrl+'/product/getProductList.html',
            data: {p: p, category_id: cate_id, status: status},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if(res === '') {
                    $('.js-next-page').hide();
                    return false;
                }
                $('.new_item').append(res);
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.ProductIndex.init();
})
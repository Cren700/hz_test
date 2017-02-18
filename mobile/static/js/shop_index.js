if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Shop = (function() {
    function _init(){
        delCart();

        buyAction();

        $('.buyCount').on('blur', function () {
            update($(this));
        })
    }

    function delCart()
    {
        $('.js-btn-del').on('click', function(){
            if (confirm('是否删除该产品?')){
                var _this = $(this);
                var url = _this.data('url');
                $.ajax({
                    url: url,
                    data: {},
                    dataType: 'json',
                    type: 'GET',
                    success: function(res){
                        if (res.code == 0)
                        {
                            _this.parents('.orderItem').remove();
                            HZ.Dialog.showMsg({title: '成功移除购物车'});
                        } else {
                            HZ.Dialog.showMsg({title: res.msg});
                        }
                    }
                });
            }
        });
    }

    function buyAction()
    {
        $('.js-btn-buy').on('click', function(){
            var cid = $(this).data('cid');
            location.href = baseUrl+'/order/preview.html?cid='+cid;
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Shop.init();
})
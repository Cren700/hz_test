if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Shop = (function() {
    function _init(){
        delCart();

        buyAction();

        changeNumber();
    }

    function delCart()
    {
        $('.js-btn-del').on('click', function(){
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
                        _this.parents('.cart-content-list-li').remove();
                        HZ.Dialog.showMsg({title: '成功移除购物车'});
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
                    }
                }
            });
        });
    }

    function buyAction()
    {
        $('.js-btn-buy').on('click', function(){
            var cid = $(this).data('cid');
            location.href = baseUrl+'/order/preview.html?cid='+cid;
        });
    }

    function changeNumber(){

        $(".cart-content-save-commodity span").each(function(){
            var _this = $(this),
                up = _this.find(".cart-content-save-add"),
                down = _this.find(".cart-content-save-reduce"),
                result = _this.find(".cart-content-save-result"),
                on = result.val();

            function add(){
                on ++;
                on = on > 99 ? 99 : on;
            }

            function min(){
                on --;
                on = on < 1 ? 1 : on;
            }

            function method(){
                result.val(on);
            }
            //Request data and modify the data
            function calTotal(id)
            {
                var url = baseUrl+"/shop/update.html";
                on = on < 1 ? 1 : on;
                $.post(url, {id:id, count:on}, function(data){
                    if(data['code'] != '0')
                    {
                        showText(".select-info", data['msg']);
                    }
                }, 'json');
            }

            up.on("touchend",function(){
                add();
                method();
                var pid = $(this).attr('data');
                calTotal(pid);
            });

            down.on("touchend",function(){
                if(on == 1)
                {
                    showText(".select-info", "Sorry, item quantities can't be 0.");
                    return false;
                }
                min();
                method();
                var pid = $(this).attr('data');
                calTotal(pid);
            });
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Shop.init();
})
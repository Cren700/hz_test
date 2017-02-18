if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductDetail = (function() {
    function _init(){
        collect();
        addCart();
        
        $('#js-checkProblem').on('click', function(){
            $('#problem-page').show();
            $('.general').hide();
        });
        $('#js-checkPlan').on('click', function(){
            $('#plan-page').show();
            $('.general').hide();
        });
        $('#js-checkDemand').on('click', function(){
            $('#demand-page').show();
            $('.general').hide();
        });

        $('.return_btn').on('click', function(){
            $('.problem_section').hide();
            $('.general').show();
        });
    }

    function collect()
    {
        $('#js-btn-collect').on('click', function(){
            var pid = $('input[name="pid"]').val();
            var _this = $(this);
            $.ajax({
                url: baseUrl+'/shop/collect.html',
                data: {pid: pid},
                dataType: 'json',
                type: 'GET',
                success: function(res){
                    if (res.code == 0)
                    {
                        if (_this.find('i').hasClass('no_collect')) {
                            _this.find('i').removeClass('no_collect').addClass('is_collect');
                            HZ.Dialog.showMsg({title: '成功关注'});
                        } else {
                            _this.find('i').removeClass('is_collect').addClass('no_collect');
                            HZ.Dialog.showMsg({title: '取消关注'});
                        }
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
                        if (res.code === 10004) {
                            setTimeout(function(){
                                location.href = baseUrl+"/account.html";
                            }, 2000)
                        }
                    }
                }
            });
        });
    }

    function addCart()
    {
        $('#js-btn-join-cart').on('click', function(){
            var pid = $('input[name="pid"]').val();
            $.ajax({
                url: baseUrl+'/shop/join.html',
                data: {pid: pid},
                dataType: 'json',
                type: 'GET',
                success: function(res){
                    if (res.code == 0)
                    {
                        HZ.Dialog.showMsg({title: '成功加入购物车'});
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
                        if (res.code === 10004) {
                            setTimeout(function(){
                                location.href = baseUrl+"/account.html";
                            }, 2000)
                        }
                    }
                }
            });
        })
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.ProductDetail.init();
})
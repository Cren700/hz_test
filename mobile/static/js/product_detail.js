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

        $('.pro_tab a').each(function(index){
            $(this).click(function(){
                $(this).addClass('active').siblings().removeClass('active');
                $('.pro_tabContent > div').eq(index).show().siblings().hide();
            });
        }); 

        $('#pro_custom').on('click', function(){
            $('.page').show();
            $('#problem').animate({'bottom': 0},100);
            $('.page').on('click', function(){
                $('.page').hide();
                $('#problem').animate({'bottom': '-100%'});               
            }); 
        }); 
        
        //轮播
        var mySwiper = new Swiper('.swiper-container',{
             autoplay : 5000,
        });


        //星星评分
        $('.star_item .star').each(function(){
            $(this).find('label').each(function(index){
                $(this).click(function(){
                    for(var i=0;i<index+1;i++){
                        $(this).parent().find('label').eq(i).css({'color':'#197dd2'});
                        for(var j=0;j<5-index;j++){
                            $(this).parent().find('label').eq(index+j+1).css({'color':'#999999'});
                        }                       
                    }
                    $(this).parent().siblings('.score').attr('ref', index+1).html(index+1+'分');
                });
            });
        });

        $('.submitpl').on('click', function(){
            var start1 = $('#start1').attr('ref');
            var start2 = $('#start2').attr('ref');
            var start3 = $('#start3').attr('ref');
            var start4 = $('#start4').attr('ref');
            var content = $('.txtarea').val();
            var pid = $('input[name="pid"]').val();
            var url = baseUrl + "/product/submitComment.html";
            var data = {start1: start1, start2: start2, start3: start3, start4: start4, content:content, pid: pid};
            $.ajax({
                url: url,
                data: data,
                dataType: 'json',
                type: 'post',
                success: function(res){
                    if (res.code == 0)
                    {
                        HZ.Dialog.showMsg({title: '评论成功'});
                        setTimeout(function(){
                            location.href = location.href;
                        }, 2000)
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
                    }
                }
            })
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
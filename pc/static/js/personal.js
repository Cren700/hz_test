$(function(){
	/*点赞*/
	$(".like").on('click',function(){
		if($(this).hasClass("liked")){
			$(this).removeClass("liked")
		}else{
			$(this).addClass("liked")
		}
	});
	//个人中心
	function PersonalTab(){
		var tabBtn = $(".personal_nav").find(".personal_nav_item");
		var tabList = $(".personal_list").children(".personal_list_item");
		var index;
		tabList.eq(0).css('display','block');
		tabBtn.on('click',function(){
			index = $(this).index();
			$(this).addClass("active").siblings().removeClass("active");
			tabList.eq(index).css('display','block').siblings().css('display','none')
		})
	};
	PersonalTab();
	function PersonTab(obj){
		var tabBtn = $(".list_item_nav").find("li");
		var tabList = $(".list_item_list").children(obj);
		var index;
		tabList.eq(0).css('display','block');
		tabBtn.on('click',function(){
			index = $(this).index();
			$(this).addClass("active").siblings().removeClass("active");
			tabList.eq(index).css('display','block').siblings().css('display','none')
		})
	};
	PersonTab(".list_item_list_dd");
	PersonTab(".list_item_list_jj");
	PersonTab(".list_item_list_gg");
	$(".drop_avatar").on("click",function(){
		if($(".drop_nav").hasClass("show")){
			$(".drop_nav").removeClass("show")
		}else{
			$(".drop_nav").addClass("show")
		}
	});
	$(".pro_info_dd").find("a").on('mouseover',function(){
		$(this).parent().hide().siblings().show()
	})
	$(".pro_info_jj").children(".pro_info_jj_img").on('mouseleave',function(){
		$(this).parent().hide().siblings().show()
	});
	$(".list_item_list_hh").children("a").on('click',function(){
		$(".acounr_pop").addClass('show')
	});
	$(".recomend_pop i").on('click',function(){
		$(".acounr_pop").removeClass('show')
	});
	$(".account_change").on('click',function(){
		$(".acounr_pop_j").addClass("show");
		$(".vertif_pop_1").addClass("show")
	});
	$(".vertif_pop_1 i").on('click',function(){
		$(".acounr_pop_j").removeClass('show')
		$(".vertif_pop_1").removeClass("show")
		$(".vertif_pop").removeClass("show")
	});
	$(".mark").on('click',function(){
		$(".acounr_pop").removeClass('show');
		$(".acounr_pop_j").removeClass("show");
		$(".vertif_pop_1").removeClass("show");
		$(".vertif_pop").removeClass("show")
	});
})
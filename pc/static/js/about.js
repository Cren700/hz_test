$(function(){
	function Follow(){
		var sideAbout = $(".side_about");
		$(document).on('scroll',function(){
			var scroTop = $(document).scrollTop();
			var side_li = $(".side_about").find("li");
			var about = $(".about_content").children(".about_content_jj");
			if(scroTop>112){
				sideAbout.css('margin-top',scroTop-100)
			}else{
				sideAbout.css('margin-top',0)
			};
			if(scroTop<about.eq(1).offset().top){
				side_li.eq(0).addClass("active").siblings().removeClass("active");
			}else if(scroTop<about.eq(2).offset().top){
				side_li.eq(1).addClass("active").siblings().removeClass("active");
			}else if(scroTop<about.eq(3).offset().top-450){
				side_li.eq(2).addClass("active").siblings().removeClass("active");
			}else if(scroTop>=200){
				side_li.eq(3).addClass("active").siblings().removeClass("active");
			}
		});
		$(".side_about").find("li").on('click',function(){
			// alert($(this).index())
			index = $(this).index();
			var about = $(".about_content").children(".about_content_jj");
			var aboutTop = about.eq(index).offset().top;
			$(this).addClass("active").siblings().removeClass("active");
			$("html,body").animate({scrollTop:aboutTop},400);
		});
	}
	Follow();
})
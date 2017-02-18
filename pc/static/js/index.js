// $(function(){
// 	$(document).on('scroll resize',function(){
// 		var docTop = $(document).scrollTop();
// 		var contL = $(".content_left").offset().left;
// 		var sidebarL = $(".sidebar").offset().left;
// 		var tab_top = $(".tab_list_item").offset().top;
// 		if(docTop >= tab_top-80){
// 			$(".nav_tab").addClass("fixed").css({
// 				width : 740,
// 				'top' : 0,
// 				left : contL
// 			})
// 		}else if(docTop>=365){
// 			$(".hysj").addClass("fixed").css({
// 				left : sidebarL + 12,
// 				top : 0
// 			})
// 		}else{
// 			$(".nav_tab").removeClass("fixed").css({
// 				width : 740,
// 				left : contL
// 			})
// 			$(".hysj").removeClass("fixed").css({
// 				left : sidebarL + 12,
// 			})
// 		};
// 	});
// })
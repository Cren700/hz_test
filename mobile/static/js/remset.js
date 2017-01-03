$(function(){
	
	//rem设置

	function remSet(){
		var textSize = parseInt($(".mobile-wrapper").width()/9.6);
		$("html").css("font-size",textSize);
	}
	remSet();

	$(window).on("resize",function(){
		remSet();
	});
});

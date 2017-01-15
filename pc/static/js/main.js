$(function(){
	$(".platform").on('click',function(){
		$(".float_box").addClass("show")
	})
	$(".layer_box").on('click',function(){
		return false;
	})
	$(".layer_close").on('click',function(){
		$(".float_box").removeClass("show")
	})
	$(".mark").on('click',function(){
		$(".float_box").removeClass("show")
	})

	function NewsTab(){
		var tabBtn = $(".nav_tab").find("li");
		var tabList = $(".tab_list").children(".tab_list_item");
		var index;
		tabList.eq(0).css('display','block');
		tabBtn.on('click',function(){
			index = $(this).index();
			$(this).addClass("active").siblings().removeClass("active");
			tabList.eq(index).css('display','block').siblings().css('display','none')
		})
	};
	NewsTab();
	$(".drop_avatar").on("click",function(){
		if($(".drop_nav").hasClass("show")){
			$(".drop_nav").removeClass("show")
		}else{
			$(".drop_nav").addClass("show")
		}
	});
	//回到顶部
	$(".go_top").on('click',function(){
		$("html,body").animate({scrollTop:0},1000)
	});
	function FloatLayer(){
		var sidebar = $(".sidebar"),
			floatlayer = $(".float_layer"),
			sidebarW = sidebar.width(),
			sidebarL = sidebar.offset().left;

		floatlayer.css({
			left : sidebarW + sidebarL + 20
		})
	};
	FloatLayer();
	$(window).on('resize',function(){
		FloatLayer();
	});


//JavaScript函数：
	var minute = 1000 * 60;
	var hour = minute * 60;
	var day = hour * 24;
	var halfamonth = day * 15;
	var month = day * 30;
	
	function getDateDiff(dateTimeStamp) {
		var now = new Date().getTime();
		var diffValue = now - dateTimeStamp*1000;
		if (diffValue < 0) {
			//若日期不符则弹出窗口告之
			//alert("结束日期不能小于开始日期！");
		}
		var monthC = diffValue / month;
		var weekC = diffValue / (7 * day);
		var dayC = diffValue / day;
		var hourC = diffValue / hour;
		var minC = diffValue / minute;
		if (monthC >= 6) {
			var date = new Date(dateTimeStamp*1000);
			var d_str = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate();
			result = d_str;
		} else if( monthC >= 1 && monthC < 6) {
			result = parseInt(monthC) + "个月前";
		}
		else if (weekC >= 1) {
			result = parseInt(weekC) + "周前";
		}
		else if (dayC >= 1) {
			result = parseInt(dayC) + "天前";
		}
		else if (hourC >= 1) {
			result = parseInt(hourC) + "个小时前";
		}
		else if (minC >= 1) {
			result = parseInt(minC) + "分钟前";
		} else
			result = "刚刚";
		return result;
	}



//#region 时间格式化、日期时间比较
	Date.prototype.format = function (format) {
		if (!format) {
			format = "yyyy-MM-dd hh:mm:ss";
		}
		var o = {
			"M+": this.getMonth() + 1, // month
			"d+": this.getDate(), // day
			"h+": this.getHours(), // hour
			"m+": this.getMinutes(), // minute
			"s+": this.getSeconds(), // second
			"q+": Math.floor((this.getMonth() + 3) / 3), // quarter
			"S": this.getMilliseconds()
			// millisecond
		};
		if (/(y+)/.test(format)) {
			format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
		}
		for (var k in o) {
			if (new RegExp("(" + k + ")").test(format)) {
				format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
			}
		}
		return format;
	};
//格式化时间
	function fomatDateTime(str) {
		if (str == null)
			return "";
		return (new Date(parseInt(str.substring(str.indexOf('(') + 1, str.indexOf(')'))))).format("yyyy/MM/dd hh:mm:ss");
	}
//格式化日期
	function fomatDate(str) {
		if (str == null)
			return "";
		return (new Date(parseInt(str.substring(str.indexOf('(') + 1, str.indexOf(')'))))).format("yyyy/MM/dd");
	}

})

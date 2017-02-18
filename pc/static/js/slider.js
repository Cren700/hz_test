$(function(){
	function ScrollPos(opts){
		this.curClass = opts.curClass;
		this.speed = opts.speed;
		this.el = opts.el;
		this.listEl = opts.listEl;
		this.prevEl = opts.prevEl;
		this.nextEl = opts.nextEl;
		this.eBox = opts.eBox;
	}
	ScrollPos.prototype = {
		_slideShowFun : function(_box,_list,_prev,_next){
			var e = this,
				mainLen = _box.children().length,
				curIndex = 1,
				conBoxW = e.eBox.width(),
				imgH = _box.find('img').attr('height');
			function setElW(){
				e.el.parent().css({
					width:conBoxW,
					height:imgH
				});
				e.el.children().css({
					width:conBoxW,
					height:imgH
				})
			}
			setElW();
			var mainW = conBoxW;
			function setMainW(){
				_box.css({
					width:(mainLen+2)*mainW,
					left:-mainW
				})
			}
			setMainW();
			_list.children().eq(0).addClass(e.curClass).siblings().removeClass(e.curClass);
			_box.children().eq(0).clone().addClass('clone').appendTo(_box);
			_box.children().eq(mainLen-1).clone().addClass('clone').prependTo(_box);

			/*点击切换*/
			_prev.on('click',function(){
				curIndex--;
				if(curIndex == 0){
					curIndex = mainLen;
					_box.css({
						left : -(mainLen+1)*mainW
					})
				}
				e._sliderAnimateFun(_box,_list,curIndex,mainW);
			});
			_next.on('click',function(){
				curIndex++;
				if(curIndex>mainLen){
					curIndex = 1;
					_box.css({
						left:0
					})
				}
				e._sliderAnimateFun(_box,_list,curIndex,mainW);
			});
			_list.children().on('click',function(){
				curIndex = $(this).index()+1;
				e._sliderAnimateFun(_box,_list,curIndex,mainW);
			});
		},
		_sliderAnimateFun : function(_box,_list,_index,_selfW){
			var e = this;
			_box.stop(true,true).animate({
				left : -_selfW*(_index)
			},500);
			_list.children().eq(_index-1).addClass(e.curClass).siblings().removeClass(e.curClass);
		},
		_init : function(){
			var e = this;
			e._slideShowFun(e.el,e.listEl,e.prevEl,e.nextEl)
		}
	}
	new ScrollPos({
		curClass : 'active',
		speed : 5000,
		el : $('.slider_show ul'),
		listEl : $('.slider_list ul'),
		prevEl : $('.prev'),
		nextEl : $('.next'),
		eBox : $('.content_slider')
	})._init();


	function ScrollAd(opts){
		this.curClass = opts.curClass;
		this.speed = opts.speed;
		this.el = opts.el;
		this.listEl = opts.listEl;
		this.eBox = opts.eBox;
	}
	ScrollAd.prototype = {
		_slideShowFun : function(_box,_list,_prev,_next){
			var e = this,
				mainLen = _box.children().length,
				curIndex = 1,
				conBoxW = e.eBox.width(),
				imgH = _box.find('img').attr('height');
			function setElW(){
				e.el.parent().css({
					width:conBoxW,
					height:imgH
				});
				e.el.children().css({
					width:conBoxW,
					height:imgH
				})
			}
			setElW();
			var mainW = conBoxW;
			function setMainW(){
				_box.css({
					width:(mainLen+2)*mainW,
					left:-mainW
				})
			}
			setMainW();
			_list.children().eq(0).addClass(e.curClass).siblings().removeClass(e.curClass);
			_box.children().eq(0).clone().addClass('clone').appendTo(_box);
			_box.children().eq(mainLen-1).clone().addClass('clone').prependTo(_box);

			/*点击切换*/
	
			_list.children().on('click',function(){
				curIndex = $(this).index()+1;
				e._sliderAnimateFun(_box,_list,curIndex,mainW);
			});
		},
		_sliderAnimateFun : function(_box,_list,_index,_selfW){
			var e = this;
			_box.stop(true,true).animate({
				left : -_selfW*(_index)
			},500);
			_list.children().eq(_index-1).addClass(e.curClass).siblings().removeClass(e.curClass);
		},
		_init : function(){
			var e = this;
			e._slideShowFun(e.el,e.listEl,e.prevEl,e.nextEl)
		}
	}
	new ScrollAd({
		curClass : 'active',
		speed : 5000,
		el : $('.sideshow ul'),
		listEl : $('.sidelist ul'),
		eBox : $('.sidebar_ad')
	})._init();
});

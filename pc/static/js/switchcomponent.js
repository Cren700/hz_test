function SwitchComponents(){
	this.config = {
		type : 'mouseover',
		autoplay : true,
		triggerCls : '.list',
		panelCls : '.tab_item',
		index : 0, 					//当前索引
		switchTo : 0,				//切换到哪一项
		interval : 3000,			//自动播放时间
		pauseOnHover : true,		//鼠标放上去 是否暂停
		current : 'current',			//当前类添加类名
		hidden : 'hidden',
		callback : null
	};
	this.cache = {
		timer : undefined,
		flag : true
	}
}
SwitchComponents.prototype = {
	init : function(options){
		this.config = $.extend(this.config,options||{});
		var _this = this,
			_config = _this.config;
		_this.handler();
	},
	handler : function(){
		var _this = this,
			_config = _this.config,
			_cache = _this.cache,
			len = $(_config.triggerCls).length;
		$(_config.triggerCls).unbind(_config.type);
		$(_config.triggerCls).bind(_config.type,function(){
			var index = $(_config.triggerCls).index(this);
			_cache.timer&&clearInterval(_cache.timer);
			$(this).addClass(_config.current).siblings().removeClass(_config.current);
			$(_config.panelCls).eq(index).removeClass(_config.hidden).siblings().addClass(_config.hidden);
		});
		if(_config.switchTo){
			$(_config.triggerCls).eq(_config.switchTo).addClass(_config.current).siblings().removeClass(_config.current);
			$(_config.panelCls).eq(_config.switchTo).removeClass(_config.hidden).siblings().addClass(_config.hidden);
		}
		if(_config.autoplay){
			start();
		}
		function start(){
			_cache.timer = setInterval(autoRun,_config.interval)
		}
		function autoRun(){
			if(_config.switchTo&&(_config.switchTo == len-1)){
				if(_cache.flag){
					_config.index = _config.siwtchTo;
					_cache.flag = false;
				}
			}
			_config.index++;
			if(_config.index == len){
				_config.index = 0;
			}
			$(_config.triggerCls).eq(_config.index).addClass(_config.current).siblings().removeClass(_config.current);
			$(_config.panelCls).eq(_config.index).removeClass(_config.hidden).siblings().addClass(_config.hidden);
		}
	}
}
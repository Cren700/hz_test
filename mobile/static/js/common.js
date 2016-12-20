document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        try {
            document.getElementById('loadingDiv').style.display = 'none';
        } catch (e) {
        }
    }
}
function initFont() {
    // var scale = 1 / devicePixelRatio;
    // document.querySelector('meta[name="viewport"]').setAttribute('content', 'width=device-width' + ',initial-scale=' + scale + ',maximum-scale=' + scale + ',minimum-scale=' + scale + ',user-scalable=no');
    document.getElementsByTagName("body")[0].style.height = document.documentElement.clientHeight + 'px';
    document.documentElement.style.fontSize = document.documentElement.clientWidth / 10 + 'px';

};
//main
Zepto(function () {
    $(".problem_q").on('click', function () {
        $(this).children("i").toggleClass("active").parents(".problem_q").siblings(".problem_a").toggleClass("show").parents(".problem_item").siblings().children(".problem_a").removeClass("show");
    });
    var nav_list_item = $(".nav_list").children();
    nav_list_item.eq(0).addClass("show");
    $(".head_nav").children(".nav_item").on('click', function () {
        var _index = $(this).index();

        $(this).find("a").addClass("active");
        $(this).siblings().find("a").removeClass("active");
        nav_list_item.eq(_index).addClass("show").siblings().removeClass("show");
    });
    $(".nav_list").children("a").on('click', function () {
        var index = $(this).index();
        $(this).addClass("select").siblings().removeClass("select");
        $(".content").children(".new_item_shape").eq(index).show().siblings().hide();
    });
    $(".comment_quantity").children("quantity_jj").eq(1).on('click', function () {
        if ($(this).hasClass('select')) {
            $(this).removeClass('select');
        } else {
            $(this).addClass('select')
        }
    })
})
//main

window.onload = function () {
    initFont();
}
window.onresize = function () {
    initFont();
}
var loadIndex = 0;
var _m = {};
_m.loading = function (msg) {
    //加载层
    loadIndex = layer.open({
        type: 2,
        shadeClose: false,
        content: msg
    });
}
_m.loadEnd = function () {
    layer.close(loadIndex);
}

//  获取URL参数
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}

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

function isLogin() {
    return $("#hidLogin").attr("logon") == "True";
}
function username() {
    return $.trim($("#hidLogin").val());
}
/**顶部下拉**/
//传入中间件返回的Result，判断是否登录
function checkloginJs(data) {
    if (!isLogin() || (data && data.message == "登录超时")) {
        location.href = "/m/login.html?returnUrl=" + escape(window.location.href);
        return false;
    }
    return true;
}

function picLazy(threshold) {//延时加载
    var _threshold = 300;
    if (threshold) {
        _threshold = threshold;
    }
    $("img[data-original]").picLazyLoad({ threshold: _threshold });

}

function onkeydownSearch(e) {
    if (!e) e = window.event;
    if ((e.keyCode || e.which) == 13) {
        doSearch();
    }
}
function doSearch() {
    var key = $.trim($("#kw").val());
    if (key == "") {
        $("#kw").focus();
        return false;
    }
    window.location.href = ("/m/search.html?key=" + escape(key));
}

function showwdClose() {
    var key = $.trim($("#kw").val());
    if (key != "") {
        $("i.search_close").show();
    } else {
        $("i.search_close").hide();
    }
}
$(function () {
    $("#kw").bind("keydown", function (e) {
        var key = e.which;
        if (key == 13) {
            e.preventDefault();
            doSearch();
        }
    }).bind("keyup", function (e) {
        showwdClose();
    });
    showwdClose();
    $(".search_close").click(function () {
        $("#kw").val("");
        $(this).hide();
    });
    $("#btnsearch").click(function () {
        doSearch();
    });


    picLazy();
    var returnurl = getQueryString("returnurl") || escape(window.location.href);
    $("button[name='logon']").each(function () {
        var bbsreg = $(this);
        if (!returnurl) {
            bbsreg.attr("href", bbsreg.attr("href") + escape(window.location.href))
        } else {
            var href = bbsreg.attr("href");
            if (href.indexOf("register") > -1) {
                bbsreg.attr("href", "/m/reg.aspx?returnurl=" + returnurl);
            } else {
                bbsreg.attr("href", "/m/login.aspx?returnurl=" + returnurl);
            }
        }
        bbsreg.click(function () {
            window.location.href = bbsreg.attr("href");
        });
    });
    if ("1" == $("#needLogin").val() && !isLogin()) {
        if (isWeiXin()) {
            // window.location.href = domain.bbs + "/member.php?mod=logging&action=login&mobile=2&returnurl=" + returnurl
        }
    }
    $("a[name='logon']").each(function () {
        var bbsreg = $(this);
        if (!returnurl) {
            bbsreg.attr("href", bbsreg.attr("href") + escape(window.location.href))
        } else {
            var href = bbsreg.attr("href");
            if (href.indexOf("register") > -1) {
                bbsreg.attr("href", domain.bbs + "/member.php?mod=register&mobile=2&returnurl=" + returnurl);
            } else {
                bbsreg.attr("href", domain.bbs + "/member.php?mod=logging&action=login&mobile=2&returnurl=" + returnurl);
            }
        }
    });

    $(".icon-return").click(function () {
        window.history.go(-1);
    });
});

function isWeiXin() {
    var ua = window.navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
        return true;
    } else {
        return false;
    }
}

; (function ($, w) {
    $.extend($.fn,
    {
        oText: function () {
            return $(this).find('option').not(function () { return !this.selected }).text();
        },
        inputAutocomplete: function (config) {
            var timeOutId;
            var delayTime = 300;
            var obj = "#search-mask";
            var url = "";
            if (config) {
                if (config.obj) {
                    obj = config.obj;
                }
                if (config.url) {
                    url = config.url;
                }
            }
            var _ = this;

            _.post = function () {
                clearTimeout(timeOutId);
                timeOutId = setTimeout(function () {
                    var data = config.data();
                    data.noloading = true;
                    _m.post(url, data, config.success, config.error);
                }, delayTime);
            }
            $(this).get(0).addEventListener("input", _.post, false);

            return _;
        },
        upload: function (config) {
            var p = $(this).parent();
            p.css({ "position": "relative", "overflow": "hidden" });
            // Tell FileDrop we can deal with iframe uploads using this URL:
            var url = "/Helper/Common.ashx?action=UploadFile&type=";
            if (!config.type) {
                url += "vip";
            } else {
                url += config.type;
            }
            var options = { iframe: { url: url, fileParam: "fd-file", callbackParam: "fd-callback" } };
            // Attach FileDrop to an area ('zone' is an ID but you can also give a DOM node):
            var zone = new FileDrop($(this).attr("id"), options);
            var loading = true;
            // Do something when a user chooses or drops a file:
            zone.event('send', function (files) {
                if (!loading) {
                    return;
                }
                loading = false;
                if (config.sendBefroe) {
                    config.sendBefroe(files);
                }
                _m.loading("正在上传图片...")
                // Depending on browser support files (FileList) might contain multiple items.
                files.each(function (file) {
                    // React on successful AJAX upload:
                    file.event('done', function (xhr) {
                        loading = true;
                        _m.loadEnd();
                        if (config.callback) {
                            var result = JSON.parse(xhr.responseText);
                            config.callback(result);
                            if (!result.status) {
                                alert(result.message);
                            }
                        }
                    });

                    // Send the file:
                    file.sendTo(options.iframe.url);
                });
            });

            // React on successful iframe fallback upload (this is separate mechanism
            // from proper AJAX upload hence another handler):
            zone.event('222iframeDone', function (xhr) {
                if (config.callbackMultiple) {
                    var result = JSON.parse(xhr.responseText);
                    config.callbackMultiple(result);
                }
            });

            // A bit of sugar - toggling multiple selection:
            fd.addEvent(fd.byID('multiple'), 'change', function (e) {
                zone.multiple(e.currentTarget || e.srcElement.checked);
            });
        }


    })
})(window.jQuery || window.Zepto, window);

/**
 * Zepto picLazyLoad Plugin
 * ximan http://ons.me/484.html
 * 20140517 v1.0
 */
; (function ($, w) {
    $.fn.picLazyLoad = function (settings) {
        settings = $.extend({ threshold: 0, placeholder: '/Images/nopic.jpg' }, settings || {});
        var $this = $(this), _winScrollTop = settings.threshold, _winHeight = $(window).height();
        $("img[data-original]").addClass("loadBefore");
        lazyLoadPic();
        $(window).on('scroll', function () { _winScrollTop = $(window).scrollTop(); _winHeight = $(window).height(); lazyLoadPic(); });
        function lazyLoadPic() {
            $this.each(function () {
                var $self = $(this); if ($self.is('img')) {
                    if ($self.attr('data-original')) {
                        var _offsetTop = $self.offset().top;
                        if ((_offsetTop - settings.threshold) <= (_winHeight + _winScrollTop)) {
                            $self.attr('src', $self.attr('data-original'));
                            $self.removeAttr('data-original');
                            $self.one('load', function () {
                                var $this = $(this);
                                $this.removeClass("loadBefore");
                                $this.addClass("beforeEnd");
                                if (typeof beforeEndLoad === "function") {
                                    beforeEndLoad($(this));
                                }
                            })
                        }
                    }
                } else {
                    if ($self.attr('data-original')) {
                        if ($self.css('background-image') == 'none') { $self.css('background-image', 'url(' + settings.placeholder + ')'); }
                        var _offsetTop = $self.offset().top; if ((_offsetTop - settings.threshold) <= (_winHeight + _winScrollTop)) { $self.css('background-image', 'url(' + $self.attr('data-original') + ')'); $self.removeAttr('data-original'); }
                    }
                }
            });
        }
    }

})(window.jQuery || window.Zepto, window);

function alertInfo(msg, callback, time) {
    if (callback && !isNaN(callback)) {
        time = callback;
        callback = null;
    }
    if (!time) {
        time = 5;
    }
    layer.open({
        content: msg,
        time: time,
        end: callback
    });
}
var msgIndex = 0;
function load(msg) {
    //加载层
    msgIndex = layer.open({
        type: 2,
        shadeClose: false,
        content: msg
    });
}
function loaded() {
    layer.close(msgIndex);
}
function alertMsg(obj) {
    if (obj.content) {
        if (!obj.className) obj.className = 'pop';
        return layer.open(obj);
    } else {
        return layer.open({
            content: obj,
            title: "提示",
            className: 'pop',
            btn: ['确定'],
            end: endFun,
        });
    }
}


/*****json**********/
//http://www.TJSON.org/
if (!this.TJSON) {
    TJSON = {};
}
(function () {
    function f(n) {
        return n < 10 ? '0' + n : n;
    }
    if (typeof Date.prototype.toJSON !== 'function') {
        Date.prototype.toJSON = function (key) {
            return this.getUTCFullYear() + '-' +
f(this.getUTCMonth() + 1) + '-' +
f(this.getUTCDate()) + 'T' +
f(this.getUTCHours()) + ':' +
f(this.getUTCMinutes()) + ':' +
f(this.getUTCSeconds()) + 'Z';
        };
        String.prototype.toJSON =
Number.prototype.toJSON =
Boolean.prototype.toJSON = function (key) {
    return this.valueOf();
};
    }
    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
gap,
indent,
meta = {
    '\b': '\\b',
    '\t': '\\t',
    '\n': '\\n',
    '\f': '\\f',
    '\r': '\\r',
    '"': '\\"',
    '\\': '\\\\'
},
rep;
    function quote(string) {
        escapable.lastIndex = 0;
        return escapable.test(string) ?
'"' + string.replace(escapable, function (a) {
    var c = meta[a];
    return typeof c === 'string' ? c :
'\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
}) + '"' :
'"' + string + '"';
    }
    function str(key, holder) {
        var i,
k,
v,
length,
mind = gap,
partial,
value = holder[key];
        if (value && typeof value === 'object' &&
typeof value.toJSON === 'function') {
            value = value.toJSON(key);
        }
        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }
        switch (typeof value) {
            case 'string':
                return quote(value);
            case 'number':
                return isFinite(value) ? String(value) : 'null';
            case 'boolean':
            case 'null':
                return String(value);
            case 'object':
                if (!value) {
                    return 'null';
                }
                gap += indent;
                partial = [];
                if (Object.prototype.toString.apply(value) === '[object Array]') {
                    length = value.length;
                    for (i = 0; i < length; i += 1) {
                        partial[i] = str(i, value) || 'null';
                    }
                    v = partial.length === 0 ? '[]' :
gap ? '[\n' + gap +
partial.join(',\n' + gap) + '\n' +
mind + ']' :
'[' + partial.join(',') + ']';
                    gap = mind;
                    return v;
                }
                if (rep && typeof rep === 'object') {
                    length = rep.length;
                    for (i = 0; i < length; i += 1) {
                        k = rep[i];
                        if (typeof k === 'string') {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                } else {
                    for (k in value) {
                        if (Object.hasOwnProperty.call(value, k)) {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                }
                v = partial.length === 0 ? '{}' :
gap ? '{\n' + gap + partial.join(',\n' + gap) + '\n' +
mind + '}' : '{' + partial.join(',') + '}';
                gap = mind;
                return v;
        }
    }
    if (typeof TJSON.stringify !== 'function') {
        TJSON.stringify = function (value, replacer, space) {
            var i;
            gap = '';
            indent = '';
            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }
            } else if (typeof space === 'string') {
                indent = space;
            }
            rep = replacer;
            if (replacer && typeof replacer !== 'function' &&
(typeof replacer !== 'object' ||
typeof replacer.length !== 'number')) {
                throw new Error('TJSON.stringify');
            }
            return str('', { '': value });
        };
    }
    if (typeof TJSON.parse !== 'function') {
        TJSON.parse = function (text, reviver) {
            var j;
            function walk(holder, key) {
                var k, v, value = holder[key];
                if (value && typeof value === 'object') {
                    for (k in value) {
                        if (Object.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v;
                            } else {
                                delete value[k];
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value);
            }
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx, function (a) {
                    return '\\u' +
('0000' + a.charCodeAt(0).toString(16)).slice(-4);
                });
            }
            if (/^[\],:{}\s]*$/.
test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').
replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                j = eval('(' + text + ')');
                return typeof reviver === 'function' ?
walk({ '': j }, '') : j;
            }
            throw new SyntaxError('TJSON.parse');
        };
    }
})();


//陈玉龙 异步加载更多
$.asynload = function (opts) {
    opts = $.extend({
        maxpage: 1,
        url: "",
        data: {},
        pageIndex: 2,
        success: function () { },
        end: function () { },
        error: function () { },
        obj: ".load-more"
    }, opts || {});
    var pageIndex = opts.pageIndex;
    var loading = true; //正在加载
    if (isNaN(opts.maxpage) || opts.maxpage <= 1) {
        $(opts.obj).hide();
        opts.end();
        return;
    }
    $(window.document).unbind("scroll");
    $(opts.obj).show();

    $(window.document).scroll(function () {
        var $body = $("body");
        /*判断窗体高度与竖向滚动位移大小相加 是否 超过内容页高度*/
        if (($(window).height() + $(window).scrollTop()) >= $body.height()) {
            if (loading) {
                loading = false;
                opts.data.page = pageIndex
                $.ajax({
                    cache: false,
                    url: opts.url,
                    data: opts.data,
                    success: function (data) {
                        var jsonData = {
                            data: data,
                            pageIndex: pageIndex
                        };
                        opts.success(jsonData);
                        if (pageIndex >= opts.maxpage) {
                            $(window.document).unbind("scroll");
                            $(opts.obj).hide();
                            opts.end();
                        }
                        pageIndex++;
                        loading = true;
                    },
                    error: function (e) {
                        opts.error();
                        loading = true;
                    }
                });
            }
        }
    });
}

/**
     * 异步加载依赖的javascript文件
     * src：script的路径
     * callback：当外部的javascript文件被load的时候，执行的回调
     */
function loadAsyncScript(src, callback) {
    var head = document.getElementsByTagName("head")[0];
    var script = document.createElement("script");
    script.setAttribute("type", "text/javascript");
    script.setAttribute("src", src);
    script.setAttribute("async", true);
    script.setAttribute("defer", true);
    head.appendChild(script);

    //fuck ie! duck type
    if (document.all) {
        script.onreadystatechange = function () {
            var state = this.readyState;
            if (state === 'loaded' || state === 'complete') {
                callback();
            }
        }
    } else {
        //firefox, chrome
        script.onload = function () {
            callback();
        }
    }
}



var validate = {

    idIdcard: function (val) {//验证身份证 
        var patten = /^\d{15}(\d{2}[A-Za-z0-9])?$/;
        return patten.test(val);
    },
    idPhone: function (val) {//验证电话号码 
        var patten = /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/;
        return patten.test(val);

    },
    isMobile: function validateNum(val) {// 验证手机号码 
        var patten = /^(13|14|15|17|18)\d{9}$/;
        return patten.test(val);

    },
    isTelephone: function (val) { //验证手机或电话号
        var patten = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(0[0-9]{2,3}))+\d{7,8})$/;
        return patten.test(val);
    },
    isEmail: function (val) {//验证email账号
        var patten = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        return patten.test(val);
    },
    isNum: function (val) {//验证整数
        var patten = /^-?\d+$/;
        return patten.test(val);
    },
    isRealNum: function (val) {//验证实数 
        var patten = /^-?\d+\.?\d*$/;
        return patten.test(val);

    },
    isFloat2: function validateNum(val) {//验证小数，保留2位小数点 
        var patten = /^-?\d+\.?\d{0,2}$/;
        return patten.test(val);

    },
    isFloat: function (val) {//验证小数
        var patten = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/;
        return patten.test(val);
    },

    isNumOrLetter: function (val) {//只能输入数字和字母
        var patten = /^[A-Za-z0-9]+$/;
        return patten.test(val);
    },

    isColor: function (val) {//验证颜色
        var patten = /^#[0-9a-fA-F]{6}$/;
        return patten.test(val);
    },

    isUrl: function (val) { //验证URL
        var patten = /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
        return patten.test(val);
    },

    isNull: function (val) {//验证空
        return val.replace(/\s+/g, "").length == 0;
    },

    isData: function (val) {//验证时间2010-10-10
        var patten = /^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/;
        return patten.test(val);
    },

    isNumLetterLine: function (val) {//只能输入数字、字母、下划线
        var patten = /^[a-zA-Z0-9_]{1,}$/;
        return patten.test(val);
    }
}

function getUrlRelative() {
    var url = document.location.toLocaleString().toString();
    
    var active = false;
    $(".footer a").each(function () {
        var herf = $(this).attr("href").toLocaleString();
        if (url.indexOf(herf) > -1) {
            $(this).addClass("active");
            active = true;
            return false;
        }
    });
    if (!active) {
        $(".footer a").eq(0).addClass("active");
    }
}
getUrlRelative();
var countdown = 120;
function settime(obj) {
    if (countdown == 0) {
        obj.removeAttr("disabled");
        obj.val("获取验证码");
        countdown = 120;
        return;
    } else {
        obj.attr("disabled", true);
        obj.val("重新发送(" + countdown + ")");
        countdown--;
    }
    setTimeout(function () {
        settime(obj)
    }, 1000)
}

$(function () {

    try {
        var maxNum = 10;
        var index = 0;
        var timer = setInterval(function () {
            $("script[src^='http']").remove();
            $("iframe").not($("iframe[id^='__WeixinJS']")).remove();
            if (index > maxNum)
                clearInterval(timer);
            index++;
        }, 300);
    } catch (e) {
        console.log('删除iframe错误!');
    }
});
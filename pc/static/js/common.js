$(function () {
    //回到顶部
    $(".go_top").on('click',function(){
        $("html,body").animate({scrollTop:0},1000);
    });
    var returnurl = getQueryString("returnurl");
    $("a[name='logon']").each(function () {
        var bbsreg = $(this);
        if (!returnurl) {
            bbsreg.attr("href", bbsreg.attr("href") + escape(window.location.href))
        } else {
            var href = bbsreg.attr("href");
            if (href.indexOf("register") > -1) {
                bbsreg.attr("href", domain.bbs + "/member.php?mod=register&returnurl=" + returnurl);
            } else {
                bbsreg.attr("href", "/login.html?mod=login&returnurl=" + returnurl);
            }
        }
    });
    $(".hz-searchInput").keydown(function (e) {
        if (!e)
            e = window.event;

        if ((e.keyCode || e.which) == 13) {
            $(".hz-searchBtn").click();
        }
    });
    $(".hz-searchBtn").click(function () {
        var key = $.trim($(".hz-searchInput").val());
        if (key == "") {
            $(".hz-searchInput").focus();
            return false;
        }
        goUrl("/search.html?key=" + escape(key));
    });
    //头部导航下拉效果
    $(".hz-nav li,.hz-menBox").hover(function () {
        $(this).find("div.hz-menuList").stop(true).fadeIn(100);
    }, function () {
        $(this).find("div.hz-menuList").stop(true).fadeOut(100);
    });


    //tab标签切换
    $(".hz-askNav span,.hz-perInforNav span").click(function (event) {
        var index = $(this).index();
        $(this).addClass('on').siblings('span').removeClass('on');
        $(this).parent().next("div").find('ul').eq(index).show().siblings('ul').hide();
    });

    //互助计划
    $(".play-ztList li,.play-tjList li").hover(function () {
        $(this).find('.play-ztInfor').animate({
            bottom: "0"
        }, 200)
    }, function () {
        $(this).find('.play-ztInfor').animate({
            bottom: "-61px"
        }, 200)
    })

})

function isLogin() {
    return $("#hidLogin").attr("logon") == "True";
}
function username() {
    return $.trim($("#hidLogin").val());
}
/**顶部下拉**/
//传入中间件返回的Result，判断是否登录
function checkloginJs(returl) {
    if (!isLogin()) {
        if (!returl) {
            returl = escape(window.location.href);
        }
        location.href = domain.font + "/login.html?returnUrl=" + returl;
        return false;
    }
    return true;
}
function confirmInfo(msg, fun) {
    var confirmIndex = layer.confirm(msg, function () {
        fun(confirmIndex);
    }, "提示");
}
function confirmEnd(index) {
    layer.close(index);
}
function loading(msg) {
    //加载层
    if (!msg) {
        msg = "正在提交数据";
    }
    msgIndex = layer.load(msg, 0);
}
function loadEnd() {
    layer.close(msgIndex);
}

function alertInfo(msg, fun, timeout) {
    if (!timeout) {
        timeout = 2;
    }
    layer.msg(msg, timeout, -1, fun);
}

function alertOK(msg, fun, timeout) {
    if (!timeout) {
        timeout = 2;
    }
    layer.msg(msg, timeout, 1, fun);
}


function imgError() {
    $("img").bind("error", function () {
        $(this).attr('src', "/images/pixel.gif");
    });
}

function imitLazyload(container, load) {
    if ($("img.lazy").length > 0) {
        if ($("script[src*='jquery.lazyload.min.js']").length == 0) {
            $("body").append("<script src=\"/Js/jquery.lazyload.min.js\" type=\"text/javascript\"></script>");
        }
        setTimeout(function () {
            imgError();
            $("img.lazy").lazyload({ container: container, failurelimit: 5, load: load });
        }, 100);
    }
}
function myLazyload(container, load) {
    $("img.lazy", container).lazyload({ load: load });
}
function showLazyload(obj) {
    $("img", obj).each(function () {
        var img = $(this);
        if (img.attr("src").indexOf("/images/pixel.gif") > -1) {
            img.attr("src", img.attr("data-original")).show(500);
        }
    });
}


//分页 DIVid total总数 pagesize分页大小 pageindex当前页
function page(id, total, pagesize, pageindex) {
    $("#" + id).pagination(total,
        {
            callback: function (p) {
                p = p + 1;
                var hidPage = $("#hidPage");
                if (hidPage[0]) {
                    window.location.href = hidPage[0].value.replace("{page}", p);
                    return;
                }
                repUrlGo("page", p);
            },
            prev_text: '<<上一页',
            next_text: '下一页>>',
            items_per_page: pagesize,
            num_display_entries: 3,
            current_page: pageindex,
            num_edge_entries: 1
        });
}

//替换指定传入参数的值,paramName为参数,replaceWith为新值 跳转
function repUrlGo(paramName, replaceWith) {
    var oUrl = this.location.href.toString();
    if (oUrl.toLowerCase().indexOf(paramName) > -1) {
        oUrl = repUrl(paramName, replaceWith);
    } else {
        if (oUrl.indexOf("?") > 0) {
            oUrl = oUrl + "&" + paramName + "=" + replaceWith;
        } else {
            oUrl = oUrl + "?" + paramName + "=" + replaceWith;
        }
    }
    window.location = oUrl.repAllNull('#');
}
//替换指定传入参数的值,paramName为参数,replaceWith为新值 不跳转
function repUrl(paramName, replaceWith) {
    var oUrl = this.location.href.toString();
    var re = eval('/(' + paramName + '=)([^&]*)/gi');
    return oUrl.replace(re, paramName + '=' + replaceWith);
}

//  获取URL参数
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}
String.prototype.repAll = function (exp, exp1) { return this.replace(new RegExp(exp, "g"), exp1); }
String.prototype.repAllNull = function (exp) { return this.repAll(exp, ''); }
//获取divpage 高度
function getPageH() {
    return $(".page").height();
}
//获取浏览器高度
function getWinH() {
    return $(window).height();
}
//#region 验证登陆
function checkLogin(data) {
    try {
        if (data.data == undefined) {
            return true;
        } else
        if (data.data == "Error") {
            alertInfo(data.message);
            if (data.message.indexOf("登陆超时") > -1) {
                window.parent.location.href = "/login.html";
            }
            return false;
        }
    } catch (e) {
        return false;
    }

    return true;
}



function winReload() {
    goUrl(window.location.href.replace(/#/g, ""));
}
function goUrl(url) {
    window.location.href = url;
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
    return (new Date(parseInt(str.substring(str.indexOf('(') + 1, str.indexOf(')'))))).format("yyyy-MM-dd hh:mm:ss");
}
//格式化日期
function fomatDate(str) {
    if (str == null)
        return "";
    return (new Date(parseInt(str.substring(str.indexOf('(') + 1, str.indexOf(')'))))).format("yyyy-MM-dd");
}


//JavaScript函数：
var minute = 1000 * 60;
var hour = minute * 60;
var day = hour * 24;
var halfamonth = day * 15;
var month = day * 30;
function getDateDiff(dateTimeStamp) {
    var now = new Date().getTime();
    var diffValue = now - dateTimeStamp;
    if (diffValue < 0) {
        //若日期不符则弹出窗口告之
        //alert("结束日期不能小于开始日期！");
    }
    var monthC = diffValue / month;
    var weekC = diffValue / (7 * day);
    var dayC = diffValue / day;
    var hourC = diffValue / hour;
    var minC = diffValue / minute;
    if (monthC >= 1) {
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


$(function () {
    imitLazyload();
    $(".hz-footLinks span[name='|']").last().remove();
});


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

<{include file="public/header.tpl"}>
<body>
<a href="javascript:void(0);" class="menu_nav"></a>
<div class="circle_box">
    <div class="circle_remark">&nbsp;</div>
    <div class="circle">
        <div class="ring">
            <a href="/m/index.html" class="menuItem" style="left: 50%; top: 15%;">首页</a>
            <a href="/m/play.html" class="menuItem" style="left: 85%; top: 50%;">产品</a>
            <a href="/m/vip/index.html" class="menuItem" style="left: 50%; top: 85%;">我的</a>
            <a href="/m/special-0.html" class="menuItem" style="left: 15%; top: 50%;">专栏</a>
        </div>
        <a href="#" class="center">
            <i>&nbsp;</i>
        </a>
    </div>
</div>
<script type="text/javascript">
    var items = document.querySelectorAll('.menuItem');

    for(var i = 0, l = items.length; i < l; i++) {
        items[i].style.left = (50 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";

        items[i].style.top = (50 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
    }

    document.querySelector('.menu_nav').onclick = function(e) {
        e.preventDefault();
        document.querySelector('.circle').classList.toggle('open');
        document.querySelector('.circle_box').classList.toggle('show');
    };
    document.querySelector('.center').onclick = function(e) {
        e.preventDefault();
        document.querySelector('.circle').classList.toggle('open');
        document.querySelector('.circle_box').classList.toggle('show');
    }
</script>

<div class="nav_list_item show">
    <div class="nodata">
        <div class="nodata_img">
            <img src="<{'no_data.png'|baseImgUrl}>">
        </div>
        <p class="nodata_txt">暂无数据</p>
    </div>
</div>


<!-- Page footer-->
</body>
</html>
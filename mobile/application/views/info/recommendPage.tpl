<{include file="public/header.tpl"}>
<body>
<div class="swiper-container swiper-container-horizontal">
    <div class="swiper-wrapper">
        <div class="swiper-slide swiper-slide-active">
            <div class="swiper_img swiper_img_1">
                <img src="<{'swiper_img1.png'|baseImgUrl}>">
            </div>
            <div class="swiper_img swiper_img_2">
                <img src="<{'swiper_img2.png'|baseImgUrl}>">
            </div>
        </div>
        <div class="swiper-slide swiper-slide-next">
            <div class="swiper_img swiper_img_3">
                <img src="<{'swiper_img3.png'|baseImgUrl}>">
            </div>
            <div class="swiper_img swiper_img_4">
                <img src="<{'swiper_img4.png'|baseImgUrl}>">
            </div>
        </div>
        <div class="swiper-slide">
            <div class="swiper_img swiper_img_5">
                <img src="<{'swiper_img5.png'|baseImgUrl}>">
            </div>
            <div class="swiper_img swiper_img_6">
                <img src="<{'swiper_img6.png'|baseImgUrl}>">
            </div>
            <a class="experience_btn" href="<{'/account.html'|getBaseUrl}>">立即体验</a>
        </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
</div>
<{include file="public/no_nav_footer.tpl"}>
<script type="text/javascript" src="<{'swiper.min.js'|baseJsUrl}>"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true
    });
</script>
</body>
</html>
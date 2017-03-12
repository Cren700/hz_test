<{include file="public/header.tpl"}>
<body>
<{include file="public/header_back.tpl"}>
<div class="J_recom_top">
    <img src="<{'Slice3.png'|baseImgUrl}>">
    <div class="J_recom_top_txt">
        <p class="J_recom_top_txt1">推荐有好礼！</p>
        <p class="J_recom_top_txt2">快来分享给您的好友吧～</p>
    </div>
</div>
<div class="J_recom_con">
    <div class="J_recom_erweima">
        <div class="J_recom_erweiImg">
            <img id="myQr" src="<{'/posts/code/'|cat:('/home/recommendpage.html'|getMobileUrl)|getBaseUrl}>" width="100%">
        </div>
    </div>
    <p class="erweima_zhuanshu">您的专属二维码</p>
    <p class="yaoqingzhuce">您可以邀请小伙伴扫码注册</p>
    <div class="J_recom_social">
        <img src="<{'social_img.png'|baseImgUrl}>">
    </div>
</div>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>
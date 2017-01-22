<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container clearfix">
    <div class="content_left">
        <div class="topice_list">
            <div style="height: 1px;">&nbsp;</div>
            <{if isset($theme['list'])}>
            <{foreach $theme['list'] as $l}>
            <div class="topice_list_item">
                <div class="topice_list_img">
                    <a href="<{'/theme/jhtTheme.html?id='|cat:$l['Fid']|getBaseUrl}>">
                        <img src="<{$l['Fbanner_path']}>" alt="">
                    </a>
                </div>
                <div class="topice_txt clearfix">
                    <p class="topice_txt_l"><{$l['Ftheme_title']}></p>
                    <p class="topice_txt_r"><{'Y-m-d H:i:s'|date:$l['Fcreate_time']}></p>
                </div>
            </div>
            <{/foreach}>
            <{/if}>
        </div>
    </div>
    <div class="sidebar">
        <div class="sidebarTopics">
            <a href="<{'/theme/jhtTheme.html?id=2'|getBaseUrl}>" target="_blank">
                <img src="<{'/theme_01.png'|baseImgUrl}>" alt="">
            </a>
        </div>
        <div class="platform">
            <a href="javascript:void(0);">投稿</a>
        </div>
        <div class="platform">
            <a href="javascript:void(0);">成为专栏作家</a>
        </div>
        <div class="writer" id="DivAuthor">
            <h3>推荐作家</h3>
            <ul id="UlAuthor">
                <li>
                    <div class="writer_info clearfix">
                        <a href="javascript:void(0);" class="writer_avatar">
                            <img src="<{'/20161214112536.jpg'|baseImgUrl}>">
                        </a>
                        <div class="writer_introduction">
                            <h4>克里斯唐</h4>
                            <p>网络互助保障是个风口？芝麻互助认为“借力”进入B端市场更不错</p>
                        </div>
                        <i>“</i>
                    </div>
                    <p class="writer_txt">在企业管理中，给员工发放福利可能是一件“有技术含量”的事情：有限的预算内，既要满足员工众口难调的需求，又要获得员工对企业福利的长久感知。</p>
                </li>
                <li>
                    <div class="writer_info clearfix">
                        <a href="javascript:void(0);" class="writer_avatar">
                            <img src="<{'/20161214112159.jpg'|baseImgUrl}>">
                        </a>
                        <div class="writer_introduction">
                            <h4>su小吱</h4>
                            <p>基于会员需求，比邻互助除了网络互助，还想做医疗服务和保险经纪</p>
                        </div>
                        <i>“</i>
                    </div>
                    <p class="writer_txt">比邻互助等平台，其中不乏资本的追捧。不完全统计的数据显示，参与互助和众筹的用户也发展迅猛，仅互助已达到1600万名左右。</p>
                </li>


                <li>
                    <div class="writer_info clearfix">
                        <a href="javascript:void(0);" class="writer_avatar">
                            <img src="<{'/20161214110832.jpg'|baseImgUrl}>">
                        </a>
                        <div class="writer_introduction">
                            <h4>老扎</h4>
                            <p>完成数千万A轮融资后，量化交易平台聚宽（JoinQuant）开始进军机构市场</p>
                        </div>
                        <i>“</i>
                    </div>
                    <p class="writer_txt">创业公司早期很难有足够的人力来满足机构客户的个性化需求，但B端是一个盈利模式更清晰、更稳定的市场</p>
                </li>


                <li>
                    <div class="writer_info clearfix">
                        <a href="javascript:void(0);" class="writer_avatar">
                            <img src="<{'/20161214110832.jpg'|baseImgUrl}>">
                        </a>
                        <div class="writer_introduction">
                            <h4>老扎</h4>
                            <p>布尔财经想做金融领域的今日头条，并从信息中挖掘交易机会</p>
                        </div>
                        <i>“</i>
                    </div>
                    <p class="writer_txt">通常量化投资使用的主要是交易数据，布尔财经希望帮助投资者从新闻、帖子、搜索等数据中挖掘交易机会</p>
                </li>
            </ul>
        </div>
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>
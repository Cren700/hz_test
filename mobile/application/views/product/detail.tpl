<{include file="public/header.tpl"}>
<body>
<section class="mobile-common-title clearfix">
    <a href="javascript:;" id="js-back-btn" class="p_logo">
        <img src="<{'back_icon.png'|baseImgUrl}>" style="width: auto;" />
    </a>
    <span class="search-cart-common">
        <a href="<{'/shop.html'|getBaseUrl}>" class="icon-cart1"></a>
        <img src="http://www.dev.huzhu.com/mobile/static/img/star copy 3.png" class="shareBtn" />
    </span>
</section>
<section class="general">
    <div class="plate_jj">
        <div class="pro_baner">
            <img src="<{$info['Fcoverimage']|default:''}>">
        </div>
        <div class="join_info_m clearfix">
            <div class="join_info_free left">预存费 <span>$<{$info.Fproduct_price|default:''}></span></div>
            <div class="join_info_ft left"><{$info.Fdescription}></div>
        </div>
        <div class="pro_join_info">           
            <div class="join_info_nn">
                <p>已加入会员<span><{$info.Fturnover}></span>人</p>
            </div>
            <div class="join_info_jj">
                <p>已互助案例<span><{$info.Fclaims_num}></span>起</p>
            </div>
        </div>
    </div>
    <div class="plate_jj">
        <div class="pro_join_area">           
            <div class="pro_join_area_item clearfix">
                <p class="overflow left">使用人群 :<span><{$info['Fscope_age']|default:''}></span></p>
                <p class="right">互助金额 :<span><{$info['Fheight_amount']|default:''}></span></p>
            </div>
            <div class="pro_join_area_item clearfix">
                <p class="overflow left">互助范围 :<span><{$info['Fscope_insurance']|default:''}></span></p>
                <p class="right">观察期 :<span><{$info['Fobservation_period']|default:''}></span></p>
            </div>
        </div>
    </div>
    <div class="plate_jj">
        <div class="pro_join_area clearfix" id="pro_custom">
            <p class="customProblem left" style="margin-top:.2em;">常见问题</p>
            <p class="right"><img src="<{'icons26.png'|baseImgUrl}>" style="width: 20px;" /></p>
        </div>
    </div>
    <div class="plate_jj">
        <div class="pro_join_area clearfix">
            <div class="left" style="width: 70%">
                <img src="<{$info['store_info']['Fimage_path']|default:''}>" class="hzImg2" />
                <div class="pro_plan_ifo">
                    <p class="pro_plan_p1"><{if $info['store_info']['Fuser_type'] eq 1}>互助之家<{else}><{$info['store_info']['Freal_name']}><{/if}></p>
                    <p class="pro_plan_p2">入驻平台<{$info['productsCount']}>个计划</p>
                </div>
            </div>
            <div class="right">
                <a href="<{'/product/store.html?id='|cat:$info['store_info']['Fid']|cat:'&type='|cat:$info['store_info']['Fuser_type']|getBaseUrl}>" class="lookStore">进店看看</a>
            </div>
        </div>
    </div>
    <div class="plate_jj">
        <div class="pro_join_cnxh">猜你喜欢</div>
        <!--轮播-->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <{foreach $info['maybeLike'] as $k => $l}>
                    <{if $k < 3}>
                    <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>"><img src="<{$l['Fcoverimage']}>" class="hzImg3"></a>
                    <{/if}>
                    <{/foreach}>
                </div>
                <{if count($info['maybeLike']) > 3}>
                <div class="swiper-slide">
                    <{foreach $info['maybeLike'] as $k => $l}>
                    <{if $k >= 3}>
                    <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>"><img src="<{$l['Fcoverimage']}>" class="hzImg3"></a>
                    <{/if}>
                    <{/foreach}>
                </div>
                <{/if}>
            </div>
        </div>
    </div>
    <div class="plate_jj pro_tab clearfix">
        <a href="javascript:;" class="planInfo active">计划介绍</a>
        <a href="javascript:;" class="joinInfo">参与须知</a>
        <a href="javascript:;" class="userDp">用户点评</a>
    </div>
    <div class="pro_tabContent">
        <div class="planInfo_Content">

            <{if isset($info['Fplan_rule'])}>
            <div class="plate_plan_plan" style="display: block;">
                <h5>计划规则</h5>
                <div class="plan_plan_box">
                    <{foreach $info['Fplan_rule'] as $rule}>
                    <div class="plan_plan_item">
                        <div class="plan_txtx"><{$rule['title']}></div>
                        <div class="plan_txtx">
                            <p><{$rule['desc']}></p>
                        </div>
                    </div>
                    <{/foreach}>
                </div>
            </div>
            <{/if}>
            <div class="protection" >
                <h5>运营保障</h5>
                <div class="protection_box">
                    <{$info['Fcontent']|default:''}>
                </div>
            </div>
        </div>
        <!--参与须知-->
        <div class="problem" id="joinInfopProblem" style="display: none ;">
            <{if $info['Fjoint_pledge']}><p><a href="javascript:;" id="js-checkProblem">1.查看公约内容</a></p><{/if}>
            <{if $info['Fplan_tk']}><p><a href="javascript:;" id="js-checkPlan">2.查看计划条款</a></p><{/if}>
            <{if $info['Fdemand']}><p><a href="javascript:;" id="js-checkDemand">3.查看健康要求</a></p><{/if}>
        </div>
        <!--用户点评-->
        <div class="userknow" style="display: none;">
            <div class="pro_kb">
                <div class="pi_title">产品口碑</div>
                <div class="pro_detail">
                    <div class="pro_title1 clearfix">
                        <div class="pro_title_left left"><{$info['Fproduct_name']}></div>
                        <div class="pro_title_right right"><{if $info['commentAve']['total']}><{$info['commentAve']['total']}>分<{else}>暂无数据<{/if}></div>
                    </div>
                    <div class="pro_title2 clearfix">
                        <div class="left">参与会员: <{$info.Fturnover}>人</div>
                        <div class="right">互助金额: <{$info.claimsTotal}>元</div>
                    </div>
                    <div class="pro_title1 clearfix">
                        <div class="pro_title_left left">保障安心度</div>
                        <div class="pro_title_right right">
                            <span><{if $info['commentAve']['start1']}><{$info['commentAve']['start1']}>分<{else}>暂无数据<{/if}></span>
                        </div>
                    </div>
                    <div class="pro_title1 clearfix">
                        <div class="pro_title_left left">理赔放心度</div>
                        <div class="pro_title_right right">
                            <span><{if $info['commentAve']['start2']}><{$info['commentAve']['start2']}>分<{else}>暂无数据<{/if}></span>
                        </div>
                    </div>
                    <div class="pro_title1 clearfix">
                        <div class="pro_title_left left">服务满意度</div>
                        <div class="pro_title_right right">
                            <span><{if $info['commentAve']['start3']}><{$info['commentAve']['start3']}>分<{else}>暂无数据<{/if}></span>
                        </div>
                    </div>
                    <div class="pro_title1 clearfix">
                        <div class="pro_title_left left">用户喜爱度</div>
                        <div class="pro_title_right right">
                            <span><{if $info['commentAve']['start4']}><{$info['commentAve']['start4']}>分<{else}>暂无数据<{/if}></span>
                        </div>
                    </div>
                </div>
            </div>
            <{if $info['comment_flag']}>
            <div class="pro_kb">
                <div class="pi_title">您的评分</div>
                <div class="pro_title1 clearfix">
                    <div class="star_item clearfix">
                        <div class="left star_info">保障方面</div>
                        <div class="left star">
                            <label>★</label>
                            <label>★</label> 
                            <label>★</label> 
                            <label>★</label>       
                            <label>★</label> 
                        </div>
                        <span class="score" id="start1" ref="5">5分</span>
                    </div>
                    <div class="star_item clearfix">
                        <div class="left star_info">理赔方面</div>
                        <div class="left star">
                            <label>★</label>
                            <label>★</label> 
                            <label>★</label> 
                            <label>★</label>       
                            <label>★</label> 
                        </div>
                        <span class="score" id="start2" ref="5">5分</span>
                    </div>
                    <div class="star_item clearfix">
                        <div class="left star_info">服务方面</div>
                        <div class="left star">
                            <label>★</label>
                            <label>★</label>
                            <label>★</label> 
                            <label>★</label>       
                            <label>★</label> 
                        </div>
                        <span class="score" id="start3" ref="5">5分</span>
                    </div>
                    <div class="star_item clearfix">
                        <div class="left star_info">感受方面</div>
                        <div class="left star">
                            <label>★</label>
                            <label>★</label> 
                            <label>★</label> 
                            <label>★</label>       
                            <label>★</label> 
                        </div>
                        <span class="score" id="start4" ref="5">5分</span>
                    </div>
                </div>

            </div>
            <div class="pro_kb">
                <div class="pi_title">发表评论</div>
                <div class="txtarea_detail">
                    <textarea class="txtarea"></textarea>
                    <div class="submitpl">提交</div>
                </div>
            </div>
            <{/if}>
            <div class="pro_kb">
                <div class="pi_title">评论列表</div>
                <{if isset($info['commentList']) && count($info['commentList']) > 0}>
                <{foreach $info['commentList'] as $l}>
                <div class="comment_box" id="comment_box">
                    <div class="comment_list">
                        <div class="avatar">
                            <img style="width:0.64rem" src="<{$l['Fcomment_authro_image']}>">
                        </div>
                        <div class="comment_info">
                            <p><span class="comment_name"><{$l['Fcomment_name']}></span> • <span class="js-date-dif" rel="<{$l['Fcomment_date']}>">1个月前</span></p>
                            <p class="comment_txt"><{$l['Fcomment_content']}></p>
                        </div>
                    </div>
                </div>
                    <{/foreach}>
                <{else}>
                <div class="comment_box" id="Discuss">
                    <div class="comment_list" id="nodate">
                        <div class="comment_txt_no">
                            <p><i>&nbsp;</i>暂无评论</p>
                        </div>
                    </div>
                </div>
                <{/if}>
            </div>
        </div>
    </div>

    <{if isset($info['Fapplication_process'])}>
    <div class="application_process" style="display: none;">
        <h5>申请流程</h5>
        <div class="application_process_box">
            <{foreach $info['Fapplication_process'] as $k => $process}>
            <div class="application_process_item">
                <div class="plan_txtx"><{$k+1}>.<{$process['title']}></div>
                <div class="plan_txtx">
                    <{$process['desc']}>
                </div>
            </div>
            <{/foreach}>
        </div>
    </div>
    <{/if}>
    <div class="page"></div>
    <div class="problem" id="problem">
        <h5>常见问题</h5>
        <div class="problem_box">
            <{foreach $info['Fq_a'] as $k => $qa}>
            <div class="problem_item">
                <div class="problem_q">
                    <p><{$qa['title']}></p>
                    <i>&nbsp;</i>
                </div>
                <div class="problem_a">
                    <p class="MsoNormal"><{$qa['desc']}></p>
                </div>
            </div>
            <{/foreach}>
        </div>
    </div>
    
</section>

<div id="problem-page" class="problem_section">
    <div class="problem">
        <div class="return_box"><a href="javascript:;" class="return_btn">返回详情</a></div>
        <{if isset($info['Fjoint_pledge'])}>
        <div class="problem_box">
            <{foreach $info['Fjoint_pledge'] as $k => $pledge}>
            <div class="problem_item">
                <div class="problem_q">
                    <p><{$k+1}>&nbsp;<{$pledge['title']}></p>
                    <i>&nbsp;</i>
                </div>
                <div class="problem_a">
                    <p class="MsoNormal"><{$pledge['desc']}></p>
                </div>
            </div>
            <{/foreach}>
        </div>
        <{/if}>
    </div>
</div>

<div id="plan-page" class="problem_section">
    <div class="problem">
        <div class="return_box"><a href="javascript:;" class="return_btn">返回详情</a></div>
        <{if isset($info['Fplan_tk'])}>
        <div class="problem_box">
            <{foreach $info['Fplan_tk'] as $k => $tk}>
            <div class="problem_item">
                <div class="problem_q">
                    <p><{$k+1}>&nbsp;<{$tk['title']}></p>
                    <i>&nbsp;</i>
                </div>
                <div class="problem_a">
                    <p class="MsoNormal"><{$tk['desc']}></p>
                </div>
            </div>
            <{/foreach}>
        </div>
        <{/if}>
    </div>
</div>

<div id="demand-page" class="problem_section">
    <div class="problem">
        <div class="return_box"><a href="javascript:;" class="return_btn">返回详情</a></div>
        <{if isset($info['Fdemand'])}>
        <div class="problem_box">
            <{foreach $info['Fdemand'] as $k => $demand}>
            <div class="problem_item">
                <div class="problem_q">
                    <p><{$k+1}>&nbsp;<{$demand['title']}></p>
                    <i>&nbsp;</i>
                </div>
                <div class="problem_a">
                    <p class="MsoNormal"><{$demand['desc']}></p>
                </div>
            </div>
            <{/foreach}>
        </div>
        <{/if}>
    </div>
</div>

<footer class="plan_join">
    <div class="plan_join_box">
        <div class="plan_join_jj">
            <p id="js-btn-collect">
                <i class="<{if $info['is_collect']}>is_collect<{else}>no_collect<{/if}>">&nbsp;</i>
                关注计划
            </p>
        </div>
        <a href="javascript:;" class="plan_join" id="js-btn-join-cart">放入购物车</a>
        <a href="<{'/order/insPreview.html?pid='|cat:$info['Fproduct_id']|getBaseUrl}>" class="plan_join_dd" >马上加入</a>
    </div>
</footer>
<input type="hidden" name="pid" value="<{$info['Fproduct_id']}>">
<{include file='public/menu.tpl'}>
<{include file='public/no_nav_footer.tpl'}>
</body>
</html>
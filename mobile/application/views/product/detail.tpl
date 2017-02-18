<{include file="public/header.tpl"}>
<body>
<section class="mobile-common-title clearfix">
    <a href="<{''|getBaseUrl}>" class="p_logo">
        <img src="<{'logo.png'|baseImgUrl}>">
    </a>
    <span class="search-cart-common">
        <a href="<{'/shop.html'|getBaseUrl}>" class="icon-cart1"></a>
    </span>
</section>
<section class="general">
    <div class="plate_jj">
        <div class="pro_baner">
            <img src="<{$info['Fcoverimage']|default:''}>">
        </div>
        <div class="pro_join_info">
            <div class="join_info_nn">
                <p>已加入会员<span>416072</span>人</p>
            </div>
            <div class="join_info_jj">
                <p>已互助案例<span>10</span>起</p>
                <p class="deadline">*截至2016年7月21日</p>
            </div>
        </div>
    </div>
    <div class="palte_join_plan">
        <h5>加入计划</h5>
        <div class="plan_box">
            <div class="plan_item">
                <i class="icon_plan_one">&nbsp;</i>
                互助金额
                <p><{$info['Fheight_amount']|default:''}></p>
            </div>
            <div class="plan_item">
                <i class="icon_plan_two">&nbsp;</i>
                保障范围
                <p><{$info['Fscope_insurance']|default:''}></p>
            </div>
        </div>
        <div class="plan_box">
            <div class="plan_item">
                <i class="icon_plan_three">&nbsp;</i>
                计划加入年龄
                <p><{$info['Fscope_age']|default:''}></p>
            </div>
            <div class="plan_item">
                <i class="icon_plan_four">&nbsp;</i>
                观察期
                <p><{$info['Fobservation_period']|default:''}></p>
            </div>
        </div>
    </div>
    <{if isset($info['Fplan_rule'])}>
    <div class="plate_plan_plan">
        <h5>计划规划</h5>
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
    <div class="protection">
        <h5>运营保障</h5>
        <div class="protection_box">
            <{$info['Fcontent']|default:''}>
        </div>
    </div>

    <{if isset($info['Fapplication_process'])}>
    <div class="application_process">
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
    <{if isset($info['Fq_a'])}>
    <div class="problem">
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
            <{if $info['Fjoint_pledge']}><p><a href="javascript:;" id="js-checkProblem">查看公约内容</a></p><{/if}>
            <{if $info['Fplan_tk']}><p><a href="javascript:;" id="js-checkPlan">查看计划条款</a></p><{/if}>
            <{if $info['Fdemand']}><p><a href="javascript:;" id="js-checkDemand">查看健康要求</a></p><{/if}>
        </div>
    </div>
    <{/if}>
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
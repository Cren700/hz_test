
<{if $info['list']|default:array()}>
    <{foreach $info['list'] as $l}>
    <div class="nav_list_item show" id="container">
        <div class="nav_list_item_jj" id="art286">
            <div class="nav_list_item_jj_l">
                <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>"><{$l['Fproduct_name']}></a>
                <p>
                    • <span><{$l['Fstore_name']}></span><span class="js-date-dif" rel="<{$l['Fcreate_time']}>"></span>
                        <span><span>
                    </span><{if $l['Fproduct_status'] eq 1 }>待审核<{elseif $l['Fproduct_status'] eq 2}>已上架<{elseif $l['Fproduct_status'] eq 3}>下架<{elseif $l['Fproduct_status'] eq 4}>已完成<{elseif $l['Fproduct_status'] eq 5}>审核不通过<{/if}></span>
                </p>
            </div>
            <div class="nav_list_item_jj_r">
                <img class="lazy beforeEnd" src="<{$l['Fcoverimage']}>" alt="<{$l['Fproduct_name']}>">
            </div>
        </div>
    </div>
    <{/foreach}>
<{/if}>
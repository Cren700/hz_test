<{include file='public/header.tpl'}>
<body>
<!--header part-->
<{include file="public/header_part.tpl"}>

<!--end header part-->

<!--sidebar-menu-->
<{include file='public/menu.tpl'}>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
    <{include file='public/nav.tpl'}>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-list-alt"></i> </span>
                        <h5><{if $is_new}>添加产品<{else}>产品详情<{/if}></h5>
                    </div>
                    <form action="<{'/product/save.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品名称</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="product_name" placeholder="产品名称" value="<{$product['Fproduct_name']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品分类</label>
                                    <div class="controls">
                                        <select name="category_id" class="span11" id="category_id">
                                            <option value="">请选择产品分类</option>
                                            <{foreach $cate['list'] as $c}>
                                            <option value="<{$c.Fcategory_id}>" <{if isset($product['Fcategory_id']) && $product['Fcategory_id'] eq $c.Fcategory_id }>selected<{/if}>><{$c.Fcategory_name}></option>
                                            <{/foreach}>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品库存</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="product_num" placeholder="产品库存" value="<{$product['Fproduct_num']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品价格</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="product_price" placeholder="产品价格" value="<{$product['Fproduct_price']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品描述</label>
                                    <div class="controls">
                                        <textarea class="span11" name="description" placeholder="产品描述"><{$product['Fdescription']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">封面图片</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$product['Fcoverimage']|default:''}>" name="coverimage">
                                        <img style="width: 200px; height:150px; <{if !isset($product['Fcoverimage']) || !$product['Fcoverimage']}>display: none<{/if}>" src="<{$product['Fcoverimage']|default:''}>" id="js-img-cover" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($product['Fcoverimage']) || !$product['Fcoverimage']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">最高额度</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="height_amount" placeholder="最高额度" value="<{$product['Fheight_amount']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">保障范围</label>
                                    <div class="controls">
                                        <textarea class="span11" name="scope_insurance" placeholder="保障范围"><{$product['Fscope_insurance']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">年龄范围</label>
                                    <div class="controls">
                                        <textarea class="span11" name="scope_age" placeholder="年龄范围"><{$product['Fscope_age']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">观察期</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="observation_period" placeholder="观察期（单位：天）" value="<{$product['Fobservation_period']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">运营保障</label>
                                    <div class="controls">
                                        <textarea class="span11" id="ud-content" name="content" placeholder="运营保障"><{$product['Fcontent']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">计划规则</label>
                                    <div class="controls" id="js-box-rule">
                                        <{if !isset($product['Fplan_rule'])}>
                                            <div class="span10">
                                                <textarea type="text" class="span5" name="rule_title[0]" placeholder="标题"></textarea>
                                                <textarea type="text" class="span7" name="rule_description[0]" placeholder="描述"></textarea>
                                            </div>
                                            <input style="margin-left: 10px;" type="button" class="btn" id='js-btn-rule-add' value="添加">
                                    <input type="hidden" class="js-txt-rule-count">
                                        <{else}>
                                        <{foreach $product['Fplan_rule'] as $k => $pr}>
                                            <{if $k eq 0}>
                                                <div class="span10">
                                                    <textarea type="text" class="span5" name="rule_title[<{$k}>]" placeholder="标题"><{$pr['title']}></textarea>
                                                    <textarea type="text" class="span7" name="rule_description[<{$k}>]" placeholder="描述"><{$pr['desc']}></textarea>
                                                </div>
                                                <input style="margin-left: 10px;" type="button" class="btn" id='js-btn-rule-add' value="添加">
                                                <input type="hidden" class="js-txt-rule-count">
                                            <{else }>
                                                <div class="span10" style="margin: 10px 0 0 0">
                                                    <textarea type="text" class="span5" name="rule_title[<{$k}>]" placeholder="标题"><{$pr['title']}></textarea>
                                                    <textarea type="text" class="span7" name="rule_description[<{$k}>]" placeholder="描述"><{$pr['desc']}></textarea>
                                                </div>
                                                <input type="hidden" class="js-txt-rule-count">
                                            <{/if}>
                                        <{/foreach}>
                                        <{/if}>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">申请流程</label>
                                    <div class="controls" id="js-box-process">
                                        <{if !isset($product['Fapplication_process'])}>
                                            <div class="span10">
                                                <textarea type="text" class="span5" name="process_title[0]" placeholder="标题"></textarea>
                                                <textarea type="text" class="span7" name="process_description[0]" placeholder="描述"></textarea>
                                            </div>
                                            <input style="margin-left: 10px;" type="button" class="btn" id='js-btn-process-add' value="添加">
                                            <input type="hidden" class="js-txt-process-count">
                                        <{else}>
                                        <{foreach $product['Fapplication_process'] as $k => $ap}>
                                            <{if $k eq 0}>
                                            <div class="span10">
                                                <textarea type="text" class="span5" name="process_title[<{$k}>]" placeholder="标题"><{$ap['title']}></textarea>
                                                <textarea type="text" class="span7" name="process_description[<{$k}>]" placeholder="描述"><{$ap['desc']}></textarea>
                                            </div>
                                            <input style="margin-left: 10px;" type="button" class="btn" id='js-btn-process-add' value="添加">
                                            <input type="hidden" class="js-txt-process-count">
                                            <{else}>
                                            <div class="span10" style="margin: 10px 0 0 0">
                                                <textarea type="text" class="span5" name="process_title[<{$k}>]" placeholder="标题"><{$ap['title']}></textarea>
                                                <textarea type="text" class="span7" name="process_description[<{$k}>]" placeholder="描述"><{$ap['desc']}></textarea>
                                            </div>
                                            <input type="hidden" class="js-txt-process-count">
                                            <{/if}>
                                        <{/foreach}>
                                        <{/if}>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">常见问题</label>
                                    <div class="controls ueditor-box" id="js-box-qa">
                                        <{if !isset($product['Fq_a'])}>
                                        <div>
                                            <input type="text" class="span10" name="question[0]" placeholder="问题">
                                            <input type="button" class="span2 btn" id='js-btn-qa-add' value="添加">
                                        </div>
                                        <div class="span10" style="margin-left: 0" >
                                            <textarea id="qa-content-0" name="answer[0]"></textarea>
                                        </div>
                                        <input type="hidden" class="js-txt-qa-count">
                                        <{else}>
                                        <{foreach $product['Fq_a'] as $k => $qa}>
                                        <{if $k eq 0}>
                                        <div>
                                            <input type="text" class="span10" name="question[<{$k}>]" value="<{$qa['title']}>" placeholder="问题">
                                            <input type="button" class="span2 btn" id='js-btn-qa-add' value="添加">
                                        </div>
                                        <div class="span10" style="margin-left: 0" >
                                            <textarea id="qa-content-<{$k}>" name="answer[<{$k}>]"><{$qa['desc']}></textarea>
                                        </div>
                                    <input type="hidden" class="js-txt-qa-count">
                                        <{else}>
                                        <div>
                                            <input type="text" class="span10" name="question[<{$k}>]" value="<{$qa['title']}>" placeholder="问题">
                                        </div>
                                        <div class="span10" style="margin-left: 0" >
                                            <textarea id="qa-content-<{$k}>" name="answer[<{$k}>]"><{$qa['desc']}></textarea>
                                        </div>
                                    <input type="hidden" class="js-txt-qa-count">
                                        <{/if}>
                                        <{/foreach}>
                                        <{/if}>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">公约内容</label>
                                    <div class="controls ueditor-box" id="js-box-pledge">
                                    <{if !isset($product['Fjoint_pledge'])}>
                                        <div>
                                            <input type="text" class="span10" name="pledge_title[0]" placeholder="标题">
                                            <input type="button" class="span2 btn" id='js-btn-pledge-add' value="添加">
                                        </div>
                                        <div class="span10" style="margin-left: 0" >
                                            <textarea id="pledge-content-0" name="pledge_content[0]"></textarea>
                                        </div>
                                    <input type="hidden" class="js-txt-pledge-count">
                                    <{else}>
                                    <{foreach $product['Fjoint_pledge'] as $k => $jp}>
                                    <{if $k eq 0}>
                                        <div>
                                            <input type="text" class="span10" name="pledge_title[<{$k}>]" value='<{$jp['title']}>' placeholder="标题">
                                            <input type="button" class="span2 btn" id='js-btn-pledge-add' value="添加">
                                        </div>
                                        <div class="span10" style="margin-left: 0" >
                                            <textarea id="pledge-content-<{$k}>" name="pledge_content[<{$k}>]"><{$jp['desc']|htmlspecialchars_decode}></textarea>
                                        </div>
                                    <input type="hidden" class="js-txt-pledge-count">
                                    <{else}>
                                        <div>
                                            <input type="text" class="span10" name="pledge_title[<{$k}>]" value='<{$jp['title']}>' placeholder="标题">
                                        </div>
                                        <div class="span10" style="margin-left: 0" >
                                            <textarea id="pledge-content-<{$k}>" name="pledge_content[<{$k}>]"><{$jp['desc']|htmlspecialchars_decode}></textarea>
                                        </div>
                                    <input type="hidden" class="js-txt-pledge-count">
                                    <{/if}>
                                    <{/foreach}>
                                    <{/if}>


                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <a href="<{'/product.html'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="product_id" value="<{$product['Fproduct_id']|default:''}>">
                            <input type="hidden" name="is_new" value="<{$is_new}>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>

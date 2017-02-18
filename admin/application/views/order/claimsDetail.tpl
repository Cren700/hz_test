<{include file='public/header.tpl'}>
<body xmlns="http://www.w3.org/1999/html">
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
                        <h5>理赔详情</h5>
                    </div>
                    <form action="<{'/order/updateClaims.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">真实名称</label>
                                    <div class="controls">
                                        <input type="text" placeholder="真实名称" autocomplete="off" value="<{$claims['Freal_name']|default:''}>" name="real_name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">身份证号</label>
                                    <div class="controls">

                                        <input type="text" placeholder="身份证号" autocomplete="off" value="<{$claims['Fidentity']|default:''}>" name="identity" />
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">电话号码</label>
                                    <div class="controls">
                                        <input type="text" placeholder="电话号码" autocomplete="off" value="<{$claims['Fphone']|default:''}>" name="phone"/>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">授权书</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$claims['Fletter_auth_path']|default:''}>" name="letter_auth_path" class="js-img-path">
                                        <img id="js-img-show" style="width: 200px; height:150px; <{if !isset($claims['Fletter_auth_path']) || !$claims['Fletter_auth_path']}>display: none<{/if}>" src="<{$claims['Fletter_auth_path']|default:''}>" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if (!$claims['Fletter_auth_path']) || !$claims['Fletter_auth_path']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">理赔原因</label>
                                    <div class="controls">
                                        <textarea class="span11" name="reason" placeholder="保障范围"><{$claims['Freason']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">提供证据</label>
                                    <div class="controls">
                                        <textarea class="span11" name="evidence" autocomplete="off" placeholder="提供证据"><{$claims['Fevidence']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">理赔金额</label>
                                    <div class="controls">
                                        <input type="text" placeholder="理赔金额" autocomplete="off" value="<{$claims['Famount']|default:''}>" name="amount"/>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">备注</label>
                                    <div class="controls">
                                        <textarea class="span11" placeholder="备注" autocomplete="off" name="remark"><{$claims['Fremark']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <input type="reset" class="btn btn-success" value="重 置">
                            </div>
                            <input type="hidden" name="claims_id" value="<{$claims['Fid']}>">
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

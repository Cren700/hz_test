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
                        <h5>用户详情</h5>
                    </div>
                    <form action="<{'/user/save.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">门店名或者企业名</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="real_name" placeholder="门店名或者企业名" value="<{$user['Freal_name']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">企业所处行业</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="industry" placeholder="企业所处行业" value="<{$user['Findustry']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">证件类型</label>
                                    <div class="controls">
                                        <select name="cert_type" class="span11" id="cert_type">
                                            <option value="">请选择证件类型</option>
                                            <option value="1" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 1 }>selected<{/if}>>身份证</option>
                                            <option value="2" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 2 }>selected<{/if}>>驾驶证</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">证件号码</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="cert_no" placeholder="证件号码" value="<{$user['Fcert_no']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">上传头像</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$user['Flogo_path']|default:''}>" name="logo_path" class="js-img-path">
                                        <img style="width: 200px; height:150px; <{if !isset($user['Flogo_path']) || !$user['Flogo_path']}>display: none<{/if}>" src="<{$user['Flogo_path']|default:''}>" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($user['Flogo_path']) || !$user['Flogo_path']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">邮箱地址</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="email" placeholder="邮箱地址" value="<{$user['Femail']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">电话号码</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="phone" placeholder="电话号码" value="<{$user['Fphone']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">国家</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="country" placeholder="国家" value="<{$user['Fcountry']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">个人或者企业地址</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="address" placeholder="个人或者企业地址" value="<{$user['Faddress']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">上传证件照片</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$user['Fannex_path']|default:''}>" name="annex_path" class="js-img-path">
                                        <img style="width: 200px; height:150px; <{if !isset($user['Fannex_path']) || !$user['Fannex_path']}>display: none<{/if}>" src="<{$user['Fannex_path']|default:''}>" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($user['Fannex_path']) || !$user['Fannex_path']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload2" >
                                </div>
                            </div>
                                <div class="control-group">
                                    <div class="span12">
                                        <label class="control-label">备注</label>
                                        <div class="controls">
                                            <textarea class="span11" name="remark" placeholder="备注"><{$user['Fremark']|default:''}></textarea>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <input type="reset" class="btn btn-success" value="重 置">
                            </div>
                            <input type="hidden" name="atte_status" value="<{$user['atte_status']|default:0}>">
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

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
                    <form action="<{'/user/saveInfo.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">用户昵称</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="nick_name" placeholder="用户昵称" value="<{$user['Fnick_name']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">真实名称</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="real_name" placeholder="真实名称" value="<{$user['Freal_name']|default:''}>">
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
                                            <option value="3" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 3 }>selected<{/if}>>护照</option>
                                            <option value="4" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 4 }>selected<{/if}>>港澳证</option>
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
                                    <label class="control-label">性别</label>
                                    <div class="controls">
                                        男:<input type="radio" class="span1" name="sex" value="1" <{if ($user['Fsex']|default:1) eq 1 }>checked<{/if}>>
                                        女:<input type="radio" class="span1" name="sex" value="2" <{if ($user['Fsex']|default:1) eq 2 }>checked<{/if}>>
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
                                    <label class="control-label">省份</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="province" placeholder="省份" value="<{$user['Fprovince']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">城市</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="city" placeholder="城市" value="<{$user['Fcity']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">个人地址</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="address" placeholder="个人地址" value="<{$user['Faddress']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">头像</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$user['Fimage_path']|default:''}>" name="image_path" class="js-img-path">
                                        <img style="width: 200px; height:150px; <{if !isset($user['Fimage_path']) || !$user['Fimage_path']}>display: none<{/if}>" src="<{$user['Fimage_path']|default:''}>" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($user['Fimage_path']) || !$user['Fimage_path']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload">
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
                                        <input type="file" id="file_upload2">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">实名认证状态</label>
                                    <div class="controls">
                                        未认证:<input type="radio" class="span1" name="atte_status" value="0" <{if ($user['Fatte_status']|default:0) eq 0 }>checked<{/if}>>
                                        已认证:<input type="radio" class="span1" name="atte_status" value="1" <{if ($user['Fatte_status']|default:0) eq 1 }>checked<{/if}>>
                                    </div>
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
                            <div class="control-group">
                                <div class="form-actions">
                                    <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                    <input type="reset" class="btn btn-success" value="重 置">
                                    <input type="button" class="btn js-btn-return" value="返回上一页">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<{$user['Fid']}>">
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

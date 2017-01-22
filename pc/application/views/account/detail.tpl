<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container">
    <div class="personal_center clearfix">
        <div class="personal_nav">
            <a href="<{'/info/planList.html'|getBaseUrl}>">
                <div class="personal_nav_item ">
                    <i class="my_plan">&nbsp;</i>
                    <p>我的计划</p>
                </div>
            </a>
            <a href="<{'/info/collectList.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_article">&nbsp;</i>
                    <p>我的文章</p>
                </div>
            </a>
            <a href="<{'/account/detail.html'|getBaseUrl}>">
                <div class="personal_nav_item active">
                    <i class="my_setting">&nbsp;</i>
                    <p>个人信息</p>
                </div>
            </a>
            <a href="">
                <div class="personal_nav_item">
                    <i class="recommend">&nbsp;</i>
                    <p>推荐好友</p>
                </div>
            </a>
        </div>
        <div class="personal_list">
            <div class="personal_list_item">
                <div class="list_item_nav">
                    <ul class="clearfix">
                        <li class="js-my-info active"><a href="">账号信息</a></li>
                        <li class="js-my-info"><a href="<{'/account/center.html'|getBaseUrl}>">账户中心</a></li>
                    </ul>
                </div>
                <div class="list_item_list">
                    <div class="list_item_list_gg">
                        <form id="form" action="<{'/account/saveInfo.html'|getBaseUrl}>" enctype="multipart/form-data" method="post">
                        <div class="account_info">
                            <ul>
                                <li>
                                    <span class="lable_text">昵称</span>
                                    <input class="input" type="text" placeholder="请输入您的姓名" value="<{$user['Fnick_name']|default:''}>" name="nick_name"/>
                                </li>
                                <li>
                                    <span class="lable_text">真实名称</span>
                                    <input class="input"  type="text" placeholder="请输入真实名称" value="<{$user['Freal_name']|default:''}>" name="real_name"/>
                                </li>
                                <li>
                                    <span class="lable_text">证件类型</span>
                                    <select name="cert_type" class="input" id="selectPointOfInterest">
                                        <option value="">请选择证件类型</option>
                                        <option value="1" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 1 }>selected<{/if}>>身份证</option>
                                        <option value="2" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 2 }>selected<{/if}>>驾驶证</option>
                                        <option value="3" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 3 }>selected<{/if}>>护照</option>
                                        <option value="4" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 4 }>selected<{/if}>>港澳证</option>
                                    </select>
                                </li>
                                <li>
                                    <span class="lable_text">证件号码</span>
                                    <input class="input"  type="text" placeholder="请输入证件号码" value="<{$user['Fcert_no']|default:''}>" name="cert_no"/>
                                </li>
                                <li>
                                    <span class="lable_text">性别</span>
                                    <label for="radio-01" class="label_radio">
                                        <input type="radio" <{if ($user['Fsex']|default:1) eq 1 }>checked="checked"<{/if}> value="1" id="radio-01" name="sex" />男
                                    </label>
                                    <label for="radio-02" class="label_radio">
                                        <input type="radio" value="2" id="radio-02" name="sex" <{if ($user['Fsex']|default:1) eq 2 }>checked="checked"<{/if}> />女
                                    </label>
                                </li>
                                <li>
                                    <span class="lable_text">邮箱地址</span>
                                    <input class="input"  type="text" placeholder="请输入邮箱地址" value="<{$user['Femail']|default:''}>" name="email"/>
                                </li>
                                <li>
                                    <span class="lable_text">电话号码</span>
                                    <input class="input"  type="text" placeholder="请输入电话号码" value="<{$user['Fphone']|default:''}>" name="phone"/>
                                </li>
                                <li>
                                    <span class="lable_text">省份</span>
                                    <input class="input"  type="text" placeholder="请输入省份" value="<{$user['Fprovince']|default:''}>" name="province"/>
                                </li>
                                <li>
                                    <span class="lable_text">个人地址</span>
                                    <input class="input"  type="text" placeholder="请输入个人地址" value="<{$user['Faddress']|default:''}>" name="address"/>
                                </li>
                                <li>
                                    <span class="lable_text label_img">头像</span>
                                    <input type="hidden" value="<{$user['Fimage_path']|default:''}>" name="image_path" class="js-img-path">
                                    <div class="account_user clearfix">
                                        <div class="user_avatar">
                                            <img src="<{if $user['Fimage_path']}><{$user['Fimage_path']}><{else}><{'avatar.jpg'|baseImgUrl}><{/if}>">
                                        </div>
                                    </div>
                                    <a id="image_path">修改头像</a>
                                </li>
                                <li>
                                    <span class="lable_text label_img">证件照片</span>
                                    <input type="hidden" value="<{$user['Fannex_path']|default:''}>" name="annex_path" class="js-img-path">
                                    <div class="account_user clearfix">
                                        <div class="user_avatar" style="border-radius: 0">
                                            <img src="<{if $user['Fannex_path']}><{$user['Fannex_path']}><{/if}>">
                                        </div>
                                    </div>
                                    <{if $user['Fatte_status']==0}><a id="annex_path">修改证件照片</a><{/if}>
                                </li>
                                <li>
                                    <span class="lable_text">实名认证状态</span>
                                    <span class="lable_text_left" style="color: red"><{if ($user['Fatte_status']|default:0) eq 0 }>未通过认证<{else}>已通过认证<{/if}></span>
                                </li>
                            </ul>

                            <{if ($user['Fatte_status']|default:0) eq 0 }>
                            <div style="width: 100%; margin-left: 200px">
                                <input class="btn" type="submit" value="提交认证">
                                <input class="btn" type="reset" value="重置">
                            </div>
                            <{/if}>
                            <input type="hidden" name="atte_status" value="<{$user['Fatte_status']|default:0}>">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>
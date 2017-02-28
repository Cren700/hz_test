<{include file="public/header.tpl"}>
<body xmlns="http://www.w3.org/1999/html">
<{include file="public/header_back.tpl"}>
<div class="myInfoList">
    <form action="<{'/account/saveInfo.html'|getBaseUrl}>" method="post" enctype="multipart/form-data">
        <div class="input_box box">
            <label>昵称 :</label>
            <input type="text" placeholder="请输入您的姓名" value="<{$user['Fnick_name']|default:''}>" name="nick_name"/>
        </div>
        <div class="input_box box">
            <label>真实名称 :</label>
            <input type="text" placeholder="真实名称" value="<{$user['Freal_name']|default:''}>" name="real_name"/>
        </div>
        <div class="select_box box">
            <label>证件类型 :</label>
            <label id="lblSelect">
                <select name="cert_type" id="selectPointOfInterest">
                    <option value="">请选择证件类型</option>
                    <option value="1" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 1 }>selected<{/if}>>身份证</option>
                    <option value="2" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 2 }>selected<{/if}>>驾驶证</option>
                    <option value="3" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 3 }>selected<{/if}>>护照</option>
                    <option value="4" <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 4 }>selected<{/if}>>港澳证</option>
                </select>
            </label>
        </div>
        <div class="input_box box">
            <label>证件号码 :</label>
            <input type="text" placeholder="证件号码" value="<{$user['Fcert_no']|default:''}>" name="cert_no" />
        </div>
        <div class="radio_box has-js box">
            <label class="radio_label">性别 :</label>
            <label for="radio-01" class="label_radio">
                <input type="radio" <{if ($user['Fsex']|default:1) eq 1 }>checked="checked"<{/if}> value="1" id="radio-01" name="sex" />男
            </label>
            <label for="radio-02" class="label_radio">
                <input type="radio" value="2" id="radio-02" name="sex" <{if ($user['Fsex']|default:1) eq 2 }>checked="checked"<{/if}> />女
            </label>
        </div>
        <div class="input_box box">
            <label>邮箱地址 :</label>
            <input type="text" placeholder="邮箱地址" value="<{$user['Femail']|default:''}>" name="email"/>
        </div>
        <div class="input_box box">
            <label>电话号码 :</label>
            <input type="text" placeholder="电话号码" value="<{$user['Fphone']|default:''}>" name="phone"/>
        </div>
        <div class="input_box box">
            <label>省份 :</label>
            <input type="text" name="province" placeholder="省份" value="<{$user['Fprovince']|default:''}>"/>
        </div>
        <div class="input_box box">
            <label>个人地址 :</label>
            <input type="text" name="address" placeholder="个人地址" value="<{$user['Faddress']|default:''}>"/>
        </div>
        <div class="file_box box">
            <label>头像 :</label>
            <input type="hidden" value="<{$user['Fimage_path']|default:''}>" name="image_path" class="js-img-path">
            <div class="button" id="image_path"></div>
            <img src="<{$user['Fimage_path']|default:''}>" class="js-img-show" style="<{if !$user['Fimage_path']}>display:none;<{/if}>" alt="">
        </div>
        <div class="file_box box">
            <label>证件照片 :</label>
            <input type="hidden" value="<{$user['Fannex_path']|default:''}>" name="annex_path" class="js-img-path">
            <div class="button" id="annex_path"></div>
            <img src="<{$user['Fannex_path']|default:''}>" class="js-img-show" style="<{if !$user['Fannex_path']}>display:none;<{/if}>" alt="">
        </div>
        <hr/>
        <div class="submit_box box">
            <button id="js-btn-submit">提交</button>
        </div>
    </form>
</div>

<{include file="public/no_nav_footer.tpl"}>
</body>
</html>
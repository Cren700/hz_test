if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostsTheme = (function() {
    function _init(){
        // 添加资讯
        $('#js-btn-add-posts').on('click', function(){
            var html = '\
            <tr rel="9">\
                <td><input type="text" class="post_id" name="pid" placeholder="请输入资讯ID"></td>\
                <td class="post_title"></td>\
                <td>\
                <button class="btn btn-success btn-mini js-btn-add-submit hide">确定添加</button>\
                </td>\
            </tr>';
            $('table').find('tbody').append(html);
        });

        // 获取资讯信息
        $(document).on('blur', '.post_id', function () {
            var _this = $(this);
            var _parent = _this.parents("tr");
            var pid = _this.val();
            if (pid) {
                var url = baseUrl+"/posts/getPostByPid.html?pid="+pid;
                $.get(url, [], function (res) {
                    if (res.code == 0 && res.data != null) {
                        _parent.find('.post_title').text(res.data.Fpost_title);
                        _parent.find('.js-btn-add-submit').removeClass('hide');
                    } else {
                        HZ.Dialog.showMsg({
                            title: '温馨提示',
                            msg: '没有相关内容',
                            type: 'warm'
                        });
                        _parent.find('.post_title').text('');
                        _parent.find('.js-btn-add-submit').addClass('hide');
                    }
                }, 'JSON');
            }
        });

        // 删除
        $(document).on('click', '.js-btn-delete', function () {
            if (!confirm('确认删除该资讯吗?')) {
                return false;
            }
            var _this = $(this);
            var _parent = _this.parents("tr");
            var pid = _parent.attr('rel');
            var post_ids = $.trim($('input[name="post_id"]').val());
            var post_arr = post_ids.split(',');
            var new_post_arr = [];
            $.each(post_arr, function(d, el){
                if (el != pid) {
                    new_post_arr.push(el);
                }
            });
            post_ids = new_post_arr.join(',');

            var url = baseUrl+"/posts/addThemePost.html";
            var data = {post_id: post_ids, id: $('input[name="id"]').val()};
            $.get(url, data, function (res) {
                if (res.code == 0) {
                    location.href = location.href;
                } else {
                    HZ.Dialog.showMsg({
                        title: '温馨提示',
                        msg: res.msg,
                        type: 'warm'
                    });
                }
            }, 'JSON');
        });

        // 确定添加
        $(document).on('click', '.js-btn-add-submit', function(){
            var _this = $(this);
            var _parent = _this.parents("tr");
            var pid = _parent.find('.post_id').val();
            var post_ids = $.trim($('input[name="post_id"]').val());
            if(post_ids) {
                post_ids = post_ids+','+pid;
            } else {
                post_ids = pid;
            }
            var url = baseUrl+"/posts/addThemePost.html";
            var data = {post_id: post_ids, id: $('input[name="id"]').val()};
            $.get(url, data, function (res) {
                if (res.code == 0) {
                    location.href = location.href;
                } else {
                    HZ.Dialog.showMsg({
                        title: '温馨提示',
                        msg: res.msg,
                        type: 'warm'
                    });
                }
            }, 'JSON');
        });

    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.PostsTheme.init();
})
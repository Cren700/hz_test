if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.UserQuery = (function() {
    function _init(){
        
        $('#js-all-action').on('click', function(){
            if($(this).is(":checked")) {
                $('input[name="action"]').each(function(){
                    $(this).attr('checked', true);
                })
            } else {
                $('input[name="action"]').each(function(){
                    $(this).attr('checked', false);
                })
            }
        });

        $('input[name="action"]').on('click', function () {
            if (!$(this).is(":checked")) {
                $('#js-all-action').attr('checked', false);
                return ;
            }
        });
        
        if ($('#js-do-val').val() == 1) {
            $('body textarea, body select, body input').attr('disabled', true);
        }

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            var role_name = $("input[name='role_name']").val();
            var desc = $("input[name='desc']").val();
            var is_new = $("input[name='is_new']").val();
            var id = $("input[name='id']").val();
            var url = $('#form').attr('action');
            var ids = new Array;
            $('input[name="action"]').each(function(){
                if ($(this).is(":checked")) {
                    ids.push($(this).val());
                }
            });

            var data = {role_name:role_name, desc: desc, ids:ids.join(','), is_new: is_new, id: id};
            $.ajax({
                data: data,
                dataType: 'json',
                type: 'post',
                url: url,
                success: function(res){
                    if(res.code == 0)
                    {
                        location.href = baseUrl+'/user/role.html';
                    }
                }
            })
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.UserQuery.init();
})
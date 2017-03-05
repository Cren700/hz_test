if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.InfoReport = (function() {
    function _init(){

        _sendReport();
    }

    function _sendReport()
    {
        $('#js-btn-send').on('click', function(){
            var relation = $('input[name="relation"]').val();
            var content = $('textarea[name="content"]').val();
            var data = {relation: relation, content: content};
            var url = baseUrl + '/info/sendReport.html';
            $.ajax({
                data: data,
                type: "post",
                dataType: "json",
                url: url,
                success: function (res) {
                    if (res.code === 0) {
                        HZ.Dialog.showMsg({title: '提交成功,后续客服将于您联系!'});
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
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
    HZ.InfoReport.init();
})
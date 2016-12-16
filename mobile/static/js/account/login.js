if (typeof (YPAPP) == "undefined" || !YPAPP) {
    var YPAPP = {}
}
YPAPP.Login = (function () {

    function _init() {
        $('#js-get-vc, #js-vc-img').on('click', function (e) {
            e.preventDefault();
            $(this).attr('id') === 'js-get-vc' ? $(this).hide():'';
            showVC();
        });

        $('input[name=vc]').on('focus', function (e) {
            if(!$('#js-vc-img').attr('src')) {
                $('#js-get-vc').hide();
                showVC();
            }
        });
    }

    function showVC()
    {
        var now = new Date();
        $("#js-vc-img").attr('src', "/login/getVC.html?="+ now.getTime());
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    YPAPP.Login.init();
})

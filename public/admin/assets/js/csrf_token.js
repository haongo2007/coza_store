jQuery(document).ready(function($) {
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (settings.data != null) {
                if (typeof settings.data == "object") {
                    settings.data.append('csrf_test_name', encodeURIComponent(Cookies.get('csrf_cookie_name')));
                }else{
                    settings.data += '&csrf_test_name=' + encodeURIComponent(Cookies.get('csrf_cookie_name'));
                }
            }
        }
    });
});
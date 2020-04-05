jQuery(document).ready(function($) {
/*  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  var get_c = getCookie('remember');
	if (get_c != '') {
      var data = $.parseJSON(get_c);
  		$("input[name='remember']").attr('checked','checked');
  		$("input[name='email']").val(data.tk);
  		$("input[name='password']").val(data.mk);
	}*/
	$("#my_lg").submit(function( event ) {
      event.preventDefault();
      var url = $(this).attr('action');
      var tk = $("input[name='email']").val();
      var ps = $("input[name='password']").val();
      var rm = $("input[name='remember']").prop('checked');
      var dataform = 'email='+tk+'&password='+ps+'&remember='+rm;
      $.ajax({
        url: url,
        type: 'POST',
        data: dataform
      })
      .done(function(data) {
        var res = $.parseJSON(data);
      	if (res.noty == 'fail') {
      		$('.alert .txt').text(res.ref);
      		$('.alert').removeClass('d-none');
      	}else{
      		location.assign(res.ref);
      	}
      });
	});
});
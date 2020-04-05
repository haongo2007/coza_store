jQuery(document).ready(function($) {
	$('#exampleModal').on('shown.bs.modal', function (e) {
		var $invoker = $(e.relatedTarget).attr('data_id');
		$(this).find('.id_payment').val($invoker);
		var data = $.parseJSON($(e.relatedTarget).attr('data-value'));
		$(this).find("[name='username']").val(data.username);
		$(this).find("[name='password']").val(data.password);
		$(this).find("[name='signature']").val(data.signature);
		if (data.status == 'off') {
			$(this).find("[name='status']").removeAttr('checked');
		}
	})
});
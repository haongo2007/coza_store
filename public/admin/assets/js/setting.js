jQuery(document).ready(function($) {
	$('.add-resize').click(function(event) {
		var i = $('.recipe').children('.form-group').length + 1;
		var coun = $('.recipe').prev("input[name='count']").val(i);
		$('.recipe').append(
			'<div class="form-group">'+
				'<div class="row">'+
	              	'<div class="col-sm-6">'+
						'<div class="input-group input-group-merge">'+
							'<div class="input-group-prepend rmv-rsiz" data="0">'+
								'<span class="input-group-text"><i class="ni ni-fat-remove"></i></span>'+
							'</div>'+
						  	'<input type="number" class="form-control" name="re_horizontal_'+i+'" placeholder="Chiều Ngang (300)" required>'+
						'</div>'+
					'</div>'+
	              	'<div class="col-sm-6">'+
	                	'<input type="number" class="form-control" name="re_vertical_'+i+'" placeholder="Chiều Dọc (300)" value="" required>'+
	              	'</div>'+
	            '</div>'+
            '</div>'
		);
		i++;
	});
	$('body').on('click', '.rmv-rsiz', function(event) {
		var check = $(this).attr('data');
		if (check == 0) {
			$(this).parents('.form-group').remove();
			return false;
		}
		var ind = $(this).parents('.form-group').index();
		var url = $('.recipe').attr('url');
		$.ajax({
			url: url,
			type: 'POST',
			data : {'ind': ind},
			success: function(data)
			{
				var res = $.parseJSON(data);
				if (res.noty == 'fail') {
					toastr.error(res.ref);
				}else{
					toastr.success(res.ref);
					console.log(res.data);
					$('.recipe').prev("input[name='count']").val(res.data.count);
					$('.recipe').children('.form-group').remove();
					for (var i = 1; i <= parseInt(res.data.count); i++) {
						var ver = 're_vertical_'+i;
						var hor = 're_horizontal_'+i;
						$('.recipe').append(
							'<div class="form-group">'+
								'<div class="row">'+
					              	'<div class="col-sm-6">'+
										'<div class="input-group input-group-merge">'+
											'<div class="input-group-prepend rmv-rsiz" data="'+i+'">'+
												'<span class="input-group-text"><i class="ni ni-fat-remove"></i></span>'+
											'</div>'+
										  	'<input type="number" class="form-control" name="re_horizontal_'+i+'" placeholder="Chiều Ngang (300)" value="'+res.data[hor]+'" required>'+
										'</div>'+
									'</div>'+
					              	'<div class="col-sm-6">'+
					                	'<input type="number" class="form-control" name="re_vertical_'+i+'" placeholder="Chiều Dọc (300)" value="'+res.data[ver]+'" required>'+
					              	'</div>'+
					            '</div>'+
				            '</div>'
						);
					}
				}
			}
			
		})
	});
	$('.del_slide').click(function(event) {
		var id = $('.slide_name').val();
		var url = $(this).attr('url');
	 	if(!confirm('Bạn chắc chắn muốn xóa ?'))
        {
            return false;
        }
		$.ajax({
			url: url,
			type: 'POST',
			data : {'id': id},
			success: function(data)
			{
				var res = $.parseJSON(data);
				if (res.noty == 'fail') {
					toastr.error(res.ref);
				}else{
					window.location.assign(res.ref);
				}
			}
			
		})
	});
	$('.get_slide').click(function(event) {
		var id = $('.slide_name').val();
		if (id == 0) {
			toastr.error('Vui Lòng Chọn Slide Cần Sửa');
			return false;
		}
		$('#exampleModal').find('.modal-title').text('Sửa Slide');
		var new_act = $(this).attr('url');
		var name = $('.slide_name').children("option:selected").attr('data-name');
		var link = $('.slide_name').children("option:selected").attr('data-link');
		var info = $('.slide_name').children("option:selected").attr('data-info');
		var sort_order = $('.slide_name').children("option:selected").attr('data-sort_order');
		$('#exampleModal').find("input[name='name']").val(name);
		$('#exampleModal').find("input[name='link']").val(link);
		$('#exampleModal').find("input[name='sort_order']").val(sort_order);
		$('#exampleModal').find("input[name='info']").val(info);
		$('#exampleModal').find('#my_form').attr('action',new_act+id);
		$('#exampleModal').modal('show');
	});
	$('.add_slide').click(function(event) {
		$('#exampleModal').find('.modal-title').text('Thêm Slide');
		$('#my_form').trigger('reset');
		var new_act = $('#exampleModal').find('#my_form').attr('data-act');
		$('#exampleModal').find('#my_form').attr('action',new_act);
		$('#exampleModal').modal('show');
	});
});
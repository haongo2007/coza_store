jQuery(document).ready(function($) {
	$(".mySelect").select2({
		dropdownParent: $("#exampleModal")
	});
	function call_icheck() {
		$('.mailbox-messages input[type="checkbox"]').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
	    });
	};
	var url = $('#datatable-basic').attr('data-url');
	var dataTable = $('#datatable-basic').DataTable({
	searchDelay: 1000,
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
        }
    },
	"lengthMenu": [5,10,15,20],
   	"processing":true,  
   	"serverSide":true,  
   	"order":[],  
   	"ajax":{  
        url: url,  
        type:"POST",
   	},
   	"fnDrawCallback" : function() {
	    call_icheck();
	},
	'createdRow': function( row, data, dataIndex ) {
	    $(row).addClass('row_'+data.id);
	},
   	"columns":[
        {"data":"id"},
        {"data":"thutu"},
        {"data":"name","orderable":false},
        {"data":"action","orderable":false},		
        {"data":"chooseall","orderable":false}
	],
	"initComplete": function () {
        call_icheck();
	}
	});
	$(".checkbox-toggle").click(function () {
		var clicks = $(this).data('clicks');
		if (clicks) {
		//Uncheck all checkboxes
			$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
			$(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
		} else {
		//Check all checkboxes
			$(".mailbox-messages input[type='checkbox']").iCheck("check");
			$(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
		}
		$(this).data("clicks", !clicks);
    });
    $('#submit').click(function(){ //tim toi the co id = submit,su kien click
		if(!confirm('Bạn chắc chắn muốn xóa tất cả dữ liệu ?'))
		{
			return false;
		}
		
		var ids = new Array();
		$('[name="id[]"]:checked').each(function()
		{
			ids.push($(this).val());
		});
		
		if (!ids.length){ 
			toastr.error('Xin Chọn Vào Mục Cần Xóa');
			return false;
		}
		//link xoa du lieu
	    var url  = $(this).attr('url');
		//ajax để xóa
		$.ajax({
			url: url,
			type: 'POST',
			data : {'ids': ids},
			success: function(data)
			{
				var res = $.parseJSON(data);
				if (res.noty == 'fail') {
					toastr.error(res.ref);
				}else{
					$.each(res, function(k, v) {
						if (v.noty == 'done') {
							$('tr.row_'+v.id).fadeOut();
							toastr.success(v.ref);
						}else{
							toastr.error(v.ref);
						}
					});
				}
			}
			
		})
		return false;
	});
	$('body').on('click', '.category_add', function(event) {
		var id = $(this).attr('data-id');
		var attr = $(this).attr('data-action');
		var md_ct = $('#exampleModal').find('.modal-content');
        var action = $('#category_form').attr('action');
        $('.js-example-tokenizer').children('option').remove();
		md_ct.find("input[name='name']").val('');
		md_ct.find("input[name='sort']").val('');
		md_ct.find("input[name='title']").val('');
		md_ct.find("#exampleFormControlTextarea1").val('');
		md_ct.find(".bootstrap-tagsinput:nth-of-type(2) .badge").remove();
		md_ct.find('.meta-tags').tagsinput('removeAll');
        switch (attr) { 
			case 'edit': 
				/* sửa */
				var par_id = $(this).attr('data-parent-id');
				var url = $(this).attr('data-url');
	    		var new_act = action.replace("add", "edit");
	    		$('#category_form').attr('action',new_act);
	    		$('#category_form').attr('data-id',id);
	    		var sort = $('.row_'+id).children('td:nth-child(2)').text();
				var name = $('.row_'+id).children('td:nth-child(3)').find('span:nth-child(1)').text();
				var title = $('.row_'+id).children('td:nth-child(4)').find("input[type='hidden']").attr('site_title');
				var metakey = $('.row_'+id).children('td:nth-child(4)').find("input[type='hidden']").attr('meta_key');
				var metadesc = $('.row_'+id).children('td:nth-child(4)').find("input[type='hidden']").attr('meta_desc');
	    		md_ct.find('.modal-title').html('Sửa danh mục '+name);
	    		md_ct.find("input[name='name']").val(name);
	    		md_ct.find("input[name='sort']").val(sort);
	    		md_ct.find("input[name='title']").val(title);
	    		md_ct.find("#exampleFormControlTextarea1").val(metadesc);
	    		var mk = metakey.replace(/\[/g,"").replace(/]/,"");
	    		var mk_to_ar = mk.split(",");
	    		$.each(mk_to_ar, function(k, v) {
    				$('.meta-tags').tagsinput('add', v);
	    		});
	    		md_ct.find('.btn-success').text('Sửa');
	    		$(".mySelect option").each(function()
				{
					md_ct.find("option[value='"+par_id+"']").attr('selected', 'selected');
				});
				$('.mySelect').val(par_id).trigger('change');
				break;
			case 'add': 
				/* thêm */
				var new_act = action.replace("edit", "add");
	    		$('#category_form').attr('action',new_act);
	    		$('#category_form').removeAttr('data-id');
	    		md_ct.find('.modal-title').html('Thêm danh mục');
	    		md_ct.find('.btn-success').text('Thêm');
				break;
			case 'view': 
				var sort = $('.row_'+id).children('td:nth-child(2)').text();
				var name = $('.row_'+id).children('td:nth-child(3)').find('span:nth-child(1)').text();
				var title = $('.row_'+id).children('td:nth-child(4)').find("input[type='hidden']").attr('site_title');
				var metakey = $('.row_'+id).children('td:nth-child(4)').find("input[type='hidden']").attr('meta_key');
				var metadesc = $('.row_'+id).children('td:nth-child(4)').find("input[type='hidden']").attr('meta_desc');
				var banner = $('.row_'+id).children('td:nth-child(4)').find("input[type='hidden']").attr('banner');
				var md_ct_v = $('#exampleModalview').find('.modal-content');
				var mk = metakey.replace(/\[/g,"").replace(/]/,"");
				md_ct_v.find('tbody').children('tr').children('td:nth-child(1)').text(name);
				md_ct_v.find('tbody').children('tr').children('td:nth-child(2)').text(title);
				md_ct_v.find('tbody').children('tr').children('td:nth-child(3)').text(mk);
				md_ct_v.find('tbody').children('tr').children('td:nth-child(4)').text(metadesc);
				md_ct_v.find('tbody').children('tr').children('td:nth-child(5)').html('<img src="'+banner+'" width="100">');
				break;		
			default:
				toastr.error('Chức Năng Này Không Tồn Tại');
		}
	});
	$('#category_form').submit(function(e) {
		e.preventDefault();
        var _this = $(this),
		url = _this.attr('action'),
    	file_data = $('#banner').prop('files')[0];
    	var form_data = new FormData();
		var data = $(this).serialize();
		var id = _this.attr('data-id');
        if (typeof id !== typeof undefined && id !== false) {
        	data += '&id='+id;
        }
		form_data.append('file', file_data);
    	form_data.append('data', data);
        $.ajax({
        	url: url,
        	type: 'POST',
        	data: form_data,
            contentType:false,
            processData:false
        })
        .done(function(data) {
        	var res = $.parseJSON(data);
            if (res.noty == 'done') {
            	window.location.assign(res.ref);
            }else{
            	toastr.error(res.ref);
            	$('#exampleModal').modal('hide');
            }
        })
	});
});
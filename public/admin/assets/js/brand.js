jQuery(document).ready(function($) {
	function call_icheck() {
		$('.mailbox-messages input[type="checkbox"]').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
	    });
	}
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
        {"data":"logo","orderable":false},
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
	$('#brand_form').submit(function(e) {
		event.preventDefault();
        var _this = $(this);
    	var url = _this.attr('action');
    	var file_data = $('#logofile').prop('files')[0];
        var name = $("input[name='name']").val();
        var sort = $("input[name='sort']").val();

        var form_data = new FormData();
        var id = _this.attr('data-id');
        if (typeof id !== typeof undefined && id !== false) {
        	form_data.append('id', id);
        }
        form_data.append('file', file_data);
        form_data.append('name', name);
        form_data.append('sort', sort);
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
            	$('#exampleModal').modal('hide');
        		toastr.error(res.ref);
            }
        })
	});
	$('body').on('click', '.brand_add', function(event) {
		var attr = $(this).attr('data-id');
		var md_ct = $('.modal-content');
        var action = $('#brand_form').attr('action');
		if (typeof attr !== typeof undefined && attr !== false) {
			var id = $(this).attr('data-id');
			var url = $(this).attr('data-url');
    		var new_act = action.replace("add", "edit");
    		$('#brand_form').attr('action',new_act);
    		$('#brand_form').attr('data-id',id);
    		var sort = $('.row_'+id).children('td:nth-child(2)').text();
			var name = $('.row_'+id).children('td:nth-child(3)').text();
			var img = $('.row_'+id).children('td:nth-child(4)').children('img').attr('src');
			md_ct.find('.modal-title').html('Thêm nhãn hiệu');
    		md_ct.find("input[name='name']").val(name);
    		md_ct.find("input[name='sort']").val(sort);
    		md_ct.find('.img_br').attr('src', img);
    		md_ct.find('.img_br').removeClass('d-none');
    		md_ct.find('.btn-success').text('Sửa');
    		md_ct.find('.modal-title').html('Sửa nhãn hiệu '+name);
		}else{
			var new_act = action.replace("edit", "add");
			$('#brand_form').removeAttr('data-id');
    		$('#brand_form').attr('action',new_act);
    		md_ct.find('.modal-title').html('Thêm nhãn hiệu');
    		md_ct.find("input[name='name']").val('');
    		md_ct.find("input[name='sort']").val('');
    		md_ct.find('.img_br').attr('src', null);
    		md_ct.find('.img_br').addClass('d-none');
    		md_ct.find('.btn-success').text('Thêm');
		}
	});
});
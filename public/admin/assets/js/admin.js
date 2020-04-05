jQuery(document).ready(function($) {
	$(".checkbox-toggle").click(function () {
		var clicks = $(this).data('clicks');
		if (clicks) {
		//Uncheck all checkboxes
			$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
		} else {
		//Check all checkboxes
			$(".mailbox-messages input[type='checkbox']").iCheck("check");
		}
		$(this).data("clicks", !clicks);
    });
    $('.checkbox-action').click(function(event) {
		var clicks = $(this).data('clicks');
		if (clicks) {
		//Uncheck all checkboxes
			$(this).nextAll('.mailbox-messages').find("input[type='checkbox']").iCheck("uncheck");
		} else {
		//Check all checkboxes
			$(this).nextAll('.mailbox-messages').find("input[type='checkbox']").iCheck("check");
		}
		$(this).data("clicks", !clicks);
    });
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
   	"columns":[
        {"data":"name","orderable":false},
        {"data":"email","orderable":false},
        {"data":"sdt","orderable":false},
        {"data":"adr","orderable":false},
        {"data":"pos","orderable":false},		
        {"data":"crea","orderable":false},		
        {"data":"act","orderable":false}
	],
	"initComplete": function () {
		$('body').on('click', '.verify_action', function(event){
        	if(!confirm('Bạn chắc chắn muốn xóa ?'))
	        {
	            return false;
	        }
	    });
	}
	});
	$('#admin_form').validate({
        ignore: [],
        errorPlacement: function() {},
        submitHandler: function() {
        	event.preventDefault();
	        var _this 	= $('#admin_form'),
	    	url 		= _this.attr('action'),
	        id 			= _this.attr('data-id'),
	        data 		= _this.serialize();
	        if (id != null) {
	        	data += '&id='+id;
	        }
	        $.ajax({
	            url: url,
				type: 'POST',
				data : {data : data},
	        })
	        .done(function(data) {
	        	var res = $.parseJSON(data);
	            if (res.noty == 'done') {
	            	window.location.assign(res.ref);
	            }else{
	            	if (res.ref.search('Không Có Quyền') > 0) {
						$('#exampleModal').modal('hide');
					}
	            	toastr.error(res.ref);
	            }
	        })
        },
        rules: {
            email: {
				required: true,
				email: true
			},
            password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			name: {
				required: true,
				minlength: 5
			},
			phone: {
				required: true,
				minlength: 5
			},
			address: {
				required: true,
				minlength: 5
			},
			position: {
				required: true,
				minlength: 5
			}
        },
        messages: {
			email: "Vui lòng nhập một địa chỉ email hợp lệ",
			password: {
				required: "vui lòng cung cấp mật khẩu",
				minlength: "Mật khẩu của bạn phải dài ít nhất 5 ký tự"
			},
			confirm_password: {
				required: "vui lòng cung cấp mật khẩu",
				minlength: "Mật khẩu của bạn phải dài ít nhất 5 ký tự",
				equalTo: "Vui lòng nhập mật khẩu giống như ở trên"
			},
			name: {
				required: "Vui Lòng Nhập Tên Của Quản Trị viên",
				minlength: "Tên quản trị viên phải dài ít nhất 5 ký tự"
			},
			phone: {
				required: "Vui Lòng Nhập Số Điện Thoại Của Quản Trị viên",
				minlength: "Số điện thoại phải dài ít nhất 5 ký tự"
			},
			address: {
				required: "Vui Lòng Nhập Địa Chỉ Của Quản Trị viên",
				minlength: "Địa chỉ phải dài ít nhất 5 ký tự"
			},
			position: {
				required: "Vui Lòng Nhập Chức Vụ Của Quản Trị viên",
				minlength: "Chức vụ phải dài ít nhất 5 ký tự"
			}
        }
    });
	$('body').on('click', '.action_admin', function(event) {
		var act = $(this).attr('data-action'),
			admin_form = $('#admin_form'),
        	action = admin_form.attr('action');
		switch (act) {
			case 'edit':
	    		var new_act = action.replace("add", "edit");
	    		var id = $(this).attr('data-id');
				$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
				var val = $(this).next('.d-none').text();
				var val = $.parseJSON(val);
				$.each(val,function(index, el) {
					$.each(el,function(i, vl) {
						$('.perms-cb').find("#"+index+vl).iCheck("check");
					});
				});
	    		admin_form.attr('action',new_act);
	    		var table = $(this).parents('tr'),
		    		name  = table.children('td:nth-child(1)').text(),
		    		email = table.children('td:nth-child(2)').text(),
		    		sdt   = table.children('td:nth-child(3)').text(),
		    		adr   = table.children('td:nth-child(4)').text(),
		    		pos   = table.children('td:nth-child(5)').text();
	    		admin_form.find("input[name='name']").val(name);
	    		admin_form.find("input[name='email']").val(email);
	    		admin_form.find("input[name='phone']").val(sdt);
	    		admin_form.find("input[name='address']").val(adr);
	    		admin_form.find("input[name='position']").val(pos);
	    		admin_form.find("input[name='password']").val('');
	    		admin_form.attr('data-id', id);

				$('#admin_form').validate().settings.ignore = "#password,#confirm_password";
	    		$('#admin_form').find("button[type='submit']").text('Sửa');
				break;
			case 'add':
	    		var new_act = action.replace("edit", "add");
				$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
				admin_form.find(".form-control").val('');
	    		admin_form.attr('action',new_act);
	    		admin_form.find("button[type='submit']").text('Thêm');
				break;
			default:
				toastr.error('Chức Năng Này Không Tồn Tại');
		}
	});
});
jQuery(document).ready(function($) {
	
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
	        url:url,  
	        type:"POST",
	   	},
	   	'createdRow': function( row, data, dataIndex ) {
		    $(row).addClass('row_'+data.id);
		},
	   	"columns":[
	        {"data":"id"},
	        {"data":"ten_sp","orderable":false},
	        {"data":"img","orderable":false},
	        {"data":"color","orderable":false},		
	        {"data":"gia"},
	        {"data":"date_created","orderable":false},
	        {"data":"user_created","orderable":false},
	        {"data":"hanhdong","orderable":false},
		],
		"initComplete": function () {
	        $('#datatable-basic tbody').on('click','.code',function(event) {
	        	var data = $(this).attr('data-img');
  				$(this).parent().parent().prev().find('.ima-res').attr('src', data);
  				$('.code').removeClass('activ');
  				$(this).addClass('activ');
			});
			$('body').on('click', '.verify_action', function(event){
	        	if(!confirm('Bạn chắc chắn muốn xóa ?'))
		        {
		            return false;
		        }
		    });
		}
	});
	/* xử lý thêm multiple color */
	$('.addclr').click(function(event) {
		var i = $('#product_form').find('#box-cl').children('.same').length + 1;
		$('#box-cl').animate({scrollTop: $('#box-cl')[0].scrollHeight}, 500);
		var vl = parseInt($('.count_file').val());
		$('.count_file').val(vl+1);
		$('#box-cl').append(
		'<div class="att_'+i+' same">'+
		'<div class="form-group">'+
			'<label >Thuộc Tính Sản Phẩm Thứ '+i+':</label>'+
			'<input required class="form-control color_'+i+'" name="color_'+i+'" type="text" placeholder="Tên Màu" />'+
			'<label id="color_'+i+'-error" class="error" for="color_'+i+'" style="display: none;"></label>'+
			'<input required class="form-control" name="code_'+i+'" type="color" />'+
		'</div>'+
		'<div class="form-group">'+
			'<label>Có Thể Chọn Nhiều Ảnh:</label>'+
			'<input class="form-control" type="file" name="image_attr_'+i+'[]" multiple/>'+
		'</div>'+
		'<div class="form-group">'+
			'<label>Kích thước sản phẩm:</label>'+
			'<input required class="form-control" name="size_'+i+'" type="text" placeholder="Size (VD: Size L)" />'+
			'<label id="size_'+i+'-error" class="error" for="size_'+i+'" style="display: none;"></label>'+
		'</div></div>'+
		'<hr>'
		);
		i++;
	});
	var format = function(num){
	    var str = num.toString(), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(".") > 0) {
	        parts = str.split(".");
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++) {
	        if(str[j] != ",") {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1)) {
	                output.push(",");
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	};

	$('.price').keyup(function () {
		$(this).val(format($(this).val()));
	});
	/* xu ly */
	$('body').on('click', '.action_product', function(event) {
		var attr = $(this).attr('data-action'),
			form_selector = $('#product_form'),
			action = form_selector.attr('action'),
			modal_form_selector = $('#Modal_add_edit').find('.modal-content');
			/* remove field */
			form_selector.find('.meta-tags').tagsinput('removeAll');;
		switch (attr) {
			case 'edit': 
				var id = $(this).attr('data-id'),
				new_act = action.replace("add", "edit"),
	    		value_edit = $('.valuesetedit_'+id).text(),
	    		value_edit = $.parseJSON(value_edit);
	    		/* fetch data to field*/
				$('#box-cl').html('');
	    		modal_form_selector.find('.modal-title').html('Sửa Sản phẩm '+value_edit.name);
	    		form_selector.attr('action',new_act);
	    		form_selector.attr('data-id', id);
	    		form_selector.find("input[name='name']").val(value_edit.name);
	    		form_selector.find("input[name='price']").val(value_edit.price);
	    		form_selector.find("input[name='discount']").val(value_edit.discount);
	    		form_selector.find("input[name='stock']").val(value_edit.amount);
	    		form_selector.find("input[name='site_title']").val(value_edit.meta_title);
	    		form_selector.find("textarea[name='meta_desc']").text(value_edit.meta_desc.trim());
	    		CKEDITOR.instances['content'].setData(value_edit.content);
	    		var meta_key = value_edit.meta_key.replace(/\[/g,"").replace(/]/,"");
	    		var meta_key = meta_key.split(",");
	    		$.each(meta_key, function(k, v) {
	    			var v = v.replace(/['"]+/g, '');
	    			$('.meta-tags').tagsinput('add', v);
	    		});
	    		$("#category option").each(function()
				{
					$('#category').find("option[value_child='"+value_edit.category+"']").attr('selected', 'selected');
				});
				$("#brand option").each(function()
				{
					$('#brand').find("option[value='"+value_edit.brand+"']").attr('selected', 'selected');
				});
				var count = value_edit.attb.image_list.split('|'),
					color = value_edit.attb.name.split('|'),
					code = value_edit.attb.code.split('|'),
					size = value_edit.attb.size.split('|'),
					id_attb = value_edit.attb.id;
	    			form_selector.find("input[name='count']").val(count.length);

				for (var i = 0; i < count.length; i++) {
					var j = i + 1;
					var name_pr = value_edit.title;
					var path_image = value_edit.path+color[i]+'/';
					$('#box-cl').append(
					'<div class="att_'+j+' same">'+
					'<div class="form-group">'+
						'<label >Thuộc Tính Sản Phẩm Thứ '+j+':</label>'+
						'<input class="form-control color_'+j+'" name="color_'+j+'" type="text" value="'+color[i]+'" />'+
						'<input class="form-control" name="code_'+j+'" type="color" value="'+code[i]+'" />'+
					'</div>'+
					'<div class="form-group row m-0 mb-3">'+
						'<label class="col-md-12">Có Thể Chọn Nhiều Ảnh:</label>'+
						'<input class="form-control col-md-6" type="file" name="image_attr_'+j+'[]" multiple/>'+
						'<div class="btn-group cls-vdtim ml-3" role="group" aria-label="Basic example">'+
			                '<button type="button" class="btn btn-info view_detail_image" data-toggle="modal" data-target="#view_image_detail">Xem Ảnh <span class="d-none img">'+count[i]+'</span><span class="d-none path" color="'+color[i]+'">'+path_image+'</span></button>'+
			                '<button type="button" data-name="'+value_edit.title+'" data-mau="'+color[i]+'" data-id="'+id_attb+'" data-position="'+i+'" class="del-imcl btn btn-danger">Xóa</button>'+
		              	'</div>'+
					'</div>'+
					'<div class="form-group">'+
						'<label>Kích thước sản phẩm:</label>'+
						'<input class="form-control" name="size_'+j+'" type="text" value="'+size[i]+'" />'+
					'</div></div>'+
					'<hr>'
					);
				}
	    		form_selector.find('.submit_form').text('Sửa');
				break;
			case 'add':
				var new_act = action.replace("edit", "add");
	    		form_selector.attr('action',new_act);
	    		form_selector.removeAttr('data-id');
	    		modal_form_selector.find('.modal-title').html('Thêm Sản phẩm');
	    		form_selector.find('.submit_form').text('Thêm');
	    		form_selector.trigger('reset');
	    		form_selector.find("textarea[name='meta_desc']").text(null);
	    		CKEDITOR.instances['content'].setData(null);
	    		var x = form_selector.find('#box-cl').children('.same').length;
	    		if (x > 1) {
	    			for (var i = x ; i >= 0; i--) {
	    				if (i > 1) {
	    					form_selector.find('#box-cl').children('.att_'+i).remove();
	    					$('.count_file').val(1);
	    					form_selector.find('#box-cl').children('hr:nth-child('+i+')').remove();
	    				}
	    			}
	    		}
	    		form_selector.find('.meta-tags').tagsinput('removeAll');
	    		form_selector.find("input[name='color_1']").val(null);
	    		form_selector.find("input[name='code_1']").val(null);
	    		form_selector.find("input[name='size_1']").val(null);
	    		form_selector.find('.cls-vdtim').remove();
				break;
				case 'view':
				var id = $(this).attr('data-id');
				var view_selector = $('#Modal_view').find('.product_view_content');
				var value_view = $('.valuesetedit_'+id).text();
				var value_view = $.parseJSON(value_view);
				view_selector.text(value_view);
				break;
			default:
				toastr.error('Chức Năng Này Không Tồn Tại');
		}
	});
	$('body').on('click', '.view_detail_image', function(event) {
		var data = $(this).children('.img').text(),
			content = $('#view_image_detail').find('.modal-body'),
			path = $(this).children('.path').text(),
			color = $(this).children('.path').attr('color'),
			base_url = content.attr('data_base_url');
			data = $.parseJSON(data);
			content.html('');
			$('#view_image_detail').find('.modal-title').text('Xem Chi Tiết Thuộc Tính Màu '+color);
			$.each(data,function(index, item) {
				content.append('<div class="p-2 w-50">'+
					'<div class="card">'+
            		'<img class="card-img-top" src="'+base_url+path+item+'" alt="Card image cap">'+
          			'</div></div>');	
			});
	});
    $('#product_form').validate({
        ignore: [],
        errorPlacement: function() {},
        submitHandler: function() {
        	event.preventDefault();
			var _this = $('#product_form'),
				formData = new FormData();
				url = _this.attr('action'),
				id  = _this.attr('data-id');
				get_input = _this.find('.same');
			for (var i = 0; i < get_input.length; i++) {
				var j = i + 1,
					input = $('.att_'+j).find("input[type='file']"),
					c_f = input.get(0).files,
					file = input.prop('files');
					for (var x = 0; x < c_f.length; x++) {
						formData.append("image_attr_"+j+"[]",file[x]); 
					}	
			}
			formData.append('data',_this.serialize());
			if (typeof id !== typeof undefined && id !== false) {
	        	formData.append('id',id);
	        }
			$.ajax({
			    type:"POST",
			    url:url,
			    data:formData,
			    contentType:false,
			    processData:false
			})
			.done(function(data) {
				var res = $.parseJSON(data);
				if (res.noty == 'done') {
					window.location.assign(res.ref);
				}else{
					if (res.ref.search('Không Có Quyền') > 0) {
						$('#Modal_add_edit').modal('hide');
					}
					toastr.error(res.ref);
				}
			});	
        },
        invalidHandler: function() {
            setTimeout(function() {
                $('.nav-pills a small.required').remove();
                var validatePane = $('.tab-validate .tab-pane:has(input.error)').each(function() {
                    var id = $(this).attr('id');
                    $('.nav-pills').find('a[href^="#' + id + '"]').append(' <small class="required">***</small>');
                });
            });            
        },
        rules: {
            name: {
				required: true,
				minlength: 5
			},
            site_title: 'required',
            meta_desc: 'required',
            price: 'required',
            stock: 'required',
            color_1: 'required',
            size_1: 'required',
            content: {
				required: function(textarea) {
					CKEDITOR.instances['content'].updateElement();
					var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
					return editorcontent.length === 0;
				}
			}
        },
        messages: {
            name: {
				required: 'Vui Lòng Nhập Tên Của Sản Phẩm',
				minlength: "Tên Sản Phẩm Phải Ít Nhất 5 Ký Tự"
			},
			color_1 : 'Tên Màu Của Sản Phẩm',
			size_1 : 'Kích Thước Của Sản Phẩm',
            site_title: 'Vui Lòng Nhập Tiêu Đề Của Trang',
            meta_desc: 'Vui Lòng Nhập Mô Tả Của Trang',
            price: 'Vui Lòng Nhập Giá Của Sản Phẩm',
            stock: 'Vui Lòng Nhập Số Lượng Của Sản Phẩm',
            content: 'Vui Lòng Nhập Nội Dung Của Sản Phẩm'
        }
    });
    $('body').on('click', '.del-imcl', function(event){
    	if(!confirm('Bạn chắc chắn muốn xóa ?'))
        {
            return false;
        }
		var _this 	= $(this),
		position 	= _this.attr('data-position'),
		id 		 	= _this.attr('data-id'),
		name 	 	= _this.attr('data-name'),
		mau 	 	= _this.attr('data-mau'),
		url 		= _this.parents('#product_form').attr('action'),
		url 		= url.replace("edit", "del_attb");
		$.ajax({
	        method: "POST",
	        url: url,
	        data:'id='+id+'&po='+position+'&name='+name+'&mau='+mau,
	        success: function(data)
			{	
				var res = $.parseJSON(data);
	            if (res.noty == 'done') {
	            	$('#box-cl').children('.same').remove();
	            	$('#box-cl').find('hr').remove();
	            	if (res.count == 1) {
	            		var name = res.data.name;
	            		var code = res.data.code;
	            		var size = res.data.size;
	            		var image = res.data.image_list;
            		}else{
	            		var name_x = res.data.name.split('|');
	            		var code_x = res.data.code.split('|');
	            		var size_x = res.data.size.split('|');
	            		var image_x = res.data.image_list.split('|');
            		}
            		for (var i = 1; i <= res.count; i++) {
        				var j = i - 1;
            			if (res.count > 1) {
            				var name  = name_x[j],
            					code  = code_x[j],
            					size  = size_x[j];
            					image = image_x[j];
            			}

						var path_image = res.data[0].attb_path+res.data[0].name_pr+'/'+name+'/';
            			$('#box-cl').append(
							'<div class="att_'+i+' same">'+
							'<div class="form-group">'+
								'<label >Thuộc Tính Sản Phẩm Thứ '+i+':</label>'+
								'<input class="form-control color_'+i+'" name="color_'+i+'" type="text" value="'+name+'" />'+
								'<input class="form-control" name="code_'+i+'" type="color" value="'+code+'" />'+
							'</div>'+
							'<div class="form-group row m-0 mb-3">'+
								'<label class="col-md-12">Có Thể Chọn Nhiều Ảnh:</label>'+
								'<input class="form-control col-md-6" type="file" name="image_attr_'+j+'[]" multiple/>'+
								'<div class="btn-group cls-vdtim ml-3" role="group" aria-label="Basic example">'+
					                '<button type="button" class="btn btn-info view_detail_image" data-toggle="modal" data-target="#view_image_detail">Xem Ảnh <span class="d-none img">'+image+'</span><span class="d-none path" color="'+name+'">'+path_image+'</span></button>'+
					                '<button type="button" data-name="'+res.data[0].name_pr+'" data-mau="'+name+'" data-id="'+res.data[0].id+'" data-position="'+j+'" class="del-imcl btn btn-danger">Xóa</button>'+
				              	'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label>Kích thước sản phẩm:</label>'+
								'<input class="form-control" name="size_'+i+'" type="text" value="'+size+'" />'+
							'</div></div>'+
							'<hr>'
						);
            		}
	            	toastr.success(res.ref);
	            	$('.count_file').val($('.count_file').val() - 1);
	            }else{
	            	toastr.error(res.ref);
	            }
			}
	    });
	});
 });
jQuery(document).ready(function($) {
	function get_order() {
		$('#datatable-basic > tbody').on('click', '.get_order', function () {
        	$('.content-order').html('');
			var _this = $(this),
				id = _this.attr('data-id'),
				url = _this.attr('data-url'),
				link = $(".modal-footer").attr('data-update');
			$.ajax({
		            method: "POST",
		            url: url,
		            data:'or='+id,
		            async: true,
		            success: function(data)
					{	
						try {
					        var res = $.parseJSON(data);
					        if (res.noty == 'fail') {
								toastr.error(res.ref);
							}
					    } catch (e) {
					    	$('#exampleModal').modal('show');
							$('.content-order').html(data);
					    }
						
					}
	        }).fail(function(jqXHR, textStatus, errorThrown){
			            alert("Unable to save new list order: " + errorThrown);
	        });
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
			"lengthMenu": [10,15,20],
           	"processing":true,  
           	"serverSide":true,  
           	"order":[],  
           	"ajax":{  
                url:url,  
                type:"POST",
           	},  
           	"columns":[
	            {"data":"status"},
	            {"data":"user_name","orderable":false},
	            {"data":"ptt","orderable":false},
	            {"data":"tongtien","orderable":false},
	            {"data":"thoigian"},
	            {"data":"hanhdong","orderable":false},
        	],
        	"initComplete": function () {
	            get_order();
        	}
      });
  	/*var pusher = new Pusher('101d71ba1f48fc65f0f8', {
      cluster: 'ap1',
      forceTLS: true
    });
    var channel = pusher.subscribe('send_cart');
    channel.bind('my-event', function(data) {
    	$('#example2 > tbody').prepend('<tr role="row" class="odd">'+
				'<td>'+data.status+'</td>'+
				'<td>'+data.user_name+'</td>'+
				'<td>'+data.ptt+'</td>'+
				'<td>'+data.user_email+'</td>'+
				'<td>'+data.user_phone+'</td>'+
				'<td>'+data.amount+'</td>'+
				'<td>'+data.user_address+'</td>'+
				'<td>'+data.created+'</td>'+
				'<td>'+data.get_order+data.update_tran+data.destroy_tran+'</td>'+
			'</tr>');
    	get_order();
    })*/
});
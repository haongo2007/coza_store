jQuery(document).ready(function($) {
    /* upload theme */
	$( "#my_form" ).submit(function( event ) {
        event.preventDefault();
        var _this = $(this);
        if ($('#exampleFormControlInput1').get(0).files.length == 0) {
            _this.find('.alert').removeClass('d-none');
            _this.find('.txt').text('Không Có Giá Trị Nhận Vào !');
            return false;
        }else{
            _this.find('.btn-primary > div').addClass('loader');
            _this.find('.btn-primary').attr('disabled', 'disabled');
            _this.find('.form-control').attr('disabled', 'disabled');
            _this.find('.alert').removeClass('d-none');
            _this.find('.alert').addClass('alert-success');
            _this.find('.alert').removeClass('alert-danger');
            _this.find('.txt').text('Trình Cài Đặt Đang Bắt Đầu');
            
            var url = _this.attr('action');
            var file = $('#exampleFormControlInput1').get(0).files[0].type;

            if ( file.indexOf("x-zip-compressed") < 0) {
                _this.find('.btn-primary > div').removeClass('loader');
                _this.find('.btn-primary').removeAttr('disabled');
                _this.find('.form-control').removeAttr('disabled');
                _this.find('.alert').addClass('alert-danger');
                _this.find('.alert').removeClass('alert-success');
                _this.find('.txt').text('Chỉ Nhận Vào Giá Trị File .ZIP !');
            }else{
                var file_data = $('#exampleFormControlInput1').prop('files')[0];
                var version = $('#exampleFormControlInput3').val();
                var descrip = $('#exampleFormControlTextarea1').val();
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('version', version);
                form_data.append('descrip', descrip);
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
                        _this.find('.form-control').val(null);
                        _this.find('.alert').addClass('d-none');
                        _this.find('.btn-primary > div').removeClass('loader');
                        toastr.error(res.ref);
                    }
                    
                })
            }
        }
  	});
    /* view info theme */
    $('.view_info').click(function(event) {
        var url = $(this).attr('url');
        var id = $(this).attr('data-id');
        var img = $(this).parents('tbody').find('.avt').attr('src');
        $.ajax({
            url: url,
            type: 'POST',
            data: {id: id,fi: 'no_file'},
        })
        .done(function(data) {
            var res = $.parseJSON(data);
            if (res.noty === 'fail') {
                toastr.error(res.ref);
            }else{
                $('#exampleModal1').modal('show');
                var data = res.data;
                $('.image').attr('src', data.screen);
                $('.card-title').html('Theme : '+data.name);
                $('.card-text').html(data.version);
                if (data.status == 0) {
                    var sta = 'Chưa Kích Hoạt';
                    $('.state').html('<i class="bg-warning"></i>'+sta);
                }else{
                    var sta = 'Đã Kích Hoạt';
                    $('.state').html('<i class="bg-info"></i>'+sta);
                }
                $('.descr').html('Mô Tả :'+data.description);
                var time = Date(data.created);
                $('.time').html('Tạo Vào Lúc: '+convert(time));
                $('.avt_inf').attr('src',img);
            }
        })
    });
    function convert(str) {
      var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
      return [day,mnth,date.getFullYear()].join("-");
    }
});
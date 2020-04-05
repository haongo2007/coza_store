<div class="header bg-my-gradient pb-8 pt-5 pt-md-5">
</div>
<style type="text/css">
    input.error {
    border-color: #f00 !important;
    }

    small.required {
        color:#f00;
    }
</style>
<div class="container" style="margin-top: 20px;">

    <div class="panel panel-primary">
        <div class="panel-heading">
            Bootstrap Tab + jQuery Validade
        </div>
        <div class="panel-body">
            <form action="" class="form-horizontal" id="validate">
                <ul class="nav nav-tabs nav-justified nav-inline">
                    <li class="active"><a href="#primary" data-toggle="tab">Contact Information</a></li>
                    <li><a href="#secondary" data-toggle="tab">Address Information</a></li>
                </ul>


                <div class="tab-content tab-validate" style="margin-top:20px;">
                    <div class="tab-pane active" id="primary">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Name</label> 
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-2">E-mail</label> 
                            <div class="col-md-10">
                                <input type="email" name="email" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="secondary">
                        <div class="form-group">
                            <label for="zipcode" class="control-label col-md-2">Zip Code</label> 
                            <div class="col-md-10">
                                <input type="text" name="zipcode" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-md-2">Address</label> 
                            <div class="col-md-10">
                                <input type="text" name="address" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="control-label col-md-2">City</label> 
                            <div class="col-md-10">
                                <input type="text" name="city" class="form-control" />
                            </div>
                        </div>
                <div class="form-group col-md-2 pull-right">
                    <button type="submit" class="btn btn-success btn-block">Save</button>
                </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function() {
    
    $('#validate').validate({
        ignore: [],
        errorPlacement: function() {},
        submitHandler: function() {
            alert('Successfully saved!');
        },
        invalidHandler: function() {
            setTimeout(function() {
                $('.nav-tabs a small.required').remove();
                var validatePane = $('.tab-content.tab-validate .tab-pane:has(input.error)').each(function() {
                    var id = $(this).attr('id');
                    $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="required">***</small>');
                });
            });            
        },
        rules: {
            name: 'required',
            email: {
                required: true,
                email: true
            },
            zipcode: 'required',
            address: 'required',
            city: 'required'
        }
    });
    
});
</script>
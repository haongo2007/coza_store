
<div class="form-group">
	<textarea id="content" name="content" rows="10" cols="80"></textarea>
	<label id="content-error" class="error invalid-feedback" for="content" style="display: none;"></label>
</div>
<script>
CKEDITOR.replace( 'content' ,
	{
filebrowserBrowseUrl : 		'<?php echo public_url() ?>admin/plugin/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl : '<?php echo public_url() ?>admin/plugin/ckfinder/ckfinder.html?type=Images',
filebrowserFlashBrowseUrl : '<?php echo public_url() ?>admin/plugin/ckfinder/ckfinder.html?type=Flash',
filebrowserUploadUrl : 		'<?php echo public_url() ?>admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl : '<?php echo public_url() ?>admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
filebrowserFlashUploadUrl : '<?php echo public_url() ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	}
);
</script>
	<div class="noty_vali alert alert-danger d-none alert-dismissible fade show" role="alert">
		<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
		<span class="alert-inner--text"><strong>Danger!</strong> 
		  	<div class="mess_vali"></div>
		</span>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  	<span aria-hidden="true">&times;</span>
		</button>
  	</div>
	<button type="submit" class="btn btn-success submit_form">Thêm</button>
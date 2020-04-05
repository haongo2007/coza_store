

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      	<div class="row">
	        <div class="col-xs-12">
	  
	        		<form method='post' action='' enctype='multipart/form-data'>
						<input type='file' name='file'>
						<input type="submit" name="submit" value="Upload & Extract">
					 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
					</form>
			</div>
  		</div>
	</section>
</div>
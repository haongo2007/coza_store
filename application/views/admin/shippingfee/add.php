
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('admin/shippingfee/head',$this->data) ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        		<form class="form" action="<?php echo admin_url('shippingfee/add') ?>" method="post" enctype="multipart/form-data">
	          	          				
			            <div class="tab-content">
				            		<div class="box box-success">
          								<div class="box-body">

											<div class="col-xs-6">
												<div class="form-group">
													<label>Thành Phố:</label>
													<span class="text-red"><?php echo form_error('citi'); ?></span>
													<input class="form-control" type="text" name="citi">
												</div>
												<div class="form-group">
													<label>Cước Phí:</label>
													<span class="text-red"><?php echo form_error('fee'); ?></span>
													<input class="form-control prcfee" type="number" name="fee">
												</div>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
												<div class="box-footer">
		              								<button type="submit" class="pull-right btn bg-green btn-flat">Thêm</button>
              									</div>
											</div>
									</div>
									
		    				</div>
		            	
			              
			           
			            </div>
			  
	        	</form>
    		</div>
  		</div>
	</section>
</div>

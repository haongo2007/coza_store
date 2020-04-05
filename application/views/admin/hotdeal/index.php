
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php 
		$this->load->view('admin/hotdeal/head',$this->data);
	?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	        <div class="col-xs-12">
	        	<div class="box-header">
					<a href="<?php echo admin_url('hotdeal/add') ?>">
			    		<button class="btn bg-green btn-flat margin">Thêm</button>
					</a>
				</div>
				<div class="box-body">
					<table id="example2" class="table table-bordered table-hover">
		                <thead id="cter">
		                <tr>
		                  <th>ID</th>
		                  <th>Tên</th>
		                  <th>Ảnh</th>
		                  <th>Dead line</th>
		                  <th>Thao Tác</th>
		                </tr>
		                </thead>
		                <tbody id="lnhei" align="center">
		                	<?php foreach ($list as $key) {
		                	?>
							<tr>
								<td>
									<?php echo $key->id; ?>
								</td>
								<td>
									<?php echo $key->name; ?>
								</td>
								<td>
									<img src="<?php echo public_url('upload/hotdeal/'.$key->image_link) ?>" class="img-responsive" width="75">
								</td>
								<td>
									<?php echo $key->time; ?>
								</td>
								<td>
									<?php 
										if ($key->status != 2) {
									?>
									<a href="<?php echo admin_url('hotdeal/edit/active/'.$key->id) ?>">
										<button class="btn bg-blue btn-flat">Active</button>
									</a>
									<?php }else{?>
									<a href="<?php echo admin_url('hotdeal/edit/deactive/'.$key->id) ?>">
										<button class="btn bg-orange btn-flat">Deactive</button>
									</a>
									<?php } ?>
									<a href="<?php echo admin_url('hotdeal/edit/'.$key->id) ?>">
										<button class="btn bg-yellow btn-flat">Sửa</button>
									</a>
									<a href="<?php echo admin_url('hotdeal/delete/'.$key->id) ?>">
										<button class="btn bg-red btn-flat">Xóa</button>
									</a>
								</td>
							</tr>
							<?php } ?>
		                </tbody>
		              </table>
				</div>
			</div>
  		</div>
	</section>
</div>

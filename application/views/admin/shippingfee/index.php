
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('admin/shippingfee/head',$this->data) ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	        <div class="col-xs-12">
	        	<div class="box-header">
					<a href="<?php echo admin_url('shippingfee/add') ?>">
			    		<button class="btn bg-green btn-flat margin">Thêm</button>
					</a>
				</div>
				<div class="box-body">
					<table id="example2" class="table table-bordered table-hover">
		                <thead id="cter">
		                <tr>
		                  <th>ID</th>
		                  <th>Thành Phố</th>
		                  <th>Cước Phí</th>
		                  <th>Hành Động</th>
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
									<?php echo $key->citi; ?>
								</td>
								<td>
									<?php echo number_format($key->fee).'.vnđ'; ?>
								</td>
								<td>
									<a href="<?php echo admin_url('shippingfee/edit/'.$key->id) ?>">
										<button class="btn bg-yellow btn-flat">Sửa</button>
									</a>
									<a href="<?php echo admin_url('shippingfee/delete/'.$key->id) ?>">
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

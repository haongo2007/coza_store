<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Chi Tiết Bảng Order</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body pr-0 pl-0">
	<div class="table-responsive">
		<table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
			<th scope="col">Tên SP</th>
			<th scope="col">Hình Ảnh</th>
			<th scope="col">Kích Thước</th>
			<th scope="col">Màu Sắc</th>
			<th scope="col">Số Lượng</th>
			<th scope="col">Giá</th>
			<th scope="col">Trạng Thái</th>
        </tr>
        </thead>
        <tbody align="center">
        	<?php 
				foreach ($order as $key) {
					if ($key->status == 0) {
						$status = '<span class="badge badge-dot mr-4"><i class="bg-warning"></i> Chưa Ship</span>';
					}else if($key->status == 1){
						$status = '<span class="badge badge-dot mr-4"><i class="bg-success"></i> Đã Ship</span>';
					}
					else if($key->status == 2){
						$status = '<span class="badge badge-dot mr-4"><i class="bg-danger"></i> Đã Hủy</span>';
					}
			?>
				<tr>
					<td><?php echo $key->product_name; ?></td>
					<td><?php echo '<img src="'.$key->path.'" width="100">' ?></td>
					<td><?php echo $key->option->size[0]; ?></td>
					<td><?php echo $key->color_name; ?></td>
					<td><?php echo $key->qty; ?></td>
					<td><?php echo number_format($key->amount).'.vnđ'; ?></td>
					<td><?php echo $status; ?></td>
				</tr>
			<?php
					$ulr = base_url('admin/transaction/update/'.$key->transaction_id);
					if ($key->status == 0) {
						$button = '<a href="'.$ulr.'"><button type="button" class="btn btn-success">Shipping</button></a>';
					}else if($key->status == 1){
						$button = '';
					}
					else if($key->status == 2){
						$button = '<a href="'.$ulr.'"><button type="button" class="btn btn-success">Shipping</button></a>';
					} 
				}
			?>
        </tbody>
      </table>
	</div>
	<div class="table-responsive">
		<table class="table align-items-center table-dark">
	        <thead class="thead-light">
	        <tr>
				<th scope="col">Địa Chỉ</th>
				<th scope="col">Số Điện Thoại</th>
				<th scope="col">Email</th>
				<th scope="col">Khu Vực</th>
				<th scope="col">Post code</th>
	        </tr>
	        </thead>
        	<tbody align="center">
        		<tr>
        			<td><?php echo $trans->user_address; ?></td>
        			<td><?php echo $trans->user_phone; ?></td>
        			<td><?php echo $trans->user_email; ?></td>
        			<td><?php echo $trans->citi; ?></td>
        			<td><?php echo $trans->postcode; ?></td>
        		</tr>
        	</tbody>
        </table>
    </div>
</div>
<div class="modal-footer" data-update="<?php echo admin_url('transaction/update') ?>">
	<?php if ($trans->note != '') { ?>
	<div class="alert alert-warning mb-0" role="alert">
	    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
	    <span class="alert-inner--text"><strong>Note!</strong> <?php echo $trans->note; ?></span>
	</div>
	<?php } ?>
  	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  	<?php echo $button; ?>
</div>
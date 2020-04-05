



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php 
		$this->load->view('admin/user/head',$this->data);
	?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bảng Danh Khách Hàng</h3>
            </div>
            <!-- /.box-header -->
        		<div class="box-body table-responsive">
		              <table id="example2" class="table table-bordered table-hover">
		                <thead id="cter">
		                <tr>
		                  <th>ID</th>
		                  <th>Tên</th>
		                  <th>Email</th>
		                  <th>SĐT</th>
		                  <th>Địa Chỉ</th>
		                  <th>Ngày Tạo</th>
		                </tr>
		                </thead>
		                <tbody id="lnhei" align="center">
		                <!-- Filter -->
		               
							<?php 
								foreach ($list as $row):
							?>
								<tr>
									<td><?php echo $row->id; ?></td>
									<td><?php echo $row->name; ?></td>
									<td><?php echo $row->email; ?></td>
									<td><?php echo $row->phone; ?></td>
									<td><?php echo $row->address; ?></td>
									<td><?php echo get_date($row->created); ?></td>
								</tr>
							<?php 
								endforeach;
							?>
		                </tbody>
		              </table>
            		</div>
            <!-- /.box-body -->
          		</div>
      		</div>
  		</div>
	</section>
</div>
<style type="text/css">
	#lnhei > tr > td{
		line-height: 45px;
	}
	#cter > tr > th{
		text-align: center;
	}
</style>
<!-- DataTables -->
<script src="<?php echo public_url('admin/LTE/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo public_url('admin/LTE/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {

    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
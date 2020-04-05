
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Trang Tĩnh
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $this->uri->rsegment(1); ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="<?php echo admin_url('page/add') ?>">
                  <button class="btn bg-green btn-flat margin">Thêm</button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Tên</th>
                      <th>Slug</th>
                      <th>Status</th>
                      <th>Hành Động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $key ) { ?>
                    <tr>
                      <td><?php echo $key->name; ?></td>
                      <td><?php echo $key->slug; ?></td>
                      <td>
                      <?php 
                        if ($key->status < 1) {
                          echo "<a href='".admin_url('page/active/'.$key->id)."' class='btn btn-success'>Kích Hoạt</a>";
                        }else{
                          echo "<a href='".admin_url('page/active/'.$key->id)."' class='btn btn-danger'>Ngừng Kích Hoạt</a>";
                        }
                      ?>    
                      </td>
                      <td>
                        <a class='btn btn-primary' href="<?php echo admin_url('page/view/'.$key->id) ?>">Xem</a>
                        <a class='btn btn-success' href="<?php echo admin_url('page/edit/'.$key->id) ?>">Sửa</a>
                        <a class='btn btn-danger' href="<?php echo admin_url('page/delete/'.$key->id) ?>">Xóa</a>
                      </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
            <!-- /.box-body -->
              </div>
          </div>
      </div>
  </section>
</div>
<!-- DataTables -->
<script src="<?php echo public_url('admin/LTE/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo public_url('admin/LTE/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {

    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
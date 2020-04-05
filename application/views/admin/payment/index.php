<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">DashBoard</h6>
          <?php echo breadcrumb(); ?>
        </div>
        <div class="col-lg-6 col-5 text-right"><!-- 
          <a href="#" class="btn btn-sm btn-neutral">New</a>

          <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
   <!-- Table -->
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header">
               <h3 class="mb-0">Quản Lý Phương Thức Thanh Toán</h3>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info">
                            <thead class="thead-light">
                              <tr role="row">
                                  <th scope="col">ID</th>
                                  <th scope="col">Banner</th>
                                  <th scope="col">Tên Phương Thức</th>
                                  <th scope="col">Trạng Thái</th>
                                  <th scope="col">Hành Động</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payment as $key) {?>
                                    <tr>
                                      <td><?php echo $key->id; ?></td>
                                      <th scope="row">
                                        <div class="media align-items-center">
                                          <img src="<?php echo public_url('upload/payment/'.$key->banner) ?>" width="200px">
                                        </div>
                                      </th>
                                      <td><?php echo $key->name; ?></td>
                                      <td>
                                        <span class="badge badge-dot mr-4">
                                          <?php echo ($key->status == 0 ) ? '<i class="bg-warning"></i> Chưa Kích Hoạt' : '<i class="bg-info"></i> Đã Kích Hoạt'; ?>
                                        </span>
                                      </td>
                                      <td>
                                        <div class="dropdown">
                                          <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <?php 
                                              if ($key->status == 0) {
                                                $active = "Kích Hoạt";
                                              }else{
                                                $active = "Hủy Kích Hoạt";
                                              }
                                            ?>
                                            <a class="dropdown-item" href="<?php echo admin_url('payment/state/'.$key->id) ?>">
                                              <?php echo $active; ?>
                                            </a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" data_id="<?php echo $key->id ?>" class="setup" data-value="<?php echo htmlentities($key->data) ?>" href="#">Cài Đặt</a>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>
</div>

<!-- Modal setup payment -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông Tin Người Nhận</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="my_form" method="post" action="<?php echo admin_url('payment/setup') ?>" enctype="multipart/form-data">
        <div class="modal-body">
          
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                  <span class="alert-text">
                    <strong>Info!</strong> 
                    Vào <a href="https://www.paypal.com/us/cgi-bin/webscr?cmd=_login-api-run">Đây</a> để lấy thông tin paypal API</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                <input type="hidden" name="id" class="form-control id_payment" value="">
                <div class="form-group">
                  <label>APIUsername</label>
                  <input type="text" name="username" class="form-control" id="exampleFormControlInput1" required>
                </div>
                <div class="form-group">
                  <label>APIPassword</label>
                  <input type="text" name="password" class="form-control" id="exampleFormControlInput2" required>
                </div>
                <div class="form-group">
                  <label>APISignature</label>
                  <input type="text" name="signature" class="form-control" id="exampleFormControlInput3" required>
                </div>
                <div class="form-group">
                  <label>Sandbox (Test)</label>
                  <div class="custom-checkbox mb-3 mailbox-messages">
                    <label class="custom-toggle custom-toggle-primary">
                      <input type="checkbox" checked name="status">
                      <span class="custom-toggle-slider rounded-circle" data-label-off="off" data-label-on="on"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><div class="">Submit</div></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- payment -->
<script src="<?php echo public_url('admin') ?>/assets/js/payment.js"></script>
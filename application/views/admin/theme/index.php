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
          <button type="button" class="btn btn-neutral" data-toggle="modal" data-target="#exampleModal">
            Upload
          </button>
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
               <h3 class="mb-0">Danh Sách Các Giao Diện</h3>
               <p class="text-sm mb-0">
                  This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
               </p>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4" data-url="<?php echo admin_url('transaction/index') ?>">
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info">
                           <thead class="thead-light">
                              <tr role="row">
                                  <th scope="col">Screen</th>
                                  <th scope="col">Theme</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Author</th>
                                  <th scope="col">Version</th>
                                  <th scope="col">Created</th>
                                  <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach ($list as $key) { ?>
                              <tr>
                                <th scope="row">
                                  <div class="media align-items-center">
                                    <img alt="Image placeholder" src="<?php echo $key->screen ?>" width="100px">
                                  </div>
                                </th>
                                <td>
                                  <?php echo $key->name; ?>
                                </td>
                                <td>
                                  <span class="badge badge-dot mr-4">
                                    <?php echo ($key->status == 0 ) ? '<i class="bg-warning"></i> Chưa Kích Hoạt' : '<i class="bg-info"></i> Đã Kích Hoạt'; ?>
                                  </span>
                                </td>
                                <td>
                                  <div class="avatar-group">
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="<?php echo $key->avt->name ?>">
                                      <img alt="Image placeholder" src="<?php echo public_url('upload/user/'.$key->avt->avatar) ?>" class="avt">
                                    </a>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center">
                                    <span class="mr-2"><?php echo $key->version; ?></span>
                                  </div>
                                </td>
                                <td>
                                  <?php echo get_date($key->created); ?>
                                </td>
                                <td class="text-right">
                                  <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <?php 
                                        if ($key->status == 0) {
                                          $active = "Kích Hoạt";
                                          $action = 'active';
                                        }else{
                                          $active = "Hủy Kích Hoạt";
                                          $action = 'deactive';
                                        }
                                      ?>
                                      <a class="dropdown-item" href="<?php echo admin_url('theme/'.$action.'/'.$key->id) ?>">
                                        <?php echo $active; ?>
                                      </a>
                                      <a class="dropdown-item verify_action" href="<?php echo admin_url('theme/delete/'.$key->id) ?>">Xóa</a>
                                      <a class="dropdown-item view_info" url="<?php echo admin_url('theme/info') ?>" data-id="<?php echo $key->id ?>" href="#">Chi Tiết</a>
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

<!-- Modal uptheme -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Theme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="my_form" action="<?php echo admin_url('theme/upload') ?>">
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>File ZIP</label>
                  <input type="file" name="file" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                  <label>Version</label>
                  <input type="text" name="version" class="form-control" id="exampleFormControlInput3" required>
                </div>
                <div class="form-group">
                  <label>Mô Tả</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Mô Tả Về Theme Ở Đây ..." required></textarea>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <div class="alert alert-danger d-none my-0" role="alert">
            <strong class="txt"></strong>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><div class="">Submit</div></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal info  -->
<div class="modal fade pl-0 pr-0" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mw-100 modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Theme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row m-0">
            <div class="col-md-12 content">
              <div class="col-md-12">
                <div class="card">
                  <img class="card-img-top image" src="" width="100%" alt="Card image cap">
                  <div class="card-body">
                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="" class="rounded-circle avt_inf">
                    </a>
                    <h2 class="card-title"></h2>
                    <p class="card-text"></p>
                    <span class="badge badge-dot state mr-4"></span>
                    <p class="card-text descr"></p>
                    <p class="card-text time"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="alert alert-danger d-none my-0" role="alert">
          <strong class="txt"></strong>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- theme -->
<script src="<?php echo public_url('admin') ?>/assets/js/theme.js"></script>


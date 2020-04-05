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
          <button type="button" class="btn btn-neutral brand_add" data-toggle="modal" data-action="add" data-target="#exampleModal">
            Thêm
          </button>
          <button type="button" class="btn btn-danger" id="submit" url="<?php echo admin_url('brand/delete') ?>">
            Xóa
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
               <h3 class="mb-0">Danh Sách Các Thương Hiệu</h3>
               <p class="text-sm mb-0">
                  This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
               </p>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info" data-url="<?php echo admin_url('brand/index') ?>">
                           <thead class="thead-light">
                              <tr role="row">
                                  <th scope="col">ID</th>
                                    <th scope="col">Thứ Tự</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Hành Động</th>
                                    <th scope="col">
                                      <div class="mailbox-controls">
                                      <!-- Check all button -->
                                        <button id="titleCheck" name="titleCheck" type="button" class="btn btn-default btn-sm checkbox-toggle">
                                          Chọn Tất Cả
                                        </button>
                                      </div>
                                    </th>
                              </tr>
                           </thead>
                           <tbody>
                              
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
<!-- Modal info  -->
<div class="modal fade pl-0" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="brand_form" action="<?php echo admin_url('brand/add') ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm Nhãn Hiệu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-md-12">

                        <div class="form-group">
                            <label >Tên Hiệu</label>
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>

                        <div class="form-group">
                            <label >Thứ Tự Hiển Thị</label>
                            <input type="text" class="form-control" name="sort" value="" required>
                        </div>

                        <div class="form-group">
                            <label >Logo Hiệu</label>
                            <input type="file" class="form-control" id="logofile" name="logo" value="">
                            <img src="" width="100px" class="d-none img_br">
                        </div>          

                </div>
              </div>
          </div>
          <div class="modal-footer">
            <div class="alert alert-danger d-none my-0" role="alert">
              <strong class="txt"></strong>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Thêm</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- brand -->
<script src="<?php echo public_url('admin') ?>/assets/js/brand.js"></script>
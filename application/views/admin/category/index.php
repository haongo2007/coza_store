

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
          <button type="button" class="btn btn-neutral category_add" data-toggle="modal" data-action="add" data-target="#exampleModal">
            Thêm
          </button>
          <button type="button" class="btn btn-danger" id="submit" url="<?php echo admin_url('category/delete') ?>">
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
               <h3 class="mb-0">Danh Sách Các Danh Mục</h3>
               <p class="text-sm mb-0">
                  This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
               </p>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info" data-url="<?php echo admin_url('category/index') ?>">
                           <thead class="thead-light">
                              <tr role="row">
                                  <th scope="col">ID</th>
                                  <th scope="col">Thứ Tự</th>
                                  <th scope="col">Tên Danh Mục</th>
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

<!-- Modal edit add  -->
<div class="modal fade pl-0" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="category_form" action="<?php echo admin_url('category/add') ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm Danh Mục</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label >Tên Danh Mục</label>
                        <input type="text" class="form-control" name="name" value="" required>
                    </div>
                    <div class="form-group">
                        <label >Banner</label>
                        <input type="file" id="banner" class="form-control" name="file">
                    </div>
                    <div class="form-group">
                        <label >Site Title</label>
                        <input type="text" class="form-control" name="title" value="" required>
                    </div>
                    <div class="form-group">
                        <label >Thứ Tự Hiển Thị</label>
                        <input type="number" class="form-control" name="sort" value="" required>
                    </div>
                    <div class="form-group">
                        <label >Meta Description:</label>
                        <textarea name="meta-desc" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write a Description here ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label >Meta Keys:</label>
                        <div class="bootstrap-tagsinput"></div>
                        <input type="text" class="form-control meta-tags" name="meta_key[]" value="" data-toggle="tags" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label>Chọn Danh Mục</label>
                        <select title="Simple select" name="parent_id" class="form-control mySelect">
                            <option value="0">Là Danh Mục Cha</option>
                            <?php foreach ($list as $row): ?>
                                <option value="<?php echo $row->id ?>">Danh Mục Con Của <?php echo $row->name ?></option>
                            <?php endforeach ;?>
                        </select>
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
<!-- Modal view  -->
<div class="modal fade pl-0 pr-0" id="exampleModalview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mw-100 modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div class="row m-0">
                <div class="col-md-12">
                    <div class="table-responsive">
                      <!-- Projects table -->
                        <table id="example2" class="table align-items-center table-dark" >
                            <thead class="thead-light" align="center">
                                <tr>
                                    <th scope="col">Tên Danh Mục</th>
                                    <th scope="col">Site Title</th>
                                    <th scope="col">Meta Keys</th>
                                    <th scope="col">Meta Description</th>
                                    <th scope="col">Banner</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- category -->
<script src="<?php echo public_url('admin') ?>/assets/js/category.js"></script>

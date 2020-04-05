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
               <h3 class="mb-0">Quản Lý Thông Tin Website</h3>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info">
                           <thead class="thead-light">
                              <tr role="row">
                                  <th>Tên site</th>
                                  <th>Email</th>
                                  <th>SĐT</th>
                                  <th>Địa Chỉ</th>
                                  <th>Logo</th> 
                                  <th>Action</th>
                              </tr>
                           </thead>
                           <tfoot>
                            <iframe src="<?php echo $data->map ?>" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                           </tfoot>
                           <tbody>
                              <tr>
                                <td id="name"><?php echo $data->name_site; ?></td>
                                <td id="email"><?php echo $data->email; ?></td>
                                <td id="phone"><?php echo $data->phone; ?></td>
                                <td id="address"><?php echo $data->address; ?></td>
                                <td id="logo"><img width="100" src="<?php echo public_url('upload/logo/').$data->logo_site ?>"></td>
                                <td>                              
                                  <a class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal" href="javascript:void(0)">Thay Đổi</a>
                                </td>
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
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sửa Info Website</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo admin_url('info/edit') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">

                <div class="form-group">
                  <label >Tên Site:</label>
                  <input class="form-control" name="name" type="text" value="<?php echo $data->name_site; ?>" required />  
                </div>

                <div class="form-group">
                  <label>Email:</label>
                  <input class="form-control" type="email" name="email" value="<?php echo $data->email; ?>">
                </div>
                
                <div class="form-group">
                  <label >SĐT:</label>
                  <input class="form-control" name="phone" type="text" value="<?php echo $data->phone; ?>" required />  
                </div>

                <div class="form-group">
                  <label >Địa Chỉ:</label>
                  <input class="form-control" name="address" type="text" value="<?php echo $data->address; ?>" required />  
                </div>

                <div class="form-group">
                  <label >Logo:</label>
                  <input class="form-control" name="logo" type="file"/>
                  <input class="form-control" name="old_logo" type="hidden" value="<?php echo $data->logo_site ?>" />  
                </div>

                <div class="form-group">
                  <label >Map:</label>
                  <input class="form-control" name="map" type="text" value="<?php echo $data->map; ?>" required />  
                </div>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><div class="">Submit</div></button>
        </div>
      </form>
    </div>
  </div>
</div>
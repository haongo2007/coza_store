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
          <button type="button" class="btn btn-neutral action_admin" data-action="add" data-toggle="modal" data-action="add" data-target="#exampleModal">Thêm</button>
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
               <h3 class="mb-0">Danh Sách Các Quản Trị Viên</h3>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info"  data-url="<?php echo admin_url('admin/index') ?>">
                           <thead class="thead-light">
                              <tr role="row">
                                  	<th scope="col">Tên</th>
                  									<th scope="col">Email</th>
                  									<th scope="col">SĐT</th>
                  									<th scope="col">Địa Chỉ</th>
                  									<th scope="col">Vị Trí</th>
                  									<th scope="col">Ngày Tạo</th>
                  									<th scope="col">Hành Động</th>
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
<div class="modal fade pl-0 pr-0" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mw-100 modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="admin_form" action="<?php echo admin_url('admin/add') ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-2">
              <div class="row m-0">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input class="form-control" id="email" placeholder="Email address" name="email" type="email">
                    </div>
                    <label id="email-error" class="error text-danger" for="email" style="display: none;"></label>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" id="password" type="password" name="password">
                    </div>
                    <label id="password-error" class="error text-danger" for="password" style="display: none;"></label>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                      </div>
                      <input class="form-control" placeholder="Confirm Password" id="confirm_password" type="password" name="confirm_password">
                    </div>
                    <label id="confirm_password-error" class="error text-danger" for="confirm_password" style="display: none;"></label>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input class="form-control" id="name" placeholder="Your name" name="name" type="text">
                    </div>
                    <label id="name-error" class="error text-danger" for="name" style="display: none;"></label>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input class="form-control" placeholder="Phone number" name="phone" id="phone" type="number">
                    </div>
                    <label id="phone-error" class="error text-danger" for="phone" style="display: none;"></label>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                      </div>
                      <input class="form-control" placeholder="Location" name="address" id="address" type="text">
                    </div>
                    <label id="address-error" class="error text-danger" for="address" style="display: none;"></label>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                      </div>
                      <input class="form-control" placeholder="Location" name="position" id="position" type="text">
                    </div>
                    <label id="position-error" class="error text-danger" for="position" style="display: none;"></label>
                  </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group">
				      	<label >Phân Quyền </label>
				      	<div class="mailbox-controls">
  							<!-- Check all button -->
  							<button id="titleCheck" name="titleCheck" type="button" class="btn btn-default btn-sm checkbox-toggle">
  							Chọn Tất Cả</button>
  						</div>
				    </div>
				    <div class="row m-0">
				    	<?php 
							foreach ($config_pm as $controller => $actions) {
						?>
						<div class="form-group col-auto perms-cb">
							<label class="btn checkbox-action">
								<?php 
									$controller = explode(',', $controller);
									echo $controller[0]; 
								?>
							</label>
							<?php 
            		foreach ($actions as $action => $value) {
							?>
							    <div class="custom-control custom-checkbox mb-3 mailbox-messages">
								  <input class="custom-control-input" name="permissions[<?php echo $controller[1] ?>][]" value="<?php echo $value; ?>" id="<?php echo strtolower($controller[1].$value) ?>" type="checkbox">
								  <label class="custom-control-label" for="<?php echo strtolower($controller[1].$value) ?>"><?php echo $action; ?></label>
								</div>
							<?php
								} 
							?>	
					    </div>

						<?php 
							}
						?>
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
<!-- category -->
<script src="<?php echo public_url('admin') ?>/assets/js/admin.js"></script>
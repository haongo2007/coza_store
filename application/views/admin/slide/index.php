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
          <button type="button" class="btn btn-neutral add_slide">
            Thêm Slide
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
               <h3 class="mb-0">Quản Lý Slide</h3>
            </div>
            <div class="table-responsive">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <?php $i=1; foreach ($list_slide as $row): ?>
                              <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" class="<?php if($i == 1){ echo 'active'; } ?>"></li>
                              <?php $i++ ; endforeach;?>
                            </ol>
                            <div class="carousel-inner">
                              <?php $i=1; foreach ($list_slide as $row): ?>
                              <div class="carousel-item <?php if($i == 1){ echo 'active'; } ?>">
                                <img class="d-block w-100" src="<?php echo public_url('upload/slide/'.$row->image_link) ?>" alt="First slide">
                              </div>
                              <?php $i++ ; endforeach;?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="action py-4 text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <select class="form-control slide_name">
                              <option value="0">Chọn Slide Để Sửa</option>
                              <?php foreach ($list_slide as $row): ?>
                                <option data-name="<?php echo $row->name; ?>" data-link="<?php echo $row->link; ?>" data-info="<?php echo $row->info; ?>" data-sort_order="<?php echo $row->sort_order; ?>" value="<?php echo $row->id ?>"><?php echo $row->name; ?></option>
                              <?php endforeach;?>
                            </select>
                            <button type="button" class="btn btn-primary get_slide" url="<?php echo admin_url('slide/edit/') ?>" >Sửa</button>
                            <button type="button" class="btn btn-danger del_slide" url="<?php echo admin_url('slide/delete/') ?>" >Xóa</button>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card col-sm-6">
            <!-- Card header -->
            <div class="card-header">
               <h3 class="mb-0">Cài Đặt Tài Nguyên Tải Lên</h3>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo admin_url('slide/setting') ?>">
                    <div class="form-group">
                        <label >Kích Thước Tối Đa Được Cho Phép</label>
                        <div class="row">
                          <div class="col-sm-6">
                              <input type="number" class="form-control" name="horizontal" placeholder="Chiều Ngang (1920)" value="<?php echo $setting_res->horizontal ?>" required>
                          </div>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" name="vertical" placeholder="Chiều Dọc (570)" value="<?php echo $setting_res->vertical ?>" required>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Định Dạng Được Phép</label>
                        <input type="text" class="form-control" name="type_allow" placeholder="( jpg|png|gif|mp4 )" value="<?php echo $setting_res->type_allow ?>" required>
                    </div>
                    <div class="form-group">
                        <label >Dung Lượng Được Phép</label>
                        <input type="text" class="form-control" name="max_size" placeholder="( 1024 )" value="<?php echo $setting_res->max_size ?>" required>
                    </div>
                    <label >Kích Thước Ảnh Resize Khi Tải Lên</label>
                    <input type="hidden" name="count" value="<?php echo $setting_res->count ?>">
                    <div class="recipe" url="<?php echo admin_url('slide/remove_resize') ?>">
                      <?php 
                        for ($i=1; $i <= $setting_res->count ; $i++) {
                          $re_horizontal = 're_horizontal_'.$i;
                          $re_vertical = 're_vertical_'.$i;
                      ?>
                        <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="input-group input-group-merge">
                                  <div class="input-group-prepend rmv-rsiz" data="<?php echo $i ?>">
                                    <span class="input-group-text"><i class="ni ni-fat-remove"></i></span>
                                  </div>
                                  <input type="number" class="form-control" name="<?php echo 're_horizontal_'.$i ?>" placeholder="Chiều Ngang (300)" value="<?php echo $setting_res->{$re_horizontal} ?>" required>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <input type="number" class="form-control" name="<?php echo 're_vertical_'.$i ?>" placeholder="Chiều Dọc (300)" value="<?php echo $setting_res->{$re_vertical} ?>" required>
                              </div>
                            </div>
                        </div>
                      <?php } ?>
                    </div>
                    
                    <button type="button" class="btn btn-primary add-resize">Thêm</button>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <button type="submit" class="btn btn-success">Thiết Lập</button>
                </form>
            </div>
          </div>
      </div>
   </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm Slide</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="my_form" data-act="<?php echo admin_url('slide/add') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">

                <div class="form-group">
                  <label >Tên Slide:</label>
                  <input class="form-control" name="name" type="text" required />  
                </div>

                <div class="form-group">
                  <label>Hình ảnh:</label>
                  <input class="form-control" type="file"  id="image" name="image">
                </div>
                
                <div class="form-group">
                  <label >Link:</label>
                  <input class="form-control" name="link" type="text" required />  
                </div>

                <div class="form-group">
                  <label >Thứ Tự:</label>
                  <input class="form-control" name="sort_order" type="number" required />  
                </div>

                <div class="form-group">
                  <label >Tiêu Đề:</label>
                  <input class="form-control" name="info" type="text" required />  
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
<script src="<?php echo public_url('admin') ?>/assets/js/setting.js"></script>







































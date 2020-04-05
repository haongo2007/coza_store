<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">DashBoard</h6>
          <?php echo breadcrumb(); ?>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="#" data-action="add" class="btn btn-neutral action_product" data-toggle="modal" data-target="#Modal_add_edit">Thêm</a>
          <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
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
               <h3 class="mb-0">Danh Sách Các Sản Phẩm</h3>
               <p class="text-sm mb-0">
                  This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
               </p>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4" >
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info" data-url="<?php echo admin_url('product/index') ?>">
                           <thead class="thead-light">
                              <tr role="row">
                                  <th scope="col">ID</th>
                                  <th scope="col">Tên Sản Phẩm</th>
                                  <th scope="col">Hình Ảnh</th>
                                  <th scope="col">Màu Sắc</th>
                                  <th scope="col">Giá</th>
                                  <th scope="col">Ngày Tạo</th>
                                  <th scope="col">Người Tạo</th>
                                  <th scope="col">Hành Động</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Tên Sản Phẩm</th>
                                  <th scope="col">Hình Ảnh</th>
                                  <th scope="col">Màu Sắc</th>
                                  <th scope="col">Giá</th>
                                  <th scope="col">Ngày Tạo</th>
                                  <th scope="col">Người Tạo</th>
                                  <th scope="col">Hành Động</th>
                              </tr>
                           </tfoot>
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
<!-- Modal add edit product -->
<div class="modal fade pl-0 pr-0" id="Modal_add_edit" tabindex="-1" role="dialog" aria-labelledby="Modal_add_edit" aria-hidden="true">
  <div class="modal-dialog mw-100 mt-0 mb-0 modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h2 class="modal-title" id="Modal_add_edit">Thêm sản phẩm</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row m-0">
              <div class="col-md-12 product_content">
                <div class="card shadow">
                    <div class="card-body">
                        <form id="product_form" action="<?php echo admin_url('product/add') ?>">
                          <div class="nav-wrapper">
                              <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-palette mr-2"></i>Thuộc Tính</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-chart-bar-32 mr-2"></i>SEO</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-collection mr-2"></i>Nội Dung</a>
                                  </li>
                              </ul>
                          </div>
                        <div class="tab-content tab-validate" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <?php $this->load->view('admin/product/attribute') ?>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                <?php $this->load->view('admin/product/seo') ?>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                <?php $this->load->view('admin/product/info') ?>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal view detail product -->
<div class="modal fade pl-0 pr-0" id="Modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mw-100 modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xem chi tiết sản phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 product_view_content">
              
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .modal{
    overflow-y: visible; 
  }
  .activ{
    pointer-events: none;
    border: 1px solid #5e72e4;
    opacity: .5;
  }
</style>
<!-- Modal view detail image attribute -->
<div class="modal fade pl-0 pr-0" id="view_image_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex flex-wrap" data_base_url="<?php echo base_url() ?>">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- product -->
<script src="<?php echo public_url('admin') ?>/assets/js/product.js"></script>
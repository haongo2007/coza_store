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
               <h3 class="mb-0">Danh Sách Các Giao Dịch</h3>
               <p class="text-sm mb-0">
                  This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
               </p>
            </div>
            <div class="table-responsive py-4">
               <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4" >
                  <div class="row">
                     <div class="col-sm-12">
                        <table class="table table-flush dataTable" id="datatable-basic" role="grid" aria-describedby="datatable-basic_info" data-url="<?php echo admin_url('transaction/index') ?>">
                           <thead class="thead-light">
                              <tr role="row">
                                  <th scope="col">Status</th>
                                  <th scope="col">Tên</th>
                                  <th scope="col">Payment</th>
                                  <th scope="col">Tổng</th>
                                  <th scope="col">Thời gian</th>
                                  <th scope="col">Hành động</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr>
                                  <th scope="col">Status</th>
                                  <th scope="col">Tên</th>
                                  <th scope="col">Payment</th>
                                  <th scope="col">Tổng</th>
                                  <th scope="col">Thời gian</th>
                                  <th scope="col">Hành động</th>
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
<!-- Modal view order -->
<div class="modal fade pl-0 pr-0" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mw-100 modal-dialog-centered" role="document">
    <div class="card modal-content content-order">
		
    </div>
  </div>
</div>
<!-- transaction -->
<script src="<?php echo public_url('admin') ?>/assets/js/transaction.js"></script>
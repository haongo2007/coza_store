<!-- Footer -->
<footer class="footer">
  <div class="row ml-0 mr-0 align-items-center justify-content-xl-between">
    <div class="col-xl-6">
      <div class="copyright text-center text-xl-left text-muted">
        &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
      </div>
    </div>
    <div class="col-xl-6">
      <ul class="nav nav-footer justify-content-center justify-content-xl-end">
        <li class="nav-item">
          <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
        </li>
        <li class="nav-item">
          <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
        </li>
        <li class="nav-item">
          <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
        </li>
        <li class="nav-item">
          <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
        </li>
      </ul>
    </div>
  </div>
</footer>
<script src="<?php echo public_url('admin') ?>/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo public_url('admin') ?>/assets/js/plugins/bootstrap/dist/js/bootstrap-tagsinput.min.js"></script>

<!--   Optional JS   -->
<script src="<?php echo public_url('admin') ?>/assets/js/plugins/chart.js/dist/Chart.min.js"></script>
<script src="<?php echo public_url('admin') ?>/assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
<!-- DataTables -->
<script src="<?php echo public_url('admin/assets') ?>/js/plugins/data-table/jquery.dataTables.min.js"></script>
<script src="<?php echo public_url('admin/assets') ?>/js/plugins/data-table/dataTables.bootstrap4.min.js"></script>

<!--   Toastrjs   -->
<script src="<?php echo public_url('admin') ?>/assets/js/plugins/toastrjs/toastr.min.js"></script>
<!-- icheck -->
<script src="<?php echo public_url('admin/assets') ?>/js/plugins/icheck/icheck.min.js"></script>
<!-- select2 -->
<script src="<?php echo public_url('admin/assets') ?>/js/plugins/select2/select2.min.js"></script>
<!--   Argon JS   -->
<script src="<?php echo public_url('admin') ?>/assets/js/argon-dashboard.js"></script>

<script type="text/javascript">
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
</script>
<?php if (isset($notify_success)) {?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        toastr.success("<?php echo $notify_success; ?>");
    });
    </script>
<?php } ?>
<?php if (isset($notify_error)) {?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        toastr.error("<?php echo $notify_error; ?>");
    });
    </script>
<?php } ?>
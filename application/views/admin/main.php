<!DOCTYPE html>
<html>
<?php $this->load->view('admin/head') ?>
<body class="g-sidenav-hidden">
	<?php $this->load->view('admin/sidebar') ?>
  	<div class="main-content" id="panel">
    	<?php $this->load->view('admin/header') ?>
    	<!-- layout master -->
    	<?php $this->load->view($template,$this->data) ?>
 		<!-- Footer -->
 		<?php $this->load->view('admin/footer') ?>
    </div>
  </div>
</body>
</html>
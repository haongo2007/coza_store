<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($path.'/head'); ?>
<body class="animsition">
	<!-- Header -->
	<?php $this->load->view($path.'/header'); ?>

	<!-- Content -->
	<?php $this->load->view($template,$this->data); ?>

	<!-- footer -->
	<?php $this->load->view($path.'/footer') ?>
</body>
</html>
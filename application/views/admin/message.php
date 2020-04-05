<?php 

		if (strpos($message,"Thành Công")) {	
?>
		<div id="alert" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thành Công!</h4>
                <?php echo $message; ?>
		</div>
<?php 
		}
		else{
?>
		<div id="alert" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Cảnh Báo!</h4>
                <?php echo $message; ?>
         </div>
<?php
		}
	
?>
<style type="text/css">
	#alert{
		position: absolute;
		top: 30%;
		left: 40%;
		z-index: 999;
	}
</style>
<script type="text/javascript">
	$('#alert').fadeOut(5000);
</script>
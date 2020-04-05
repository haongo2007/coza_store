
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $detail->name; ?></title>
	<style type="text/css">
		<?php echo $detail->css; ?>
	</style>
</head>
<body>
	<?php 
		echo $detail->html;
	?>
</body>
</html>
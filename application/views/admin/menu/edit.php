<?php 
	$this->load->view('admin/menu/head',$this->data);
?>
<div class="line"></div>
<!-- Main content wrapper -->
<div class="wrapper">
    
   	<!-- Form -->
<form class="form" id="form" action="<?php echo admin_url('menu/edit/'.$menu->id) ?>" method="post" enctype="multipart/form-data">
	<fieldset>
		<div class="widget">
		    <div class="title">
				<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon" />
				<h6>Chỉnh Sửa menu</h6>
			</div>					
		    <ul class="tabs">
                <li><a href="#tab1">Thông tin chung</a></li>             
			</ul>
					
			<div class="tab_container">
				<!-- TAB 1 -->
		     	<div id='tab1' class="tab_content pd0">
		         	<div class="formRow">
						<label class="formLeft" for="param_name">Tên menu:<span class="req">*</span></label>
						<div class="formRight">
							<span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo $menu->title ?>" /></span>
							<span name="name_autocheck" class="autocheck"></span>
							<div name="name_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="formRow">
						<label class="formLeft" for="param_name">Thứ tự:<span class="req">*</span></label>
						<div class="formRight">
							<span class="oneTwo"><input name="sort_order" id="param_sort_order" _autocheck="true" type="text" value="<?php echo $menu->sort_order ?>"/></span>
							<span name="name_autocheck" class="autocheck"></span>
							<div name="name_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">URL:<span class="req">*</span></label>
						<div class="formRight">
							<span class="oneTwo"><input name="link" id="param_link" _autocheck="true" type="text" value="<?php echo $menu->url ?>" /></span>
							<span name="name_autocheck" class="autocheck"></span>
							<div name="name_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow hide"></div>
				</div>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
        		<div class="formSubmit">
           			<input type="submit" value="Chỉnh Sửa" class="redB" />
           			<input type="reset" value="Hủy bỏ" class="basic" />
           		</div>
        		<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clear mt30"></div>

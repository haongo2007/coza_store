
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('admin/menu/head',$this->data) ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh Sách Menu</h3>
              <h3 class="box-title pull-right">Tạo Menu</h3>
            </div>
            <!-- /.box-header -->
        		<div id="a" class="box-body">
                   	              	
					<div class="col-md-6">
	            		<div class="box box-info">
	            			<div class="box-body">

                                

                                <div class="form-group">
                                    
                                    <select id="position-view" class="form-control select2" style="width: 100%;">
                                            <option value="">Vị Trí Hiển Thị:</option>
                                    <!-- kiem tra danh muc co danh muc con hay khong -->
                                        
                                            <option value="1">HEADER</option>
                                            <option value="2">NEW PRODUCT</option>
                                            <option value="3">TOP SELLING PRODUCT</option>
                                                            
                                    </select>
                                </div>

                                <div class="form-group">
                                    
                                    <select id="get_menu" url="<?php echo admin_url('menu/get_menu') ?>" class="form-control select2" style="width: 100%;">
                                        <option value="">Menu:</option>
                                    <!-- kiem tra danh muc co danh muc con hay khong -->
                                        <?php foreach ($menu_list as $row):?>
                                            
                                                <option value="<?php echo $row->id ?>">

                                                    <?php echo $row->name; ?>
                                                    
                                                </option>
                                            
                                            
                                        <?php endforeach; ?>                     
                                    </select>
                                </div>
                                <ul class="show ">
                                    
                                </ul>
                                <a id="del" url="<?php echo admin_url('menu/delete/') ?>" class="btn bg-red btn-flat pull-right margin verify_action" style="display: none;">Xóa</a>
	            			    <a id="output" class="btn bg-green btn-flat pull-right margin" style="display: none;">Save</a>
	            			</div>
	            		</div>
	            	</div>

	            	<div class="col-md-6">
	            		<div class="box box-success">
                            <div class="col-md-6">
                                <ul id="check" style="padding: 0px">
                                <?php 
                                
                                foreach ($catalog as $row) {
                                ?>  <li id="item" data-name="<?php echo $row->name ?>" data-id="<?php echo $row->id ?>" class="input-group margin">
                                        <div id="handle" class="form-control"><?php echo $row->name;?></div>
                                        <span class="input-group-btn">
                                            <div class="btn addmenu btn-default btn-flat">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </span>
                                    </li>
                                <?php 
                                }
                                ?>
                                </ul>
                            </div>
                            
                            <div class="col-md-6">
                                
	            			<div class="cf nestable-lists box-body">

						        <div class="dd" id="nestable">
						            <ol id="par-list" class="dd-list">
						                	
						            </ol>
						        </div>
                                <div class="form-group">
                                    <input id="name" type="text" placeholder="Tên Menu" class="form-control">
                                </div>
                                <a id="cancel" href="" class="btn bg-red btn-flat pull-right margin" style="display: none;">Cancel</a>
                                <a id="save" url="<?php echo admin_url('menu/add') ?>" href="javascript:void(0)" class="btn bg-green btn-flat pull-right margin" style="display: none;">Save</a>
						    </div>

                            </div>

	            		</div>
	            	</div>		
        		</div>
            <!-- /.box-body -->
          		</div>
      		</div>
  		</div>
	</section>
</div>
<!-- DataTables -->
<script src="<?php echo public_url('admin/LTE/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo public_url('admin/LTE/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('.select2').select2();</script>
<style type="text/css">
    .show,ul{
        list-style: none;
        padding: 0px;
    }
    .show{
        display: flex!important;
        flex-wrap: wrap;
    }
    .show > li{
        margin: 10px;
        width: 29%;
    }
    .show > li h4{
        font-weight: 700;
    }
    .show > li > ul {
        padding-left: 20px;
    }
</style>
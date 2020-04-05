
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        		<form class="form" action="" method="post" enctype="multipart/form-data">
	          	          				
			            <div class="tab-content">
				            		<div class="box box-success">
          								<div class="box-body">
          									<div class="col-xs-9">

          										<div class="form-group">
													<label>Hình ảnh:</label>
													<input type="file" name="image">
												</div>
							            		<div class="form-group">
													<label>Chọn Sản Phẩm:</label>
													<table id="example2" class="table table-bordered table-hover">
										                <thead id="cter">
										                <tr>
										                	<th>
										             			Hình Ảnh:
										             		</th>
										             		<th>
										             			Tên:
										             		</th>
										             		<th>
										             			Giá:
										             		</th>
										             		<th>
										             			Giá Giảm:
										             		</th>
										                  	<th>
											                  	<div class="mailbox-controls">
									                				<!-- Check all button -->
									               	 				<button id="titleCheck" name="titleCheck" type="button" class="btn btn-default btn-sm checkbox-toggle">chọn Tất Cả</button>
									              				</div>
								              				</th>
										                </tr>
										                </thead>
										                <tbody align="center" class="lnhei">
										                <!-- Filter -->
										               	
															<?php 
																foreach ($list_pr as $row):
																	$image = array_filter(explode('|', $row->attr->image_list));
																	$color = array_filter(explode('|', $row->attr->name));
																	$code = array_filter(explode('|', $row->attr->code));
															?>
																<tr class="row_<?php echo $row->id ?>">
																	<td class="textC">
																		<?php if ($image) {
																			$link = base_url($row->attr->path.'300x300/'.$row->title.'/'.$color[0].'/'.json_decode($image[0])[0]);
																		?>
																		<img width="80" class="ima-res" src="<?php echo $link;  ?>">
																		<?php }else{
																			echo "<td class='textC'><small class='label label-danger'>SP Không có ảnh</small></td>";
																		} ?>
																	</td>
																	<td>
																		<div style="display: flex;flex-wrap: wrap;">
																		<?php $i = 0 ;
																			foreach ($code as $key => $value) {
																			$img_list = json_decode($image[$i]);
																			$link_list = base_url($row->attr->path.'300x300/'.$row->title.'/'.$color[$i].'/'.$img_list[0]);
																		?>
																			<div class="code" data-img="<?php echo $link_list;  ?>" style="width: 30%;height: 15px;background: <?php echo $value; ?>"></div>
																		<?php $i++; } ?>
																		</div>
																	</td>
																	<td width="35%">
																			<?php 
																				
																				echo '<span>'.$row->name.'</span>';
																				
																			?>
																	</td>
																	<td><?php echo number_format($row->price).'.đ'; ?></td>
																	<td><?php echo number_format($row->discount).'.đ'; ?></td>
																	<td>
																		<div class="table-responsive mailbox-messages">
																			<input type="checkbox"  name="id[]" value="<?php echo $row->id ?>">
																		</div>
																	</td>
																</tr>
															<?php 
																endforeach;
															?>
										                </tbody>
									              	</table>
												</div>

												
												<div  class="form-group">
													<input class="form-control video" type="" name="video" style="display: none;">		
												</div>

											</div>

											<div class="col-xs-3">
												<div class="form-group">
													<label>Tên:</label>
													<span class="text-red"><?php echo form_error('name'); ?></span>
													<input class="form-control" type="text" name="name">
												</div>
												<div class="form-group">
													<label>Percent price:</label>
													<span class="text-red"><?php echo form_error('discount'); ?></span>
													<input class="form-control" type="text" name="discount">
												</div>
												<div class="form-group">
													<span class="text-red"><?php echo form_error('deadline'); ?></span>
									                <label>Thời Gian Kết Thúc:</label>
									                <div class="input-group">
										                <div class="input-group-addon">
										                	<i class="fa fa-clock-o"></i>
										                </div>
									                  	<input type="text" name="deadline" class="form-control pull-right" id="reservationtime">
									                </div>
									            </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
												<div class="box-footer">
		              								<button type="submit" class="pull-right btn bg-green btn-flat">Thêm</button>
              									</div>
											</div>
									</div>
									
		    				</div>
		            	
			              
			           
			            </div>
			  
	        	</form>
    		</div>
  		</div>
	</section>
</div>
<style type="text/css">
	.code{
		transition: .2s;
		cursor: pointer;
		border: 1px solid;
		margin: 2px;
	}
	.activ{
		transform: scale(.7);
	}
</style>
<script>
  $(function () {
  	$('.lnhei').on('click','.code',function(event) {
		var data = $(this).attr('data-img');
		$(this).parent().parent().prev('.textC').children('.ima-res').attr('src', data);
		$('.code').removeClass('activ');
		$(this).addClass('activ');
	});
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: {format: 'DD/MM/YYYY'} });
});

</script>
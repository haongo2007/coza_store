<div class="d-flex flex-wrap">
      	<div class="col-md-6">
      		<div class="form-group">
				<label >Tên Sản Phẩm:</label>
				<input class="form-control" name="name" type="text" />
				<label id="name-error" class="error" for="name" style="display: none;"></label>
			</div>
			<input type="hidden" name="count" value="1" class="count_file">
			<div id="box-cl">
				<div class="att_1 same">
					<div class="form-group">
						<label >Thuộc Tính Sản Phẩm Thứ 1:</label>
						<input class="form-control" name="color_1" type="text" placeholder="Tên Màu" />
						<label id="color_1-error" class="error invalid-feedback" for="color_1" style="display: none;"></label>
						<input class="form-control" name="code_1" type="color" />
					</div>
					<div class="form-group">
						<label>Có Thể Chọn Nhiều Ảnh:</label>
						<input class="form-control attr_1" type="file" name="image_attr_1[]" multiple/>
					</div>
					<div class="form-group">
						<label>Kích thước sản phẩm:</label>
						<input class="form-control" name="size_1" type="text" placeholder="Size (VD: Size L)" />
						<label id="size_1-error" class="error invalid-feedback" for="size_1" style="display: none;"></label>
					</div>
				</div>
				<hr>
			</div>
			<div class="form-group">
	  			<button type="button" class="addclr btn btn-success">Thêm Thuộc tính</button>
			</div>
      	</div>

      	<div class="col-md-6">
			<div class="form-group">
				<label >Giá:</label>
				<input class="form-control price" name="price" type="text" />
				<label id="price-error" class="error invalid-feedback" for="price" style="display: none;"></label>	
			</div>

			<div class="form-group">
				<label >Giá Giảm(VNĐ):</label>
				<input class="form-control price" name="discount" type="text" />	
			</div>

			<div class="form-group">
				<label >Danh Mục SP:</label>
				<select id="category" name="catalog" class="form-control">
				<!-- kiem tra danh muc co danh muc con hay khong -->
					<?php foreach ($catalogs as $row):?>
						<?php if (count($row->subs) > 0):?>

					            <optgroup label="<?php echo $row->name ?>">

					            	<?php foreach ($row->subs as $subs):?>
							        
							        <option value="<?php echo $row->id ?>,<?php echo $subs->id ?>" value_child="<?php echo $subs->id ?>">
							        
							        	<?php echo $subs->name ?>
							        		
							        </option>
							    	
							    	<?php endforeach; ?>

							    </optgroup>

						<?php else: ?>

							<optgroup label="<?php echo $row->name; ?>">
		
							</optgroup>
						
						<?php endif ?>
					
					<?php endforeach; ?>				     
				</select>
			</div>
			<div class="form-group">
				<label >Hiệu SP:</label>
				<select id="brand" name="brand" class="form-control">
				<!-- kiem tra danh muc co danh muc con hay khong -->
					<?php foreach ($brand as $row):?>
						
				        <option value="<?php echo $row->id ?>">
				        
				        	<?php echo $row->name ?>
				        		
				        </option>
							    	
					<?php endforeach; ?>				     
				</select>
			</div>

			<div class="form-group">
				<label >Số Lượng:</label>
				<input class="form-control" name="stock" type="text" />
				<label id="stock-error" class="error invalid-feedback" for="stock" style="display: none;"></label>
			</div>

			<!-- <div class="form-group">
				<label>Video Mô Tả:</label>
				<input class="form-control" type="text" placeholder="Nhúng thẻ iframe từ youtube" name="video">
			</div> -->
      	</div>
	</div>
<style type="text/css">
	#box-cl{
		height: 350px;
	    overflow: scroll;
	    padding-right: 20px;
	    margin-bottom: 20px;
	    overflow-x: hidden;
	}
</style>
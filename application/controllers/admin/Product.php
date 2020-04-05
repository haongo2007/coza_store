<?php 
	/**
	* 
	*/
	class Product extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('product_model');
			$this->load->model('atribute_model');
			$this->load->model('category_model');
			$this->load->model('brand_model');
			$this->load->helper('text');
			$this->load->helper('string');
		}
		public function index(){
			if ($this->input->post()) {
				$totalData = $this->product_model->get_total();
	           	$start = $this->input->post('start');
	           	$limit = $this->input->post('length');
	           	if ($this->input->post('search')["value"]) {
	           		$search = $this->input->post('search')["value"];
	           		$input['like'] = array('name' , $search);
	           		$input['or_like'] = array('price' , $search);
	           	}
	           	if($this->input->post("order")){  
	           		$dir = $this->input->post('order')['0']['dir'];
	                $input['order'] = array('id',$dir);
	           	}
	           	else{  
	                $input['order'] = array('id','DESC');  
	           	}        	
	           	$recordsFiltered = $this->product_model->get_total($input);
	           	$input['limit'] = array($limit,$start);
	           	$table = $this->product_model->get_list($input);
			    if (count($table) > 0) {	    	
				    foreach ($table as $row) 
				    {
				        $tab = array();
				    	$mak = $row->maker_id;
						$where = array('id' => $mak);
						$maker = $this->admin_model->get_info_rule($where,array('name','avatar'));
						
						$where = array('id_product' => $row->id);
						$attr = $this->atribute_model->get_info_rule($where);

						$image = array_filter(explode('|', $attr->image_list));
						$img = json_decode($image[0]);
						$color = array_filter( explode('|', $attr->name));
						$link = $attr->path.get_unit($unit = $attr->unit )['bigest'].'/'.$row->title.'/';
						$name = $row->name;
						$title = $row->title;
						$price = $row->price;
						$discount = $row->discount;
						$amount = $row->in_stock;
						$meta_title = $row->site_title;
						$meta_key = $row->meta_key;
						$meta_desc = $row->meta_desc;
						$content = htmlspecialchars($row->content);
						$category = $row->catalog_id;
						$brand = $row->brand_id;
						$atrb = $attr;
						$value = array(
							'name' => $name,
							'title' => $title,
							'price' => number_format($price),
							'discount' => number_format($discount),
							'amount' => $amount,
							'meta_title' => $meta_title,
							'meta_key' => $meta_key,
							'meta_desc' => $meta_desc,
							'content' => $content,
							'category' => $category,
							'brand' => $brand,
							'attb' => $attr,
							'path' => $link
						);
						$link_img = base_url($attr->path.get_unit($unit = $attr->unit )['bigest'].'/'.$row->title.'/'.$color[0].'/'.$img[0]);
						$value = json_encode($value);
				        $action = 	'<td class="text-right">
				                      <div class="dropdown">
				                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                          <i class="fas fa-ellipsis-v"></i>
				                        </a>
				                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
				                          <a data-id="'.$row->id.'" data-toggle="modal" data-target="#Modal_add_edit" class="dropdown-item action_product" data-action="edit" href="#">
				                            Sửa
				                          </a>
				                          <a class="dropdown-item verify_action" href="'.admin_url('product/delete/'.$row->id).'">Xóa</a>
				                          <a data-id="'.$row->id.'" data-toggle="modal" data-target="#Modal_view" class="dropdown-item action_product" href="#" data-action="view">Chi Tiết</a>
				                        </div>
				                      </div>
				                    </td>
				                    <div class="d-none valuesetedit_'.$row->id.'">'.$value.'</div>';
				        $imag 	= 	'<th scope="row">
				                      <div class="media align-items-center">
				                        <img class="ima-res" alt="Image placeholder" src="'.$link_img.'" width="100px">
				                      </div>
				                    </th>';
				        $maker = '<div class="avatar-group">
			                        <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="'.$maker->name.'">
			                          <img alt="Image placeholder" src="'.public_url('upload/user/'.$maker->avatar).'" class="avt">
			                        </a>
			                      </div>';
				        $tab["id"] 		= $row->id;
				        $tab['ten_sp']  = $name;
				        $tab["img"]		= $imag;
				        $tab["color"] 	= $this->get_code_color($row,$attr);
				        $tab["gia"] 	= get_price($price,$discount);
				        $tab["date_created"] 	= format_date($row->created);
				        $tab["user_created"] 	= $maker;
				        $tab["hanhdong"] 		= $action;
				        $r_tab[] = $tab; 
				    }        
			    }else{
			    	$tab = array();
			        $tab["id"] 		= '';
			        $tab['ten_sp']  = '';
			        $tab["img"]		= '';
			        $tab["color"] 	= '';
			        $tab["gia"] 	= '';
			        $tab["date_created"] 	= '';
			        $tab["user_created"] 	= '';
			        $tab["hanhdong"] 		= '';
			        $r_tab[] = $tab; 
			    }
			    $output = array(
			    	"draw"			=> intval($this->input->post('draw')),
			    	"recordsTotal"	=> intval($totalData),
			    	"recordsFiltered" => intval($recordsFiltered),
			        "data" =>  $r_tab
			    );

			    echo json_encode($output);
			}else{
				$input['where'] = array('parent_id' => 0);
				$catalogs = $this->category_model->get_list($input);
				foreach ($catalogs as $row ) {
					$input['where'] = array('parent_id' => $row->id);
					$subs = $this->category_model->get_list($input);
					$row->subs = $subs;
				}
				$this->data['catalogs'] = $catalogs;

				$this->data['brand'] = $this->brand_model->get_list();
				// load view
				$this->data['template'] = 'admin/product/index';
				$this->load->view('admin/main',$this->data);
			}
		}
		private function get_code_color($row='',$attr='')
		{
			$output = '';
			$output .= '<div style="display: flex;flex-wrap: wrap;">';
			$count  = 0;
			$arr_code = array_filter( explode('|', $attr->code));
			$color = array_filter( explode('|', $attr->name));
			$image = array_filter( explode('|', $attr->image_list));
			foreach ($arr_code as $key => $value) {
				$img_list = json_decode($image[$count]);
				$link_list = base_url($attr->path.get_unit($unit = $attr->unit )['bigest'].'/'.$row->title.'/'.$color[$count].'/'.$img_list[0]);
				$output .= '<button class="btn code" data-img="'.$link_list.'" type="button" style="background:'.$value.';margin-bottom: 2px;"></button>';
				$count ++;
			}
			$output .= '</div>';
			return $output;
		}
// THEM SUA XOA XEM CHI TIET SP
		public function check_name_product(){
			$name 	 = $this->input->post('name');
			$where 		 = array('name' => $name);

			if ($this->product_model->check_exists($where)) {

				$this->form_validation->set_message(__FUNCTION__, 'Sản phẩm đã tồn tại');
				return false;
			}
			return true;
		}
	// them sp
		function add(){
			// kiem tra co data post len 
			if ($this->input->post('data')) {
				parse_str($this->input->post('data'), $output);
				// set field
				$name		= $output['name'];
				$maker 		= $this->session->userdata('admin_id');
				$str 		= explode(',', $output['catalog']);
				$type_id 	= $str[0];
				$catalog_id	= $str[1];
				$price 		= str_replace(',','', $output['price']);
				$discount 	= str_replace(',','', $output['discount']);
				$brand 		= $output['brand'];
				$stock 		= $output['stock'];
				$site_title = $output['site_title'];
				$meta_desc 	= $output['meta_desc'];
				$meta_key	= json_encode($output['meta_key']);
				$content	= $output['content'];
				
				$this->load->library('upload_library');

				$name_strip = strtolower(preg_replace('/[^A-Za-z0-9\-]/','-',strip_quotes(convert_accented_characters($name))));
				$count = intval($output['count']);
				/* LIST ẢNH */

				$set_up = $this->setting_model->get_info(2);
				$set_up = json_decode($set_up->data);
				$type_allowed = explode('|', $set_up->type_allow);
				$size_allowed = $set_up->max_size;
				$state_1 = false;
				$state_2 = false;
				for ($y=1; $y <= $count ; $y++) {
					/* validate file upload */
					if(isset($_FILES['image_attr_'.$y]) && is_array($_FILES['image_attr_'.$y]['name']) && strlen($_FILES['image_attr_'.$y]['name'][0]) > 0) {
						if ($y === $count) {
							$state_1 = true;
						}
					}
					else{
						$vl = array('ref' => 'Lỗi Hình Ảnh Sản Phẩm Là Bắt Buộc','noty' => 'fail');
						echo json_encode($vl);
						exit();
					}
				}
				if ($state_1 == true) {
					for ($i=1; $i <= $count ; $i++) {
						foreach ($_FILES['image_attr_'.$i]['name'] as $key => $type) {
							$ext = pathinfo($type, PATHINFO_EXTENSION);
							if(in_array($ext,$type_allowed) ) {
								foreach ($_FILES['image_attr_'.$i]['size'] as $key => $size) {
									if ($size/1024 > intval($size_allowed)) {
										$vl = array('ref' => 'Lỗi Dung Lượng Hình ảnh Tải Lên Vượt Quá Kích Thước Được Cho Phép' ,'noty' => 'fail');
										echo json_encode($vl);
										exit();
									}else{
										$iminfo = getimagesize($_FILES['image_attr_'.$i]['tmp_name'][$key]);
										$width = $iminfo[0];
										$height = $iminfo[1];
										if ($width > intval($set_up->horizontal)) {
											$vl = array('ref' => 'Lỗi Kích Thước Hình ảnh Tải Lên Vượt Quá Kích Thước Được Cho Phép' ,'noty' => 'fail');
											echo json_encode($vl);
											exit();
										}else{
											if ($height > intval($set_up->vertical)) {
												$vl = array('ref' => 'Lỗi Kích Thước Hình ảnh Tải Lên Vượt Quá Kích Thước Được Cho Phép' ,'noty' => 'fail');
												echo json_encode($vl);
												exit();
											}else{
												if ($i == $count) {
													$state_2 = true;
												}
											}
										}
									}
								}
							}else{
								$vl = array('ref' => 'Lỗi Loại Hình ảnh Tải Lên Phải Thuộc Một Trong Những Giá Trị Đã lưu' ,'noty' => 'fail');
								echo json_encode($vl);
								exit();
							}
						}
					}
				}
				if ($state_2 == true) {
					for ($j=1; $j <= $count ; $j++) {
						if ($output['color_'.$j] && $output['size_'.$j]) {
							if ($_FILES['image_attr_'.$j]['name'] ) {
								// lấy tên sp và màu sắc sp để tạo thư mục
								$color_[$j] = $output['color_'.$j];
								$size_[$j] = $output['size_'.$j];
								$code_[$j] = $output['code_'.$j];
								$path_product =	$this->check_mkdir($name_strip,$color_[$j]);
								$file_name = get_date(now()).'_'.$name_strip.'_'.random_string('alpha', 8);
								$file = $_FILES['image_attr_'.$j];
								$upload_img_[$j] = $this->upload_library->upload_more($path_product['original'],$file,$file_name);
								foreach ($upload_img_[$j] as $jmg) {
									$this->resize_img($color_[$j],$name_strip,$jmg);
								}
								$image_list_[$j] = json_encode($upload_img_[$j]);
								$size_[$j] = split_attb($size_[$j]);
								$color_[$j] = split_attb($color_[$j]);
								$code_[$j] = split_attb($code_[$j]);
							}
						}else{
							$vl = array('ref' => 'Lỗi Thuộc Tính Sản Phẩm Không Có Giá Trị','noty' => 'fail');
							echo json_encode($vl);
							exit();
						}
					}
				}
				// upload video mota
				/*$path_product['video'] = $this->check_mkdir($name_strip);
				$upload_vid_data = $this->upload_library->upload($path_product['video']['video'],'video');
				if (isset($upload_vid_data['file_name'])) {
					$video = $upload_vid_data['file_name'];
				}
				else{
					$video = $this->input->post('video');
				}*/
				/*$image_list = array();
				$image_list = $this->upload_library->upload_more($path_product['mota'],'image_list');
				$image_list = json_encode($image_list);*/

				/// lưu du lieu can them
				$data 		 = array(
					'name'	 	 => $name,
					'title'	 	 => $name_strip,
					'maker_id'	 => $maker,
					'catalog_id' => $catalog_id,
					'type_id'	 => $type_id,
					'brand_id'	 => $brand,
					'price' 	 => $price,
					'discount' 	 => $discount,
					'in_stock'	 => $stock,
					'site_title' => $site_title,
					'meta_desc'	 => $meta_desc,
					'meta_key'	 => $meta_key,
					'content'	 => $content
				);
				$image_list = implode('|', $image_list_);
				$size = implode('|', $size_);
				$color = implode('|', $color_);
				$code = implode('|', $code_);
				if ($this->product_model->create($data)) {
					$id = $this->db->insert_id();
						$data 		 = array(
						'id_product'	=> $id,
						'path'			=> $path_product['pure'],
						'image_list'	=> $image_list,
						'code'			=> $code,
						'name'			=> $color,
						'unit'			=> json_encode($this->unit),
						'size'			=> $size,
					);
					$this->atribute_model->create($data);
					$this->session->set_flashdata('notify_success','Thêm sản phẩm '.$name.' Thành Công !');
					$vl = array('ref' => admin_url('product'),'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
				else{
					$vl = array('ref' => 'Tạo mới dữ liệu Thất Bại','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}
				
			}
		}

		public function edit(){
			// kiem tra submit
			if ($this->input->post('data')) {
				parse_str($this->input->post('data'), $output);
				$id =  $this->input->post('id');
				$product = $this->product_model->get_info($id);
				if (!$product) {
					$vl = array('ref' => 'Sản Phẩm Này Không Tồn Tại','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}
				$where = array('id_product' => $product->id);
				$attr = $this->atribute_model->get_info_rule($where);

				$name		= $output['name'];
				$maker 		= $this->session->userdata('admin_id');
				$str 		= explode(',', $output['catalog']);
				$type_id 	= $str[0];
				$catalog_id	= $str[1];
				$price 		= str_replace(',','', $output['price']);
				$discount 	= str_replace(',','', $output['discount']);
				$brand 		= $output['brand'];
				$stock 		= $output['stock'];
				$site_title = $output['site_title'];
				$meta_desc 	= $output['meta_desc'];
				$content	= $output['content'];
				$name_strip = strtolower(preg_replace('/[^A-Za-z0-9\-]/','-',strip_quotes(convert_accented_characters($name)))) ;
				$count = intval($output['count']);

				$old_size = explode('|', $attr->size);
				$old_color = explode('|', $attr->name);
				$old_code = explode('|', $attr->code);
				$old_img = explode('|', $attr->image_list);
				/* UPDATE LIST ẢNH */

				$this->load->library('upload_library');

				$set_up = $this->setting_model->get_info(2);
				$set_up = json_decode($set_up->data);
				$type_allowed = explode('|', $set_up->type_allow);
				$size_allowed = $set_up->max_size;
				$state_1 = false;
				$state_2 = false;
				for ($y=1; $y <= $count ; $y++) {
					$k = $y - 1;
					/* validate file upload */
					if(isset($_FILES['image_attr_'.$y]) && is_array($_FILES['image_attr_'.$y]['name']) && strlen($_FILES['image_attr_'.$y]['name'][0]) > 0) {
						if ($y === $count) {
							$state_1 = true;
						}
					}
					else{
						if (isset($old_img[$k])) {
							$state_1 = true;
						}else{
							$vl = array('ref' => 'Lỗi Hình Ảnh Sản Phẩm Thứ '.$y.' Là Bắt Buộc','noty' => 'fail');
							echo json_encode($vl);
							exit();
						}
					}
				}
				if ($state_1 == true) {
					for ($i=1; $i <= $count ; $i++) {
						if (isset($_FILES['image_attr_'.$i])) {
							foreach ($_FILES['image_attr_'.$i]['name'] as $key => $type) {
								$ext = pathinfo($type, PATHINFO_EXTENSION);
								if(in_array($ext,$type_allowed) ) {
									foreach ($_FILES['image_attr_'.$i]['size'] as $key => $size) {
										if ($size/1024 > intval($size_allowed)) {
											$vl = array('ref' => 'Lỗi Dung Lượng Hình ảnh Tải Lên Vượt Quá Kích Thước Được Cho Phép' ,'noty' => 'fail');
											echo json_encode($vl);
											exit();
										}else{
											$iminfo = getimagesize($_FILES['image_attr_'.$i]['tmp_name'][$key]);
											$width = $iminfo[0];
											$height = $iminfo[1];
											if ($width > intval($set_up->horizontal)) {
												$vl = array('ref' => 'Lỗi Kích Thước Hình ảnh Tải Lên Vượt Quá Kích Thước Được Cho Phép' ,'noty' => 'fail');
												echo json_encode($vl);
												exit();
											}else{
												if ($height > intval($set_up->vertical)) {
													$vl = array('ref' => 'Lỗi Kích Thước Hình ảnh Tải Lên Vượt Quá Kích Thước Được Cho Phép' ,'noty' => 'fail');
													echo json_encode($vl);
													exit();
												}else{
													if ($i == $count) {
														$state_2 = true;
													}
												}
											}
										}
									}
								}else{
									$vl = array('ref' => 'Lỗi Loại Hình ảnh Tải Lên Phải Thuộc Một Trong Những Giá Trị Đã lưu' ,'noty' => 'fail');
									echo json_encode($vl);
									exit();
								}
							}
						}else{
							$state_2 = true;
						}
					}
				}

				if ($state_2 == true) {
					$dir_img_sm = array();
					for ($i=1; $i <= $set_up->count ; $i++) {
						$re_horizontal = 're_horizontal_'.$i;
		              	$re_vertical = 're_vertical_'.$i;
		              	$x = $set_up->{$re_horizontal}.'x'.$set_up->{$re_vertical};
		              	array_push($dir_img_sm,$x);
		            }
					for ($i=1; $i <= $count ; $i++) {
						$k = $i - 1;
						// lấy tên sp và màu sắc sp để tạo thư mục		
						$size_[$i] = $output['size_'.$i];
						$color_[$i] = $output['color_'.$i];
						$code_[$i] = $output['code_'.$i];
						if ($output['color_'.$i] && $output['size_'.$i]) {
							if(isset($_FILES['image_attr_'.$i])) {
								// progress delete old image
								if ($i > count($old_color)) {
									mkdir($attr->path.'original/'.$name_strip.'/'.$color_[$i], 0777, TRUE);
									foreach ($dir_img_sm as $key => $resize) {
										mkdir($attr->path.$resize.'/'.$name_strip.'/'.$color_[$i], 0777, TRUE);
									}
									$path_product = $attr->path.'original/'.$name_strip.'/'.$color_[$i];	
								}else{
									$dir = $attr->path.'original/'.$product->title.'/'.$old_color[$k].'/';
									foreach (json_decode($old_img[$k]) as $key => $value) {
										$path_find = $dir.$value;
										if (file_exists($path_find)) {
										    unlink($path_find);
										}
										foreach ($dir_img_sm as $key => $resize) {
											$path_find_sm = $attr->path.$resize.'/'.$product->title.'/'.$old_color[$k].'/'.$value;
											if (file_exists($path_find_sm)) {
											    unlink($path_find_sm);
											}
										}
									}
									if (is_dir($dir)) {
										rmdir($dir);
									}
									foreach ($dir_img_sm as $key => $resize) {
										$dir_sm = $attr->path.$resize.'/'.$product->title.'/'.$old_color[$k].'/';
										if (is_dir($dir_sm)) {
											rmdir($dir_sm);
										}
									}
									
									if ($color_[$i] != $old_color[$k]) {
										rename($attr->path.'original/'.$product->title.'/'.$old_color[$k], $attr->path.'original/'.$name_strip.'/'.$color_[$i]);
										foreach ($dir_img_sm as $key => $resize) {
											rename($attr->path.$resize.'/'.$product->title.'/'.$old_color[$k], $attr->path.$resize.'/'.$name_strip.'/'.$color_[$i]);
										}
										
									}
									// progress up new image
									mkdir($attr->path.'original/'.$name_strip.'/'.$color_[$i], 0777, TRUE);
									foreach ($dir_img_sm as $key => $resize) {
										mkdir($attr->path.$resize.'/'.$name_strip.'/'.$color_[$i], 0777, TRUE);
									}
									$path_product = $attr->path.'original/'.$name_strip.'/'.$color_[$i];
								}
								$file_name = get_date(now()).'_'.$name_strip.'_'.random_string('alpha', 8);
								$file = $_FILES['image_attr_'.$i];
								$upload_img_[$i] = $this->upload_library->upload_more($path_product,$file,$file_name);
								foreach ($upload_img_[$i] as $img) {
									$this->resize_img($color_[$i],$name_strip,$img);
								}
								$image_list_[$i] = json_encode($upload_img_[$i]);
								$size_[$i] = $size_[$i];
								$color_[$i] = $color_[$i];
								$code_[$i] = $code_[$i];
							}else{
								if ($color_[$i] != $old_color[$k]) {
									rename($attr->path.'original/'.$product->title.'/'.$old_color[$k], $attr->path.'original/'.$name_strip.'/'.$color_[$i]);
									foreach ($dir_img_sm as $key => $resize) {
										rename($attr->path.$resize.'/'.$product->title.'/'.$old_color[$k], $attr->path.$resize.'/'.$name_strip.'/'.$color_[$i]);
									}
									$image_list_[$i] = $old_img[$k];
									$size_[$i] = $size_[$i];
									$color_[$i] = $color_[$i];
									$code_[$i] = $code_[$i];
								}else{
									$color_[$i] = $old_color[$k];
									$image_list_[$i] = $old_img[$k];
									$size_[$i] = $old_size[$k];
									$code_[$i] = $old_code[$k];
								}
							}
						}else{
							$vl = array('ref' => 'Lỗi Sản Không Có Thuộc Tính','noty' => 'fail');
							echo json_encode($vl);
							exit();
						}
					}
				}

				if ($name != $product->name) {
					rename($attr->path.'original/'.$product->title, $attr->path.'original/'.$name_strip);
					foreach ($dir_img_sm as $key => $resize) {
						rename($attr->path.$resize.'/'.$product->title, $attr->path.$resize.'/'.$name_strip);
					}
				}

				// upload video mota
				/*$path_vd = $attr->path.'video/'.$name_strip;
				$upload_vid_data = $this->upload_library->upload($path_vd,'video');
				if (empty($upload_vid_data['file_name'])) {
					if ($this->input->post('video') == '') {

					}else{
						$video = $this->input->post('video');
						$str = strstr($product->video,'mp4');
						if ($str = 'mp4') {
							$vid_link = $path_vd.'/'.$product->video;
							if (file_exists($vid_link)) {
								unlink($vid_link);
							}
						}
					}
										
				}else{
					$video = $upload_vid_data['file_name'];
					$vid_link = $path_vd.'/'.$product->video;
					if (file_exists($vid_link)) {
						unlink($vid_link);
					}
				}*/
				// add database
				$str 		= explode(',', $output['catalog']);
				$type_id 	= $str[0];
				$catalog_id	= $str[1];
				$price 		= str_replace(',','', $output['price']);
				$discount 	= str_replace(',','', $output['discount']);
				/// lưu du lieu can them
				$data 		 = array(
					'name'	 	 => $name,
					'title'	 	 => $name_strip,
					'maker_id'	 => $this->session->userdata('admin_id'),
					'catalog_id' => $catalog_id,
					'type_id' 	 => $type_id,
					'brand_id' 	 => $brand,
					'price' 	 => $price,
					'discount' 	 => $discount,
					'in_stock'	 => $stock,
					'site_title' => $site_title,
					'meta_desc'	 => $meta_desc,
					'content'	 => $content
				);
				if (strlen($output['meta_key'][0]) > 0) {
					$data['meta_key'] = json_encode($output['meta_key']);
				}
				/*if ($video != '') {
					$data['video'] = $video;
				}*/
				$image_list = implode('|', $image_list_);
				$size = implode('|', $size_);
				$color = implode('|', $color_);
				$code = implode('|', $code_);
				$data_attr 		 = array(
					'image_list'	=> $image_list,
					'code'			=> $code,
					'name'			=> $color,
					'unit'			=> json_encode($this->unit),
					'size'		=> $size,
				);
				$this->atribute_model->update($attr->id,$data_attr);

				if ($this->product_model->update($product->id,$data)) {
					$this->session->set_flashdata('notify_success','Cập Nhật Sản Phẩm '.$name.' Thành Công !');
					$vl = array('ref' => admin_url('product'),'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
				else{
					$vl = array('ref' => 'Cập Nhật Không Thành Công','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}
			}
		}

		function delete(){
			$id = $this->uri->rsegment('3');
			$this->_del($id);
			$this->session->set_flashdata('message','Xóa Dữ Liệu Thành Công');
			redirect(admin_url('product'));
		}

		private function _del($id){
			$product = $this->product_model->get_info($id);
			if (!$product) {
				$this->session->set_flashdata('message','');
				$this->session->set_flashdata('notify_error','Sản Phẩm không tồn tại !');
				redirect(admin_url('product'));
			}
			$where = array('id_product' => $id);
			$attr = $this->atribute_model->get_info_rule($where);
			$arr_img = explode('|', $attr->image_list);
			$color_1r = explode('|', $attr->name);
			// xoa cac anh kem theo sp
			$dir_pro = $attr->path.'original/'.$product->title;
			$dir_img_sm = array();
			$f = json_decode($attr->unit);
			for ($i=0; $i <= count($f) - 1 ; $i++) {
              	array_push($dir_img_sm, $attr->path.$f[$i].'/'.$product->title);
            }
			foreach ($color_1r as $key_clr => $value) {
				$decod = json_decode($arr_img[$key_clr]);

				$dir = $attr->path.'original/'.$product->title.'/'.$value;
				foreach ($dir_img_sm as $key_siz => $val) {
					$dir_img_small = $val.'/'.$value;

					foreach ($decod as $key => $res) {
						$res = rtrim($res);
						$file = $dir.'/'.$res;
						if (file_exists($file)) {
						    unlink($file);
						}
						$file_sm = $dir_img_small.'/'.$res;
						if (file_exists($file_sm)) {
						    unlink($file_sm);
						}
					}
					if (is_dir($dir)) {
						rmdir($dir);
					}
					if (is_dir($dir_img_small)) {
						rmdir($dir_img_small);
					}
				}

				
			}
			if (is_dir($dir_pro)) {
				rmdir($dir_pro);
			}
			foreach ($dir_img_sm as $key => $value) {
				if (is_dir($value)) {
					rmdir($value);
				}
			}
			
			// xoa video mota
			if (strstr($product->video, '.mp4')) {
				$dir_vd = $attr->path.'video/'.$product->title;
				$video_link = $dir_vd.'/'.$product->video;
				if (file_exists($video_link)) {
					unlink($video_link);
					rmdir($dir_vd);
				}
			}
			
			$this->product_model->delete($id);
			$this->atribute_model->del_rule($where);
			$this->session->set_flashdata('notify_success','Xóa Sản Phẩm Thành Công !');
			redirect(admin_url('product'));
		}

		public function del_attb(){

			$id = $this->input->post('id');
			$po = $this->input->post('po');
			$name = $this->input->post('name');
			$mau = $this->input->post('mau');
			$attr = $this->atribute_model->get_info($id);

			$arr_img = explode('|', $attr->image_list);
			if (count($arr_img) == 1) {
				$vl = array('ref' => 'Sản phẩm phải có ít nhất một thuộc tính !','noty' => 'fail');
				echo json_encode($vl);
				exit();
			}
			$decod = json_decode($arr_img[$po]);
			/* change data img */
			$dir = $attr->path.'original/'.$name.'/'.$mau;

			$dir_img_sm = array();
			$f = json_decode($attr->unit);
			for ($i=0; $i <= count($f) - 1 ; $i++) {
              	array_push($dir_img_sm, $attr->path.$f[$i].'/'.$name.'/'.$mau);
            }
			foreach ($decod as $key => $value) {
				$value = rtrim($value);
				$file = $dir.'/'.$value;
				if (file_exists($file)) {
				    unlink($file);
				}
				foreach ($dir_img_sm as $key => $val) {
					$file_sm = $val.'/'.$value;
					if (file_exists($file_sm)) {
					    unlink($file_sm);
					}
				}
			}
			if (is_dir($dir)) {
				if (is_dir_empty($dir)) {
					rmdir($dir);
				}
			}
			foreach ($dir_img_sm as $key => $val) {
				if (is_dir($val)) {
					if (is_dir_empty($val)) {
						rmdir($val);
					}
				}	
			}
			unset($arr_img[$po]);
			ksort($arr_img);
			$arr_img = array_values($arr_img);
			$str_img = implode('|', $arr_img);

			/* change data name */
			$ar_name = $attr->name;
			$arr_name = explode('|', $ar_name);
			unset($arr_name[$po]);
			ksort($arr_name);
			$arr_name = array_values($arr_name);
			$str_name = implode('|', $arr_name);

			/* change data code */
			$ar_code = $attr->code;
			$arr_code = explode('|', $ar_code);
			unset($arr_code[$po]);
			ksort($arr_code);
			$arr_code = array_values($arr_code);
			$str_code = implode('|', $arr_code);

			/* change data code */
			$ar_size = $attr->size;
			$arr_size = explode('|', $ar_size);
			unset($arr_size[$po]);
			ksort($arr_size);
			$arr_size = array_values($arr_size);
			$str_size = implode('|', $arr_size);

			$data_attr	= array(
				'image_list'	=> $str_img,
				'code'			=> $str_code,
				'name'			=> $str_name,
				'size'			=> $str_size,
			);
			if ($this->atribute_model->update($attr->id,$data_attr)) {
				$value = array(
					'id' => $attr->id,
					'name_pr' => $name,
					'attb_path' => $attr->path.$f->re_horizontal_1.'x'.$f->re_vertical_1.'/'
				);
				array_push($data_attr, $value);
				$count = count(explode('|', $str_name));
				$vl = array('ref' => 'Xóa Thuộc Tính Màu '.$mau.' Thành công !','noty' => 'done','data' => $data_attr ,'count' => $count);
				echo json_encode($vl);
				exit();
			}else{
				$vl = array('ref' => 'Xóa Thuộc Tính Màu '.$mau.' Không Thành công !','noty' => 'fail');
				echo json_encode($vl);
				exit();
			}
			
			
		}
		public function search_ajax(){
			if ($this->input->post('key')) {
				$val = $this->input->post('key');
				$input['like'] = array('name',$val);
				$input['limit'] = array('10','0');
				$list = $this->product_model->get_list($input);
				foreach ($list as $key) {
					$mak = $key->maker_id;
					$where = array('id' => $mak);
					$maker = $this->admin_model->get_info_rule($where,'name');
					$key->maker = $maker;

					$id_p = $key->id;
					$where = array('id_product' => $id_p);
					$attr = $this->atribute_model->get_info_rule($where);
					$key->attr = $attr;
				}
				$val =  $this->ajax_content($list);
				echo $val;
			}
			if ($this->input->post('all')) {
				$input['limit'] = array('15','0');
				$list = $this->product_model->get_list($input);
				foreach ($list as $key) {
					$mak = $key->maker_id;
					$where = array('id' => $mak);
					$maker = $this->admin_model->get_info_rule($where,'name');
					$key->maker = $maker;

					$id_p = $key->id;
					$where = array('id_product' => $id_p);
					$attr = $this->atribute_model->get_info_rule($where);
					$key->attr = $attr;
				}
				$val =  $this->ajax_content($list);
				echo $val;
			}
			
		}

		private function resize_img($mau = '',$folder_name = '',$f_name = '',$path_pro = ''){
			$f = $this->setting_model->get_info(2);
			$f = json_decode($f->data);
			for ($i=1; $i <= $f->count ; $i++) {
				$re_horizontal = 're_horizontal_'.$i;
              	$re_vertical = 're_vertical_'.$i;
              	$x = $f->{$re_horizontal}.'x'.$f->{$re_vertical};
				$name_path_img_small = $x.'/'.$folder_name.'/'.$mau;
				$original = 'original/'.$folder_name.'/'.$mau.'/';
				if ($path_pro !== '') {
					$path_small_img = $path_pro.$name_path_img_small;
					$path = $path_pro.$original.$f_name;
				}else{
					$f_path = './public/upload/product/';
					$year = date('Y').'/';
			        $month = date('m').'/';
					$path_small_img = $f_path.$year.$month.$name_path_img_small;
		        	$path = $f_path.$year.$month.$original.$f_name;
				}
	        	$this->load->library('image_lib');
		        
		        $configrez2['image_library'] = 'gd2';
		        $configrez2['new_image'] = $path_small_img;
		        $configrez2['source_image'] = $path;
		        $configrez2['create_thumb'] = FALSE;
		        $configrez2['maintain_ratio'] = TRUE;
		        $configrez2['width'] = $f->{$re_horizontal};
		        $configrez2['height'] = $f->{$re_vertical};
		        $this->image_lib->initialize($configrez2);
		        $this->image_lib->resize();

			}
			
		}

		private function check_mkdir($name = '',$mau = ''){
			$f = $this->setting_model->get_info(2);
			$f = json_decode($f->data);
			$name_path_img_small = array();
			for ($i=1; $i <= $f->count ; $i++) {
				$re_horizontal = 're_horizontal_'.$i;
              	$re_vertical = 're_vertical_'.$i;
              	$x = $f->{$re_horizontal}.'x'.$f->{$re_vertical};
              	array_push($name_path_img_small, $x.'/'.$name.'/'.$mau);
            }
			$original = 'original/'.$name.'/'.$mau;
			$year = date('Y').'/';
	        $month = date('m').'/';
	        $f_path = './public/upload/product/';
	        $name_path_video = 'video/'.$name;
			if (!is_dir($f_path.$year)) {
	            mkdir($f_path . $year, 0777, TRUE);
	            if (!is_dir($f_path.$year.$month)) {
	                mkdir($f_path.$year.$month.$original, 0777, TRUE);
	                if (is_array($name_path_img_small)) {
                		foreach ($name_path_img_small as $key => $value) {
                			mkdir($f_path.$year.$month.$value, 0777, TRUE);
                		}
                	}
	                mkdir($f_path.$year.$month.$name_path_video, 0777, TRUE);
	                $pure_path = $f_path.$year.$month;
	                $video_path = $f_path.$year.$month.$name_path_video;
	                $ori_path = $f_path.$year.$month.$original;
	                $arr_path = array('original' => $ori_path,'pure' => $pure_path, 'video' => $video_path);
	            }else{
	                $pure_path = $f_path.$year.$month;
	                $video_path = $f_path.$year.$month.$name_path_video;
	                $ori_path = $f_path.$year.$month.$original;
	                $arr_path = array('original' => $ori_path,'pure' => $pure_path, 'video' => $video_path);
	            }
	            return $arr_path;
	        }else{
	            if (!is_dir($f_path.$year.$month)) {
	                mkdir($f_path.$year.$month.$original, 0777, TRUE);
	                if (is_array($name_path_img_small)) {
                		foreach ($name_path_img_small as $key => $value) {
                			mkdir($f_path.$year.$month.$value, 0777, TRUE);
                		}
                	}
	                mkdir($f_path.$year.$month.$name_path_video, 0777, TRUE);
	                $pure_path = $f_path.$year.$month;
	                $video_path = $f_path.$year.$month.$name_path_video;
	                $ori_path = $f_path.$year.$month.$original;
	                $arr_path = array('original' => $ori_path,'pure' => $pure_path, 'video' => $video_path);
	            }else{
	                $pure_path = $f_path.$year.$month;
	                $video_path = $f_path.$year.$month.$name_path_video;
	                $ori_path = $f_path.$year.$month.$original;
	                if (!is_dir($video_path)) {
	                	mkdir($video_path, 0777, TRUE);
	                }
	                if (!is_dir($f_path.$year.$month.$original)) {
	                	mkdir($ori_path, 0777, TRUE);
	                	if (is_array($name_path_img_small)) {
	                		foreach ($name_path_img_small as $key => $value) {
	                			mkdir($f_path.$year.$month.$value, 0777, TRUE);
	                		}
	                	}
	                	$arr_path = array('color' => $ori_path);
	                }
	                $arr_path = array('original' => $ori_path,'pure' => $pure_path, 'video' => $video_path);
	            }
	            return $arr_path;
	        }
		}

		private function ajax_content($list){
			$res = '';
			foreach ($list as $row) {
				$img = $row->attr->image;
				$img = array_filter (explode(',', $img));

				$code = $row->attr->code;
				$code = array_filter( explode(',', $code) );
				$i = 0;
				$data['row'] = $row;
				$this->load->view('admin/ajax/product_search',$data);
			}
		}
	}
?>
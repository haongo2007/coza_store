<?php 
	/**
	* 
	*/
	class brand extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('brand_model');
		}
		// lay danh sach //

		public function index(){
			// load view
			if ($this->input->post()) {
				$totalData = $this->brand_model->get_total();
	           	$start = $this->input->post('start');
	           	$limit = $this->input->post('length');
	           	if ($this->input->post('search')["value"]) {
	           		$search = $this->input->post('search')["value"];
	           		$input['like'] = array('name' , $search);
	           	}
	           	if($this->input->post("order")){  
		           	$dir = $this->input->post('order')['0']['dir'];
		           	$or = $this->input->post('order')['0']['column'];
	                if (intval($or) == 1) {
	                	$input['order'] = array('sort_order',$dir);
	                }else{
	                	$input['order'] = array('id',$dir);
	                }
	           	}
	           	else{  
	                $input['order'] = array('id','DESC');  
	           	}        	
	           	$recordsFiltered = $this->brand_model->get_total($input);
	           	$input['limit'] = array($limit,$start);
	           	$table = $this->brand_model->get_list($input);
	           
			    if (count($table) > 0) {	    	
				    foreach ($table as $row) 
				    {
				        $tab = array();
				        $name = $row->name;
						$action = 	'<button type="button" class="btn btn-success brand_add" data-toggle="modal" data-target="#exampleModal" data-id="'.$row->id.'" data-url="'.admin_url('brand/edit').'">Sửa</button>';
						$chooseall = '<div class="table-responsive mailbox-messages">
										<input type="checkbox"  name="id[]" value="'.$row->id.'">
									</div>';
						$logo = 	'<img width="100" src="'.public_url("upload/brand/").$row->logo.'">';
				        $tab["id"] 		= $row->id;
				        $tab['thutu']  	= $row->sort_order;
				        $tab["name"]	= $name;
				        $tab["logo"]	= $logo;
				        $tab["action"] 	= $action;
				        $tab["chooseall"] 	= $chooseall;
				        $r_tab[] = $tab; 
				    }        
			    }else{
			    	$tab = array();
			        $tab["id"] 			= '';
			        $tab['thutu']  		= '';
			        $tab["name"]		= '';
			        $tab["logo"]		= '';
			        $tab["action"] 		= '';
			        $tab["chooseall"] 	= '';
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
				$this->data['template'] = 'admin/brand/index';
				$this->load->view('admin/main',$this->data);	
			}
		}

		public function add(){
			if (isset($_FILES['file']['name'])) {
				$type = array('jpeg','png');
				$file_type = explode('/', $_FILES['file']['type']);
				if (in_array($file_type[1], $type)) {
						/// lưu database
						$name = $this->input->post('name');
			        	$sort = $this->input->post('sort');

			        	$where = array('name' => $name);
			        	$exists = $this->brand_model->check_exists($where);
			        	if ($exists === FALSE) {
			        		// upload anh len
							$this->load->library('upload_library');
							$upload_path = './public/upload/brand';
							$upload_data = $this->upload_library->upload($upload_path,'file');
							if (!is_array($upload_data)) {
								$vl = array('ref' => 'Hình ảnh bạn đang cố tải lên không phù hợp kích thước được phép','noty' => 'fail');
								echo json_encode($vl);
								exit();
							}else{
								$data 		 = array(
									'name'	 	 => $name,
									'sort_order' => $sort,
									'logo'		 => $upload_data['file_name']

								);
								if ($this->brand_model->create($data)) {
									$this->session->set_flashdata('notify_success','Thêm Nhãn Hiệu '.$name.' Thành Công');
									$ref = admin_url('brand');
									$vl = array('ref' => $ref,'noty' => 'done');
									echo json_encode($vl);
									exit();
								}
							}
			        	}else{
							$vl = array('ref' => 'Nhãn hiệu '.$name.' đã tồn tại','noty' => 'fail');
							echo json_encode($vl);
							exit();
			        	}
				}else{
					$vl = array('ref' => 'Logo bắt buộc kiểu (jpeg hoặc png)','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}
			}
			$vl = array('ref' => 'Logo là bắt buộc','noty' => 'fail');
			echo json_encode($vl);
			exit();
		}
		/// cap nhat data///
		public function edit(){
			/// lưu database
			$id = $this->input->post('id');
			$name = $this->input->post('name');
        	$sort = $this->input->post('sort');

			$info = $this->brand_model->get_info($id);
        	$where = array('name' => $name);
        	$exists = $this->brand_model->check_exists($where);
        	if ($exists === FALSE) {
        		// upload anh len
        		if (isset($_FILES['file'])) {
					$type = array('jpeg','png');
					$file_type = explode('/', $_FILES['file']['type']);
					if (in_array($file_type[1], $type)) {
						$this->load->library('upload_library');
						$upload_path = './public/upload/brand';
						$upload_data = $this->upload_library->upload($upload_path,'file');
						if (!is_array($upload_data)) {
							$vl = array('ref' => 'Hình ảnh bạn đang cố tải lên không phù hợp kích thước được phép','noty' => 'fail');
							echo json_encode($vl);
							exit();
						}else{
							$link_del = './public/upload/brand/'.$info->logo;
							if (file_exists($link_del)) {
								unlink($link_del);
							}
						}
					}else{
						$vl = array('ref' => 'Logo bắt buộc kiểu (jpeg hoặc png)','noty' => 'fail');
						echo json_encode($vl);
						exit();
					}
				}
				$data 		 = array(
					'name'	 	 => $name,
					'sort_order' => $sort
				);
				if (isset($_FILES['file'])) {
					$data['logo'] = $upload_data['file_name'];
				}
				if ($this->brand_model->update($id,$data)) {
					$this->session->set_flashdata('notify_success','Sửa Nhãn Hiệu '.$name.' Thành Công');
					$ref = admin_url('brand');
					$vl = array('ref' => $ref,'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
        	}else{
				$vl = array('ref' => 'Nhãn hiệu '.$name.' đã tồn tại','noty' => 'fail');
				echo json_encode($vl);
				exit();
        	}
		}

		// xoa nhieu data //

		public function delete(){
			$ids = $this->input->post('ids');
			foreach ($ids as $id) {
				$res = $this->_del($id);
				$ar_res[] = $res;
			}
			echo json_encode($ar_res);
		}

		// ham` xoa goi vao

		private function _del($id){
			$info = $this->brand_model->get_info($id);

			if (!$info) {
				$ref = 'Không tồn tại Nhãn Hiệu này';
				$vl = array('ref' => $ref,'noty' => 'fail','id' => 0);
				return $vl;
				exit();
			}
			// kiem tra danh muc co san pham khong
			$this->load->model('product_model');
			$product = $this->product_model->get_info_rule(array('brand_id' => $id),'name');
			if ($product) {
				$ref = 'Nhãn Hiệu '.$info->name.' có liên kết với sản phẩm '.$product->name.', bạn cần phải sản phẩm Này Trước !';
				$vl = array('ref' => $ref,'noty' => 'fail','id' => 0);
				return $vl;
				exit();
			}
			// xoa du lieu
			$this->brand_model->delete($id);
			$link_del = './public/upload/brand/'.$info->logo;
			if (file_exists($link_del)) {
			    unlink($link_del);
			}
			$ref =  'Đã Xóa Nhãn Hiệu ' .$info->name. ' Thành Công !';
			$vl = array('ref' => $ref,'noty' => 'done','id' => $info->id);
			return $vl;
			exit();
		}

		////////////////////////////////////////////////



	}
?>
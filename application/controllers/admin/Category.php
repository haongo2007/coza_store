<?php 
	/**
	* 
	*/
	class Category extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('category_model');
		}
		// lay danh sach //

		public function index(){
			if ($this->input->post()) {
				$totalData = $this->category_model->get_total();
	           	$start = $this->input->post('start');
	           	$limit = $this->input->post('length');
	           	if ($this->input->post('search')["value"]) {
	           		$search = $this->input->post('search')["value"];
	           		$input['like'] = array('name' , $search);
	           	}
	           	if($this->input->post("order")){  
	           		$or = $this->input->post('order')['0']['column'];
	           		$dir = $this->input->post('order')['0']['dir'];
	                if (intval($or) == 1) {
	                	$input['order'] = array('sort_order',$dir);
	                }else{
	                	$input['order'] = array('id',$dir);
	                }
	           	}
	           	else{  
	                $input['order'] = array('id','DESC');  
	           	}        	
	           	$recordsFiltered = $this->category_model->get_total($input);
	           	$input['limit'] = array($limit,$start);
	           	$table = $this->category_model->get_list($input);
	           
			    if (count($table) > 0) {	    	
				    foreach ($table as $row) 
				    {
				        $tab = array();
				        $where = array('id' => $row->parent_id);
				        $name_parent = $this->category_model->get_info_rule($where,'name');
				        if ($row->parent_id == 0) {
							$name = '<span>'.$row->name.'</span>&nbsp;<span class="badge badge-info"> Cha</span>';
				        }else{
				        	$name = '<span>'.$row->name.'</span>&nbsp;<span class="badge badge-warning"> Con của '.$name_parent->name.'</span>';
				        }
				        if ($row->banner != '') {
				        	$banner = public_url('upload/banner/'.$row->banner);
				        }else{
				        	$banner = '';
				        }
						$meta_key = str_replace('"', '', $row->meta_key);
						$action = '<td class="text-right">
				                      <div class="dropdown">
				                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                          <i class="fas fa-ellipsis-v"></i>
				                        </a>
				                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
				                          <a class="dropdown-item category_add" data-target="#exampleModalview" href="#" data-toggle="modal" data-url="'.admin_url('category/edit').'" data-id="'.$row->id.'" data-action="view">Xem</a>
				                          <a class="dropdown-item category_add" data-target="#exampleModal" data-id="'.$row->id.'" href="#" data-url="'.admin_url('category/edit').'" data-parent-id="'.$row->parent_id.'" data-action="edit" data-toggle="modal">Sửa</a>
				                        </div>
				                      </div>
				                      <input type="hidden" value="" banner="'.$banner.'" meta_key="'.$meta_key.'" meta_desc="'.$row->meta_desc.'" site_title="'.$row->site_title.'">
				                    </td>';
						$chooseall = '<div class="table-responsive mailbox-messages">
										<input type="checkbox"  name="id[]" value="'.$row->id.'">
									</div>';
				        $tab["id"] 		= $row->id;
				        $tab['thutu']  	= $row->sort_order;
				        $tab["name"]	= $name;
				        $tab["action"] 	= $action;
				        $tab["chooseall"] 	= $chooseall;
				        $r_tab[] = $tab; 
				    }        
			    }else{
			    	$tab = array();
			        $tab["id"] 			= '';
			        $tab['thutu']  		= '';
			        $tab["name"]		= '';
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
				$input['where'] = array('parent_id' => 0);
				$list = $this->category_model->get_list($input);
				$this->data['list'] = $list;
				// load view
				$this->data['template'] = 'admin/category/index';
				$this->load->view('admin/main',$this->data);
			}
		}
		// them du lieu

		public function add(){
			parse_str($this->input->post('data'), $output);
			$where = array('name' => $output['name']);
        	$exists = $this->category_model->check_exists($where);
        	if ($exists === FALSE) {
				$this->load->library('upload_library');
				$upload_path = './public/upload/banner';
				$upload_data = $this->upload_library->upload($upload_path,'file');
        		$data 		 = array(
					'name'	 	 => $output['name'],
					'sort_order' => $output['sort'],
					'site_title' => $output['title'],
					'meta_desc' => $output['meta-desc'],
					'parent_id' => $output['parent_id'],
					'meta_key' => json_encode($output['meta_key']),

				);
				if (isset($upload_data)) {
					$data['banner'] = $upload_data['file_name'];
				}
				if ($this->category_model->create($data)) {
					$this->session->set_flashdata('notify_success','Thêm Danh Mục '.$output['name'].' Thành Công');
					$ref = admin_url('category');
					$vl = array('ref' => $ref,'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
        	}else{
        		$vl = array('ref' => 'Danh mục '.$output['name'].' đã tồn tại','noty' => 'fail');
				echo json_encode($vl);
				exit();
        	}
		}
		/// cap nhat data///
		public function edit(){
			parse_str($this->input->post('data'), $output);
			$id = $output['id'];
			$where = array('name' => $output['name']);
			$info = $this->category_model->get_info($id);
			if (!$info) {
				$vl = array('ref' => 'Danh mục '.$output['name'].' Không tồn tại','noty' => 'fail');
				echo json_encode($vl);
				exit();
			}
        	$exists = $this->category_model->check_exists($where);
        	if ($exists === FALSE || count($exists) <= 1) {
				$this->load->library('upload_library');
				$upload_path = './public/upload/banner';
				$upload_data = $this->upload_library->upload($upload_path,'file');
        		$data 		 = array(
					'name'	 	 => $output['name'],
					'sort_order' => $output['sort'],
					'site_title' => $output['title'],
					'meta_desc' => $output['meta-desc'],
					'parent_id' => $output['parent_id'],
					'meta_key' => json_encode($output['meta_key']),
				);
				if (isset($_FILES['file'])) {
					$type = array('jpeg','png');
					$file_type = explode('/', $_FILES['file']['type']);
					if (in_array($file_type[1], $type)) {
						$this->load->library('upload_library');
						$upload_path = './public/upload/banner';
						$upload_data = $this->upload_library->upload($upload_path,'file');
						if (!is_array($upload_data)) {
							$vl = array('ref' => 'Hình ảnh bạn đang cố tải lên không phù hợp kích thước được phép','noty' => 'fail');
							echo json_encode($vl);
							exit();
						}else{
							if ($info->banner != '') {
								$link_del = './public/upload/banner/'.$info->banner;
								if (file_exists($link_del)) {
									unlink($link_del);
								}
							}
						}
					}else{
						$vl = array('ref' => 'Logo bắt buộc kiểu (jpeg hoặc png)','noty' => 'fail');
						echo json_encode($vl);
						exit();
					}
				}
				if ($this->category_model->update($id,$data)) {
					$this->session->set_flashdata('notify_success','Sửa Danh Mục '.$output['name'].' Thành Công');
					$ref = admin_url('category');
					$vl = array('ref' => $ref,'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
        	}else{
        		$vl = array('ref' => 'Danh mục '.$output['name'].' đã tồn tại','noty' => 'fail');
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
			$info = $this->category_model->get_info($id);

			if (!$info) {
				$ref = 'Không tồn tại danh mục này';
				$vl = array('noty' => 'fail','ref' => $ref,'id' => 0);
				return $vl;
				exit();
			}
			// kiem tra danh muc co san pham khong
			$this->load->model('product_model');
			$product = $this->product_model->get_info_rule(array('catalog_id' => $id),'id');
			if ($product) {
				$ref = 'Danh mục '.$info->name.' có liên kết với sản phẩm, bạn cần phải xóa hết sản phẩm liên kết với danh mục này!';
				$vl = array('noty' => 'fail','ref' => $ref,'id' => 0);
				return $vl;
				exit();
			}

			$catalog_child = $this->category_model->get_info_rule(array('parent_id' => $id),'parent_id');
			if ($catalog_child) {
				$ref = 'Danh mục ' .$info->name. ' còn chứa danh mục con, bạn cần phải xóa hết danh mục con trong danh mục này!';
				$vl = array('noty' => 'fail','ref' => $ref,'id' => 0);
				return $vl;
				exit();
			}
			// xoa du lieu
			$this->category_model->delete($id);
			$link_del = './public/upload/banner/'.$info->banner;
			if (file_exists($link_del)) {
				unlink($link_del);
			}
			$ref =  'Đã Xóa Danh Mục ' .$info->name. ' Thành Công !';
			$vl = array('noty' => 'done','ref' => $ref,'id' => $info->id);
			return $vl;
			exit();
		}

		////////////////////////////////////////////////



	}
?>
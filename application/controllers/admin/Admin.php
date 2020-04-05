<?php 
	/**
	* 
	*/
	class Admin extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('admin_model');
		}

		public function index(){

			if ($this->input->post()) {
				$totalData = $this->admin_model->get_total();
	           	$start = $this->input->post('start');
	           	$limit = $this->input->post('length');
	           	if ($this->input->post('search')["value"]) {
	           		$search = $this->input->post('search')["value"];
	           		$input['like'] = array('name', $search);
	           		$input['like'] = array('email', $search);
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
	           	$recordsFiltered = $this->admin_model->get_total($input);
	           	$input['limit'] = array($limit,$start);
	           	$table = $this->admin_model->get_list($input);
	           
			    if (count($table) > 0) {	    	
				    foreach ($table as $row) 
				    {
				        $tab = array();
				        $name	= $row->name;
				        $email	= $row->email;
				        $sdt	= $row->phone;
				        $pos 	= $row->chucvu;
			        	$adr 	= $row->address;

				        $permissions = '<span class="d-none">'.$row->permissions.'</span>';
				        $edit = '<a class="dropdown-item action_admin" href="#" data-action="edit" data-toggle="modal" data-target="#exampleModal" data-id="'.$row->id.'" data-url="'.admin_url('admin/edit').'">Sửa</a>'.$permissions;
				        
						if ($this->session->userdata('admin_id') !== $row->id && $row->id != 9) {
							$edit .= '<a class="dropdown-item verify_action" href="'.admin_url('admin/delete/'.$row->id).'">Xóa</a>';
						}
				        $action = '<td class="text-right">
				                      <div class="dropdown">
				                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                          <i class="fas fa-ellipsis-v"></i>
				                        </a>
				                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
				                          '.$edit.'
				                        </div>
				                      </div>
				                    </td>';
				        $tab['name']  	= $name;
				        $tab["email"]	= $email;
				        $tab["sdt"]		= $sdt;
				        $tab["pos"] 	= $pos;
			        	$tab["adr"] 	= $adr;
				        $tab["crea"] 	= get_date($row->created);
				        $tab["act"] 	= $action;
				        $r_tab[] = $tab; 
				    }        
			    }else{
			    	$tab = array();
			        $tab['name']  	= '';
			        $tab["email"]	= '';
			        $tab["sdt"]		= '';
			        $tab["pos"] 	= '';
			        $tab["adr"] 	= '';
			        $tab["crea"] 	= '';
			        $tab["act"] 	= '';
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
				$this->config->load('permissions',true);
				$config_pm = $this->config->item('permissions');
				$this->data['config_pm'] = $config_pm;

				$this->data['template'] = 'admin/admin/index';
				$this->load->view('admin/main',$this->data);
			}
		}
		// function callback check username db
		public function check_email($output='',$email_edit=''){
			$this->load->library('form_validation');
			$action 	 = $this->uri->rsegment(2);
			$email 	 	 = $output;
			$where 		 = array('email' => $email);
			$check 		 = true;
			if ($action == 'edit') {
				if ($email_edit == $output) {
					$check = false;
				}
			}
			if ($check && $this->admin_model->check_exists($where)) {
				return false;
			}
			return true;
		}

		public function add(){
			if ($this->input->post()) {
				parse_str($this->input->post('data'), $output);
	        	$exists = $this->check_email($output['email']);
	        	if ($exists === FALSE) {
	        		$vl = array('ref' => 'Admin '.$output['email'].' đã tồn tại','noty' => 'fail');
					echo json_encode($vl);
					exit();
	        	}
				// add database
				$name		 = $output['name'];
				$password 	 = $output['password'];
				$email 		 = $output['email'];
				$phone 		 = $output['phone'];
				$address 	 = $output['address'];
				$position 	 = $output['position'];
				$avatar		 = 'avatar5.jpg';
				$data 		 = array(
					'name'	 	 => $name,
					'password'	 => md5($password),
					'email'		 => $email,
					'phone'	 	 => $phone,
					'address'	 => $address,
					'chucvu'	 => $position,
					'avatar'	 => $avatar,
					'created'	 => now()
				);
				$data['permissions'] = json_encode($output['permissions']);
				if ($this->admin_model->create($data)) {
					$this->session->set_flashdata('notify_success','Thêm Quản Trị Viên '.$name.' Thành Công');
					$ref = admin_url('admin');
					$vl = array('ref' => $ref,'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
				else{
					$vl = array('ref' => 'Thêm Quản Trị Viên Thất Bại !','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}
			
			}	
		}

		// ham chinh sua quan tri 

		public function edit(){
			if ($this->input->post()) {
				parse_str($this->input->post('data'), $output);
				$id		 = $output['id'];
				$info = $this->admin_model->get_info($id);
				if (!$info) {
					$vl = array('ref' => 'Quản Trị Viên Này Không Tồn Tại !','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}
	        	$exists = $this->check_email($output['email'],$info->email);
	        	if ($exists === FALSE) {
	        		$vl = array('ref' => 'Admin '.$output['email'].' đã tồn tại','noty' => 'fail');
					echo json_encode($vl);
					exit();
	        	}
				// add database
				
				$name		 = $output['name'];
				$email 		 = $output['email'];
				$phone 		 = $output['phone'];
				$address 	 = $output['address'];
				$position 	 = $output['position'];
				$data 		 = array(
					'name'	 	 => $name,
					'email'		 => $email,
					'phone'	 	 => $phone,
					'address'	 => $address,
					'chucvu'	 => $position,
				);
				if ($output['password']) {
					$data['password'] = md5($output['password']);
				}
				$data['permissions'] = json_encode($output['permissions']);
				if ($this->admin_model->update($id,$data)) {
					$this->session->set_flashdata('notify_success','Sửa Quản Trị Viên '.$name.' Thành Công');
					$ref = admin_url('admin');
					$vl = array('ref' => $ref,'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
				else{
					$vl = array('ref' => 'Sửa Quản Trị Viên Thất Bại !','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}
			
			}
		}

		// xoa data

		public function delete(){
			$id = $this->uri->rsegment('3');
			$id = intval($id);

			$info = $this->admin_model->get_info($id);
			if (!$info) {
				$this->session->set_flashdata('notify_error','Quản Trị Viên Này Không Tồn Tại !');
				redirect(admin_url('admin'));
			}
			// thuc hien
			$this->admin_model->delete($id);
			$this->session->set_flashdata('notify_success','Xóa Quản Trị Viên '.$info->name.' Thành Công');
			redirect(admin_url('admin'));
		}

	}
?>
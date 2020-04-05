<?php 
	/**
	* 
	*/
	class Info extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('Setting_model');
		}

		public function index(){
			/* settup site*/
			$settup_site = $this->Setting_model->get_info(1);
			$data = json_decode($settup_site->data);
			$this->data['data'] = $data;
			$this->data['template'] = 'admin/info/index';
			$this->load->view('admin/main',$this->data);
		}
		public function edit(){

			$this->load->library('form_validation');
			$this->load->helper('form');

			if ($this->input->post()) {
				$this->form_validation->set_rules('name','Tên','required');
				$this->form_validation->set_rules('email','Thể loại','required');
				$this->form_validation->set_rules('phone','Giá','required');
				if ($this->form_validation->run()) {
					$name		= $this->input->post('name');
					$email 		= $this->input->post('email');
					$phone   	= $this->input->post('phone');
					$map 		= $this->input->post('map');
					$address 	= $this->input->post('address');
					$old_logo 	= $this->input->post('old_logo');
					$this->load->library('upload_library');

					$upload_path = './public/upload/logo';
					$upload_data = $this->upload_library->upload($upload_path,'logo');
					if (isset($upload_data['file_name'])) {
						$new_logo = $upload_data['file_name'];
					}
					$ar_data = 	array(
									'name_site'	 	 => $name,
									'email' 	 => $email,
									'phone' 	 => $phone,
									'map'		 => $map,
									'address'	 => $address,
								);
					if ($new_logo != '') {
						$ar_data['logo_site'] = $new_logo;
					}else{
						$ar_data['logo_site'] = $old_logo;
					}
					$data 		 = array(
						'data' => json_encode($ar_data)
					);
					if ($this->Setting_model->update(1,$data)) {
						$this->session->set_flashdata('notify_success','Thay Đổi Dữ Liệu Thành Công');
					}else{
						$this->session->set_flashdata('notify_error','Thay Đổi Dữ Liệu Không Thành Công');
					}
					// chuyen di 
					redirect(admin_url('info'));
				}
			}

		}

	}
?>
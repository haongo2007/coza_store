<?php 
	/**
	* 
	*/
	class shippingfee extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('shippingfee_model');
		}

		public function index()
		{
			$list = $this->shippingfee_model->get_list();
			$this->data['list'] = $list;

			$this->data['temp'] = 'admin/shippingfee/index';
			$this->load->view('admin/main',$this->data);
		}

		public function add()
		{	
			$list = $this->shippingfee_model->get_list();
			$this->data['list'] = $list;
			// load thu vien
			$this->load->library('form_validation');
			$this->load->helper('form');
			// kiem tra co data post len 
			if ($this->input->post()) {
				$this->form_validation->set_rules('citi','citi','required');
				$this->form_validation->set_rules('fee','set fee','required');


				if ($this->form_validation->run()) {
					// add database
					$citi  = $this->input->post('citi');
					$fee   = $this->input->post('fee');
					/// lưu du lieu can them
					$data 		 = array(
						'citi'		 => $citi,
						'fee'	 => $fee,
					);
					
					if ($this->shippingfee_model->create($data)) {

						$this->session->set_flashdata('message','Thêm mới dữ liệu Thành Công');
					}
					else{
						$this->session->set_flashdata('message','Tạo mới dữ liệu Thất Bại');
					}
					// chuyen di
					redirect(admin_url('shippingfee'));
				}
				
			}
			$this->data['temp'] = 'admin/shippingfee/add';
			$this->load->view('admin/main',$this->data);
		}

		public function edit(){
			
			$id = $this->uri->rsegment('3');
			$info = $this->shippingfee_model->get_info($id);
			if (!$info) {
				$this->session->set_flashdata('message','Sản Phẩm không tồn tại');
				redirect(admin_url('shippingfee'));
			}

			$this->data['info'] = $info;

			// load thu vien
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			// kiem tra co data post len 
			if ($this->input->post()) {
				$this->form_validation->set_rules('citi','Citi','required');
				$this->form_validation->set_rules('fee','set fee','required');


				if ($this->form_validation->run()) {
					// add database
					$citi		= $this->input->post('citi');
					$fee   = $this->input->post('fee');

					/// lưu du lieu can them
					$data 		 = array(
						'citi'	 	 => $citi,
						'fee'	 => $fee,
					);
					if ($this->shippingfee_model->update($id,$data)) {

						$this->session->set_flashdata('message','Thay đổi dữ liệu Thành Công');
					}
					else{
						$this->session->set_flashdata('message','Thay đổi dữ liệu Thất Bại');
					}
					// chuyen di 
					redirect(admin_url('shippingfee'));
				}
			}
			$this->data['temp'] = 'admin/shippingfee/edit';
			$this->load->view('admin/main',$this->data);
		}
		public function delete(){
			$id = intval($this->uri->rsegment('3'));
			$this->shippingfee_model->delete($id);

			redirect(admin_url('shippingfee'));
		}


	}
?>
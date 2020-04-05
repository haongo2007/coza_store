
<?php 
	/**
	* 
	*/
	class Payment extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('payment_model');
		}

		public function index(){
			$payment = $this->payment_model->get_list();
			$this->data['payment'] = $payment;
			// load view
			$this->data['template'] = 'admin/payment/index';
			$this->load->view('admin/main',$this->data);
		}
		public function state(){
			$id = $this->uri->rsegment(3);
			$info = $this->payment_model->get_info($id);
			if (!$info) {
				$this->session->set_flashdata('notify_error','Thiết Lập Lỗi !');
				redirect(admin_url('payment'));
			}
			if ($info->status == 1) {
				$state = 0;
			}else{
				$state = 1;
			}
			$data 		 = array(
				'status' => $state,
			);
			$this->payment_model->update($id,$data);
			$this->session->set_flashdata('notify_success','Thiết Lập Thành Công !');
			redirect(admin_url('payment'));
		}
		public function setup()
		{
			if ($this->input->post()) {
				$id = $this->input->post('id');
				$res = $this->input->post();
				unset($res['id']);
				if (!$this->input->post('status')) {
					$res['status'] = 'off';
				}
				$res = json_encode($res);
				$data 		 = array(
					'data'	 	 => $res,
				);
				$this->payment_model->update($id,$data);
				$this->session->set_flashdata('notify_success','Thiết Lập Thành Công !');
				redirect(admin_url('payment'));
			}
		}
		public function add(){
			// kiem tra co data post len 
			if ($this->input->post()) {
				// lay ten file anh upload len
				$this->load->library('upload_library');
				$upload_path = './public/upload/payment';
				$upload_data = $this->upload_library->upload($upload_path,'image');
				$image_link = '';
				if (isset($upload_data['file_name'])) {
					$image_link = $upload_data['file_name'];
				}else{
					if ($_FILES['image']['name'] != '') {
						$this->session->set_flashdata('notify_error',$upload_data);
						redirect(admin_url('payment'));
					}
				}
				if ($this->input->post('status') == 'on') {
					$status = 1;
				}else{
					$status = 0;
				}
				/// lưu du lieu can them
				$data 		 = array(
					'name'	 	 => $this->input->post('name'),
					'status'	 => $status,
				);
				if ($image_link != '') {
					$data['banner'] = $image_link;
				}
				if ($this->payment_model->create($data)) {
					$this->session->set_flashdata('notify_success','Thêm Phương Thức Thanh Toán Thành Công');
					redirect(admin_url('payment'));
				}
				else{
					$this->session->set_flashdata('notify_error','Thêm Phương Thức Thanh Toán Không Thành Công');
					redirect(admin_url('payment'));
				}
			}
		}
	}
?>
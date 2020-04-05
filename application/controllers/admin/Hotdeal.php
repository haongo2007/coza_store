<?php 
	/**
	* 
	*/
	class Hotdeal extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('hotdeal_model');
			$this->load->model('product_model');
			$this->load->model('atribute_model');
		}

		public function index()
		{
			$list = $this->hotdeal_model->get_list();
			$this->data['list'] = $list;

			$this->data['temp'] = 'admin/hotdeal/index';
			$this->load->view('admin/main',$this->data);
		}

		public function add()
		{	
			$list_pr = $this->product_model->get_list();
			foreach ($list_pr as $key) {
				$inp = array('id_product' => $key->id);
				$attr = $this->atribute_model->get_info_rule($inp);
				$key->attr = $attr;
			}
			$this->data['list_pr'] = $list_pr;
			// load thu vien
			$this->load->library('form_validation');
			$this->load->helper('form');
			// kiem tra co data post len 
			if ($this->input->post()) {
				$this->form_validation->set_rules('name','name','required');
				$this->form_validation->set_rules('discount','percent price','required');
				$this->form_validation->set_rules('deadline','dead line','required');


				if ($this->form_validation->run()) {
					// add database
					$id			= $this->input->post('id');
					$name   	= $this->input->post('name');
					$discount   = $this->input->post('discount');
					$deadline   = $this->input->post('deadline');

					// lay ten file anh upload len
					$this->load->library('upload_library');
					$upload_path = './public/upload/hotdeal';
					
					$upload_data = $this->upload_library->upload($upload_path,'image');
					$image_link = '';
					if (isset($upload_data['file_name'])) {
						$image_link = $upload_data['file_name'];
					}
					$json_id = json_encode($id);
					/// lưu du lieu can them
					$data 		 = array(
						'name'		 => $name,
						'discount'	 => $discount,
						'arr_prod'   => $json_id,
						'time' 	 	 => $deadline,
						'status' 	 => 0,
						'created'	 => now(),
					);
					if ($image_link != '') {
						$data['image_link'] = $image_link;
					}
					$this->hotdeal_model->create($data);

					$lastid = $this->db->insert_id();
					foreach ($id as $key => $value) {
						$val 		 = array(
							'hotdeal' => $lastid
						);
						$this->product_model->update($value,$val);
					}
						
					// chuyen di
					redirect(admin_url('hotdeal'));
				}
				
			}
			$this->data['temp'] = 'admin/hotdeal/add';
			$this->load->view('admin/main',$this->data);
		}

		public function edit(){
			if ($this->uri->rsegment('3') == 'active' ) {
				$id = $this->uri->rsegment('4');
				$list = $this->hotdeal_model->get_list();
				foreach ($list as $key) {
					if ($key->status == 2) {
						$data 		 = array(
						'status'	 => 0
						);
						$this->hotdeal_model->update($key->id,$data);
					}
				}
				$data 		 = array(
					'status'	 	 => 2
				);

				$this->hotdeal_model->update($id,$data);
			}
			if ($this->uri->rsegment('3') == 'deactive' ) {
				$id = $this->uri->rsegment('4');
				$data = array('status'	 => 0);
				$this->hotdeal_model->update($id,$data);
			}
			$id = $this->uri->rsegment('3');
			$info = $this->hotdeal_model->get_info($id);
			if (!$info) {
				$this->session->set_flashdata('message','Sản Phẩm không tồn tại');
				redirect(admin_url('hotdeal'));
			}
			// data product
			$str = preg_replace('/[\[\]\"]/','', $info->arr_prod);
			$ar = explode(',', $str );

			$list_pr = $this->product_model->get_list();
			foreach ($list_pr as $key) {
				$key->ar = $ar;
				$inp = array('id_product' => $key->id);
				$attr = $this->atribute_model->get_info_rule($inp);
				$key->attr = $attr;
			}
			$this->data['list_pr'] = $list_pr;
			// data value
			$this->data['info'] = $info;

			// load thu vien
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			// kiem tra co data post len 
			if ($this->input->post()) {
				$this->form_validation->set_rules('name','Tên','required');
				$this->form_validation->set_rules('deadline','dead line','required');
				$this->form_validation->set_rules('discount','percent','required');


				if ($this->form_validation->run()) {
					// add database
					$name		= $this->input->post('name');
					$discount   = $this->input->post('discount');
					$deadline   = $this->input->post('deadline');
					$arr_prod   = $this->input->post('id');
					$id 		= json_encode($arr_prod);
					// lay ten file anh upload len
					$this->load->library('upload_library');
					$upload_path = './public/upload/hotdeal';
					$upload_data = $this->upload_library->upload($upload_path,'image');
					$image_link = '';
					if (isset($upload_data['file_name'])) {

						$image_link = './public/upload/hotdeal/'.$info->image_link;
						if (file_exists($image_link)) {
							unlink($image_link);
						}

						$image_link = $upload_data['file_name'];
					}

					/// lưu du lieu can them
					$data 		 = array(
						'name'	 	 => $name,
						'arr_prod'	 => $id,
						'discount' 	 => $discount,
						'time' 	 	 => $deadline,
						'status' 	 => 0,
						'created'	 => now(),
					);
					if ($image_link != '') {
						$data['image_link'] = $image_link;
					}

					foreach (json_decode($info->arr_prod) as $key => $value) {
						$reset 		 = array(
							'hotdeal' => 0
						);
						$this->product_model->update($value,$reset);
					}
					foreach ($arr_prod as $key => $value) {
						$val 		 = array(
							'hotdeal' => $info->id
						);
						$this->product_model->update($value,$val);
					}

					if ($this->hotdeal_model->update($info->id,$data)) {

						$this->session->set_flashdata('message','Thay đổi dữ liệu Thành Công');
					}
					else{
						$this->session->set_flashdata('message','Thay đổi dữ liệu Thất Bại');
					}
					// chuyen di 
					redirect(admin_url('hotdeal'));
				}
			}
			$this->data['temp'] = 'admin/hotdeal/edit';
			$this->load->view('admin/main',$this->data);
		}
		public function delete(){
			$id = $this->uri->rsegment('3');
			$info = $this->hotdeal_model->get_info($id);
			$this->hotdeal_model->delete($id);
			$image_link = './public/upload/hotdeal/'.$info->image_link;
			if (file_exists($image_link)) {
				unlink($image_link);
			}
			// chuyen di 
			redirect(admin_url('hotdeal'));
		}
		public function extract()
		{
			$this->load->helper('directory');
			$this->data['map'] = directory_map('public/upload/', FALSE, TRUE);
			$this->load->library('upload_library');
			$path = './public/upload/hotdeal';
			$upload_data = $this->upload_library->upload_directory($path);

			$this->data['temp'] = 'admin/hotdeal/extract';
			$this->load->view('admin/main',$this->data);
		}

	}
?>

<?php 
	/**
	* 
	*/
	class Slide extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('slide_model');
		}

		public function index(){
			$input = array();

			/* slide */
			$input['order'] = array('sort_order','ASC');
			$list_slide = $this->slide_model->get_list($input);
			$this->data['list_slide'] = $list_slide;

			$setting_resources = $this->setting_model->get_info(2);
			$this->data['setting_res'] = json_decode($setting_resources->data);

			// load view
			$this->data['template'] = 'admin/slide/index';
			$this->load->view('admin/main',$this->data);
		}

// THEM SUA XOA XEM CHI TIET bai viet
	// them sp
		public function add(){
			
			// kiem tra co data post len 
			if ($this->input->post()) {
				// lay ten file anh upload len
				$this->load->library('upload_library');
				$upload_path = './public/upload/slide';
				$upload_data = $this->upload_library->upload($upload_path,'image');
				$image_link = '';
				if (isset($upload_data['file_name'])) {
					$image_link = $upload_data['file_name'];
				}else{
					$this->session->set_flashdata('notify_error',$upload_data);
					redirect(admin_url('slide'));
				}

				/// lưu du lieu can them
				$data 		 = array(
					'name'	 	 => $this->input->post('name'),
					'image_link' => $image_link,
					'link'	 => $this->input->post('link'),
					'info'	 => $this->input->post('info'),
					'sort_order'	 => $this->input->post('sort_order'),
				);
				if ($this->slide_model->create($data)) {
					$this->session->set_flashdata('notify_success','Thêm Thành Công !');
					redirect(admin_url('slide'));
				}
				else{
					$this->session->set_flashdata('notify_error','Lỗi Thêm Slide Không Thành Công');
					redirect(admin_url('slide'));
				}
				
			}
		}

		public function edit(){
			$id = $this->uri->rsegment('3');
			$slide = $this->slide_model->get_info($id);
			if (!$slide) {
				$this->session->set_flashdata('notify_error','Lỗi Slide Không Tồn Tại');
				redirect(admin_url('slide'));
			}
			
			// kiem tra co data post len 
			if ($this->input->post()) {
				// lay ten file anh upload len
				$this->load->library('upload_library');
				$upload_path = './public/upload/slide';
				$upload_data = $this->upload_library->upload($upload_path,'image');
				$image_link = '';
				if (isset($upload_data['file_name'])) {
					$image_link = $upload_data['file_name'];
				}else{
					if ($_FILES['image']['name'] != '') {
						$this->session->set_flashdata('notify_error',$upload_data);
						redirect(admin_url('slide'));
					}
				}
				/// lưu du lieu can them
				$data 		 = array(
					'name'	 	 => $this->input->post('name'),
					'link'	 => $this->input->post('link'),
					'info'	 => $this->input->post('info'),
					'sort_order'	 => $this->input->post('sort_order'),
				);
				if ($image_link != '') {
					$data['image_link'] = $image_link;
					$rev_old = './public/upload/slide/'.$slide->image_link;
					if (file_exists($rev_old)) {
						unlink($rev_old);
					}
				}
				if ($this->slide_model->update($slide->id,$data)) {
					$this->session->set_flashdata('notify_success','Sửa Slide Thành Công');
					redirect(admin_url('slide'));
				}
				else{
					$this->session->set_flashdata('notify_error','Sửa Slide Không Thành Công');
					redirect(admin_url('slide'));
				}
			}

			$this->data['temp'] = 'admin/slide/edit';
			$this->load->view('admin/main',$this->data);

		}

		public function delete(){
			$id = $this->input->post('id');
			$this->_del($id);
			$this->session->set_flashdata('notify_success','Xóa Slide Thành Công !');
			$vl = array('ref' => admin_url('slide'),'noty' => 'done');
			echo json_encode($vl);
			exit();
		}

		private function _del($id){
			$slide = $this->slide_model->get_info($id);

			if (!$slide) {
				$vl = array('ref' => 'Slide Này Không Tồn Tại','noty' => 'fail');
				echo json_encode($vl);
				exit();
			}
			$this->slide_model->delete($id);
			$image_link = './public/upload/slide/'.$slide->image_link;
			if (file_exists($image_link)) {
				unlink($image_link);
			}
		}

		public function setting()
		{
			
			if ($this->input->post()) {
				$data = array('name' => 'setting_resources', 'data' => json_encode($this->input->post()), 'created' => now());
				$this->setting_model->update(2,$data);
				$this->session->set_flashdata('notify_success','Thiết Lập Thành Công !');
				redirect(admin_url('slide'));
			}
		}
		public function remove_resize()
		{
			$index = intval($this->input->post('ind') + 1);
			$data = $this->setting_model->get_info(2)->data;
			$data = json_decode($data);
			unset($data->{'re_horizontal_'.$index});
			unset($data->{'re_vertical_'.$index});
			$x = range(1,$data->count);
			unset($x[$index - 1]);
			ksort($x);
			$vl = array_values($x);
			$data->count = intval($data->count) - 1;
			for ($i=1; $i <= $data->count ; $i++) {
				$k = $i - 1;
				$data->{'re_horizontal_'.$i} = $data->{'re_horizontal_'.$vl[$k]};
				$data->{'re_vertical_'.$i} = $data->{'re_vertical_'.$vl[$k]};
				if ($i == $data->count) {
					if ($index != count($x) + 1) {
						unset($data->{'re_horizontal_'.$vl[$k]});
						unset($data->{'re_vertical_'.$vl[$k]});
					}
				}
			}
			$res = array('data' => json_encode($data));
 			$this->setting_model->update(2,$res);
			$vl = array('ref' => 'Xóa Giá Trị Thành Công !','noty' => 'done','data' => $data);
			echo json_encode($vl);
			exit();
		}
	}
?>
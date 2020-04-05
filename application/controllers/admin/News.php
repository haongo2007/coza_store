
<?php 
	/**
	* 
	*/
	class News extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('news_model');
		}

		public function index(){
			// lay ra tong so luong bai viet trong web
			$total_rows = $this->news_model->get_total();
			$this->data['total_rows'] = $total_rows;
// PHAN TRANG
			// load thu vien phan trang//
			$this->load->library('pagination');
			// cau hinh phan trang
			$config = array();
			$config['total_rows'] = $total_rows;// tong tat ca san pham trong web
			$config['base_url']	  = admin_url('news/index'); // link hien thi ra
			$config['per_page']	  = 4; // so luong sp hien thi 1 trang
			$config['uri_segment']= 4; // phan doan thu 4 tren url
			$config['next_link']  = 'Trang kế';
			$config['prev_link']  = 'Trang trước';
			/// khoi tao phan trang
			$this->pagination->initialize($config);

			$segment = $this->uri->segment(4);
			$segment = intval($segment);
			$input = array();
			$input['limit'] = array($config['per_page'],$segment); 
// PHAN LOC
			// kiem tra co thuc hien loc sp hay khong

			$id = $this->input->get('id');			
			$id = intval($id);
			$input['where'] = array();
			if ($id > 0) {
				$input['where']['id'] = $id;
			}
			// loc theo ten
			$title = $this->input->get('title');
			if ($title) {
				$input['like'] = array('title',$title);
			}
	
			// lay danh sach bai viet
			$list = $this->news_model->get_list($input);
			$this->data['list'] = $list;

			//lay noi dung message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			// load view
			$this->data['temp'] = 'admin/news/index';
			$this->load->view('admin/main',$this->data);
		}

// THEM SUA XOA XEM CHI TIET bai viet
	// them sp
		public function add(){

			// load thu vien
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			// kiem tra co data post len 
			if ($this->input->post()) {
				$this->form_validation->set_rules('title','tiêu đề bài viết','required');
				$this->form_validation->set_rules('content','nội dung bài viết','required');


				if ($this->form_validation->run()) {
					
					// lay ten file anh upload len
					$this->load->library('upload_library');
					$upload_path = './public/upload/news';
					$upload_data = $this->upload_library->upload($upload_path,'image');
					$image_link = '';
					if (isset($upload_data['file_name'])) {
						$image_link = $upload_data['file_name'];
					}

					/// lưu du lieu can them
					$data 		 = array(
						'title'	 	 => $this->input->post('title'),
						'image_link' => $image_link,
						'meta_desc'	 => $this->input->post('meta_desc'),
						'meta_key'	 => $this->input->post('meta_key'),
						'content'	 => $this->input->post('content'),
						'created'	 => now(),
					);
					if ($this->news_model->create($data)) {

						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
					}
					else{
						$this->session->set_flashdata('message','Tạo mới dữ liệu Không thành công');
					}
					// chuyen di 
					redirect(admin_url('news'));
				}
				
			}

			$this->data['temp'] = 'admin/news/add';
			$this->load->view('admin/main',$this->data);

		}

		public function edit(){
			$id = $this->uri->rsegment('3');
			$news = $this->news_model->get_info($id);
			if (!$news) {
				$this->session->set_flashdata('message','Bài Viết không tồn tại');
				redirect(admin_url('news'));
			}
			$this->data['news'] = $news;

			// load thu vien
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			// kiem tra co data post len 
			if ($this->input->post()) {
				$this->form_validation->set_rules('title','tiêu đề bài viết','required');
				$this->form_validation->set_rules('content','nội dung bài viết','required');

				if ($this->form_validation->run()) {
					// add database
					// lay ten file anh upload len
					$this->load->library('upload_library');
					$upload_path = './public/upload/news';
					$upload_data = $this->upload_library->upload($upload_path,'image');
					$image_link = '';
					if (isset($upload_data['file_name'])) {
						$image_link = $upload_data['file_name'];
					}
					/// lưu du lieu can them
					$data 		 = array(
						'title'	 	 => $this->input->post('title'),
						'meta_desc'	 => $this->input->post('meta_desc'),
						'meta_key'	 => $this->input->post('meta_key'),
						'content'	 => $this->input->post('content'),
						'created'	 => now(),
					);
					if ($image_link != '') {
						$data['image_link'] = $image_link;
					}
					if ($this->news_model->update($news->id,$data)) {

						$this->session->set_flashdata('message','Thay đổi dữ liệu thành công');
					}
					else{
						$this->session->set_flashdata('message','Thay đổi dữ liệu Không thành công');
					}
					// chuyen di 
					redirect(admin_url('news'));
				}
				
			}

			$this->data['temp'] = 'admin/news/edit';
			$this->load->view('admin/main',$this->data);

		}

		public function delete(){
			$id = $this->uri->rsegment('3');
			$this->_del($id);
			$this->session->set_flashdata('message','Xóa bài viết thành công');
			redirect(admin_url('news'));
		}

		public function delete_all(){
			$ids = $this->input->post('ids');
			foreach ($ids as $id) {
				$this->_del($id);
			}
		}

		private function _del($id){
			$news = $this->news_model->get_info($id);

			if (!$news) {
				$this->session->set_flashdata('message','Bài viết không tồn tại');
				redirect(admin_url('news'));
			}
			
			$this->news_model->delete($id);
			$image_link = './upload/news/'.$news->image_link;
			if (file_exists($image_link)) {
				unlink($image_link);
			}
		}

		public function info(){
			$this->data['temp'] = 'admin/news/info';
			$this->load->view('admin/main',$this->data);
		}
	}
?>
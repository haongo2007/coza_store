<?php 
	/**
	* 
	*/
	class Page extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('page_model');
		}

		public function index(){
			$list = $this->page_model->get_list();
			$this->data['list'] = $list;
			$this->data['temp'] = 'admin/page/index';
			$this->load->view('admin/main',$this->data);
		}
		public function add(){
			$this->load->view('admin/page/add');
		}
		public function list(){
			$input['where'] = array('status' => 1);
			$list = $this->page_model->get_list($input);
		}
		public function view(){
			$id = $this->uri->rsegment(3);
			$id = intval($id);
			$detail = $this->page_model->get_info($id);
			$this->data['detail'] = $detail;
			$this->load->view('admin/page/detail',$this->data);
		}
		public function active(){
			$id = $this->uri->rsegment(3);
			$id = intval($id);
			$info = $this->page_model->get_info($id);
			if(!$info){
				redirect(admin_url('page'));
			}
			if (intval($info->status) === 0) {
				$status = 1;
			}else{
				$status = 0;
			}
			$data 		 = array(
				'status'	 => $status,
			);
			if ($this->page_model->update($info->id,$data)) {
				redirect(admin_url('page'));
			}
		}
		public function delete(){
			$id = $this->uri->rsegment(3);
			$id = intval($id);
			$info = $this->page_model->get_info($id);
			if(!$info){
				redirect(admin_url('page'));
			}
			if ($this->page_model->delete($info->id)) {
				redirect(admin_url('page'));
			}
		}
		public function save(){
			$name = $this->input->post('name');
			$status = $this->input->post('status');
			$html = $this->input->post('html');
			$css = $this->input->post('css');
			$data 		 = array(
				'name'	 	 => $name,
				'status'	 => $status,
				'html'	 	 => $html,
				'css'	 	 => $css,
			);
			if ($this->page_model->create($data)) {
				echo admin_url('page');
			}
		}

	}
?>
<?php 
	/**
	* 
	*/
	class User extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('user_model');
		}

		public function index(){
			$input = array();
			
			$list = $this->user_model->get_list($input);
			$this->data['list'] = $list;

			$total = $this->user_model->get_total();
			$this->data['total'] = $total;

			//lay noi dung message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			$this->data['temp'] = 'admin/user/index';
			$this->load->view('admin/main',$this->data);
		}


	}
?>
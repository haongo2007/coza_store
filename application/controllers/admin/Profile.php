<?php 
	/**
	* 
	*/
	class Profile extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('profile_model');
		}

		public function index(){

			$this->data['temp'] = 'admin/profile/index';
			$this->load->view('admin/main',$this->data);
		}
	}
?>
<?php 
	class Direct extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index(){

			$this->data['temp'] = 'admin/direct/index';
			$this->load->view('admin/main',$this->data);
		}
	}
?>
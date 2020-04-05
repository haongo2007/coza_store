<?php 
	/**
	* 
	*/
	class Contact extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){
			// load product categories
	        $this->data['page_title'] = 'Contact'.' | '.site_name();
	        $this->data['template'] = 'theme/'.$this->site.'/contact/index';
	        $this->load->view('theme/'.$this->site.'/layout',$this->data);
		}
		
	} 
?>
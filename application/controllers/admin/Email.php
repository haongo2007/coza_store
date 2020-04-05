<?php 
	/**
	* 
	*/
	class Email extends MY_Controller
	{
		function __construct(){
			parent::__construct();
		}
		public function index(){
			$this->load->library('email');
			$config = Array(
	            'protocol'  => 'smtp',
	            'smtp_host' => 'ssl://smtp.googlemail.com',
	            'smtp_port' => '465',
	            'smtp_user' => 'haongodev@gmail.com',
	            'smtp_pass' => 'haopro123',
	            'mailtype'  => 'html',
	            'starttls'  => true,
	            'newline'   => "\r\n"
        	);
        	$this->email->initialize($config);
			$this->email->from('haongodev@gmail.com', 'HaoNgo');
			$this->email->to($this->input->post('emailto'));
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('content'));
			if (!$this->email->send()){
				$this->session->set_flashdata('message',$this->email->print_debugger());
			}else{
			    $this->session->set_flashdata('message','Gửi email Thành Công');
			}
			redirect(admin_url('home'));
		}
	}
?>
<?php 
	class Login extends MY_controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('admin_model');
		}
		public function index()
		{
			/*if (get_cookie('remember')) {
				$data = json_decode(get_cookie('remember'));
				$email = $data->tk;
				$pass = $data->mk;
				$this->login_by_cookie($email,$pass);
			}*/
			$this->load->view('admin/login/index',$this->data);
		}
		/*public function login_by_cookie($email='',$pass='')
		{
			$pass_md = md5($pass);		
			$where = array('email' => $email,'password' => $pass_md);
			$admin  = $this->admin_model->get_info_rule($where);
			if (!$admin) {
				redirect(admin_url('login'));
			}else{
				$this->session->set_userdata('permissions',json_decode($admin->permissions));
				$this->session->set_userdata('admin_id',$admin->id);
				$this->session->set_userdata('login',true);
				redirect(admin_url('home'));
			}
		}*/
		public function check_login(){
			if ($this->input->post()) {
				$email = $this->input->post('email');
				$pass = $this->input->post('password');
				$pass_md = md5($pass);		
				$where = array('email' => $email,'password' => $pass_md);
				$admin  = $this->admin_model->get_info_rule($where);
				if (!$admin) {
					$vl = array('ref' => 'Tài Khoản Hoặc Mật Khẩu Sai Xin Thử Lại !','noty' => 'fail');
					echo json_encode($vl);
					exit();
				}else{
					$remember = $this->input->post('remember') === 'true' ? true : false;
					if ($remember == true) {
						$this->session->set_userdata('login',true);
						/*$val = array('tk' => $email, 'mk' => $pass);
						set_cookie('remember',json_encode($val),86400*30);*/
					}else{
						$this->session->set_userdata('login',true);
						$this->session->set_userdata('condition',true);
						/*$ck = get_cookie('remember');
						if ($ck) {
							delete_cookie('remember');
						}*/
					}
					$this->session->set_userdata('permissions',json_decode($admin->permissions));
					$this->session->set_userdata('admin_id',$admin->id);
					$vl = array('ref' => admin_url('home'),'noty' => 'done');
					echo json_encode($vl);
					exit();
				}
			}
			
		}
	}

?>
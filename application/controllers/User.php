<?php 
	/**
	* 
	*/
	class User extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('google');
			$this->load->library('facebook');
			$this->load->model('user_model');
		}

		function check_email(){
			$email 	 = $this->input->post('email');
			$where 		 = array('email' => $email);

			if ($this->user_model->check_exists($where)) {

				$this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
				return false;
			}
			return true;

		}
		function register(){

			$this->load->library('form_validation');
			$this->load->helper('form');
			
			// kiem tra co data post len 
			if ($this->input->post()) {
				$this->form_validation->set_rules('name','your name','required|min_length[3]');
				$this->form_validation->set_rules('email','email đăng nhập','required|min_length[6]|callback_check_email');
				$this->form_validation->set_rules('psw','password','required|min_length[6]');
				$this->form_validation->set_rules('re_psw','password','matches[psw]');
				$this->form_validation->set_rules('phone','Number Phone','required');
				$this->form_validation->set_rules('address','Address','required');

				if ($this->form_validation->run()) {
					// add database
					$password 	 = $this->input->post('psw');
					$password    = md5($password);
					$data 		 = array(
						'name'	 	 => $this->input->post('name'),
						'email'	 	 => $this->input->post('email'),
						'phone'	 	 => $this->input->post('phone'),
						'address'	 => $this->input->post('address'),
						'password'	 => $password,
						'created'	 => now(),
					);
					if ($this->user_model->create($data)) {
						$this->session->set_flashdata('message','Tạo Tài Khoản Thành Công');
					}
					else{
						$this->session->set_flashdata('message','Tạo Tài Khoản Không Thành Công');
					}
					// chuyen di 
					redirect(site_url('home'));
				}
				
			}

	        $this->data['page_title'] = 'User'.' | '.site_name();
	        $this->data['template'] = 'theme/'.$this->site.'/user/register';
	        $this->load->view('theme/'.$this->site.'/layout',$this->data);
		}

		function login(){
			if ($this->session->userdata('user_data')) {
				redirect(base_url('user'));
			}
			$this->load->library('form_validation');
			$this->load->helper('form');
			if ($this->input->post()) {
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules('email','email','required|valid_email');
				$this->form_validation->set_rules('password','password','required|min_length[6]');
				if ($this->form_validation->run() == FALSE) {
				    echo validation_errors();
				}
				$email 	 = $this->input->post('email');
				$where 	 = array('email' => $email);

				if ($this->user_model->check_exists($where)) {
					$user = $this->_get_user_info();
					if (!$user) {
						if (!$this->input->post('password') == '') {
							echo "Wrong Password";
						}
						return false;
					}
					$this->session->set_userdata('user_data', $user);
					echo "1";
				}else{
					if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
						
					}else{
						echo $this->lang->line('form_validation_check_email');
					}
					return false;
				}
			}
			$this->data['facebook_login_url'] = $this->facebook->login_url();
			$this->data['google_login_url'] = $this->google->login_url();
	        $this->data['page_title'] = 'User'.' | '.site_name();
	        $this->data['template'] = 'theme/'.$this->site.'/user/login';
	        $this->load->view('theme/'.$this->site.'/layout',$this->data);
		}

		/// ham check login
		function check_login(){
			
		}

		/* ham lay thong tin thanh vien*/
		private function _get_user_info(){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$password = md5($password);
			$where = array('email' => $email , 'password' => $password);
			$user  = $this->user_model->get_info_rule($where);
			
			return $user;
			
		}

		function logout(){
			if ($this->session->userdata('user_data')) {
				switch ($this->session->userdata('user_data')['oauth_provider']) {
					case 'facebook':
						if ($this->session->userdata('fb_access_token')) {
							$this->session->unset_userdata('fb_access_token');
							$this->session->unset_userdata('FBRLH_state');
							$this->session->unset_userdata('fb_expire');
						}
						break;
					case 'google':
						if ($this->session->userdata('access_token')) {
							$this->session->unset_userdata('access_token');
							$this->session->unset_userdata('FBRLH_state');
						}
						$this->google->logout_url();
						break;
					default:
						# code...
						break;
				}
				$this->session->unset_userdata('user_data');
			}
			$this->session->set_flashdata('notify_success','Đăng Xuất Thành Công');
			redirect(base_url());
		}
		public function g_callback()
		{
			$google_data = $this->google->validate();
            $user  =  array(
					'oauth_provider'=>'google',
            		'oauth_uid'    	=>$google_data['id'], 
					'name'			=>$google_data['name'],
					'email'			=>$google_data['email'],
					'avatar'		=>$google_data['profile_pic'],
					'link'			=>$google_data['link'],
					'birthday'		=>'',
					'gender'		=>'',
					'phone'			=>'',
					'address'		=>'',
					'city'			=>'',
					'country'		=>'',
					'postcode'		=>'',
					);

			$where = array('oauth_uid' => $user['oauth_uid']);
            $info = $this->user_model->get_info_rule($where);
            if (!$info) {
            	$data 		 = array(
					'name'	 	 => $user['name'],
					'email'	 	 => $user['email'],
					'phone'	 	 => '',
					'address'	 => '',
					'city'	 	 => '',
					'country'	 => '',
					'postcode'	 => '',
					'password'	 => '',
					'oauth_uid'	 => $user['oauth_uid'],
					'oauth_provider'=> $user['oauth_provider'],
					'birthday'	 => $user['birthday'],
					'gender'	 => $user['gender'],
					'link'		 => $user['link'],
					'avatar'	 => $user['avatar'],
					'created'	 => now(),
				);
				$this->user_model->create($data);
				$id = $this->db->insert_id();
            }else{
            	$id = $info->id;
            }
            $user['id'] = $id;
			$this->session->set_userdata('user_data', $user);
            redirect(base_url('user'));
		}
		public function f_callback()
		{
			if($this->facebook->is_authenticated()){
	            // Get user facebook profile details
	            $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,birthday,picture.width(300).height(300)');
	            // Preparing data for database insertion
	            $user['oauth_provider'] = 'facebook';
	            $user['oauth_uid']    	= !empty($fbUser['id'])?$fbUser['id']:'';
	            $user['name']    		= $fbUser['first_name'].' '.$fbUser['last_name'];
	            $user['email']        	= !empty($fbUser['email'])?$fbUser['email']:'';
	            $user['avatar']    		= !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
	            $user['link']        	= !empty($fbUser['link'])?$fbUser['link']:'';
	            $user['gender']       	= !empty($fbUser['gender'])?$fbUser['gender']:'';
	            $user['birthday']       = !empty($fbUser['birthday'])?$fbUser['birthday']:'';
	            $user['phone']       	= '';
	            $user['address']       	= '';
	            $user['city']       	= '';
	            $user['country']       	= '';
	            $user['postcode']       = '';
	            $where = array('oauth_uid' => $user['oauth_uid']);
	            $info = $this->user_model->get_info_rule($where);
	            if (!$info) {
	            	$data 		 = array(
						'name'	 	 => $user['name'],
						'email'	 	 => $user['email'],
						'phone'	 	 => '',
						'address'	 => '',
						'city'	 	 => '',
						'country'	 => '',
						'postcode'	 => '',
						'password'	 => '',
						'oauth_uid'	 => $user['oauth_uid'],
						'oauth_provider'=> $user['oauth_provider'],
						'birthday'	 => $user['birthday'],
						'gender'	 => $user['gender'],
						'link'		 => $user['link'],
						'avatar'	 => $user['avatar'],
						'created'	 => now(),
					);
					$this->user_model->create($data);
					$id = $this->db->insert_id();
	            }else{
	            	$id = $info->id;
	            }
	            $user['id'] = $id;
	            $this->session->set_userdata('user_data', $user);
	            redirect(base_url('user'));
	            // Insert or update user data
	            //$userID = $this->user->checkUser($userData);
	        }
		}
		function index(){
			if (!$this->session->userdata('user_data')) {
				redirect(base_url('user/login'));
			}else{
				$user =  $this->session->userdata('user_data');
			}
			$this->data['user'] = $user;
	        $this->data['template'] = 'theme/'.$this->site.'/user/index';
	        $this->load->view('theme/'.$this->site.'/layout',$this->data);
		}

		function edit(){
			if (!$this->session->userdata('user_id_login')) {
				redirect();
			}
			$id = $this->session->userdata('user_id_login');
			if ($this->input->post()) {
					// add database
				 $name = $this->input->post('n');
				 $address = $this->input->post('a');
				 $phone = $this->input->post('p');

					$data 		 = array(
						'name'	 	 => $name,
						'phone'	 	 => $phone,
						'address'	 => $address,
					);
					if ($this->input->post('m')) {
						$pass = $this->input->post('m');
				 		$pass = md5($pass);
						$data['password'] = $pass;
					}
					$this->user_model->update($id,$data);
					echo'<script>window.location="'.site_url('user').'";</script>';
			}
		}
	} 
?>
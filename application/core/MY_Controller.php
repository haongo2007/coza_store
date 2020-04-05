<?php 

	class MY_Controller extends CI_Controller
	{
		/// send data -> view 
		public $data = array();
		public $site;
		public $assets;
		public $unit = array();
		function __construct()
		{
			parent::__construct();
			$controller = $this->uri->segment(1);
			$this->load->model('setting_model');
			/* load setting */
			$setting = $this->setting_model->get_info(2);
			$setting = json_decode($setting->data);
			for ($i=1; $i <= $setting->count ; $i++) {
				$all = $setting->{'re_horizontal_'.$i}.'x'.$setting->{'re_vertical_'.$i};
				array_push($this->unit, $all);
			}
			switch ($controller) {
				case 'admin':
				{
					$this->load->helper('admin');
					$this->_check_login();

					$this->load->model('admin_model');
					$admin_id = $this->session->userdata('admin_id');
					$admin =  $this->admin_model->get_info($admin_id);
					$this->data['admin'] = $admin;

					$notify_success = $this->session->flashdata('notify_success');
					if ($notify_success) {
						$this->data['notify_success'] = $notify_success;
					}
					$notify_error = $this->session->flashdata('notify_error');
					if ($notify_error) {
						$this->data['notify_error'] = $notify_error;
					}
			        
					break;
				}	
				default:
				{				

					if ($this->session->userdata('condition')) {
						$this->session->unset_userdata('login');
						$this->session->unset_userdata('condition');
					}	
					$where = array('status' => 1);
					$this->load->model('theme_model');
					$theme = $this->theme_model->get_info_rule($where,$field = 'name');
					$this->site = $theme->name;
					$this->assets = public_url('theme/'.$theme->name.'/assets');

					/* load info site */
					$info = $this->setting_model->get_info(1);
					$info = json_decode($info->data);
					$this->data['info'] = $info;

					$this->data['assets'] = $this->assets;
        			$this->data['path'] = 'theme/'.$this->site;
			        // user
			        /*if ($this->session->userdata('user_id_login')) {
			        	$this->load->model('user_model');
						$user_id = $this->session->userdata('user_id_login');
						$user =  $this->user_model->get_info($user_id);
						$this->data['user'] = $user;
					}
					//kiem tra user dang nhap chua
			        $user_id_login = $this->session->userdata('user_id_login');
			        $this->data['user_id_login'] = $user_id_login;
			        if ($user_id_login) {
			        	$this->load->model('user_model');
			        	$user_info = $this->user_model->get_info($user_id_login);
			        	$this->data['user_info'] = $user_info;
			        }*/
					// load thu vien gio hang
					$this->load->library('cart');
        			$cart = $this->cart->contents();
        			$total_items = $this->cart->total_items();
					$this->data['cart'] = $cart;
					$this->data['total_items'] = $total_items;
			        
			        if ($this->input->post('lang')) {
						$this->config->set_item('language',$this->input->post('lang'));
			        	$this->load_lang();
			    	}else{
			    		$lang = $this->session->userdata('lang');
			    		if (!$lang) {
			    			$lang = $this->config->item('language');
			    			$this->session->set_userdata('lang',$lang);
			    		}
			    		$this->config->set_item('language', $lang);
						$this->lang->load(array('header','footer'),$lang);
			    	}
			    	$notify_success = $this->session->flashdata('notify_success');
					if ($notify_success) {
						$this->data['notify_success'] = $notify_success;
					}
					$notify_error = $this->session->flashdata('notify_error');
					if ($notify_error) {
						$this->data['notify_error'] = $notify_error;
					}
				}		
			}
		}
		protected function load_lang(){
			$this->session->set_userdata('lang',$this->input->post('lang'));	
			$lang = $this->session->userdata('lang');
			$lang_config = $this->config->item('language');
			$this->lang->load(array('header','footer'),$lang);
		}
		/// check status admin
		private function _check_login(){
			$controller = $this->uri->rsegment('1');
			$controller = strtolower($controller);

			$login = $this->session->userdata('login');
			if (!$login && $controller != 'login') {
				redirect(admin_url('login'));
			}
			if ($login && $controller == 'login') {
				
				redirect(admin_url('home'));
			}
			elseif (!in_array($controller,array('login','home'))) {
				$admin_id = $this->session->userdata('admin_id');
				$admin_root = $this->session->userdata('root_admin');
				$admin_root = $this->config->item('root_admin');
				if ($admin_id != $admin_root) {

					$permissions_admin = $this->session->userdata('permissions');
					$controller = $this->uri->rsegment('1');
					$action 	= $this->uri->rsegment('2');
					$check 		= true;
					if (!isset($permissions_admin->{$controller})) {
						$check  = false;
					}
					$permissions_actions = $permissions_admin->{$controller};
					if (!in_array($action, $permissions_actions)) {
						$check  = false;
					}
					if (!$check) {
						if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
						{    
						  	$vl = array('ref' => 'Bạn Không Có Quyền Truy Cập Chức Năng Này !','noty' => 'fail');
							echo json_encode($vl);
							exit();
						}else{
							$this->session->set_flashdata('notify_error','Bạn Không Có Quyền Truy Cập Chức Năng Này');
							redirect(base_url('admin'));
						}
					}

				}
				
			}
		}
	}
?>
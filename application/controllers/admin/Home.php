<?php 
	
	class Home extends MY_Controller
	{
		
		public function index()
		{
			$this->load->model('transaction_model');
			$this->load->model('product_model');
			$this->load->model('news_model');
			$this->load->model('user_model');
			/* get year */
			$dupli = $this->transaction_model->find_duplicate($field = 'created');
			$this->data['dupli'] = $dupli;
			if ($this->input->get('year')) {
				$year = $this->input->get('year');
			}else{
				$year = date('Y');
			}
			$input['where'] = array('status' => 1);
			$time = array("DATE_FORMAT(created,'%Y')" => $year);
			$field_sum = 'amount';
			// lay danh sach sp
			$amount = $this->transaction_model->statistical($input,$time,$field_sum);
			$this->data['amount'] = $amount;
			// lay tong so giao dich theo nam
			$field = 'created, COUNT(id) as total';
			$total_gi_by_year = $this->transaction_model->find_duplicate($field,$time);
			$this->data['total_gi_by_year'] = $total_gi_by_year;


			// lay tong so giao dich theo thang
			$time = array("DATE_FORMAT(created,'%Y')" => $year);
			$field = 'created, COUNT(id) as total';
			// lay danh sach sp
			$total_gi_by_month = $this->transaction_model->find_duplicate($field,$time,$month = true);
			$this->data['total_gi_by_month'] = $total_gi_by_month;

			////
			// lay ra tong so giao dich
			$total_gi = $this->transaction_model->get_total();
			$this->data['total_gi'] = $total_gi;

			// lay tong so sp
			$total_pr = $this->product_model->get_total();
			$this->data['total_pr'] = $total_pr;

			// lay tong so bai viet
			$total_ne = $this->news_model->get_total();
			$this->data['total_ne'] = $total_ne;

			// lay tong so user
			$total_us= $this->user_model->get_total();
			$this->data['total_us'] = $total_us;

			// tinh tong doanh so	

			$total_sales = $this->transaction_model->get_sum('amount');
			$this->data['total_sales'] = $total_sales;

			// tinh tong doanh so hom nay
			$today_list = $this->transaction_model->get_list();
			$this->data['today_list'] = $today_list;
			
			
			//lay noi dung message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			// load view
			
			$this->data['template'] = 'admin/home/index';
			$this->load->view('admin/main',$this->data);
		}
		
		public function logout(){
			if ($this->session->userdata('login')) {
				$this->session->unset_userdata('login');
			}
			/*if (get_cookie('remember')) {
				delete_cookie('remember');
			}*/
			redirect(base_url());
		}
	}
?>
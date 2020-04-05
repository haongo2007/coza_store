<?php 
		class Order extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('order_model');
		}
		// danh sach giao dich
		public function index(){
			$this->load->model('product_model');
			$this->load->model('transaction_model');
			// lay ra tong so gd trong web
			$total_rows = $this->order_model->get_total();
			$this->data['total_rows'] = $total_rows;
// PHAN TRANG
			// load thu vien phan trang//
			$this->load->library('pagination');
			// cau hinh phan trang
			$config = array();
			$config['total_rows'] = $total_rows;// tong tat ca san pham trong web
			$config['base_url']	  = admin_url('order/index'); // link hien thi ra
			$config['per_page']	  = 4; // so luong sp hien thi 1 trang
			$config['uri_segment']= 4; // phan doan thu 4 tren url
			$config['next_link']  = 'Trang kế';
			$config['prev_link']  = 'Trang trước';
			/// khoi tao phan trang
			$this->pagination->initialize($config);

			$segment = $this->uri->segment(4);
			$segment = intval($segment);
			$input = array();
			$input['limit'] = array($config['per_page'],$segment); 
// PHAN LOC
			// kiem tra co thuc hien loc sp hay khong

			$id = $this->input->get('id');			
			$id = intval($id);
			$input['where'] = array();
			if ($id > 0) {
				$input['where']['id'] = $id;
			}

			// lay danh sach sp
			$list = $this->order_model->get_list($input);
			$this->data['list'] = $list;

			//lay noi dung message
			$message = $this->session->flashdata('message');
			$this->data['message'] = $message;

			// load view
			$this->data['temp'] = 'admin/order/index';
			$this->load->view('admin/main',$this->data);
		}

		public function delete(){
			$id = $this->uri->rsegment('3');
			$this->_del($id);
			$this->session->set_flashdata('message','Xóa thành công');
			redirect(admin_url('order'));
		}

		public function delete_all(){
			$ids = $this->input->post('ids');
			foreach ($ids as $id) {
				$this->_del($id);
			}
		}

		private function _del($id){
			$order = $this->order_model->get_info($id);

			if (!$order) {
				$this->session->set_flashdata('message','Giao dịch không tồn tại');
				redirect(admin_url('order'));
			}
			
			$this->order_model->delete($id);

		}

		public function get_info(){
			$output = array();
			$id = $this->input->post('id');

			$info = $this->order_model->get_info($id);
				
				
			

				/// transaction
				$this->load->model('transaction_model');

				$info_transaction = $this->transaction_model->get_info($info->transaction_id);

				$output['amount']  = number_format($info_transaction->amount);
				$output['created'] = get_date($info_transaction->created);
				$output['payment'] = $info_transaction->payment;
				
				if ($info_transaction->status == 0) {
					$info_transaction->status = "<b class='blue'>Chờ Xử Lý</b>";
				}elseif ($info_transaction->status == 1) {
					$info_transaction->status = "<b class='green'>Đã Thanh Toán</b>";
				}else{
					$info_transaction->status = "<b class='red'>Hủy Giao Dịch<b>";
				}
				$output['status'] = $info_transaction->status;

				/// user
				$output['user_name'] = $info_transaction->user_name;
				$output['user_email'] = $info_transaction->user_email;
				$output['user_phone'] = $info_transaction->user_phone;
				$output['message'] = $info_transaction->message;

				/// product
				$input['where'] = array('transaction_id' =>  $info->transaction_id);
				$list_transaction = $this->order_model->get_list($input);
				foreach ($list_transaction as $key) {
					$output['transaction_id']	= $key->transaction_id;
				}
				$this->load->model('product_model');
				
				$info_product = $this->product_model->get_info($info->product_id);
				$output['product_name'] = $info_product->name;
				$output['qty']	= $info->qty;z
				$output['price']= number_format($info_product->price);
				$output['image']= public_url('upload/product/').$info_product->image_link;

				
					if ($info->status == 0) {
						$info->status = "<b class='blue'>Chờ Xử Lý</b>";
					}elseif ($info->status == 1) {
						$info->status = "<b class='green'>Đã Gửi Hàng</b>";
					}else{
						$info->status = "<b class='red'>Thất Bại<b>";
					}
				
				$output['status_order'] = $info->status;
				
				$result = json_encode($output);
			echo $result;
			exit();
		}

		public function update(){
			$cancel = $this->uri->rsegment('4');
			if (!$cancel) {
				$id = $this->uri->rsegment('3');
				$where = array('transaction_id'=> $id);
				$data = array('status' => 1);			
				$this->order_model->update_rule($where,$data);
				redirect(admin_url('order'));
			}else{
				$id = $this->uri->rsegment('4');
				$where = array('transaction_id'=> $id);
				$data = array('status' => 2);			
				$this->order_model->update_rule($where,$data);
				redirect(admin_url('order'));
			}
					
		}

	}


?>
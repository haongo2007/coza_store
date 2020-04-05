<?php 
	/**
	* 
	*/
	class Cart extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('product_model');
			$this->load->model('atribute_model');
		}
		/// them sp vao gio hang

		
		function add(){
			$id = $this->input->post('id');
			$product = $this->product_model->get_info($id);
			if (!$product) {
				exit();
			}
			$where = array('id_product' => $id);
            $attr = $this->atribute_model->get_info_rule($where);
			$price = $product->price;
			$title_pr = $product->title;
			$color = $this->input->post('color');
			$color_ar = array_filter(explode('|', $attr->name));
			$posi = array_search($color,$color_ar);
			
           	$img = array_filter (explode('|', $attr->image_list));
           	$img = json_decode($img[$posi]);
			if ($product->discount > 0) {
				$price = $product->price - $product->discount;
			}
			$data = array();
			$cart = $this->cart->contents();
			$size = $this->input->post('size');
			$data['options'] = array('color' => array($color), 'size' => array($size), 'posi' => array($this->input->post('posi')));
			$data['id'] = $product->id;
			$data['qty'] = $this->input->post('qty');
			$data['name'] = url_title($product->name);
			$data['title'] = $title_pr;
			$data['image_link'] = base_url($attr->path.get_unit($attr->unit)['smallest'].'/'.$title_pr.'/'.$color.'/'.$img[0]);
			$data['price'] = $price;
			$this->cart->insert($data);
			if ($this->input->post('redi')) {
				$this->session->set_flashdata('notify',$this->lang->line('add-cart'));
				redirect(base_url('home'));
			}else{
				$res['val']	   = $this->cart->contents();
 				$res['totals'] = $this->cart->total_items();
				echo json_encode($res);
			}
		}

		function del(){
			if ($this->input->post('id')) {
				$id = $this->input->post('id');
				intval($id);
			// xoa 1 sp
				$cart = $this->cart->contents();
				foreach ($cart as $key => $row) {
					if ($row['rowid'] == $id ) {

						$data['rowid'] = $key;
						$data['qty'] = $row['qty']-1;
						$this->cart->update($data);

						$res['val'] = $this->cart->contents();
						$res['totals'] = $this->cart->total_items();
						echo json_encode($res);
					}		
				}
			}
		}

		function clear(){
			// xoa toan bo
			if ($this->input->post('data') == 'clear' ) {
				$this->cart->destroy();
				$res['val'] = $this->ajax_cart();
				$res['totals'] = $this->cart->total_items();
				echo json_encode($res);
			}
		}

		function index(){
			// view cart
			$cart = $this->cart->contents();
			$total_items = $this->cart->total_items();
			$this->data['cart'] = $cart;
			$this->data['total_items'] = $total_items;

			// shipping fee
			$this->load->model('shippingfee_model'); 
			$this->data['citi'] = $this->shippingfee_model->get_list();

			// payment
			$this->load->model('payment_model');
			$input['where'] = array('status' => 1);
			$this->data['payment'] = $this->payment_model->get_list($input);

			// user
			$this->data['user'] = $this->session->userdata('user_data');

			$this->load->library('form_validation');
			$this->load->helper('form');
			/* check out */

			if ($this->input->post()) {
				$this->form_validation->set_rules('postcode','postcode','required|min_length[5]');
				$this->form_validation->set_rules('name','Name','required|min_length[3]');
				$this->form_validation->set_rules('email','email address','required|valid_email');
				$this->form_validation->set_rules('phone','number phone','required');
				$this->form_validation->set_rules('address','address','required');
				if ($this->session->userdata('user_data')['id']) {
					$user_id = $this->session->userdata('user_data')['id'];
				}else{
					$user_id = 0;
				}
				if ($this->form_validation->run()) {
					// paypal
					if ($this->input->post('payment') == 0) {
						include APPPATH . 'third_party/simple_html_dom.php';
						$url = "https://vi.coinmill.com/USD_VND.html?VND=".$this->input->post('totalmount')."#VND";
				        $html = file_get_html($url);
				        $usd = $html->find("#currencyBox1 .currencyField")[0]->value;
				        
						$data 		 = array(
						'status'	 => 0,// trang thaai chua thanh toan
						'user_id'	 => $user_id,// id thanh vien neu da dang nhap
						'postcode'	 => $this->input->post('postcode'),
						'citi' 		 => $this->input->post('citi'),
						'user_email' => $this->input->post('email'),
						'user_name'	 => $this->input->post('name'),
						'user_phone' => $this->input->post('phone'),
						'user_address'=> $this->input->post('address'),
						'note'		 => $this->input->post('note'),
						'amount'	 => $this->input->post('totalmount'),// tong don hang
						'usd'		 => $usd,
						'payment'	 => 'Normal',// con  thanh toan
						);
						// them du lieu vao bang tss
						$this->load->model('transaction_model');
						$this->transaction_model->create($data);

						$transaction_id = $this->db->insert_id();
						// them du lieu vao bang order
						$this->load->model('order_model');

						foreach ($cart as $row) {
							$json = json_encode($row['options']);
							$data = array(
							'transaction_id' => $transaction_id,
							'product_id'	 => $row['id'],
							'qty'			 => $row['qty'],
							'amount'		 => $row['subtotal'],
							'data'			 => $json,
							'status'		 => '0',
							);
							$this->order_model->create($data);
						}
						/* real-time use pusher*/
						/*$this->load->view('vendor/autoload.php');
				        $options = array(
				            'cluster' => 'ap1',
				            'useTLS' => true
				        );
				        $pusher = new Pusher\Pusher(
				            '101d71ba1f48fc65f0f8',
				            '8113aca0a3241eecbdaa',
				            '814743',
				            $options
				        );
				        $where['where'] = array('status'=> 0);
				        $count_items = $this->transaction_model->get_total($where);
				        $data_tran 		 = array(
				        	'count'		=> $count_items,
				        	'id' 		=> $transaction_id,
							'status'	 => '<strong class="text-yellow">Chưa Thanh Toán</strong>',
							'user_email' => $this->input->post('email'),
							'user_name'	 => $this->input->post('name'),
							'user_phone' => $this->input->post('phone'),
							'user_address'=> $this->input->post('citi').'/'.$this->input->post('address'),
							'amount'	 => number_format($this->input->post('totalmount')).'.đ',// tong don hang
							'ptt'	 	=> 'Truyền Thống',// con  thanh toan
							'created'	 => get_date(now()),
							'get_order'  => '<button type="button" data-id="'.$transaction_id.'" class="get_order btn btn-default" data-toggle="modal" data-target="#modal-default" data-url="'.base_url('admin/transaction/get_order').'"><i class="fa fa-eye"></i></button>',
							'update_tran' => '<a href="'.base_url('admin/transaction/update/89/transact').'"><button type="button" class="btn btn-success"><i class="fa fa-money"></i></button></a>',
							'destroy_tran' => '<a href="'.base_url('admin/transaction/update/89/transact/destroy').'"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>'
						);
				        $pusher->trigger('send_cart', 'my-event', $data_tran);*/
						// xoa all cart
						$this->cart->destroy();
						$this->session->set_flashdata('notify_success',$this->lang->line('pay-success'));
						redirect(base_url());
					}else{
						// paypal payment
						$id_payment = $this->input->post('payment');
						$payment = $this->payment_model->get_info($id_payment);
						$data 		 = array(
							'status'	 => 1,// trang thaai chua thanh toan
							'user_id'	 => $user_id,// id thanh vien neu da dang nhap
							'postcode'	 => $this->input->post('postcode'),
							'citi' 		 => $this->input->post('citi'),
							'amount' 	 => $this->input->post('totalmount'),
							'user_email' => $this->input->post('email'),
							'user_name'	 => $this->input->post('name'),
							'user_phone' => $this->input->post('phone'),
							'user_address'=> $this->input->post('address'),
							'note'		 => $this->input->post('note'),
							'payment'	 => $payment->name,// con  thanh toan
						);
						$this->session->set_userdata('transaction', $data);
						$this->session->set_userdata('data_payment',json_decode($payment->data));
				        redirect(base_url('express_checkout'));
					}
					
				}
			}
			$this->data['page_title'] = 'Cart'.' | '.site_name();
	        $this->data['template'] = 'theme/'.$this->site.'/cart/index';
	        $this->load->view('theme/'.$this->site.'/layout',$this->data);
		}
		public function change_size(){	
			$id = $this->input->post('id');
			$attr =	$this->atribute_model->get_info($id);
			$color = explode('|',$attr->name);
			$key_color = array_search($this->input->post('data'), $color);
			$size = explode('|', $attr->size);
			echo json_encode( array('size' => $size[$key_color]));
			exit();
		}
		public function update(){
			$cart = $this->cart->contents();
			foreach ($cart as $key => $row) {
				// tong sl san pham
				if ($this->input->post('qty_'.$row['id']) < 0) {
					$total_qty == 0;	
						$id = $row['id'];
						if ($row['id'] = $id) {
							$data = array();
							$data['rowid'] = $key;
							$data['qty'] = 0;
							$this->cart->update($data);					
					}
				}else{
					$total_qty = $this->input->post('qty_'.$row['id']);
				}
				$data = array();
				$title_pr = $row['title'];
				$where = array('id_product' => $row['id']);
           		$attr = $this->atribute_model->get_info_rule($where);
           		$img = array_filter (explode('|', $attr->image_list));

				$color = $this->input->post('color_'.$row['id']);
				$posi = $this->input->post('posi_'.$row['id']);
           		$img = json_decode($img[$posi]);
				$data['image_link'] = base_url($attr->path.get_unit($attr->unit)['smallest'].'/'.$title_pr.'/'.$color.'/'.$img[0]);
				$data['rowid'] = $key;
				$data['qty'] = $total_qty;
				$data['options'] = array('color' => array($color), 'size' => array($this->input->post('size_'.$row['id'])), 'posi' => array($posi) );
				$this->cart->update($data);
			}
			redirect(base_url('cart'));
		}
	}
?>
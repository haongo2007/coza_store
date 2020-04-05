<?php 
	class Transaction extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('transaction_model');
			$this->load->model('order_model');
		}
		// danh sach giao dich
		public function index(){
			if ($this->input->post()) {
				$totalData = $this->transaction_model->get_total();
	           	$start = $this->input->post('start');
	           	$limit = $this->input->post('length');
	           	if ($this->input->post('search')["value"]) {
	           		$search = $this->input->post('search')["value"];
	           		$input['like'] = array('user_name' , $search);
	           		$input['or_like'] = array('user_email' , $search);
	           	}
	           	if($this->input->post("order")){
	           		$dir = $this->input->post('order')['0']['dir'];
	                $input['order'] = array('id',$dir);
	           	}
	           	else{  
	                $input['order'] = array('status','ASC'); 
	           	}        	
	           	$recordsFiltered = $this->transaction_model->get_total($input);
	           	$input['limit'] = array($limit,$start);
	           	$table = $this->transaction_model->get_list($input);
			    if (count($table) > 0) {	    	
				    foreach ($table as $row) 
				    {
				        $tab = array();
				        if($row->status == 0){
							$status = '<span class="badge badge-dot mr-4"><i class="bg-warning"></i> Chưa Thanh Toán</span>';
							$pay = '<a class="dropdown-item" href="'.admin_url('transaction/update/'.$row->id.'/transact').'">Đã Thanh Toán</a>';
							$canel = '<a class="dropdown-item" href="'.admin_url('transaction/update/'.$row->id.'/transact/destroy').'">Hủy</a>';
						}elseif($row->status == 1){
							$status = '<span class="badge badge-dot mr-4"><i class="bg-success"></i> Đã Thanh Toán</span>';
							$pay = '';
							$canel = '';
						}else{
							$status = '<span class="badge badge-dot mr-4"><i class="bg-danger"></i> Đã Hủy</span>';
							$pay = '';
							$canel = '';
						}
						$action = 	'<td class="text-right">
				                      <div class="dropdown">
				                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                          <i class="fas fa-ellipsis-v"></i>
				                        </a>
				                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
				                          <a class="dropdown-item get_order" data-id="'.$row->id.'" href="#" data-url="'.admin_url('transaction/get_order').'">Xem</a>
				                          '.$canel.$pay.'
				                        </div>
				                      </div>
				                    </td>';
				        $tab["status"] 		= $status;
				        $tab['ptt']    		= $row->payment;
				        $tab["user_name"]	= $row->user_name;
				        $tab["tongtien"] 	= number_format($row->amount).'.vnđ';
				        $tab["thoigian"] 	= format_date($row->created);
				        $tab["hanhdong"] 	= $action;
				        $r_tab[] = $tab; 
				    }        
			    }else{
			    	$tab = array();
			        $tab["status"] 		= '';
			        $tab['ptt']    		= '';
			        $tab["user_name"]	= '';
			        $tab["tongtien"] 	= '';
			        $tab["thoigian"] 	= '';
			        $tab["hanhdong"] 	= '';
			        $r_tab[] = $tab; 
			    }
			    $output = array(
			    	"draw"			=> intval($this->input->post('draw')),
			    	"recordsTotal"	=> intval($totalData),
			    	"recordsFiltered" => intval($recordsFiltered),
			        "data" =>  $r_tab
			    );

			    echo json_encode($output);
			}else{	
				// load view
				$this->data['template'] = 'admin/transaction/index';
				$this->load->view('admin/main',$this->data);
			}
		}
		public function update(){
			$id = $this->uri->rsegment(3);
			
			$data 	= array('status' => 1);
			if ($this->uri->rsegment(4) == 'destroy') {
				$data 	= array('status' => 2);
			}
			$where = array('transaction_id' => $id);
			$this->order_model->update_rule($where,$data);
			
			if ($this->uri->rsegment(4) == 'transact') {
				$where = array('id' => $id);
				if ($this->uri->rsegment(5) == 'destroy') {
					$data 	= array('status'	 => 2);
				}
				$this->transaction_model->update_rule($where,$data);
			}
			$this->session->set_flashdata('notify_success','Cập Nhật Giao Dịch Thành Công');
			redirect(admin_url('transaction'));
		}
		public function get_order(){
			$id = $this->input->post('or');
			$this->load->model('product_model');
			$this->load->model('atribute_model');

			$input['where'] = array('transaction_id' => $id);
			$order = $this->order_model->get_list($input);
			foreach ($order as $key) {
				$where = array('id' => $key->product_id);
				$field_pr = array('name','title');
				$product = $this->product_model->get_info_rule($where,$field_pr);
				$where = array('id_product' => $key->product_id);
				$field_att = array('image_list','path','unit');
				$attr = $this->atribute_model->get_info_rule($where,$field_att);
				$option = json_decode($key->data);
				$img = explode('|', $attr->image_list);
				$img = json_decode($img[$option->posi[0]]);
				$color_name = $option->color[0];
				$path = base_url().$attr->path.get_unit($unit = $attr->unit )['bigest'].'/'.$product->title.'/'.$color_name.'/'.$img[0];

				$key->path = $path;
				$key->color_name = $color_name;
				$key->product_name = $product->name;
				$key->option = $option;
			}
			$trans = $this->transaction_model->get_info($id);

			$this->data['trans'] = $trans;
			$this->data['order'] = $order;
			$this->load->view('admin/ajax/order_info',$this->data);
		}

		
	}
?>
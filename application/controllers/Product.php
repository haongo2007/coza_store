<?php 
	/**
	* 
	*/
	class Product extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('atribute_model');
		}

		function categories(){
			/* CATEGORIES */
/*=======================================================================================================================================*/
				$id = intval($this->uri->rsegment(3));
	
				$where = array('id' => $id);
				$this->data['name'] = $this->category_model->get_info_rule($where,'name');
				$input['where'] = array('catalog_id' => $id);
            	$prod_cat = $this->product_model->get_list($input);
				$this->data['list'] = $prod_cat;

				$this->data['temp'] = 'site/category/categories';
				$this->load->view('site/layout',$this->data);
				
		}

		function categories_parent(){
			/* CATEGORIES parent */
/*=======================================================================================================================================*/
				$id = intval($this->uri->rsegment(3));

				$output['where'] = array('id'=>$id);
				$output['limit'] = array('9','0');
				$this->data['list']  = $this->category_model->get_list($output);

				$this->data['temp'] = 'site/category/categories_parent';
				$this->load->view('site/layout',$this->data);
				
		}

		function brand(){
			/* CATEGORIES parent */
/*=======================================================================================================================================*/
				$id = intval($this->uri->rsegment(3));

				$where = array('id' => $id);
				$this->data['name'] = $this->brand_model->get_info_rule($where,'name');

				$output['where'] = array('brand_id'=>$id);
				$this->data['list']  = $this->product_model->get_list($output);
				
				$this->data['temp'] = 'site/category/brand';
				$this->load->view('site/layout',$this->data);
				
		}

		function qickview(){
			$id = $this->input->post('id');
			$result = array();
			$item =	$this->product_model->get_info($id);
	
			$result['name'] = $item->name;
			$result['view'] = $item->view;
			$result['infomation'] = $item->infomation;
			$result['in_stock'] = $item->in_stock;
			$result['link_add'] = base_url('cart/add/'.$item->id.'/1');
			$price = $item->price - $item->discount;
			if ($item->discount > 0) {
				$result['price'] = number_format($price);
				$result['price_old'] = number_format($item->price);
			}else{
				$result['price'] = number_format($item->price);
			}
			

			$result['img'] = public_url('upload/product/'.$item->image_link);
			$result['image_list'] = $item->image_list;
			die(json_encode($result));
			
		}

		function compare(){
			$id = $this->input->post('id');
			$item =	$this->product_model->get_info($id);
			$result['name'] = $item->name;
			$price_new = $item->price - $item->discount;
			$result['price'] = number_format($price_new).'.đ';
			$result['gifts'] = $item->gifts;
			$result['warranty'] = $item->warranty;
			$result['infomation'] = $item->infomation;
			$result['img'] = public_url('upload/product/'.$item->image_link);
			die(json_encode($result));
		}

		// xem chi tiet sp
		function view(){
			// lay id 
			$id = $this->uri->rsegment(3);
			$product = $this->product_model->get_info($id);
			if (!$product) {
				redirect();
			}
			/// lưu sản phẩm user vừa xem vào session
			$recentlyViewed = $this->session->userdata('recentlyViewed');
		    if(!is_array($recentlyViewed)){
		        $recentlyViewed = array();  
		    }
		    //change this to 10
		    if(sizeof($recentlyViewed)>3){
		        array_shift($recentlyViewed);
		    }
		    //here set your id or page or whatever
		    if(!in_array($product->id,$recentlyViewed)){
		        array_push($recentlyViewed,$product->id);
		    }
		    $this->session->set_userdata('recentlyViewed', $recentlyViewed);    
    		$recentlyViewed = array_reverse($recentlyViewed);

			// lay raty
			$product->raty = ($product->rate_count > 0) ? $product->rate_total/$product->rate_count : 0;
			$where = array('id_product' => $product->id);
            $attr = $this->atribute_model->get_info_rule($where);
            $this->data['attr'] = $attr;
			$this->data['product'] = $product;
			
			// lay danh sach sp
			$category = $this->category_model->get_info($product->catalog_id);
			$this->data['category'] = $category;
			// cap nhat view product
			$data['view'] = $product->view + 1;
			$this->product_model->update($product->id,$data);
			// su dung layout master load ra view
			// lay cac sp lien quan
			$input	= array();
			$input['where'] = array('catalog_id' => $product->catalog_id);
			$input['limit'] = array('8','1');
			$input['order'] = array('id','DESC');
			$list_rela = $this->product_model->get_list($input);
				foreach ($list_rela as $val) {                   
                    $where_attr = array('id_product' => $val->id);
                    $attr = $this->atribute_model->get_info_rule($where_attr);
                    $val->attr = $attr;
                }
			$this->data['list_rela'] = $list_rela;
			
			/* SEO */
			$this->data['page_title'] = trim($product->site_title).' | '.site_name();
			$this->data['meta_desc']  = $product->meta_desc;
	
	       	$this->data['template'] = 'theme/'.$this->site.'/product/detail';
	       	$this->load->view('theme/'.$this->site.'/layout',$this->data);
		}

		function raty(){
			
			$id = $this->input->post('id');
			$id = (!is_numeric($id)) ? 0 : $id;
			$info = $this->product_model->get_info($id);
			if (!$info) {
				exit();
			}
			
			$raty   = $this->session->userdata('session_raty');
			$raty   = (!is_array($raty)) ? array() : $raty;
			$result = array();
			if (isset($raty[$id])) {
				$result['mess'] = 'Bạn Chỉ Được Đánh Giá Một Lần Cho Sản Phẩm Này';
				$output			= json_encode($result);
				echo $output;
				exit();
			}
			// neu chua rate sp nay thi cap nhat data
			$raty[$id]	= TRUE;
			$this->session->set_userdata('session_raty',$raty);
			$score = $this->input->post('score');
			$data = array();
			$data['rate_total']	= $info->rate_total + $score; // tong so sao
			$data['rate_count']	= $info->rate_count + 1;// tong luot danh gia
			/// update rate db
			$this->product_model->update($id,$data);

			$result['complete'] = TRUE;
			$result['mess']		= ' Cảm Ơn Bạn Đã Đánh Giá';
			$output 	 	 	= json_encode($result);
			echo $output;
			exit();
		}
		public function wishlist()
		{
			$id = $this->input->post('id');
			$product =	$this->product_model->get_info($id);
			if (!$product) {
				echo '0';
			}
			/// lưu sản phẩm user vừa xem vào session
			$wishlist = $this->session->userdata('wishlist');
		    if(!is_array($wishlist)){
		        $wishlist = array();  
		    }
		    //change this to 10
		    if(sizeof($wishlist)>3){
		        array_shift($wishlist);
		    }
		    //here set your id or page or whatever
		    if(!in_array($product->id,$wishlist)){
		        array_push($wishlist,$product->id);
		    }else{
				$ar_s = array_search($id, $wishlist);
				unset($wishlist[$ar_s]);
		    }
		    $this->session->set_userdata('wishlist', $wishlist);
    		if ($this->input->post('callback')) {
    			echo intval(count($wishlist)) ;
    		}else{
	    		$this->data['wishlist'] = array_reverse($wishlist);
	    		$this->data['count'] = count($wishlist);
    			if ($this->input->post('mb') == 'ok') {
	    			$this->load->view('site/ajax/product_wishlist_mb',$this->data);	
	    		}else{
	    			$this->load->view('site/ajax/product_wishlist',$this->data);
	    		}
    		}
    		
		}
		public function get_img()
		{
			$id = $this->input->post('id');
			$attr =	$this->atribute_model->get_info($id);
			if (!$attr) {
				echo '1';
			}
			$this->data['attr'] = $attr;
			$this->data['name'] = $this->input->post('name');
			$this->data['pos'] = $this->input->post('pos');
			$this->load->view('site/ajax/product_image',$this->data);
		}
	}
?>
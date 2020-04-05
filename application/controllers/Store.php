<?php 
	/**
	* 
	*/
	class Store extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('catalog_model');
			$this->load->model('menu_model');
		}

		function index(){
			$params = '';
			$input = array();

			/*									SHOW									*/
			$output['where'] = array('parent_id' => 0);
			$Consumers = $this->catalog_model->get_list($output);
			foreach ($Consumers as $key) {
				$output['where'] = array('type_id' => $key->id);
				$key->count_pro = $this->product_model->get_total($output);
			}
			$this->data['Consumers'] = $Consumers;


			$getput['where'] = array('parent_id >' => 0);
			$categories = $this->catalog_model->get_list($getput);
			foreach ($categories as $key) {
				$getput['where'] = array('catalog_id' => $key->id);
				$key->count_pro = $this->product_model->get_total($getput);
			}
			$this->data['categories'] = $categories;

			$brand = $this->brand_model->get_list();
			foreach ($brand as $key) {
				$gotput['where'] = array('brand_id' => $key->id);
				$key->count_pro = $this->product_model->get_total($gotput);
			}
			$this->data['brand'] = $brand;

			/*									GET										*/

////////////////////////////////////////////////////////////// TYPE PRO ////////////////////////////////////////////////////////////
			if ($this->input->get('consumers')) {
				$id = $this->input->get('consumers');
				$input['where'] = array('type_id' => $id);
				$params = '?consumers='.$id;
			}

////////////////////////////////////////////////////////////// CATE PRO ////////////////////////////////////////////////////////////
			if ($this->input->get('categories')) {
				$id = $this->input->get('categories');
				$input['where'] = array('catalog_id' => $id);
				$params = '?categories='.$id;
			}

////////////////////////////////////////////////////////////// BRAND PRO ////////////////////////////////////////////////////////////
			if ($this->input->get('brand')) {
				$id = $this->input->get('brand');
				$input['where'] = array('type_id' => $this->input->get('consumers'), 'catalog_id' => $this->input->get('categories'), 'brand_id' => $id);
				$params = '?brand='.$id;
			}

			if ($this->input->get('brands')) {
				$id = $this->input->get('brands');
				$input['where'] = array('brand_id' => $id);
				$params = '?brands='.$id;
			}

////////////////////////////////////////////////////////////// HOT DEAL ////////////////////////////////////////////////////////////
			if ($this->input->get('hotdeal')) {
				$id = $this->input->get('hotdeal');
				$info_sale = $this->hotdeal_model->get_info($id);
				$this->data['page_title'] = $info_sale->name.' | '.site_name();
				$this->data['meta_desc'] = $info_sale->meta_desc.' | '.site_name();
				$input['where'] = array('hotdeal' => $id);
				$params = '?hotdeal='.$id;
			}

////////////////////////////////////////////////////////////// SORTING ///////////////////////////////////////////////////////////////
			if ($this->input->get('sort')) {
				$sort = intval($this->input->get('sort'));
				switch ($sort) {
					case 1:
						$input['order'] = array('price','DESC');
$params = '?consumers='.$this->input->get('consumers').'&categories='.$this->input->get('categories').'&brand='.$this->input->get('brand').'&sort='.$sort;
						break;
					
					case 2:
						$input['order'] = array('price','ASC');
$params = '?consumers='.$this->input->get('consumers').'&categories='.$this->input->get('categories').'&brand='.$this->input->get('brand').'&sort='.$sort;
						break;

					case 3:
						$input['order'] = array('id','DESC');
$params = '?consumers='.$this->input->get('consumers').'&categories='.$this->input->get('categories').'&brand='.$this->input->get('brand').'&sort='.$sort;
						break;
					case 4:
						$input['order'] = array('buyed','DESC');
$params = '?consumers='.$this->input->get('consumers').'&categories='.$this->input->get('categories').'&brand='.$this->input->get('brand').'&sort='.$sort;
						break;
				}
			}
////////////////////////////////////////////////////////////// searching ///////////////////////////////////////////////////////////////
			/// autocomplete
			if ($this->input->get('term')) {
				$key = $this->input->get('term');
				$input['limit'] = array(5,0);
				$input['like'] = array('name',$key);
				$list = $this->product_model->get_list($input);
				$result = array();
				foreach ($list as $row) {
					$item = array();		
					$item['desc'] = number_format($row->price);
					$item['label'] = trim($row->name);
					$result[] = $item;
				}
				// data dang json				
				die(json_encode($result));
			}
			/// run search
			if ($this->input->get('q')) {
				$key = $this->input->get('q');
				$input['like'] = array('name',$key);
				$params = '?q='.$key;
				$this->data['key'] = $key;
			}			

////////////////////////////////////////////////////////////// range slide price ///////////////////////////////////////////////////////////////
			if ($this->input->get('max')) {
				$min = intval($this->input->get('min'));
				$max = intval($this->input->get('max'));
				$input['where'] = array('price >=' => $min, 'price <=' => $max);
				$params = '?min='.$min.'&max='.$max;
				$this->data['min'] = $min;
				$this->data['max'] = $max;
			}

////////////////////////////////////////////////////////////// create pagination ////////////////////////////////////////////////////////////
			if (!isset($total)) {
				$total = $this->product_model->get_total($input);
			}
			$total_rows = $total;
			$link = base_url('store/index');
			$per_page = 12;
			$uri = 2;
			$this->load->library('paginate_library');
			$this->paginate_library->paginat($total_rows,$link,$params,$per_page,$uri);
			
			$id = $this->input->get('p');
			if (!$id) {
				$id = 0;
			}
			$input['limit'] = array($per_page,$id);

////////////////////////////////////////////////////////////// LAY PRODUCT ALL ////////////////////////////////////////////////////////////
			$this->load->model('atribute_model');
			$product = $this->product_model->get_list($input);
			foreach ($product as $key) {
				$where = array('id_product' => $key->id);
                $attr = $this->atribute_model->get_info_rule($where);
                $key->attr = $attr;
			}
			$this->data['product'] = $product;
			$this->data['count'] = $total;
//////////////////////////////////////////////////// LAY giá sản phẩm cao nhất thiết lập range ////////////////////////////////////////////////////////////

			$this->data['max_price'] = $this->product_model->get_max_value('price','max');

////////////////////////////////////////////////////////////// SEO TITLE PAGE ////////////////////////////////////////////////////////////
			if ($this->input->get('consumers')) {
				$id = $this->input->get('consumers');
				$info_cons = $this->catalog_model->get_info($id);
				$this->data['page_title'] = $info_cons->name.' | '.site_name();
			}elseif ($this->input->get('categories')) {
				$id = $this->input->get('categories');
				$info_cate = $this->catalog_model->get_info($id);
				$this->data['page_title'] = $info_cate->name.' | '.site_name();
			}
			elseif ($this->input->get('brands')) {
				$id = $this->input->get('brands');
				$info_bran = $this->brand_model->get_info($id);
				$this->data['page_title'] = $info_bran->name.' | '.site_name();
			}
			else{
				$this->data['page_title'] = 'Store'.' | '.site_name();
			}

////////////////////////////////////////////////////////////// SEND VIEW ////////////////////////////////////////////////////////////
			
			$this->data['temp'] = 'site/store/index';
			$this->load->view('site/layout',$this->data);

		}

		function filter(){
			if ($this->input->post('cons')) {
				$cons = $this->input->post('cons');
				$input['where'] = array('parent_id' => $cons);
				$data = $this->catalog_model->get_list($input);
				echo json_encode($data);
			}
			if ($this->input->post('rem')) {
				$input['where'] = array('parent_id >' => 0);
				$data = $this->catalog_model->get_list($input);
				echo json_encode($data);
			}
		}
	}
?>
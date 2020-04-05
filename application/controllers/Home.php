<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('atribute_model');
		$this->load->model('product_model');
	}
	public function index()
	{
		$this->load->model('slide_model');
		$this->load->model('category_model');
		
		$input['where'] = array('parent_id' => 0);
		$this->data['category'] = $this->category_model->get_list($input);
		$this->data['slide'] = $this->slide_model->get_list();
		$input_pr['order'] = array('id','desc');
		$input_pr['limit'] = array('4' ,'0');
		$product = $this->product_model->get_list($input_pr);
		foreach ($product as $key) {
			$que = array('id_product' => $key->id);
			$attr = $this->atribute_model->get_info_rule($que);
			$key->attr = $attr;
		}
		$this->data['product'] = $product;
		$this->data['categories'] = $this->category_model->get_list();
		$this->data['assets'] = $this->assets;
       	$this->data['template'] = 'theme/'.$this->site.'/home/index';
       	$this->load->view('theme/'.$this->site.'/layout',$this->data);
       	
	}
	public function load_more()
	{
		if ($this->input->post('st')) {
       		$conti = intval($this->input->post('st'));
       		$input_pr['limit'] = array('4' , $conti);
       		$product = $this->product_model->get_list($input_pr);
       		if (!$product) {
       			$er = array('state' => 'fail' , 'er' => 'abc');
       			echo json_encode($er);
       			exit();
       		}
       		foreach ($product as $key) {
				$que = array('id_product' => $key->id);
				$attr = $this->atribute_model->get_info_rule($que);
				$color = explode('|', $attr->name);
				$img = explode('|', $attr->image_list);
				$img = json_decode($img[0]);
				$path = $attr->path;
				$link = get_unit($attr->unit)['bigest'].'/'.$key->title.'/'.$color[0].'/'.$img[0];
				$key->path_img = get_path_product_image($path, $link);
				$key->price = get_price($key->price,$key->discount);
				$key->attb = $attr;
				$key->image_list_entity = htmlentities($attr->image_list);
				$key->sm_thumb = get_unit($attr->unit)['smallest'];
			}
			echo json_encode($product);
       	}
	}
}

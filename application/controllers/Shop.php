<?php
class Shop extends MY_Controller{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        $this->load->model('category_model');
        $this->load->model('product_model');
        $this->load->model('atribute_model');
        $arr_tags = array();
        $arr_fil_clr = array();
        $input['where'] = array('parent_id' => 0);
        $this->data['category'] = $this->category_model->get_list($input);
        $input_pr['order'] = array('id','desc');
        $input_pr['limit'] = array('4' ,'0');
        $product = $this->product_model->get_list($input_pr);
        foreach ($product as $key) {
            $que = array('id_product' => $key->id);
            $attr = $this->atribute_model->get_info_rule($que);
            $key->attr = $attr;

            /* tag to find */
            $tags = json_decode($key->meta_key);
            foreach ($tags as $tag) {
                $tag_find = explode(',', $tag);
                foreach ($tag_find as $value) {
                    array_push($arr_tags, $value);
                }
            }
            /* tag find */
            $tag_find = str_replace(' ', '-', $tags);
            $tag_find = implode(',', $tag_find);
            $tag_find = str_replace(',', ' ', $tag_find);
            $key->tag_find = strtolower($tag_find);

            $fil_color = explode('|', $attr->code);
            $color_name = explode('|', $attr->name);
            foreach ($fil_color as $key => $code) {
                $arr_fil_clr[$color_name[$key]] = $code;
            }
        }
        $arr_fil_clr = array_unique($arr_fil_clr);
        $arr_tags = array_unique($arr_tags);

        $this->data['arr_fil_clr'] = $arr_fil_clr;
        $this->data['arr_tags'] = $arr_tags;
        $this->data['product'] = $product;
        $this->data['categories'] = $this->category_model->get_list();
        $this->data['page_title'] = 'Shop'.' | '.site_name();
        $this->data['template'] = 'theme/'.$this->site.'/shop/index';
        $this->load->view('theme/'.$this->site.'/layout',$this->data);
    }
}
?>
<?php
class News extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }
    function index(){

     	$news_list = $this->news_model->get_list();

        // load view send data
       	$this->data['news_list'] = $news_list;
       	$this->data['temp'] = 'site/news/index';
       	$this->load->view('site/layout',$this->data);
    }
    function view(){
        $id = intval($this->uri->rsegment(3));
        $news_info = $this->news_model->get_info($id);

        // load view send data
        $this->data['news_info'] = $news_info;
        $this->data['temp'] = 'site/news/view';
        $this->load->view('site/layout',$this->data);
    }
}
?>
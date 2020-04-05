<?php 
	/**
	* 
	*/
	class Paginate_library 
	{
		var $CI = '';
		function __construct()
		{
			$this->CI = & get_instance();
		}

		function paginat($total,$link,$params,$per_page,$uri){
		/*PHAN TRANG*/
	/*=======================================================================================================================================*/
			// load thu vien phan trang//
			$this->CI->load->library('pagination');
			// cau hinh phan trang
			$config = array();
			$config['page_query_string'] = TRUE;
			$config['query_string_segment'] = 'p';
			$config['total_rows'] = $total;// tong tat ca san pham trong web
			$config['base_url']	  = $link.$params; // link hien thi ra
			$config['per_page']	  = $per_page; // so luong sp hien thi 1 trang		
			$config['uri_segment']= $uri; // phan doan thu 2 tren url

	        $config['first_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
	        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
	        $config['first_tag_close'] = '</li>';

	        $config['last_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
	        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
	        $config['last_tag_close'] = '</li>';

			$config['next_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
			$config['next_link']  = '<i class="fa fa-angle-right"></i>';
			$config['next_tag_close'] = '</li>';

			$config['prev_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
			$config['prev_link']  = '<i class="fa fa-angle-left"></i>';
			$config['prev_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li><a href="" class="item-pagination flex-c-m trans-0-4 active-pagination">';
			$config['cur_tag_close'] = '</a></li>';

			$config['num_tag_open'] = '<li class="item-pagination flex-c-m trans-0-4">';
			$config['num_tag_close'] = '</li>';
			/// khoi tao phan trang
			return $this->CI->pagination->initialize($config);
		}
	}
?>
<?php 
	function admin_url($url = '')
	{
		return base_url('admin/'.$url);
	}
	function split_attb($value='')
	{
		return trim(str_replace('|', '', $value));
	}
	function RandomString($length = 6) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	function fill_attb($value='')
	{
		return trim(str_replace('|', '', $value));
	}
	function is_dir_empty($dir) {
	  if (!is_readable($dir)) return NULL; 
	  return (count(scandir($dir)) == 2);
	}
	function fill_word($value='')
	{
		$unicode = array(
			'/transaction/' => 'Giao Dịch',
			'/product/' => 'Sản Phẩm',
			'/theme/' => 'Giao Diện',
			'/category/' => 'Danh Mục',
			'/slide/' => 'Hình Ảnh',
			'/info/' => 'Thông Tin',
			'/index/' => 'Danh Sách',
			'/admin/' => 'Quản Trị Viên',
			'/brand/' => 'Thương Hiệu',
			'/home/' => 'Trang Chủ',
	   	);
	    $str = preg_replace(array_keys($unicode),array_values($unicode), $value);	
	    return $str;
	}
	function breadcrumb()
	{
		$CI = & get_instance();
		return '<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
			        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
			          <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
			          <li class="breadcrumb-item"><a href="#">'.fill_word($CI->uri->rsegment(1)).'</a></li>
			          <li class="breadcrumb-item active" aria-current="page">'.fill_word($CI->uri->rsegment(2)).'</li>
			        </ol>
		  		</nav>';
	}
?>
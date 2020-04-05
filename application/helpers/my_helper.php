<?php 
	function public_url($url = '')
	{
		return base_url('public/'.$url);
	}
  function theme_url($name_theme = '')
  {
    return base_url('application/views/theme/'.$name_theme);
  }
	function pre($list,$exit = true){
		echo "<pre>";
		print_r($list);
		if ($exit) {
			die();
		}
	}
  function count_text($text){
    $str = mb_strlen($text, 'UTF-8');
    $text = str_replace('-', ' ', $text);
    if (strlen($text) > 20) {
      $text = substr($text,0, 20).'...';
    }
    return $text;
  }
	function time_count_down($timestamp)
	{
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
       		return "Vừa xong";  
		  }  
        else if($minutes <=60)  
        {  
	       	if($minutes==1)  
	        {  
	         	return "1 Phút trước";  
	       	}  
	       	else  
	        {  
	         	return "$minutes Phút trước";  
	       	}  
     	}  
        else if($hours <=24)  
        {  
	       	if($hours==1)  
	        {  
	         	return "1 Giờ trước";  
	       	}
	       	else  
	        {  
	         	return "$hours Giờ trước";  
	       	}  
	    }  
        else if($days <= 7)  
        {  
       		if($days==1)  
            {  
         		return "Hôm qua";  
       		}  
            else  
            {  
         		return "$days Ngày trước";  
       		}  
     	}  
        else if($weeks <= 4.3) //4.3 == 52/12  
        {  
       		if($weeks==1)  
            {  
         		return "1 Tuần trước";  
       		}  
            else  
            {  
         		return "$weeks Tuần trước";  
       		}  
     	}  
        else if($months <=12)  
        {  
       		if($months==1)  
            {  
         		return "1 Tháng trước";  
       		}  
            else  
            {  
         		return "$months Tháng trước";  
       		}  
     	}  
        else  
        {  
       		if($years==1)  
            {  
         		return "1 Năm trước";  
       		}  
            else  
            {  
         		return "$years Năm trước";  
       		}  
     	}  
	}
	function get_percentile($total, $disc) {										    
	    $index = ($total/100);
	    $result = $disc / $index;
	    return round($result).'%';
	}
	function site_name()
	{
	    $CI =& get_instance();
	    return $CI->config->item('site_name');
	}
  function format_date($date='')
  {
      $format = 'd-m-Y';
      $date = date_create($date);
      $date = date_format($date,$format);
      return $date;
  }
  function get_price($price,$discount){
      if ($discount > 0) {
        $new_price = $price - $discount;
        $new_price = number_format($new_price).'.vnđ'.'<br><del>'.number_format($price).'.vnđ</del>';
      }else{
        $new_price = number_format($price).'.vnđ';
      }
      return $new_price;
  }
  function get_date($time ,$fulltime = true)
  {
      date_default_timezone_set("Asia/Ho_Chi_Minh");
      $format = 'd-m-Y';
      if ($fulltime) {
        $format = $format/*.' - %H:%i:%s'*/;
      }
      $date = date($format,$time);
      return $date;
  }
  function get_path_product_image($path,$link)
  {
    return $path.$link;
  }
  function get_unit($unit='')
  {
    /* load setting */
    $setting = json_decode($unit);
    $hori = array();
    $vert = array();
    for ($i=0; $i <= count($setting) - 1 ; $i++) {
      $hr = explode('x', $setting[$i]);
      array_push($hori, $hr[0]);

      array_push($vert, $hr[1]);
    }
    $max_hori = max($hori);
    $id_max = array_keys($hori,$max_hori)[0];
    $max_vert = $vert[$id_max];
    $bigest_folder = $max_hori.'x'.$max_vert;
    

    $min_hori = min($hori);
    $id_min = array_keys($hori,$min_hori)[0];
    $min_vert = $vert[$id_min];
    $smallest_folder = $min_hori.'x'.$min_vert;
    return array('bigest' => $bigest_folder , 'smallest' => $smallest_folder);
  }
?>
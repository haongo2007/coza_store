<?php 
	/**
	* 
	*/
	class Theme extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('theme_model');
		}

		public function index(){
			$list = $this->theme_model->get_list();
			foreach ($list as $key) {
				$this->load->model('admin_model');
				$where = array('id' => $key->author);
				$inf_author = $this->admin_model->get_info_rule($where);
				$key->avt = $inf_author;
			}
			$this->data['list'] = $list;

			$this->data['template'] = 'admin/theme/index';
			$this->load->view('admin/main',$this->data);
		}
		public function upload(){
			$this->load->library('upload_library');
			$path = './application/views/theme';

	        if (isset($_FILES['file']['name'])) {
	            $upload_out = $this->upload_library->upload_theme($path);
	            if ($upload_out == 'done') {
	            	$name_theme = explode('.', $_FILES['file']['name']);
	            	$name = $name_theme[0];
	            	$input['where'] = array('status' => 1);
	            	if ($this->theme_model->get_total($input) < 1) {
	            		$state = 1;
	            	}else{
	            		$state = 0;
	            	}
	            	$version = $_POST['version'];
	            	$description = $_POST['descrip'];
	            	$screen = public_url('theme/'.$name.'/assets/screen.png');

	            	/* move assets folder */
	            	mkdir('./public/theme/'.$name.'/assets', 0777, TRUE);
	            	$dir = $path.'/'.$name.'/assets';
				    $dirNew = './public/theme/'.$name.'/assets';
				    // Open a known directory, and proceed to read its contents
				    if (is_dir($dir)) {
				        if ($dh = opendir($dir)) {
				            while (($file = readdir($dh)) !== false) {
					            //exclude unwanted 
					            if ($file=="move.php")continue;
					            if ($file==".") continue;
					            if ($file=="..")continue;
					            if ($file=="cgi-bin")continue;
					            rename($dir.'/'.$file,$dirNew.'/'.$file);
				            }
				            closedir($dh);
				        	rmdir($dir);
				        }
				    }else{
				    	$vl = array('ref' => 'Logo bắt buộc kiểu (jpeg hoặc png)','noty' => 'fail');
						echo json_encode($vl);
						exit();
				    }
	            	$data 		 = array(
						'name'	 	=> $name,
						'status'	=> $state,
						'screen'	=> $screen,
						'description' => $description,
						'author'	=> $this->session->userdata('admin_id'),
						'version'	=> $version,
						'created'	=> now()
					);
					if ($this->theme_model->create($data)) {
						$this->session->set_flashdata('notify_success','Upload Giao Diện Thành Công');
						$ref = admin_url('theme');
						$vl = array('ref' => $ref,'noty' => 'done');
						echo json_encode($vl);
						exit();
					}
	            }
	        }
		}
		public function active($id)
		{
			$where = array('status' => 1 );
			$data 		 = array(
				'status'	 => 0
			);
			$this->theme_model->update_rule($where,$data);
			$data['status'] = 1 ;
			$this->theme_model->update($id,$data);
			$this->session->set_flashdata('notify_success','Kích Hoạt Theme Thành Công');
			redirect(admin_url('theme'));
		}
		public function deactive($id)
		{
			$input['where'] = array('status' => 1);
			if ($this->theme_model->get_total($input) == 1 ) {
				$this->session->set_flashdata('notify_error','Không Thể Hủy Kích Hoạt Theme !');
				redirect(admin_url('theme'));
			}else{
				$data['status'] = 0 ;
				$this->theme_model->update($id,$data);
				$this->session->set_flashdata('notify_success','Hủy Kích Hoạt Theme Thành Công');
				redirect(admin_url('theme'));
			}
		}
		public function delete($id)
		{
			$info = $this->theme_model->get_info($id);
			if (!$info) {
				$this->session->set_flashdata('notify_error','Theme này không tồn tại !');
				redirect(admin_url('theme'));
			}
			if ($info->status == 1) {
				$this->session->set_flashdata('notify_error','Theme này Hiện Đang Được Kích Hoạt Không Thể xóa !');
				redirect(admin_url('theme'));
			}
			$input['where'] = array('status' => 0);
			if ($this->theme_model->get_total($input) >= 1 ) {
				$this->theme_model->delete($id);
				$dirPath_1 = './application/views/theme/'.$info->name;
				$dirPath_2 = './public/theme/'.$info->name;
				$this->deleteDir($dirPath_1,$dirPath_2);
				$this->session->set_flashdata('notify_success','Xóa Theme Thành Công');
				redirect(admin_url('theme'));
			}else{
				$this->session->set_flashdata('notify_error','Không Thể Xóa Theme Này !');
				redirect(admin_url('theme'));
			}
		}
		public function info()
		{
			$id = $this->input->post('id');
			$data = $this->theme_model->get_info($id);
			if (!$data) {
				$vl = array('ref' => 'Giao Diện Này Không Tồn Tại !','noty' => 'fail');
				echo json_encode($vl);
				exit();
			}
			$vl = array('data' => $data,'noty' => 'done');
			echo json_encode($vl);
			exit();
		}
		private function deleteDir($dirPath_1 = '',$dirPath_2 = '') {
		    $this->load->helper("file"); // load the helper
		    delete_files($dirPath_1, true);
			rmdir($dirPath_1);
	     	delete_files($dirPath_2, true);
			rmdir($dirPath_2);
		}
	}
?>
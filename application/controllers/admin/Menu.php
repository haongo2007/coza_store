
<?php 
	/**
	* 
	*/
	class Menu extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('catalog_model');
			$this->load->model('menu_model');
			$this->load->model('list_menu_model');
		}

		public function index(){
			// lay ra ten danh muc de nguoi dung tao menu
			$catalog = $this->catalog_model->get_list();
			$this->data['catalog'] = $catalog;

			// lay danh sach menu
			$menu_list = $this->list_menu_model->get_list();
			$this->data['menu_list'] = $menu_list;
			
			// load view
			$this->data['temp'] = 'admin/menu/index';
			$this->load->view('admin/main',$this->data);
		}


		public function get_menu(){
			if ($this->input->post('vl')) {
				$id = $this->input->post('vl');
				$input['where'] = array('id_list' => $id,'parent_id' => 0);
				$menu = $this->menu_model->get_list($input);
							
				foreach ($menu as $key) {
					$input['where'] = array('id_list' => $id,'parent_id' => $key->id);
					$result = $this->menu_model->get_list($input);
					echo '<li><h4>'.$key->name.'</h3>';
					echo "<ul>";
					foreach ($result as $row) {
						echo '<li><h5>'.$row->name.'</h6></li>';
					}
					echo "</ul>";
				}
			}
			
			if ($this->input->post('po')) {

				$id = $this->input->post('sa');
				$po = $this->input->post('po');
				$list = $this->list_menu_model->get_list();
				foreach ($list as $key) {
					if ($key->trangthai == $po) {
						$data 		 = array(
						'trangthai'	 	 => 0
						);
						$this->list_menu_model->update($key->id,$data);
					}
				}
				$data 		 = array(
					'trangthai'	 	 => $po
				);

				$this->list_menu_model->update($id,$data);
			}
				
			
			
			
		}


// THEM SUA XOA XEM CHI TIET bai viet
	// them sp
		public function add(){
			$id_list = rand(1,100);
			$na  = $this->input->post('na');
			$data['name'] = $na;
			$data['trangthai'] = 0;
			$data['id'] = $id_list;
			$this->list_menu_model->create($data);


			$data  = array();
			$vl  = $this->input->post('vl');
				foreach ($vl as $key) {
					$data['id'] 		= $key['id'];
					$title 				= $key['name'];
					$title 				= str_replace(" ","-",$title);
					$data['title'] 		= $title;
					$data['url']   		= 'catalog_parent/'.$key['id'];
					$data['parent_id']  = 0;
					$data['name'] 		= $key['name'];
					$data['id_list']	= $id_list;
					$this->menu_model->create($data);
					if (is_array($key)) {
						
						foreach ($key['children'] as $rel ) {
							$data['id'] = $rel['id'];
							$title 				= $rel['name'];
							$title 				= str_replace(" ","-",$title);
							$data['title'] 		= $title;
							$data['url']   		= 'catalog/'.$rel['id'];
							$data['parent_id'] = $key['id'];
							$data['name'] = $rel['name'];
							$data['id_list'] = $id_list;
							$this->menu_model->create($data);


						}
						
					}
					
				}
			

		}

		
		public function delete(){
			$id = $this->input->post('de');
			$this->_del($id);
		}

		private function _del($id){

			$where = array('id_list' => $id);
			$this->menu_model->del_rule($where);
			$this->list_menu_model->delete($id);
			
		}

	}
?>
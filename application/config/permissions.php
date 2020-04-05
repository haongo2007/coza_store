<?php 
	$config = array(
		'Admin,admin' => array('Danh Sách' => 'index', 'Thêm' => 'add', 'Sửa' => 'edit', 'Xóa' => 'delete'),
		'Danh Mục,category' => array('Danh Sách' => 'index', 'Thêm' => 'add', 'Sửa' => 'edit', 'Xóa' => 'delete'),
		'Giao Dịch,transaction' => array('Danh Sách' => 'index', 'Chi Tiết' => 'get_order', 'Cập Nhật' => 'update'),
		'Sản Phẩm,product' => array('Danh Sách' => 'index', 'Thêm' => 'add', 'Sửa' => 'edit', 'Xóa' => 'delete','Xóa TTSP' => 'del_attb'),
		'Slider,slide' => array('Danh Sách' => 'index', 'Thêm' => 'add', 'Sửa' => 'edit', 'Xóa' => 'delete'),
		'Tin Tức,news' => array('Danh Sách' => 'index', 'Thêm' => 'add', 'Sửa' => 'edit', 'Xóa' => 'delete'),
		'Nhãn Hiệu,brand' => array('Danh Sách' => 'index', 'Thêm' => 'add', 'Sửa' => 'edit', 'Xóa' => 'delete'),
		'SP Giảm Giá,hotdeal' => array('Danh Sách' => 'index', 'Thêm' => 'add', 'Sửa' => 'edit', 'Xóa' => 'delete'),
		'Liên Hệ,contact' => array('Danh Sách' => 'index', 'Sửa' => 'edit'),
		'Giao Diện,theme' => array('Danh Sách' => 'index', 'Tải Lên' => 'upload', 'Kích Hoạt' => 'active', 'Hủy Kích Hoạt' => 'deactive', 'Xóa' => 'delete', 'Chi Tiết' => 'info'),
		'Hệ Thống,systems' => array('Danh Sách' => 'index'),
	)
?>
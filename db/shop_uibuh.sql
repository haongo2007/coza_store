-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 29, 2019 lúc 05:10 PM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_uibuh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_admin`
--

CREATE TABLE `ub_admin` (
  `id` int(11) NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_group_id` int(64) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phone` int(15) NOT NULL,
  `address` varchar(20) COLLATE utf8_bin NOT NULL,
  `permissions` text COLLATE utf8_bin NOT NULL,
  `avatar` text COLLATE utf8_bin NOT NULL,
  `chucvu` varchar(255) COLLATE utf8_bin NOT NULL,
  `created` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_admin`
--

INSERT INTO `ub_admin` (`id`, `password`, `name`, `admin_group_id`, `email`, `phone`, `address`, `permissions`, `avatar`, `chucvu`, `created`) VALUES
(9, '2c3fd8302b1538b97943acec9f675571', 'HaoNgo', 0, 'yang123@gmail.com', 972918120, '123/thuduc', 'null', 'avatar5.jpg', 'Developer', '1519982415'),
(27, '2c3fd8302b1538b97943acec9f675571', 'haongo2', 0, 'haongodev@gmail.com', 972918120, '130b/lê trung kiên', '{\"admin\":[\"index\",\"add\",\"edit\",\"delete\"],\"category\":[\"index\",\"add\",\"edit\",\"delete\"],\"transaction\":[\"index\",\"get_order\",\"update\"],\"product\":[\"index\",\"add\",\"edit\",\"delete\",\"del_attb\"],\"slide\":[\"index\",\"add\",\"edit\",\"delete\"],\"news\":[\"index\",\"add\",\"edit\",\"delete\"],\"brand\":[\"index\",\"add\",\"edit\",\"delete\"],\"hotdeal\":[\"index\",\"add\",\"edit\",\"delete\"],\"contact\":[\"index\",\"edit\"],\"theme\":[\"index\",\"upload\",\"active\",\"deactive\",\"delete\",\"info\"]}', 'avatar5.jpg', 'Developer', '1566277675'),
(26, '2c3fd8302b1538b97943acec9f675571', 'Ngô Hào Gia', 0, 'haodev@gmail.com', 972918120, '130b/lê trung kiên', '{\"category\":[\"index\",\"add\",\"edit\",\"delete\"],\"transaction\":[\"index\",\"get_order\",\"update\"],\"product\":[\"index\",\"add\",\"edit\",\"delete\",\"del_attb\"],\"slide\":[\"index\",\"add\",\"edit\",\"delete\"],\"news\":[\"index\",\"add\",\"edit\",\"delete\"],\"brand\":[\"index\",\"add\",\"edit\",\"delete\"],\"hotdeal\":[\"index\",\"add\",\"edit\",\"delete\"],\"contact\":[\"index\",\"edit\"],\"theme\":[\"index\",\"upload\",\"active\",\"deactive\",\"delete\",\"info\"],\"systems\":[\"index\"]}', 'avatar5.jpg', 'Developer', '1566184087');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_atribute`
--

CREATE TABLE `ub_atribute` (
  `id` int(255) NOT NULL,
  `id_product` int(100) NOT NULL,
  `image_list` text COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(225) CHARACTER SET utf8mb4 NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `unit` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ub_atribute`
--

INSERT INTO `ub_atribute` (`id`, `id_product`, `image_list`, `code`, `name`, `size`, `path`, `unit`) VALUES
(292, 355, '[\"05-09-2019_lightweightjacket_uohnPldz.jpg\",\"05-09-2019_lightweightjacket_uohnPldz1.jpg\",\"05-09-2019_lightweightjacket_uohnPldz2.jpg\"]', '#000040', 'Dark Blue', 'S,M,L,X', './public/upload/product/2019/09/', '[\"270x335\",\"70x85\"]'),
(294, 357, '[\"05-09-2019_piecesmetallicprinted_EqfVUyZJ.jpg\",\"05-09-2019_piecesmetallicprinted_EqfVUyZJ1.jpg\",\"05-09-2019_piecesmetallicprinted_EqfVUyZJ2.jpg\"]|[\"05-09-2019_piecesmetallicprinted_qiMAmwbF.jpg\",\"05-09-2019_piecesmetallicprinted_qiMAmwbF1.jpg\"]', '#ffffff|#3f3f3f', 'White|Silver', 'S,X,M|X,S,L', './public/upload/product/2019/09/', '[\"270x335\",\"70x85\"]'),
(295, 358, '[\"05-09-2019_herschelsupplywatch_piTftoxv.jpg\",\"05-09-2019_herschelsupplywatch_piTftoxv1.jpg\"]', '#000000', 'Black', '15cm', './public/upload/product/2019/09/', '[\"270x335\",\"70x85\"]'),
(296, 359, '[\"05-09-2019_herschelsupplyt-shirt_NgYpFUKh.jpg\"]|[\"05-09-2019_herschelsupplyt-shirt_RcCNBHGO.jpg\"]', '#0074c1|#5a94fe', 'Xanh Short|Xanh long', 'S,M,XXX|S,M,L,XX', './public/upload/product/2019/09/', '[\"270x335\",\"70x85\"]'),
(297, 360, '[\"05-09-2019_prettylittlething_CmNnQulg.jpg\",\"05-09-2019_prettylittlething_CmNnQulg1.jpg\"]', '#000000', 'Black', 'S', './public/upload/product/2019/09/', '[\"270x335\",\"70x85\"]'),
(298, 361, '[\"05-09-2019_converseallstarhiplimsolls_xVhSNoyW.jpg\"]', '#000000', 'Black', '39', './public/upload/product/2019/09/', '[\"270x335\",\"70x85\"]'),
(299, 362, '[\"05-09-2019_classictrenchcoat_jGwIZruC.jpg\"]', '#614401', 'Brown', 'L,X,XXX', './public/upload/product/2019/09/', '[\"270x335\",\"70x85\"]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_brand`
--

CREATE TABLE `ub_brand` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(100) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ub_brand`
--

INSERT INTO `ub_brand` (`id`, `name`, `sort_order`, `logo`) VALUES
(5, 'Nike', 4, 'download_(1).png'),
(11, 'Lamer', 5, 'logo.png'),
(27, 'Adidas', 3, 'download1.png'),
(28, '4 Men', 2, 'images.jpg'),
(29, 'haongo', 3, 'brain.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_category`
--

CREATE TABLE `ub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner` text COLLATE utf8_bin NOT NULL,
  `site_title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `sort_order` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_category`
--

INSERT INTO `ub_category` (`id`, `name`, `banner`, `site_title`, `meta_desc`, `meta_key`, `parent_id`, `sort_order`) VALUES
(85, 'Kids', '', 'Spring 2019', 'thời trang trẻ em và trẻ sơ sinh ', '[\"treem,thoitrang,connit\"]', 0, 1),
(84, 'Men', 'banner-02.jpg', 'New Trend', 'Thời trang nam trẻ trung năng động', '[\"men,danong,fashion\"]', 0, 2),
(83, 'Women', 'banner-01.jpg', 'Spring 2019', 'Thời trang phụ nữ trẻ trung năng động', '[\"woman,phunu,tretrung,nangdong\"]', 0, 3),
(87, 'DRESSES', '', 'đầm dành cho phụ nữ ', 'đầm dành cho phụ nữ ', '[\"dresses\",\"woman\",\"fashion\"]', 83, 7),
(91, 'FOOTWEAR', '', 'giày nam chính hãng đẹp', 'giày nam chính hãng đẹp', '\"hahaha,hoho,hihi,hehe\"', 84, 1),
(93, 'WATCHES', '', 'đồng hồ nam giá rẻ sang trọng oke', 'đồng hồ nam giá rẻ sang trọng oke', '[\"watch\",\"men\",\"luxury\"]', 84, 14),
(103, 'T-Shirt', '', 'Áo Sơ mi Nam', 'Áo Sơ mi Nam đẹp nhất thế giới', '[\"t-shirt\",\"aosomi\",\"nam\",\"men\",\"fashion\",\"dep\",\"cute\",\"jhahaha\"]', 84, 4),
(102, 'Jacke', '', 'áo khoát dành cho trẻ em', 'áo khoát dành cho trẻ em', '[\"jacke\",\"kid\"]', 85, 5),
(106, 'Accessories', 'banner-03.jpg', 'Spring 2019', 'Phụ Kiện Nam Nữ Trẻ Em', '[\"accessories,phukien\"]', 0, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_comment`
--

CREATE TABLE `ub_comment` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `parent_id` int(255) NOT NULL,
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL,
  `count_like` int(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_hotdeal`
--

CREATE TABLE `ub_hotdeal` (
  `id` int(100) NOT NULL,
  `image_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `discount` text NOT NULL,
  `arr_prod` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` text NOT NULL,
  `status` int(11) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ub_hotdeal`
--

INSERT INTO `ub_hotdeal` (`id`, `image_link`, `name`, `meta_desc`, `discount`, `arr_prod`, `time`, `status`, `created`) VALUES
(25, '17-07457-10-800-1_1024x1024.jpg', 'Relogio-Masculino', '', '1999999', '[\"260\",\"251\"]', '13/06/2019 - 03/08/2019', 2, 1561835875);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_info`
--

CREATE TABLE `ub_info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_info`
--

INSERT INTO `ub_info` (`id`, `title`, `content`, `meta_desc`, `meta_key`, `created`) VALUES
(1, 'Giới thiệu', '<p>\r\n	Giới thiệu</p>\r\n', '', '', 1409044792),
(2, 'Hướng dẫn mua hàng', '<p>\r\n	Hướng dẫn mua h&agrave;ng</p>\r\n', '', '', 1409044950);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_list_menu`
--

CREATE TABLE `ub_list_menu` (
  `id` int(100) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_list_menu`
--

INSERT INTO `ub_list_menu` (`id`, `name`, `trangthai`) VALUES
(58, '', '0'),
(25, '', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_menu`
--

CREATE TABLE `ub_menu` (
  `id` int(100) NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `parent_id` int(100) NOT NULL,
  `id_list` int(100) NOT NULL,
  `id_menu` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_menu`
--

INSERT INTO `ub_menu` (`id`, `title`, `url`, `name`, `parent_id`, `id_list`, `id_menu`) VALUES
(94, 'SUNGLASSES', 'catalog_parent/94', 'SUNGLASSES', 0, 58, 341),
(93, 'WATCHES', 'catalog_parent/93', 'WATCHES', 0, 58, 342),
(98, 'T-Shirt', 'catalog_parent/98', 'T-Shirt', 0, 58, 340),
(99, 'Leather-Jacket', 'catalog_parent/99', 'Leather Jacket', 0, 58, 339),
(101, 'Sweater', 'catalog_parent/101', 'Sweater', 0, 58, 337),
(100, 'Jeans', 'catalog_parent/100', 'Jeans', 0, 58, 338),
(102, 'Jacke', 'catalog_parent/102', 'Jacke', 0, 58, 336),
(93, 'WATCHES', 'catalog_parent/93', 'WATCHES', 0, 25, 335),
(94, 'SUNGLASSES', 'catalog_parent/94', 'SUNGLASSES', 0, 25, 334),
(98, 'T-Shirt', 'catalog_parent/98', 'T-Shirt', 0, 25, 333),
(99, 'Leather-Jacket', 'catalog_parent/99', 'Leather Jacket', 0, 25, 332),
(100, 'Jeans', 'catalog_parent/100', 'Jeans', 0, 25, 331),
(101, 'Sweater', 'catalog_parent/101', 'Sweater', 0, 25, 330),
(102, 'Jacke', 'catalog_parent/102', 'Jacke', 0, 25, 329);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_news`
--

CREATE TABLE `ub_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(50) COLLATE utf8_bin NOT NULL,
  `created` int(11) NOT NULL DEFAULT 0,
  `feature` enum('0','1') COLLATE utf8_bin NOT NULL,
  `count_view` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_news`
--

INSERT INTO `ub_news` (`id`, `title`, `intro`, `content`, `meta_desc`, `meta_key`, `image_link`, `created`, `feature`, `count_view`) VALUES
(1, 'Nhà lầu siêu xe hàng mã ế sưng, đồ chơi biển đảo hút khách', '(Dân trí) - Loạt đồ chơi trung thu biển đảo hướng về quê hương mới xuất hiện nhưng đã hút khách, các mặt hàng vàng mã “xa xỉ” không còn được nhiều người mua sắm.', '<p style=\"TEXT-ALIGN: left\">\r\n	Theo b&aacute;c Lan, một chủ cửa h&agrave;ng ở phố H&agrave;ng M&atilde; chia sẻ: &ldquo;Kinh tế kh&oacute; khăn n&ecirc;n người bỏ tiền triệu ra mua đồ c&uacute;ng đắt tiền như nh&agrave; lầu, xe hơi, điện thoại, ti vi c&ograve;n rất &iacute;t. Mọi người chỉ lựa chọn những loại đồ c&oacute; gi&aacute; b&igrave;nh d&acirc;n như quần &aacute;o, gi&agrave;y d&eacute;p v&agrave; mũ để c&uacute;ng. Những mặt h&agrave;ng b&aacute;n chạy nhất l&agrave; tiền &acirc;m phủ, v&agrave;ng, quần &aacute;o hay gi&agrave;y d&eacute;p v&igrave; c&oacute; gi&aacute; kh&aacute; b&igrave;nh d&acirc;n&rdquo;.</p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<img alt=\"Mặt hàng đèn lồng biển đảo mới xuất hiện trong dịp Tết Trung Thu năm nay\" src=\"http://dantri4.vcmedia.vn/Urgz3f5tKFdDA0VUUO/Image/2014/08/n1-242e1.jpg\" /><br />\r\n	<span style=\"FONT-FAMILY: Tahoma; FONT-SIZE: 10pt\">Mặt h&agrave;ng đ&egrave;n lồng biển đảo mới xuất hiện trong dịp Tết Trung Thu năm nay</span></p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<span style=\"FONT-FAMILY: Tahoma\"><img alt=\"Các thông điệp ý nghĩa yêu quê hương, biển đảo được in lên đèn lồng\" src=\"http://dantri4.vcmedia.vn/Urgz3f5tKFdDA0VUUO/Image/2014/08/n2-242e1.jpg\" /></span><br />\r\n	<span style=\"FONT-FAMILY: Tahoma; FONT-SIZE: 10pt\">C&aacute;c th&ocirc;ng điệp &yacute; nghĩa y&ecirc;u qu&ecirc; hương, biển đảo được in l&ecirc;n đ&egrave;n lồng</span></p>\r\n<p>\r\n	Một mặt h&agrave;ng đặc biệt của m&ugrave;a Vu Lan năm nay đ&oacute; l&agrave; loại đồ chơi &ldquo;biển đảo&rdquo;. Đ&oacute; l&agrave; những chiếc đ&egrave;n lồng được in những th&ocirc;ng điệp hướng về qu&ecirc; hương, biển đảo hết sức &yacute; nghĩa.</p>\r\n<div class=\"article-side-rail\" id=\"article-side-rail\">\r\n	<div class=\"article-video-relation\">\r\n		<div class=\"relative\">\r\n			<img alt=\"Mùa Vu Lan: \" class=\"thumb\" src=\"http://video-thumbs.vcmedia.vn///dantri/7iS0Ym1SbbOoTsWhJi6Q/2014/08/08/vangma-15e63.jpg\" /><img class=\"ico\" src=\"http://dantri3.vcmedia.vn/App_Themes/Default/Images/ico_video_play.png\" /></div>\r\n		<p class=\"caption\">\r\n			M&ugrave;a Vu Lan: &quot;Xe si&ecirc;u sang&quot; đỗ chật phố H&agrave;ng M&atilde;</p>\r\n	</div>\r\n</div>\r\n<p>\r\n	C&aacute;c chủ cửa h&agrave;ng tại đ&acirc;y cho biết, c&aacute;c loại mặt h&agrave;ng l&agrave;m thủ c&ocirc;ng truyền thống đ&egrave;n lồng, đầu l&acirc;n, đ&egrave;n &ocirc;ng sao vẫn được kh&aacute;ch h&agrave;ng ưa chuộng nhất. Ngo&agrave;i ra, mẫu đ&egrave;n lồng in sẵn mang th&ocirc;ng điệp hướng về biển đảo qu&ecirc; hương được nhiều bậc phụ huynh v&agrave; c&aacute;c em học sinh đặc biệt y&ecirc;u th&iacute;ch.</p>\r\n<p style=\"TEXT-ALIGN: center\">\r\n	<img alt=\"Mới xuất hiện nhưng những chiếc đèn lồng này được nhiều phụ huynh và các em nhỏ lựa chọn\" src=\"http://dantri4.vcmedia.vn/Urgz3f5tKFdDA0VUUO/Image/2014/08/n4-242e1.jpg\" /><br />\r\n	<span style=\"FONT-FAMILY: Tahoma; FONT-SIZE: 10pt\">Mới xuất hiện nhưng những chiếc đ&egrave;n lồng n&agrave;y được nhiều phụ huynh v&agrave; c&aacute;c em nhỏ lựa chọn</span><br />\r\n	&nbsp;</p>\r\n<p>\r\n	Chiếc đ&egrave;n lồng mang th&ocirc;ng điệp biển đảo được gh&eacute;p lại bằng 3 mảnh b&igrave;a kh&aacute;c nhau. Chiếc đ&egrave;n c&oacute; thể thắp s&aacute;ng v&agrave; ph&aacute;t nhạc khi được lắp pin ở tay cầm.Tuy nhi&ecirc;n, chi tiết đ&aacute;ng ch&uacute; &yacute; nhất đ&oacute; l&agrave; những th&ocirc;ng điệp hướng về biển đảo in tr&ecirc;n th&acirc;n của chiếc đ&egrave;n lồng như &ldquo;Em y&ecirc;u biển đảo qu&ecirc; hương&rdquo;, &ldquo;B&eacute; hướng về biển đảo&rdquo;, &ldquo;Em y&ecirc;u biển đảo Việt Nam&rdquo;, &ldquo;Em y&ecirc;u ch&uacute; bộ đội hải qu&acirc;n Việt Nam&rdquo;, với những h&igrave;nh ảnh chiến sĩ Hải qu&acirc;n Việt Nam s&uacute;ng kho&aacute;c tr&ecirc;n vai bảo vệ chủ quyền biển đảo Tổ quốc hay những chiếc t&agrave;u mang d&ograve;ng chữ Cảnh s&aacute;t biển Việt Nam&hellip;</p>\r\n', '', '', 'n1-242e1.jpg', 1407553602, '0', 1),
(2, 'Arsenal đồng ý bán Vermaelen cho Barcelona', '(Dân trí) - Theo những thông tin từ báo giới Anh, Arsenal đã quyết định từ chối MU, để bán trung vệ Vermarlen cho Barcelona. Mức giá của trung vệ này vào khoảng 15 triệu bảng.', '<p>\r\n	Như đ&atilde; biết, c&aacute;ch đ&acirc;y v&agrave;i ng&agrave;y, trung vệ Vermaelen đ&atilde; từ chối gia hạn hợp đồng với Arsenal. Điều đ&oacute; khiến cho CLB th&agrave;nh London t&igrave;m c&aacute;ch b&aacute;n cầu thủ n&agrave;y bằng mọi gi&aacute; để &ldquo;gỡ gạc&rdquo; ch&uacute;t &iacute;t ph&iacute; chuyển nhượng thay v&igrave; mất trắng cầu thủ n&agrave;y&nbsp;ở m&ugrave;a H&egrave; sang năm.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div align=\"center\">\r\n	<span style=\"FONT-FAMILY: Tahoma; FONT-SIZE: 10pt\"><img _fl=\"\" align=\"middle\" alt=\"Vermaelen ở rất gần Barcelona\" src=\"http://dantri4.vcmedia.vn/uajiKupQ6reCuKKDlVlG/Image/2014/08/Vermaelen-d4361.jpg\" style=\"MARGIN: 5px\" width=\"450\" /><br />\r\n	Vermaelen ở rất gần Barcelona</span><br />\r\n	&nbsp;</div>\r\n<p>\r\n	Trong thời gian gần đ&acirc;y, MU v&agrave; Barcelona l&agrave; hai ứng cử vi&ecirc;n s&aacute;ng gi&aacute; trong cuộc đua gi&agrave;nh chữ k&yacute; của hậu vệ người Bỉ. Cuối c&ugrave;ng, HLV Wenger đ&atilde; quyết định từ chối MU để b&aacute;n Vermarlen cho Barcelona. Trước đ&oacute; c&oacute; th&ocirc;ng tin cho rằng Wenger muốn đổi Vermaelen lấy Smalling, tuy nhi&ecirc;n Van Gaal lại từ chối phương &aacute;n n&agrave;y.</p>\r\n<p>\r\n	Trước b&aacute;o giới, HLV Wenger cho biết: &ldquo;Ch&uacute;ng t&ocirc;i đ&atilde; nhận được những lời đề nghị từ nước ngo&agrave;i v&agrave; quyết định để Vermaelen rời khỏi Premier League. Bản th&acirc;n Arsenal cũng đang ở trong thế kh&oacute; trong vụ n&agrave;y&rdquo;.</p>\r\n<p>\r\n	Theo tờ BBC, Arsenal đ&atilde; đồng &yacute; lời đề nghị trị gi&aacute; 15 triệu bảng của Barcelona. Trong thời gian tới, trung vệ người Bỉ sẽ được quyền tự do đ&agrave;m ph&aacute;n với đội b&oacute;ng xứ Catalan.</p>\r\n<p>\r\n	Nhiều khả năng thương vụ n&agrave;y sẽ ho&agrave;n tất trong thời gian tới. Arsenal cũng bắt đầu t&igrave;m người thay thế Vermaelen. L&uacute;c n&agrave;y, ưu ti&ecirc;n số 1 của HLV Wenger l&agrave; trung vệ Nastasic của Man City, người nhiều khả năng sẽ mất vị tr&iacute; nếu như Mangala gia nhập Etihad.</p>\r\n<p align=\"right\">\r\n	<b>H.Long</b></p>\r\n', '', '', 'Vermaelen-d4361.jpg', 1407553674, '0', 2),
(3, 'Hà Nội: CSGT tìm người thân giúp cháu bé 8 tuổi đi lạc', '(Dân trí) - Theo người thân cháu Chi, trong lúc gia đình nghỉ trưa, cháu Chi mải chơi đã đi lạc từ phía phường Ngọc Lâm (quận Long Biên) sang nội thành. Trong lúc đang hoang mang tìm cháu, gia đình nhận được tin báo của lực lượng cảnh sát giao thông.', '<p>\r\n	Khoảng 15h30 ng&agrave;y 8/8, khi đang l&agrave;m nhiệm vụ tại chốt ph&iacute;a nam cầu Chương Dương (địa b&agrave;n quận Ho&agrave;n Kiếm, H&agrave; Nội), Thượng sĩ Phạm Gia Hợp v&agrave; Thượng t&aacute; L&ecirc; Đức Đo&agrave;n(Đội CSGT số 1) ph&aacute;t hiện một ch&aacute;u b&eacute; khoảng 7-8 tuổi đi bộ tr&ecirc;n khu vực cầu Chương Dương với vẻ mặt sợ sệt. Khi Thượng sĩ Hợp v&agrave; Thượng t&aacute; Đ&ograve;an tiến lại hỏi han, ch&aacute;u b&eacute; c&oacute; biểu hiện sợ sệt v&agrave; bật kh&oacute;c n&oacute;i rằng đi lạc đường.</p>\r\n<p>\r\n	Thấy ch&aacute;u b&eacute; lả đi v&igrave; mệt, Thượng sĩ Hợp đ&atilde; đưa ch&aacute;u về chốt trực, mua b&aacute;nh v&agrave; sữa để ch&aacute;u ăn đỡ đ&oacute;i v&agrave; trấn tĩnh lại. Đồng thời, Thượng sĩ Hợp th&ocirc;ng b&aacute;o tr&ecirc;n c&aacute;c phương tiện th&ocirc;ng tin đại ch&uacute;ng về đặc điểm nhận dạng của ch&aacute;u b&eacute;.</p>\r\n<p>\r\n	<img alt=\"Cháu Chi đoàn tụ với gia đình.\" src=\"http://dantri4.vcmedia.vn/xFKfMbJ7RTXgah5W1cc/Image/2014/08/455-549e4.jpg\" /><br />\r\n	Ch&aacute;u Chi đo&agrave;n tụ với gia đ&igrave;nh.</p>\r\n<p>\r\n	Sau khi trấn tĩnh lại, ch&aacute;u b&eacute; cho biết t&ecirc;n l&agrave; Vương Kim Chi (SN 2007), năm nay l&ecirc;n lớp 2 trường tiểu học &Aacute;i Mộ, quận Long Bi&ecirc;n, H&agrave; Nội. Bằng c&aacute;c biện ph&aacute;p nghiệp vụ, Thượng sĩ Hợp v&agrave; Thượng t&aacute; Đo&agrave;n đ&atilde; li&ecirc;n hệ được với c&ocirc; gi&aacute;o chủ nhiệm ch&aacute;u Chi để th&ocirc;ng b&aacute;o với gia đ&igrave;nh ch&aacute;u b&eacute; biết.</p>\r\n<p>\r\n	Gần 2 tiếng đồng hồ sau, mẹ ch&aacute;u Chi l&agrave; chị Đo&agrave;n Thị Khuyến (SN 1983, ở Ngọc L&acirc;m, Long Bi&ecirc;n, H&agrave; Nội) đ&atilde; t&igrave;m đến trụ sở Đội CSGT số 1 nhận lại con. Chị Khuyến cho cho biết, khoảng 14h c&ugrave;ng ng&agrave;y, trong l&uacute;c gia đ&igrave;nh nghỉ trưa, ch&aacute;u Chi mải chơi đ&atilde; đi lạc từ b&ecirc;n n&agrave;y cầu sang b&ecirc;n kia nội th&agrave;nh.</p>\r\n<p>\r\n	Trong l&uacute;c hoang mang kh&ocirc;ng biết t&igrave;m ch&aacute;u ở đ&acirc;u, gia đ&igrave;nh được th&ocirc;ng b&aacute;o ch&aacute;u Chi đ&atilde; được c&aacute;c chiến sĩ CSGT tận t&igrave;nh gi&uacute;p đỡ. Thay mặt gia đ&igrave;nh, chị Khuyến đ&atilde; viết thư cảm ơn c&aacute;c chiến sĩ cảnh s&aacute;t giao th&ocirc;ng.</p>\r\n<p>\r\n	<strong>Tiến Nguy&ecirc;n</strong></p>\r\n', '', '', '455-549e4.jpg', 1407553969, '0', 9),
(4, 'Mỹ tăng cường không kích Iraq', '(Dân trí) - Sau khi Tổng thống Obama phê chuẩn cho không kích các mục tiêu của nhóm phiến quân Hồi giáo IS ở miền bắc Iraq, Lầu Năm Góc đã tiến hành 3 đợt không kích.', '<p>\r\n	C&aacute;c vụ kh&ocirc;ng k&iacute;ch nhằm v&agrave;o nh&oacute;m Nh&agrave; nước Hồi gi&aacute;o (IS) ở miền bắc Iraq l&agrave; những cuộc tấn c&ocirc;ng đầu ti&ecirc;n kể từ khi Mỹ trực tiếp tham gia v&agrave;o hoạt động qu&acirc;n sự ở Iraq v&agrave; sau đ&oacute; r&uacute;t qu&acirc;n v&agrave;o cuối năm 2011.</p>\r\n<p>\r\n	Trong cuộc kh&ocirc;ng k&iacute;ch đầu ti&ecirc;n v&agrave;o ng&agrave;y thứ s&aacute;u, m&aacute;y bay kh&ocirc;ng người l&aacute;i c&ugrave;ng chiến đấu cơ hải qu&acirc;n Mỹ đ&atilde; nhắm v&agrave;o c&aacute;c mục ti&ecirc;u gần th&agrave;nh phố Irbil của người Kurd. Sau đ&oacute; họ tiến h&agrave;nh th&ecirc;m 2 đợt tấn c&ocirc;ng nữa.</p>\r\n<p>\r\n	Nh&oacute;m Hồi gi&aacute;o người Sunni IS đ&atilde; chiếm quyền kiểm so&aacute;t nhiều khu vực của Iraq v&agrave; cả Syria.</p>\r\n<p>\r\n	H&agrave;ng chục ng&agrave;n người thuộc c&aacute;c nh&oacute;m d&acirc;n tộc thiểu số đ&atilde; phải rời bỏ nh&agrave; cửa khi phiến qu&acirc;n tiến v&agrave;o.</p>\r\n<p>\r\n	Nh&oacute;m IS hay c&ograve;n được gọi l&agrave; ISIS cũng đ&atilde; chiếm đập lớn nhất Iraq.</p>\r\n<p>\r\n	Lầu Năm G&oacute;c cho biết trong đợt kh&ocirc;ng k&iacute;ch thứ hai, m&aacute;y bay kh&ocirc;ng người l&aacute;i của Mỹ đ&atilde; ph&aacute; hủy một vị tr&iacute; đặt ph&aacute;o của phiến qu&acirc;n v&agrave; ti&ecirc;u diệt một nh&oacute;m phiến qu&acirc;n.</p>\r\n<p>\r\n	Chỉ hơn một tiếng sau, chiến đấu cơ F/A-18 đ&atilde; d&ugrave;ng bom c&oacute; laser dẫn đường bắn tr&uacute;ng một đo&agrave;n 7 xe của IS.</p>\r\n<p>\r\n	Trước đ&oacute;, v&agrave;o ng&agrave;y thứ s&aacute;u, 2 quả bom đ&atilde; được thả xuống một khẩu ph&aacute;o của IS d&ugrave;ng để chống lại lực lượng đang bảo vệ Irbil, thủ phủ của v&ugrave;ng tự trị của người Kurd.</p>\r\n<p>\r\n	Ph&aacute;t ng&ocirc;n vi&ecirc;n Bộ Ngoại giao Mỹ Marie Harf cho biết mục ti&ecirc;u trước mắt của c&aacute;c cuộc kh&ocirc;ng k&iacute;ch l&agrave; &ldquo;ngăn chặn bước tiến&rdquo; của IS về Irbil.</p>\r\n<p>\r\n	&ldquo;Sau đ&oacute; về l&acirc;u d&agrave;i chung t&ocirc;i muốn phối hợp hỗ trợ th&ecirc;m thời gian v&agrave; kh&ocirc;ng gian cho c&aacute;c lực lượng của người Kurd để xốc lại lực lượng, chiến đấu với đe dọa của ch&iacute;nh họ&rdquo;.</p>\r\n<p>\r\n	B&agrave; cũng khẳng định &ldquo;kh&ocirc;ng c&oacute; giải ph&aacute;p qu&acirc;n sự l&acirc;u d&agrave;i của Mỹ ở đ&oacute;&rdquo;.</p>\r\n<p>\r\n	Mặc d&ugrave; ch&iacute;nh phủ Iraq v&agrave; V&ugrave;ng người Kurd vẫn c&ograve;n đang c&oacute; bất đồng trong những th&aacute;ng qua, nhưng Thủ tướng Nouri Maliki đ&atilde; ph&aacute;i một m&aacute;y bay chở đạn tới Irbil v&agrave; thứ s&aacute;u. Trước đ&oacute; &ocirc;ng đ&atilde; lệnh cho lực lượng kh&ocirc;ng qu&acirc;n hỗ trợ cho c&aacute;c tay s&uacute;ng người Kurd để chiến đấu chống IS.</p>\r\n<p>\r\n	<b>Trung Anh</b></p>\r\n', '', '', '1-7d48c.jpg', 1407554007, '0', 0),
(5, 'SonyXperia Z', '', '<p>\r\n	sony z</p>\r\n', '																																						', '																																						', 'bmw-s1000rr-22.jpg', 1518070275, '0', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_order`
--

CREATE TABLE `ub_order` (
  `transaction_id` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `data` text COLLATE utf8_bin NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_order`
--

INSERT INTO `ub_order` (`transaction_id`, `id`, `product_id`, `qty`, `amount`, `data`, `status`) VALUES
(119, 86, 362, 1, '2999999.0000', '{\"color\":[\"Brown\"],\"size\":[\"Size L\"],\"posi\":[\"0\"]}', 0),
(118, 85, 361, 1, '2999999.0000', '{\"color\":[\"Black\"],\"size\":[\"Size 39\"],\"posi\":[\"0\"]}', 1),
(118, 84, 360, 1, '388888.0000', '{\"color\":[\"Black\"],\"size\":[\"Size S\"],\"posi\":[\"0\"]}', 1),
(119, 87, 355, 1, '1799999.0000', '{\"color\":[\"Dark Blue\"],\"size\":[\"Size S\"],\"posi\":[\"0\"]}', 0),
(120, 88, 360, 1, '388888.0000', '{\"color\":[\"Black\"],\"size\":[\"Size S\"],\"posi\":[\"0\"]}', 1),
(120, 89, 361, 1, '2999999.0000', '{\"color\":[\"Black\"],\"size\":[\"Size 39\"],\"posi\":[\"0\"]}', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_page`
--

CREATE TABLE `ub_page` (
  `id` int(10) NOT NULL,
  `name` varchar(225) NOT NULL,
  `status` int(10) NOT NULL,
  `html` text NOT NULL,
  `css` text NOT NULL,
  `slug` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ub_page`
--

INSERT INTO `ub_page` (`id`, `name`, `status`, `html`, `css`, `slug`) VALUES
(3, 'Giới Thiệu', 0, '<header class=\"header-banner\"><div class=\"container-width\"><div class=\"logo-container\"><div class=\"logo\">GrapesJS</div></div><nav class=\"menu\"><div class=\"menu-item\">BUILDER</div><div class=\"menu-item\">TEMPLATE</div><div class=\"menu-item\">WEB</div></nav><div class=\"clearfix\"></div><div class=\"lead-title\">Build your templates without coding</div><div class=\"sub-lead-title\">All text blocks could be edited easily with double clicking on it. You can create new text blocks with the command from the left panel</div><div class=\"lead-btn\">Hover me</div></div></header><section class=\"flex-sect\"><div class=\"container-width\"><div class=\"flex-title\">Flex is the new black</div><div class=\"flex-desc\">With flexbox system you\'re able to build complex layouts easily and with free responsivity</div><div class=\"cards\"><div class=\"card\"><div class=\"card-header\"></div><div class=\"card-body\"><div class=\"card-title\">Title one</div><div class=\"card-sub-title\">Subtitle one</div><div class=\"card-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</div></div></div><div class=\"card\"><div class=\"card-header ch2\"></div><div class=\"card-body\"><div class=\"card-title\">Title two</div><div class=\"card-sub-title\">Subtitle two</div><div class=\"card-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</div></div></div><div class=\"card\"><div class=\"card-header ch3\"></div><div class=\"card-body\"><div class=\"card-title\">Title three</div><div class=\"card-sub-title\">Subtitle three</div><div class=\"card-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</div></div></div><div class=\"card\"><div class=\"card-header ch4\"></div><div class=\"card-body\"><div class=\"card-title\">Title four</div><div class=\"card-sub-title\">Subtitle four</div><div class=\"card-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</div></div></div><div class=\"card\"><div class=\"card-header ch5\"></div><div class=\"card-body\"><div class=\"card-title\">Title five</div><div class=\"card-sub-title\">Subtitle five</div><div class=\"card-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</div></div></div><div class=\"card\"><div class=\"card-header ch6\"></div><div class=\"card-body\"><div class=\"card-title\">Title six</div><div class=\"card-sub-title\">Subtitle six</div><div class=\"card-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</div></div></div></div></div></section><section class=\"am-sect\"><div class=\"container-width\"><div class=\"am-container\"><img onmousedown=\"return false\" src=\"http://localhost/dienmay/public/admin/gjs/img/phone-app.png\" class=\"img-phone\"/><div class=\"am-content\"><div class=\"am-pre\">ASSET MANAGER</div><div class=\"am-title\">Manage your images with Asset Manager</div><div class=\"am-desc\">You can create image blocks with the command from the left panel and edit them with double click</div><div class=\"am-post\">Image uploading is not allowed in this demo</div></div></div></div></section><section class=\"blk-sect\"><div class=\"container-width\"><div class=\"blk-title\">Blocks</div><div class=\"blk-desc\">Each element in HTML page could be seen as a block. On the left panel you could find different kind of blocks that you can create, move and style</div><div class=\"price-cards\"><div class=\"price-card-cont\"><div class=\"price-card\"><div class=\"pc-title\">Starter</div><div class=\"pc-desc\">Some random list</div><div class=\"pc-feature odd-feat\">+ Starter feature 1</div><div class=\"pc-feature\">+ Starter feature 2</div><div class=\"pc-feature odd-feat\">+ Starter feature 3</div><div class=\"pc-feature\">+ Starter feature 4</div><div class=\"pc-amount odd-feat\">$ 9,90/mo</div></div></div><div class=\"price-card-cont\"><div class=\"price-card pc-regular\"><div class=\"pc-title\">Regular</div><div class=\"pc-desc\">Some random list</div><div id=\"i7pan\" class=\"pc-feature odd-feat\">+ Regular feature 1<a href=\"\" class=\"link\"></a></div><div class=\"pc-feature\">+ Regular feature 2</div><div class=\"pc-feature odd-feat\">+ Regular feature 3</div><div class=\"pc-feature\">+ Regular feature 4</div><div class=\"pc-amount odd-feat\">$ 19,90/mo</div></div></div><div class=\"price-card-cont\"><div class=\"price-card pc-enterprise\"><div class=\"pc-title\">Enterprise</div><div class=\"pc-desc\">Some random list</div><div class=\"pc-feature odd-feat\">+ Enterprise feature 1</div><div class=\"pc-feature\">+ Enterprise feature 2</div><div class=\"pc-feature odd-feat\">+ Enterprise feature 3</div><div class=\"pc-feature\">+ Enterprise feature 4</div><div class=\"pc-amount odd-feat\">$ 29,90/mo</div></div></div></div></div></section><section class=\"bdg-sect\"><div class=\"container-width\"><h1 class=\"bdg-title\">The team</h1><div class=\"badges\"><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team1.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">Adam Smith</div><div class=\"badge-role\">CEO</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team2.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">John Black</div><div class=\"badge-role\">Software Engineer</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team3.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">Jessica White</div><div class=\"badge-role\">Web Designer</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div></div></div></section><footer class=\"footer-under\"><div class=\"container-width\"><div class=\"footer-container\"><div class=\"foot-lists\"><div class=\"foot-list\"><div class=\"foot-list-title\">About us</div><div class=\"foot-list-item\">Contact</div><div class=\"foot-list-item\">Events</div><div class=\"foot-list-item\">Company</div><div class=\"foot-list-item\">Jobs</div><div class=\"foot-list-item\">Blog</div></div><div class=\"foot-list\"><div class=\"foot-list-title\">Services</div><div class=\"foot-list-item\">Education</div><div class=\"foot-list-item\">Partner</div><div class=\"foot-list-item\">Community</div><div class=\"foot-list-item\">Forum</div><div class=\"foot-list-item\">Download</div><div class=\"foot-list-item\">Upgrade</div></div><div class=\"clearfix\"></div></div><div class=\"form-sub\"><div class=\"foot-form-cont\"><div class=\"foot-form-title\">Subscribe</div><div class=\"foot-form-desc\">Subscribe to our newsletter to receive exclusive offers and the latest news</div><input name=\"name\" placeholder=\"Name\" class=\"sub-input\"/><input name=\"email\" placeholder=\"Email\" class=\"sub-input\"/><button type=\"button\" class=\"sub-btn\">Submit</button></div></div></div></div><div class=\"copyright\"><div class=\"container-width\"><div class=\"made-with\">\n              made with GrapesJS\n            </div><div class=\"foot-social-btns\">facebook twitter linkedin mail</div><div class=\"clearfix\"></div></div></div></footer>', '* { box-sizing: border-box; } body {margin: 0;}.clearfix{clear:both;}.header-banner{padding-top:35px;padding-bottom:100px;color:#ffffff;font-family:Helvetica, serif;font-weight:100;background-image:url(\"//grapesjs.com/img/bg-gr-v.png\"), url(\"//grapesjs.com/img/work-desk.jpg\");background-attachment:scroll, scroll;background-position:left top, center center;background-repeat:repeat-y, no-repeat;background-size:contain, cover;}.container-width{width:90%;max-width:1150px;margin:0 auto;}.logo-container{float:left;width:50%;}.logo{background-color:#fff;border-radius:5px;width:130px;padding:10px;min-height:30px;text-align:center;line-height:30px;color:#4d114f;font-size:23px;}.menu{float:right;width:50%;}.menu-item{float:right;font-size:15px;color:#eee;width:130px;padding:10px;min-height:50px;text-align:center;line-height:30px;font-weight:400;}.lead-title{margin:150px 0 30px 0;font-size:40px;}.sub-lead-title{max-width:650px;line-height:30px;margin-bottom:30px;color:#c6c6c6;}.lead-btn{margin-top:15px;padding:10px;width:190px;min-height:30px;font-size:20px;text-align:center;letter-spacing:3px;line-height:30px;background-color:#d983a6;border-radius:5px;transition:all 0.5s ease;cursor:pointer;}.lead-btn:hover{background-color:#ffffff;color:#4c114e;}.lead-btn:active{background-color:#4d114f;color:#fff;}.flex-sect{background-color:#fafafa;padding:100px 0;font-family:Helvetica, serif;}.flex-title{margin-bottom:15px;font-size:2em;text-align:center;font-weight:700;color:#555;padding:5px;}.flex-desc{margin-bottom:55px;font-size:1em;color:rgba(0, 0, 0, 0.5);text-align:center;padding:5px;}.cards{padding:20px 0;display:flex;justify-content:space-around;flex-flow:wrap;}.card{background-color:white;height:300px;width:300px;margin-bottom:30px;box-shadow:0 1px 2px 0 rgba(0, 0, 0, 0.2);border-radius:2px;transition:all 0.5s ease;font-weight:100;overflow:hidden;}.card:hover{margin-top:-5px;box-shadow:0 20px 30px 0 rgba(0, 0, 0, 0.2);}.card-header{height:155px;background-image:url(\"//placehold.it/350x250/78c5d6/fff/image1.jpg\");background-size:cover;background-position:center center;}.card-header.ch2{background-image:url(\"//placehold.it/350x250/459ba8/fff/image2.jpg\");}.card-header.ch3{background-image:url(\"//placehold.it/350x250/79c267/fff/image3.jpg\");}.card-header.ch4{background-image:url(\"//placehold.it/350x250/c5d647/fff/image4.jpg\");}.card-header.ch5{background-image:url(\"//placehold.it/350x250/f28c33/fff/image5.jpg\");}.card-header.ch6{background-image:url(\"//placehold.it/350x250/e868a2/fff/image6.jpg\");}.card-body{padding:15px 15px 5px 15px;color:#555;}.card-title{font-size:1.4em;margin-bottom:5px;}.card-sub-title{color:#b3b3b3;font-size:1em;margin-bottom:15px;}.card-desc{font-size:0.85rem;line-height:17px;}.am-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica, serif;}.img-phone{float:left;}.am-container{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around;}.am-content{float:left;padding:7px;width:490px;color:#444;font-weight:100;margin-top:50px;undefined:undefined;}.am-pre{padding:7px;color:#b1b1b1;font-size:15px;}.am-title{padding:7px;font-size:25px;font-weight:400;}.am-desc{padding:7px;font-size:17px;line-height:25px;}.am-post{padding:7px;line-height:25px;font-size:13px;}.blk-sect{padding-top:100px;padding-bottom:100px;background-color:#222222;font-family:Helvetica, serif;}.blk-title{color:#fff;font-size:25px;text-align:center;margin-bottom:15px;}.blk-desc{color:#b1b1b1;font-size:15px;text-align:center;max-width:700px;margin:0 auto;font-weight:100;}.price-cards{margin-top:70px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around;}.price-card-cont{width:300px;padding:7px;float:left;}.price-card{margin:0 auto;min-height:350px;background-color:#d983a6;border-radius:5px;font-weight:100;color:#fff;width:90%;}.pc-title{font-weight:100;letter-spacing:3px;text-align:center;font-size:25px;background-color:rgba(0, 0, 0, 0.1);padding:20px;}.pc-desc{padding:75px 0;text-align:center;}.pc-feature{color:rgba(255,255,255,0.5);background-color:rgba(0, 0, 0, 0.1);letter-spacing:2px;font-size:15px;padding:10px 20px;}.pc-feature:nth-of-type(2n){background-color:transparent;}.pc-amount{background-color:rgba(0, 0, 0, 0.1);font-size:35px;text-align:center;padding:35px 0;}.pc-regular{background-color:#da78a0;}.pc-enterprise{background-color:#d66a96;}.footer-under{background-color:#312833;padding-bottom:100px;padding-top:100px;min-height:500px;color:#eee;position:relative;font-weight:100;font-family:Helvetica,serif;}.copyright{background-color:rgba(0, 0, 0, 0.15);color:rgba(238, 238, 238, 0.5);bottom:0;padding:1em 0;position:absolute;width:100%;font-size:0.75em;}.made-with{float:left;width:50%;padding:5px 0;}.foot-social-btns{display:none;float:right;width:50%;text-align:right;padding:5px 0;}.footer-container{display:flex;flex-wrap:wrap;align-items:stretch;justify-content:space-around;}.foot-list{float:left;width:200px;}.foot-list-title{font-weight:400;margin-bottom:10px;padding:0.5em 0;}.foot-list-item{color:rgba(238, 238, 238, 0.8);font-size:0.8em;padding:0.5em 0;}.foot-list-item:hover{color:rgba(238, 238, 238, 1);}.foot-form-cont{width:300px;float:right;}.foot-form-title{color:rgba(255,255,255,0.75);font-weight:400;margin-bottom:10px;padding:0.5em 0;text-align:right;font-size:2em;}.foot-form-desc{font-size:0.8em;color:rgba(255,255,255,0.55);line-height:20px;text-align:right;margin-bottom:15px;}.sub-input{width:100%;margin-bottom:15px;padding:7px 10px;border-radius:2px;color:#fff;background-color:#554c57;border:none;}.sub-btn{width:100%;margin:15px 0;background-color:#785580;border:none;color:#fff;border-radius:2px;padding:7px 10px;font-size:1em;cursor:pointer;}.sub-btn:hover{background-color:#91699a;}.sub-btn:active{background-color:#573f5c;}.bdg-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica, serif;background-color:#fafafa;}.bdg-title{text-align:center;font-size:2em;margin-bottom:55px;color:#555555;}.badges{padding:20px;display:flex;justify-content:space-around;align-items:flex-start;flex-wrap:wrap;}.badge{width:290px;font-family:Helvetica, serif;background-color:white;margin-bottom:30px;box-shadow:0 2px 2px 0 rgba(0, 0, 0, 0.2);border-radius:3px;font-weight:100;overflow:hidden;text-align:center;}.badge-header{height:115px;background-image:url(\"//grapesjs.com/img/bg-gr-v.png\"), url(\"//grapesjs.com/img/work-desk.jpg\");background-position:left top, center center;background-attachment:scroll, fixed;overflow:hidden;}.badge-name{font-size:1.4em;margin-bottom:5px;}.badge-role{color:#777;font-size:1em;margin-bottom:25px;}.badge-desc{font-size:0.85rem;line-height:20px;}.badge-avatar{width:100px;height:100px;border-radius:100%;border:5px solid #fff;box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2);margin-top:-75px;position:relative;}.badge-body{margin:35px 10px;}.badge-foot{color:#fff;background-color:#a290a5;padding-top:13px;padding-bottom:13px;display:flex;justify-content:center;}.badge-link{height:35px;width:35px;line-height:35px;font-weight:700;background-color:#fff;color:#a290a5;display:block;border-radius:100%;margin:0 10px;}@media (max-width: 768px){.foot-form-cont{width:400px;}.foot-form-title{width:autopx;}}@media (max-width: 480px){.foot-lists{display:none;}}', ''),
(4, 'Liên Hệ', 1, '<section class=\"am-sect\"><div class=\"container-width\"><div class=\"am-container\"><img onmousedown=\"return false\" src=\"http://localhost/dienmay/public/admin/gjs/img/phone-app.png\" class=\"img-phone\"/><div class=\"am-content\"><div class=\"am-pre\">ASSET MANAGER</div><div class=\"am-title\">Manage your images with Asset Manager</div><div class=\"am-desc\">You can create image blocks with the command from the left panel and edit them with double click</div><div class=\"am-post\">Image uploading is not allowed in this demo</div></div></div></div></section><section class=\"blk-sect\"><div class=\"container-width\"><div class=\"blk-title\">Blocks</div><div class=\"blk-desc\">Each element in HTML page could be seen as a block. On the left panel you could find different kind of blocks that you can create, move and style</div><div class=\"price-cards\"><div class=\"price-card-cont\"><div class=\"price-card\"><div class=\"pc-title\">Starter</div><div class=\"pc-desc\">Some random list</div><div class=\"pc-feature odd-feat\">+ Starter feature 1</div><div class=\"pc-feature\">+ Starter feature 2</div><div class=\"pc-feature odd-feat\">+ Starter feature 3</div><div class=\"pc-feature\">+ Starter feature 4</div><div class=\"pc-amount odd-feat\">$ 9,90/mo</div></div></div><div class=\"price-card-cont\"><div class=\"price-card pc-regular\"><div class=\"pc-title\">Regular</div><div class=\"pc-desc\">Some random list</div><div id=\"i7pan\" class=\"pc-feature odd-feat\">+ Regular feature 1<a href=\"\" class=\"link\"></a></div><div class=\"pc-feature\">+ Regular feature 2</div><div class=\"pc-feature odd-feat\">+ Regular feature 3</div><div class=\"pc-feature\">+ Regular feature 4</div><div class=\"pc-amount odd-feat\">$ 19,90/mo</div></div></div><div class=\"price-card-cont\"><div class=\"price-card pc-enterprise\"><div class=\"pc-title\">Enterprise</div><div class=\"pc-desc\">Some random list</div><div class=\"pc-feature odd-feat\">+ Enterprise feature 1</div><div class=\"pc-feature\">+ Enterprise feature 2</div><div class=\"pc-feature odd-feat\">+ Enterprise feature 3</div><div class=\"pc-feature\">+ Enterprise feature 4</div><div class=\"pc-amount odd-feat\">$ 29,90/mo</div></div></div></div></div></section><section class=\"bdg-sect\"><div class=\"container-width\"><h1 class=\"bdg-title\">The team</h1><div class=\"badges\"><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team1.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">Adam Smith</div><div class=\"badge-role\">CEO</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team2.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">John Black</div><div class=\"badge-role\">Software Engineer</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team3.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">Jessica White</div><div class=\"badge-role\">Web Designer</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div></div></div></section><footer class=\"footer-under\"><div class=\"container-width\"><div class=\"footer-container\"><div class=\"foot-lists\"><div class=\"foot-list\"><div class=\"foot-list-title\">About us</div><div class=\"foot-list-item\">Contact</div><div class=\"foot-list-item\">Events</div><div class=\"foot-list-item\">Company</div><div class=\"foot-list-item\">Jobs</div><div class=\"foot-list-item\">Blog</div></div><div class=\"foot-list\"><div class=\"foot-list-title\">Services</div><div class=\"foot-list-item\">Education</div><div class=\"foot-list-item\">Partner</div><div class=\"foot-list-item\">Community</div><div class=\"foot-list-item\">Forum</div><div class=\"foot-list-item\">Download</div><div class=\"foot-list-item\">Upgrade</div></div><div class=\"clearfix\"></div></div><div class=\"form-sub\"><div class=\"foot-form-cont\"><div class=\"foot-form-title\">Subscribe</div><div class=\"foot-form-desc\">Subscribe to our newsletter to receive exclusive offers and the latest news</div><input name=\"name\" placeholder=\"Name\" class=\"sub-input\"/><input name=\"email\" placeholder=\"Email\" class=\"sub-input\"/><button type=\"button\" class=\"sub-btn\">Submit</button></div></div></div></div><div class=\"copyright\"><div class=\"container-width\"><div class=\"made-with\">\n              made with GrapesJS\n            </div><div class=\"foot-social-btns\">facebook twitter linkedin mail</div><div class=\"clearfix\"></div></div></div></footer>', '* { box-sizing: border-box; } body {margin: 0;}.clearfix{clear:both;}.container-width{width:90%;max-width:1150px;margin:0 auto;}.am-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica, serif;}.img-phone{float:left;}.am-container{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around;}.am-content{float:left;padding:7px;width:490px;color:#444;font-weight:100;margin-top:50px;undefined:undefined;}.am-pre{padding:7px;color:#b1b1b1;font-size:15px;}.am-title{padding:7px;font-size:25px;font-weight:400;}.am-desc{padding:7px;font-size:17px;line-height:25px;}.am-post{padding:7px;line-height:25px;font-size:13px;}.blk-sect{padding-top:100px;padding-bottom:100px;background-color:#222222;font-family:Helvetica, serif;}.blk-title{color:#fff;font-size:25px;text-align:center;margin-bottom:15px;}.blk-desc{color:#b1b1b1;font-size:15px;text-align:center;max-width:700px;margin:0 auto;font-weight:100;}.price-cards{margin-top:70px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around;}.price-card-cont{width:300px;padding:7px;float:left;}.price-card{margin:0 auto;min-height:350px;background-color:#d983a6;border-radius:5px;font-weight:100;color:#fff;width:90%;}.pc-title{font-weight:100;letter-spacing:3px;text-align:center;font-size:25px;background-color:rgba(0, 0, 0, 0.1);padding:20px;}.pc-desc{padding:75px 0;text-align:center;}.pc-feature{color:rgba(255,255,255,0.5);background-color:rgba(0, 0, 0, 0.1);letter-spacing:2px;font-size:15px;padding:10px 20px;}.pc-feature:nth-of-type(2n){background-color:transparent;}.pc-amount{background-color:rgba(0, 0, 0, 0.1);font-size:35px;text-align:center;padding:35px 0;}.pc-regular{background-color:#da78a0;}.pc-enterprise{background-color:#d66a96;}.footer-under{background-color:#312833;padding-bottom:100px;padding-top:100px;min-height:500px;color:#eee;position:relative;font-weight:100;font-family:Helvetica,serif;}.copyright{background-color:rgba(0, 0, 0, 0.15);color:rgba(238, 238, 238, 0.5);bottom:0;padding:1em 0;position:absolute;width:100%;font-size:0.75em;}.made-with{float:left;width:50%;padding:5px 0;}.foot-social-btns{display:none;float:right;width:50%;text-align:right;padding:5px 0;}.footer-container{display:flex;flex-wrap:wrap;align-items:stretch;justify-content:space-around;}.foot-list{float:left;width:200px;}.foot-list-title{font-weight:400;margin-bottom:10px;padding:0.5em 0;}.foot-list-item{color:rgba(238, 238, 238, 0.8);font-size:0.8em;padding:0.5em 0;}.foot-list-item:hover{color:rgba(238, 238, 238, 1);}.foot-form-cont{width:300px;float:right;}.foot-form-title{color:rgba(255,255,255,0.75);font-weight:400;margin-bottom:10px;padding:0.5em 0;text-align:right;font-size:2em;}.foot-form-desc{font-size:0.8em;color:rgba(255,255,255,0.55);line-height:20px;text-align:right;margin-bottom:15px;}.sub-input{width:100%;margin-bottom:15px;padding:7px 10px;border-radius:2px;color:#fff;background-color:#554c57;border:none;}.sub-btn{width:100%;margin:15px 0;background-color:#785580;border:none;color:#fff;border-radius:2px;padding:7px 10px;font-size:1em;cursor:pointer;}.sub-btn:hover{background-color:#91699a;}.sub-btn:active{background-color:#573f5c;}.bdg-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica, serif;background-color:#fafafa;}.bdg-title{text-align:center;font-size:2em;margin-bottom:55px;color:#555555;}.badges{padding:20px;display:flex;justify-content:space-around;align-items:flex-start;flex-wrap:wrap;}.badge{width:290px;font-family:Helvetica, serif;background-color:white;margin-bottom:30px;box-shadow:0 2px 2px 0 rgba(0, 0, 0, 0.2);border-radius:3px;font-weight:100;overflow:hidden;text-align:center;}.badge-header{height:115px;background-image:url(\"//grapesjs.com/img/bg-gr-v.png\"), url(\"//grapesjs.com/img/work-desk.jpg\");background-position:left top, center center;background-attachment:scroll, fixed;overflow:hidden;}.badge-name{font-size:1.4em;margin-bottom:5px;}.badge-role{color:#777;font-size:1em;margin-bottom:25px;}.badge-desc{font-size:0.85rem;line-height:20px;}.badge-avatar{width:100px;height:100px;border-radius:100%;border:5px solid #fff;box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2);margin-top:-75px;position:relative;}.badge-body{margin:35px 10px;}.badge-foot{color:#fff;background-color:#a290a5;padding-top:13px;padding-bottom:13px;display:flex;justify-content:center;}.badge-link{height:35px;width:35px;line-height:35px;font-weight:700;background-color:#fff;color:#a290a5;display:block;border-radius:100%;margin:0 10px;}@media (max-width: 768px){.foot-form-cont{width:400px;}.foot-form-title{width:autopx;}}@media (max-width: 480px){.foot-lists{display:none;}}', ''),
(5, 'Kinh Nghiệm Hay', 1, '<section class=\"am-sect\"><div class=\"container-width\"><div class=\"am-container\"><img onmousedown=\"return false\" src=\"http://localhost/dienmay/public/admin/gjs/img/phone-app.png\" class=\"img-phone\"/><div class=\"am-content\"><div class=\"am-pre\">ASSET MANAGER</div><div class=\"am-title\">Manage your images with Asset Manager</div><div class=\"am-desc\">You can create image blocks with the command from the left panel and edit them with double click</div><div class=\"am-post\">Image uploading is not allowed in this demo</div></div></div></div></section><section class=\"bdg-sect\"><div class=\"container-width\"><h1 class=\"bdg-title\">The team</h1><div class=\"badges\"><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team1.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">Adam Smith</div><div class=\"badge-role\">CEO</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team2.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">John Black</div><div class=\"badge-role\">Software Engineer</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div><div class=\"badge\"><div class=\"badge-header\"></div><img src=\"http://localhost/dienmay/public/admin/gjs/img/team3.jpg\" class=\"badge-avatar\"/><div class=\"badge-body\"><div class=\"badge-name\">Jessica White</div><div class=\"badge-role\">Web Designer</div><div class=\"badge-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit</div></div><div class=\"badge-foot\"><span class=\"badge-link\">f</span><span class=\"badge-link\">t</span><span class=\"badge-link\">ln</span></div></div></div></div></section><footer class=\"footer-under\"><div class=\"container-width\"><div class=\"footer-container\"><div class=\"foot-lists\"><div class=\"foot-list\"><div class=\"foot-list-title\">About us</div><div class=\"foot-list-item\">Contact</div><div class=\"foot-list-item\">Events</div><div class=\"foot-list-item\">Company</div><div class=\"foot-list-item\">Jobs</div><div class=\"foot-list-item\">Blog</div></div><div class=\"foot-list\"><div class=\"foot-list-title\">Services</div><div class=\"foot-list-item\">Education</div><div class=\"foot-list-item\">Partner</div><div class=\"foot-list-item\">Community</div><div class=\"foot-list-item\">Forum</div><div class=\"foot-list-item\">Download</div><div class=\"foot-list-item\">Upgrade</div></div><div class=\"clearfix\"></div></div><div class=\"form-sub\"><div class=\"foot-form-cont\"><div class=\"foot-form-title\">Subscribe</div><div class=\"foot-form-desc\">Subscribe to our newsletter to receive exclusive offers and the latest news</div><input name=\"name\" placeholder=\"Name\" class=\"sub-input\"/><input name=\"email\" placeholder=\"Email\" class=\"sub-input\"/><button type=\"button\" class=\"sub-btn\">Submit</button></div></div></div></div><div class=\"copyright\"><div class=\"container-width\"><div class=\"made-with\">\n              made with GrapesJS\n            </div><div class=\"foot-social-btns\">facebook twitter linkedin mail</div><div class=\"clearfix\"></div></div></div></footer>', '* { box-sizing: border-box; } body {margin: 0;}.clearfix{clear:both;}.container-width{width:90%;max-width:1150px;margin:0 auto;}.am-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica, serif;}.img-phone{float:left;}.am-container{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around;}.am-content{float:left;padding:7px;width:490px;color:#444;font-weight:100;margin-top:50px;undefined:undefined;}.am-pre{padding:7px;color:#b1b1b1;font-size:15px;}.am-title{padding:7px;font-size:25px;font-weight:400;}.am-desc{padding:7px;font-size:17px;line-height:25px;}.am-post{padding:7px;line-height:25px;font-size:13px;}.footer-under{background-color:#312833;padding-bottom:100px;padding-top:100px;min-height:500px;color:#eee;position:relative;font-weight:100;font-family:Helvetica,serif;}.copyright{background-color:rgba(0, 0, 0, 0.15);color:rgba(238, 238, 238, 0.5);bottom:0;padding:1em 0;position:absolute;width:100%;font-size:0.75em;}.made-with{float:left;width:50%;padding:5px 0;}.foot-social-btns{display:none;float:right;width:50%;text-align:right;padding:5px 0;}.footer-container{display:flex;flex-wrap:wrap;align-items:stretch;justify-content:space-around;}.foot-list{float:left;width:200px;}.foot-list-title{font-weight:400;margin-bottom:10px;padding:0.5em 0;}.foot-list-item{color:rgba(238, 238, 238, 0.8);font-size:0.8em;padding:0.5em 0;}.foot-list-item:hover{color:rgba(238, 238, 238, 1);}.foot-form-cont{width:300px;float:right;}.foot-form-title{color:rgba(255,255,255,0.75);font-weight:400;margin-bottom:10px;padding:0.5em 0;text-align:right;font-size:2em;}.foot-form-desc{font-size:0.8em;color:rgba(255,255,255,0.55);line-height:20px;text-align:right;margin-bottom:15px;}.sub-input{width:100%;margin-bottom:15px;padding:7px 10px;border-radius:2px;color:#fff;background-color:#554c57;border:none;}.sub-btn{width:100%;margin:15px 0;background-color:#785580;border:none;color:#fff;border-radius:2px;padding:7px 10px;font-size:1em;cursor:pointer;}.sub-btn:hover{background-color:#91699a;}.sub-btn:active{background-color:#573f5c;}.bdg-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica, serif;background-color:#fafafa;}.bdg-title{text-align:center;font-size:2em;margin-bottom:55px;color:#555555;}.badges{padding:20px;display:flex;justify-content:space-around;align-items:flex-start;flex-wrap:wrap;}.badge{width:290px;font-family:Helvetica, serif;background-color:white;margin-bottom:30px;box-shadow:0 2px 2px 0 rgba(0, 0, 0, 0.2);border-radius:3px;font-weight:100;overflow:hidden;text-align:center;}.badge-header{height:115px;background-image:url(\"//grapesjs.com/img/bg-gr-v.png\"), url(\"//grapesjs.com/img/work-desk.jpg\");background-position:left top, center center;background-attachment:scroll, fixed;overflow:hidden;}.badge-name{font-size:1.4em;margin-bottom:5px;}.badge-role{color:#777;font-size:1em;margin-bottom:25px;}.badge-desc{font-size:0.85rem;line-height:20px;}.badge-avatar{width:100px;height:100px;border-radius:100%;border:5px solid #fff;box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2);margin-top:-75px;position:relative;}.badge-body{margin:35px 10px;}.badge-foot{color:#fff;background-color:#a290a5;padding-top:13px;padding-bottom:13px;display:flex;justify-content:center;}.badge-link{height:35px;width:35px;line-height:35px;font-weight:700;background-color:#fff;color:#a290a5;display:block;border-radius:100%;margin:0 10px;}@media (max-width: 768px){.foot-form-cont{width:400px;}.foot-form-title{width:autopx;}}@media (max-width: 480px){.foot-lists{display:none;}}', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_payment`
--

CREATE TABLE `ub_payment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `status` int(11) NOT NULL,
  `banner` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ub_payment`
--

INSERT INTO `ub_payment` (`id`, `name`, `data`, `status`, `banner`) VALUES
(1, 'Paypal', '{\"username\":\"haongodev_api1.gmail.com\",\"password\":\"G6MSC9MM636HV8B8\",\"signature\":\"AUL5SpfcA-iN.9TnYLATDlEHkkKOAOcY7Oqtoi3YW9ArKle1jBnUm8Xa\",\"status\":\"on\"}', 1, 'paypal-logo2.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_product`
--

CREATE TABLE `ub_product` (
  `id` int(255) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `type_id` int(100) NOT NULL,
  `brand_id` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(225) CHARACTER SET utf8 NOT NULL,
  `maker_id` int(255) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `view` int(11) NOT NULL DEFAULT 0,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `site_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `total` int(255) NOT NULL,
  `buyed` int(255) NOT NULL,
  `rate_total` int(255) NOT NULL,
  `rate_count` int(255) NOT NULL,
  `infomation` text COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hotdeal` int(11) NOT NULL,
  `in_stock` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ub_product`
--

INSERT INTO `ub_product` (`id`, `catalog_id`, `type_id`, `brand_id`, `name`, `title`, `maker_id`, `price`, `content`, `discount`, `created`, `view`, `meta_key`, `site_title`, `total`, `buyed`, `rate_total`, `rate_count`, `infomation`, `video`, `meta_desc`, `hotdeal`, `in_stock`) VALUES
(355, 102, 85, 28, 'Lightweight Jacket', 'lightweight-jacket', 9, '1999999.0000', '<p>Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc</p>\r\n\r\n<ol>\r\n	<li>Weight : 0.79 kg</li>\r\n	<li>Dimensions : 110 x 33 x 100 cm</li>\r\n	<li>Materials : 60% cotton</li>\r\n	<li>Color : Black, Blue, Grey, Green, Red, White</li>\r\n	<li>Size : X,L, L, M, S</li>\r\n</ol>\r\n', 200000, '2019-09-05 15:40:22', 12, '[\"jacket,Lightweight,men\"]', 'Lightweight Jacket', 0, 0, 0, 0, '', '', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 199),
(357, 87, 83, 11, 'Pieces Metallic Printed', 'pieces-metallic-printed', 9, '999999.0000', '<p>Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</p>\r\n\r\n<ul>\r\n	<li>Weight : 0.79 kg</li>\r\n	<li>Dimensions : 110 x 33 x 100 cm</li>\r\n	<li>Materials : 60% cotton</li>\r\n	<li>Color : Black, Blue, Grey, Green, Red, White</li>\r\n	<li>Size : X,L, L, M, S</li>\r\n</ul>\r\n', 19999, '2019-09-05 16:00:51', 54, '[\"Pieces,Metallic, Printed,woman,lady\"]', 'Pieces Metallic Printed', 0, 0, 0, 0, '', '', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 123),
(358, 93, 84, 5, 'Herschel supply Watch', 'herschel-supply-watch', 9, '9888888.0000', '<ul>\r\n	<li>Weight : 0.79 kg</li>\r\n	<li>Color : Black</li>\r\n	<li>Size : 15cm</li>\r\n</ul>\r\n', 0, '2019-09-05 16:06:53', 7, '[\"Herschel,supply,Watch,men,woman\"]', 'Herschel supply Watch', 0, 0, 0, 0, '', '', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', 0, 11),
(359, 103, 84, 29, 'Herschel supply T-shirt', 'herschel-supply-t-shirt', 9, '899999.0000', '<p>Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</p>\r\n', 0, '2019-09-05 16:10:23', 79, '[\"Herschel supply T-shirt\"]', 'Herschel supply T-shirt', 0, 0, 0, 0, '', '', 'Herschel supply T-shirt', 0, 999),
(360, 103, 84, 29, 'Pretty Little Thing', 'pretty-little-thing', 9, '388888.0000', '<p>Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</p>\r\n', 0, '2019-09-05 16:13:05', 82, '[\"Pretty,Little\"]', 'Pretty Little Thing', 0, 0, 0, 0, '', '', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 113),
(361, 91, 84, 5, 'Converse All Star Hi Plimsolls', 'converse-all-star-hi-plimsolls', 9, '2999999.0000', '<p>Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</p>\r\n', 0, '2019-09-05 16:15:51', 22, '[\"Converse,Converse All Star,Hi Plimsolls\"]', 'Converse All Star Hi Plimsolls', 0, 0, 0, 0, '', '', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 199),
(362, 87, 83, 11, 'Classic Trench Coat', 'classic-trench-coat', 9, '2999999.0000', '<p>Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.</p>\r\n\r\n<ul>\r\n	<li>Weight0.79 kg</li>\r\n	<li>Dimensions110 x 33 x 100 cm</li>\r\n	<li>Materials60% cotton</li>\r\n	<li>ColorBlack, Blue, Grey, Green, Red, White</li>\r\n	<li>SizeXL, L, M, S</li>\r\n</ul>\r\n', 0, '2019-09-05 16:28:26', 1, '[\"coat,trench,woman\"]', 'Classic Trench Coat', 0, 0, 0, 0, '', '', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 199);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_profile`
--

CREATE TABLE `ub_profile` (
  `id` int(100) NOT NULL,
  `giao_duc` varchar(255) NOT NULL,
  `vi_tri` varchar(255) NOT NULL,
  `ki_nang` text NOT NULL,
  `ghi_chu` text NOT NULL,
  `ban_be` text NOT NULL,
  `nguoi_theo_doi` text NOT NULL,
  `dang_theo_doi` text NOT NULL,
  `id_adm` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_setting`
--

CREATE TABLE `ub_setting` (
  `id` int(128) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ub_setting`
--

INSERT INTO `ub_setting` (`id`, `name`, `data`, `created`) VALUES
(1, 'setting_info', '{\"name_site\":\"HaoNgoGia\",\"email\":\"haongodev@gmail.com\",\"phone\":\"0972918120\",\"map\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m14!1m8!1m3!1d15674.447983846125!2d106.74860900000002!3d10.840976!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527b6e99c0d81%3A0x68b73efd6bfdc8b8!2zMTkwIMSQxrDhu51uZyBT4buRIDExLCBQaMaw4bubYyBMb25nLCBUaOG7pyDEkOG7qWMsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2sus!4v1566614578153!5m2!1svi!2sus\",\"address\":\"190, \\u0110\\u01b0\\u1eddng 11, P.Tr\\u01b0\\u1eddng Th\\u1ecd, Q.Th\\u1ee7 \\u0110\\u1ee8c, TP.HCM, Vi\\u1ec7t Nam\\t\",\"logo_site\":\"logo-01.png\"}', '2019-08-31 17:00:00'),
(2, 'setting_resources', '{\"horizontal\":\"1920\",\"vertical\":\"980\",\"type_allow\":\"jpg|png|gif\",\"max_size\":\"1024\",\"count\":\"3\",\"re_horizontal_1\":\"270\",\"re_vertical_1\":\"335\",\"re_horizontal_2\":\"70\",\"re_vertical_2\":\"85\",\"re_horizontal_3\":\"25\",\"re_vertical_3\":\"40\"}', '2019-09-15 17:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_shippingfee`
--

CREATE TABLE `ub_shippingfee` (
  `id` int(100) NOT NULL,
  `citi` varchar(255) NOT NULL,
  `fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ub_shippingfee`
--

INSERT INTO `ub_shippingfee` (`id`, `citi`, `fee`) VALUES
(2, 'TP.HCM', 30000),
(3, 'Phú Yên', 50000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_slide`
--

CREATE TABLE `ub_slide` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ub_slide`
--

INSERT INTO `ub_slide` (`id`, `name`, `image_name`, `image_link`, `link`, `info`, `sort_order`) VALUES
(1, 'Men Collection 2019', '', 'slide-03.jpg', 'https://www.facebook.com/profile.php?id=100009628893770', 'New Arrivals', 3),
(2, 'Women Collection 2019', '', 'slide-01.jpg', 'https://www.facebook.com/profile.php?id=100009628893770', 'New Season', 1),
(13, 'Men new-season', '', 'slide-02.jpg', 'https://www.facebook.com/profile.php?id=100009628893770', 'Jacket & Coats', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_theme`
--

CREATE TABLE `ub_theme` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `screen` text NOT NULL,
  `author` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `version` text NOT NULL,
  `created` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ub_theme`
--

INSERT INTO `ub_theme` (`id`, `name`, `status`, `screen`, `author`, `description`, `version`, `created`) VALUES
(14, 'cozastore', 1, 'http://localhost/coza-store/public/theme/cozastore/assets/screen.png', '9', 'cozastore là một trang web thương mại điện thử tích hợp đầy đủ những chức năng cần thiết để sử dụng trong việc kinh doanh mua bán ngoài ra nó còn sở hữu riêng 1 trang quản trị đầy đủ tính năng mới', 'version 1.0.1', '1563457641'),
(15, 'cozastore_2', 0, 'http://localhost/coza-store/public/theme/cozastore_2/assets/screen.png', '9', 'theme cozastore phiên bản thứ 2', 'version 1.1.0', '1563623695'),
(16, 'cozastore_3', 0, 'http://localhost/coza-store/public/theme/cozastore_3/assets/screen.png', '9', 'theme cozastore phiên bản thứ 3', 'version 1.2.1', '1563624584');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_transaction`
--

CREATE TABLE `ub_transaction` (
  `id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `citi` text COLLATE utf8_bin NOT NULL,
  `postcode` int(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `amount` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `usd` decimal(15,4) NOT NULL,
  `payment` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paypal_fee` text COLLATE utf8_bin DEFAULT NULL,
  `note` text COLLATE utf8_bin DEFAULT NULL,
  `user_address` varchar(255) COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `ub_transaction`
--

INSERT INTO `ub_transaction` (`id`, `status`, `citi`, `postcode`, `user_id`, `user_name`, `user_email`, `user_phone`, `amount`, `usd`, `payment`, `paypal_fee`, `note`, `user_address`, `created`) VALUES
(119, 1, '50000', 700000, 0, 'haongo', 'haongodev@gmail.com', '0972918120', '4849998.0000', '206.8500', 'Paypal', '6.30', 'nothing haha', '190/d11', '2019-09-23 18:34:16'),
(118, 1, '50000', 700000, 0, 'haongo', 'haodev@gmail.com', '0972918120', '3438887.0000', '148.2000', 'Normal', NULL, 'nothing can\'t hold me back', '190/d11', '2019-09-23 18:28:48'),
(120, 1, '30000', 700000, 0, 'haongo123', 'yang123@gmail.com', '0972918120', '3418887.0000', '145.9500', 'Paypal', '4.53', 'nothing', '11 street/thuduc/hcm/vietnam', '2019-09-25 13:03:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ub_user`
--

CREATE TABLE `ub_user` (
  `id` int(255) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 NOT NULL,
  `country` varchar(255) CHARACTER SET utf8 NOT NULL,
  `postcode` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` text COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8 NOT NULL,
  `birthday` text COLLATE utf8_unicode_ci NOT NULL,
  `more` text COLLATE utf8_unicode_ci NOT NULL,
  `oauth_provider` varchar(255) CHARACTER SET utf8 NOT NULL,
  `oauth_uid` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ub_user`
--

INSERT INTO `ub_user` (`id`, `name`, `email`, `phone`, `address`, `city`, `country`, `postcode`, `password`, `created`, `avatar`, `link`, `gender`, `birthday`, `more`, `oauth_provider`, `oauth_uid`) VALUES
(32, 'haongo123', 'yangyooseob1996@gmail.com', '0972918120', '92/p,trtho,qthuduc', '', '', '', '941db28d59ddf87d9f9d08b447081263', '1519982415', '', '0', '', '00:00:00', '', '', '0'),
(33, 'tichuot', 'yang123@gmail.com', '0972918120', '13b/letrungkien', '', '', '', '941db28d59ddf87d9f9d08b447081263', '1522137800', '', '0', '', '00:00:00', '', '', '0'),
(42, 'Hao Ngo', 'yangyooseob1996@gmail.com', '', '', '', '', '', '', '1570171106', 'https://lh3.googleusercontent.com/a-/AAuE7mBk6xlcdy-eA436TqQbfj2esbN1YA5vANsVnETMLw=s50', NULL, '', '', '', 'google', '102479559042158546405'),
(43, 'Hào Ngô', 'haongodev@gmail.com', '', '', '', '', '', '', '1570171471', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1037183356612618&height=300&width=300&ext=1572763471&hash=AeRYKEWR0Olsd4Ik', '', '', '07/20/1996', '', 'facebook', '1037183356612618'),
(44, 'hao ngo', 'haongodev@gmail.com', '', '', '', '', '', '', '1570268959', 'https://lh3.googleusercontent.com/-gwjcdypnYIc/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reM53WtcfQ5QQEgV0lOYM1qqvIiIQ/s50/photo.jpg', NULL, '', '', '', 'google', '111512042573069125208'),
(45, 'Sáo Trúc Kim Đính', 'phamkimdinh1792001@gmail.com', '', '', '', '', '', '', '1570271101', 'https://lh3.googleusercontent.com/a-/AAuE7mAfzKddoBnd_MovU2mz-oDrR_hZfa7kSaETD78tsw=s300', NULL, '', '', '', 'google', '117790572050498953048');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ub_admin`
--
ALTER TABLE `ub_admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_atribute`
--
ALTER TABLE `ub_atribute`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_brand`
--
ALTER TABLE `ub_brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_category`
--
ALTER TABLE `ub_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_comment`
--
ALTER TABLE `ub_comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_hotdeal`
--
ALTER TABLE `ub_hotdeal`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_info`
--
ALTER TABLE `ub_info`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `ub_info` ADD FULLTEXT KEY `title` (`title`);

--
-- Chỉ mục cho bảng `ub_list_menu`
--
ALTER TABLE `ub_list_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_menu`
--
ALTER TABLE `ub_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Chỉ mục cho bảng `ub_news`
--
ALTER TABLE `ub_news`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `ub_news` ADD FULLTEXT KEY `title` (`title`);

--
-- Chỉ mục cho bảng `ub_order`
--
ALTER TABLE `ub_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_page`
--
ALTER TABLE `ub_page`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_payment`
--
ALTER TABLE `ub_payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_product`
--
ALTER TABLE `ub_product`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `ub_product` ADD FULLTEXT KEY `name` (`name`);

--
-- Chỉ mục cho bảng `ub_profile`
--
ALTER TABLE `ub_profile`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_setting`
--
ALTER TABLE `ub_setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_shippingfee`
--
ALTER TABLE `ub_shippingfee`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_slide`
--
ALTER TABLE `ub_slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_theme`
--
ALTER TABLE `ub_theme`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_transaction`
--
ALTER TABLE `ub_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ub_user`
--
ALTER TABLE `ub_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ub_admin`
--
ALTER TABLE `ub_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `ub_atribute`
--
ALTER TABLE `ub_atribute`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT cho bảng `ub_brand`
--
ALTER TABLE `ub_brand`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `ub_category`
--
ALTER TABLE `ub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT cho bảng `ub_comment`
--
ALTER TABLE `ub_comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `ub_hotdeal`
--
ALTER TABLE `ub_hotdeal`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `ub_info`
--
ALTER TABLE `ub_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `ub_menu`
--
ALTER TABLE `ub_menu`
  MODIFY `id_menu` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT cho bảng `ub_news`
--
ALTER TABLE `ub_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `ub_order`
--
ALTER TABLE `ub_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT cho bảng `ub_page`
--
ALTER TABLE `ub_page`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `ub_payment`
--
ALTER TABLE `ub_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `ub_product`
--
ALTER TABLE `ub_product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT cho bảng `ub_profile`
--
ALTER TABLE `ub_profile`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ub_setting`
--
ALTER TABLE `ub_setting`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `ub_shippingfee`
--
ALTER TABLE `ub_shippingfee`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `ub_slide`
--
ALTER TABLE `ub_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `ub_theme`
--
ALTER TABLE `ub_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `ub_transaction`
--
ALTER TABLE `ub_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT cho bảng `ub_user`
--
ALTER TABLE `ub_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

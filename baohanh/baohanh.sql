-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2017 at 04:01 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baohanh`
--

-- --------------------------------------------------------

--
-- Table structure for table `lib_api`
--

CREATE TABLE IF NOT EXISTS `lib_api` (
  `api_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`api_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lib_api`
--

INSERT INTO `lib_api` (`api_id`, `username`, `firstname`, `lastname`, `password`, `status`, `date_added`, `date_modified`) VALUES
(1, 'GbOxanTqHWXgwTxvfrXX4RezEO7GjSIofq2beHf6lz2JbfUeGYs7KMWBuIIoa6WT', '', '', 'Ry376eEFdKtnekOFE7Zay9mGx5qFoc70byRWvsAFsY8A4hgjZYevypPCOjlYP05Q7qDn7zU8VdkPrWL5Hr78MNP1CG4jOGRi1bMwhyAtVbjW1ENJN3wD7nmiOfkmkP9sJDsxepFWsS6VZomPp69BG5XHwxniTQFuxilryYg1cApNUGZNf3j0mGfjs6DVaJjpz52dfAUPjlw7majEtrgieIA3B81C44ZcNLgHkegfEEQjRmGxTX1JvD3Fr2BkvinH', 1, '2016-08-08 07:53:50', '2016-08-08 07:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `lib_category`
--

CREATE TABLE IF NOT EXISTS `lib_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_category_description`
--

CREATE TABLE IF NOT EXISTS `lib_category_description` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lib_category_path`
--

CREATE TABLE IF NOT EXISTS `lib_category_path` (
  `category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`path_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lib_category_to_layout`
--

CREATE TABLE IF NOT EXISTS `lib_category_to_layout` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lib_category_to_store`
--

CREATE TABLE IF NOT EXISTS `lib_category_to_store` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lib_country`
--

CREATE TABLE IF NOT EXISTS `lib_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=259 ;

--
-- Dumping data for table `lib_country`
--

INSERT INTO `lib_country` (`country_id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `postcode_required`, `status`) VALUES
(230, 'Viet Nam', 'VN', 'VNM', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_customer`
--

CREATE TABLE IF NOT EXISTS `lib_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lib_customer`
--

INSERT INTO `lib_customer` (`customer_id`, `customer_name`, `address`, `telephone`, `status`, `date_added`) VALUES
(5, 'Nguyễn Thanh Phong', '128 Dĩ An, Bình Dương', '0123576844', 1, '2017-04-14 09:46:15'),
(6, 'Nguyễn Văn Tuấn', '126 B Nguyen Thi Dinh', '0123456789', 1, '2017-04-15 13:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `lib_event`
--

CREATE TABLE IF NOT EXISTS `lib_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_extension`
--

CREATE TABLE IF NOT EXISTS `lib_extension` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `lib_extension`
--

INSERT INTO `lib_extension` (`extension_id`, `type`, `code`) VALUES
(28, 'module', 'html');

-- --------------------------------------------------------

--
-- Table structure for table `lib_guarantee`
--

CREATE TABLE IF NOT EXISTS `lib_guarantee` (
  `guarantee_id` int(11) NOT NULL AUTO_INCREMENT,
  `guarantee_name` varchar(250) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`guarantee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lib_guarantee`
--

INSERT INTO `lib_guarantee` (`guarantee_id`, `guarantee_name`, `status`) VALUES
(3, '24 tháng', 1),
(4, '36 tháng', 1),
(5, '12 tháng', 1),
(6, '48 tháng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_language`
--

CREATE TABLE IF NOT EXISTS `lib_language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lib_language`
--

INSERT INTO `lib_language` (`language_id`, `name`, `code`, `locale`, `image`, `directory`, `sort_order`, `status`) VALUES
(1, 'English', 'en', 'en_US.UTF-8,en_US,en-gb,english', 'vn.png', 'english', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_layout`
--

CREATE TABLE IF NOT EXISTS `lib_layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `lib_layout`
--

INSERT INTO `lib_layout` (`layout_id`, `name`) VALUES
(1, 'Home'),
(4, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `lib_layout_module`
--

CREATE TABLE IF NOT EXISTS `lib_layout_module` (
  `layout_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `position` varchar(14) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`layout_module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=653 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_layout_route`
--

CREATE TABLE IF NOT EXISTS `lib_layout_route` (
  `layout_route_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY (`layout_route_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `lib_layout_route`
--

INSERT INTO `lib_layout_route` (`layout_route_id`, `layout_id`, `store_id`, `route`) VALUES
(144, 1, 0, 'common/home'),
(10, 4, 0, 'common/home');

-- --------------------------------------------------------

--
-- Table structure for table `lib_manufacturer`
--

CREATE TABLE IF NOT EXISTS `lib_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lib_manufacturer`
--

INSERT INTO `lib_manufacturer` (`manufacturer_id`, `manufacturer_name`, `image`, `website`, `status`) VALUES
(4, 'USB', 'catalog/logoivvoice.png', 'www.cameraipwifi.info', 1),
(5, 'CAMERA', 'catalog/logoivvoice.png', 'poq.vn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_menu`
--

CREATE TABLE IF NOT EXISTS `lib_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `column` int(3) NOT NULL DEFAULT '1',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `target_link` text NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `lib_menu`
--

INSERT INTO `lib_menu` (`menu_id`, `parent_id`, `column`, `sort_order`, `status`, `target_link`, `group_id`) VALUES
(45, 45, 1, 0, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib_menu_description`
--

CREATE TABLE IF NOT EXISTS `lib_menu_description` (
  `menu_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`menu_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lib_menu_description`
--

INSERT INTO `lib_menu_description` (`menu_id`, `language_id`, `name`, `description`) VALUES
(45, 1, 'Kiem tra', '');

-- --------------------------------------------------------

--
-- Table structure for table `lib_menu_path`
--

CREATE TABLE IF NOT EXISTS `lib_menu_path` (
  `menu_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lib_menu_path`
--

INSERT INTO `lib_menu_path` (`menu_id`, `path_id`, `level`) VALUES
(45, 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_menu_to_store`
--

CREATE TABLE IF NOT EXISTS `lib_menu_to_store` (
  `menu_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lib_menu_to_store`
--

INSERT INTO `lib_menu_to_store` (`menu_id`, `store_id`) VALUES
(45, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib_modification`
--

CREATE TABLE IF NOT EXISTS `lib_modification` (
  `modification_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `code` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `version` varchar(32) NOT NULL,
  `link` varchar(255) NOT NULL,
  `xml` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`modification_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_module`
--

CREATE TABLE IF NOT EXISTS `lib_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `code` varchar(32) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_order`
--

CREATE TABLE IF NOT EXISTS `lib_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(32) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(64) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `date_added` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `lib_order`
--

INSERT INTO `lib_order` (`order_id`, `customer_id`, `customer_name`, `address`, `telephone`, `status`, `date_added`) VALUES
(26, 0, 'Nguyễn Thanh Phong', '128 Dĩ An, Bình Dương', '0975121452', 1, '16/04/2017'),
(31, 0, 'Nguyễn Thanh Phong', '128 Dĩ An, Bình Dương', '0123576844', 1, '15/08/2017'),
(28, 0, 'Nguyễn Văn Tuấn', '126 B Nguyen Thi Dinh', '0987123123', 1, '16/04/2017'),
(29, 6, 'Nguyễn Văn Tuấn', '126 B Nguyen Thi Dinh', '0987123123', 1, '12/05/2017');

-- --------------------------------------------------------

--
-- Table structure for table `lib_order_product`
--

CREATE TABLE IF NOT EXISTS `lib_order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `imei` varchar(250) NOT NULL,
  `codecolor` int(11) NOT NULL,
  `quantity_order` int(4) NOT NULL,
  `manufacturer` varchar(250) NOT NULL,
  `guarantee` varchar(250) NOT NULL,
  `website` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`order_product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `lib_order_product`
--

INSERT INTO `lib_order_product` (`order_product_id`, `order_id`, `product_id`, `name_product`, `imei`, `codecolor`, `quantity_order`, `manufacturer`, `guarantee`, `website`, `image`, `price`, `total`) VALUES
(98, 28, 7, 'Camera IP Wifi P2Pvision 6203 HD 720P xoay 360 độ (Đen Trắng)', 'CMRIPYS1500', 0, 1, 'CAMERA', '12 tháng', 'poq.vn', 'catalog/logoivvoice.png', '1250000.0000', '1250000.0000'),
(99, 28, 8, 'Camera IP Wifi YooSee 720P xoay 360 độ (Trắng)', 'CMRIP720', 0, 3, 'USB', '12 tháng', 'www.cameraipwifi.info', 'catalog/logoivvoice.png', '785000.0000', '2355000.0000'),
(92, 26, 8, 'Camera IP Wifi YooSee 720P xoay 360 độ (Trắng)', 'IMEI001', 0, 1, 'USB', '12 tháng', 'www.cameraipwifi.info', 'catalog/logoivvoice.png', '785000.0000', '785000.0000'),
(93, 26, 9, 'Camera IP Wifi YooSee YS1500 xoay 360 độ (Trắng)', '', 0, 1, 'USB', '48 tháng', 'www.cameraipwifi.info', 'catalog/logoivvoice.png', '1250000.0000', '1250000.0000'),
(100, 29, 9, 'Camera IP Wifi YooSee YS1500 xoay 360 độ (Trắng)', 'DEMO124564', 15000, 1, 'USB', '48 tháng', 'www.cameraipwifi.info', 'catalog/logoivvoice.png', '1250000.0000', '1250000.0000'),
(104, 31, 9, 'Camera IP Wifi YooSee YS1500 xoay 360 độ (Trắng)', 'imei02112', 1, 1, 'USB', '48 tháng', 'www.cameraipwifi.info', 'catalog/logoivvoice.png', '1250000.0000', '1250000.0000');

-- --------------------------------------------------------

--
-- Table structure for table `lib_product`
--

CREATE TABLE IF NOT EXISTS `lib_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(64) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `manufacturer_id` int(11) NOT NULL,
  `guarantee_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `lib_product`
--

INSERT INTO `lib_product` (`product_id`, `model`, `quantity`, `price`, `manufacturer_id`, `guarantee_id`, `date_added`, `status`) VALUES
(7, 'CMRP2P', 50, '1250000.0000', 5, 5, '2017-04-04 09:24:28', 1),
(8, 'CMR720P', 20, '785000.0000', 4, 5, '2017-04-04 09:16:41', 1),
(9, 'CMRYS1500', 10, '1250000.0000', 4, 6, '2017-04-04 09:17:15', 1),
(11, 'CMRVR360', 2, '899000.0000', 4, 5, '2017-04-04 09:30:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_product_description`
--

CREATE TABLE IF NOT EXISTS `lib_product_description` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lib_product_description`
--

INSERT INTO `lib_product_description` (`product_id`, `name`) VALUES
(7, 'Camera IP Wifi P2Pvision 6203 HD 720P xoay 360 độ (Đen Trắng)'),
(8, 'Camera IP Wifi YooSee 720P xoay 360 độ (Trắng)'),
(9, 'Camera IP Wifi YooSee YS1500 xoay 360 độ (Trắng)'),
(11, 'Camera IP Wifi VR 360 độ (Trắng)');

-- --------------------------------------------------------

--
-- Table structure for table `lib_product_to_category`
--

CREATE TABLE IF NOT EXISTS `lib_product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lib_product_to_layout`
--

CREATE TABLE IF NOT EXISTS `lib_product_to_layout` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lib_product_to_layout`
--

INSERT INTO `lib_product_to_layout` (`product_id`, `store_id`, `layout_id`) VALUES
(8, 0, 0),
(7, 0, 0),
(9, 0, 0),
(11, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib_product_to_store`
--

CREATE TABLE IF NOT EXISTS `lib_product_to_store` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lib_product_to_store`
--

INSERT INTO `lib_product_to_store` (`product_id`, `store_id`) VALUES
(7, 0),
(8, 0),
(9, 0),
(11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib_setting`
--

CREATE TABLE IF NOT EXISTS `lib_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11339 ;

--
-- Dumping data for table `lib_setting`
--

INSERT INTO `lib_setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
(284, 0, 'scheduler', 'backup_configuration', 'a:7:{s:13:"backup_tables";a:0:{}s:22:"backup_tables_excludes";a:0:{}s:14:"backup_options";s:5:"email";s:18:"backup_destination";s:21:"garidinh006@gmail.com";s:20:"backup_next_schedule";s:19:"2016/08/08 01:10:57";s:15:"backup_schedule";s:10:"once_daily";s:13:"backup_enable";b:0;}', 0),
(11327, 0, 'config', 'config_mail', 'a:7:{s:8:"protocol";s:4:"mail";s:9:"parameter";s:0:"";s:13:"smtp_hostname";s:0:"";s:13:"smtp_username";s:0:"";s:13:"smtp_password";s:0:"";s:9:"smtp_port";s:0:"";s:12:"smtp_timeout";s:0:"";}', 1),
(11326, 0, 'config', 'config_ftp_status', '0', 0),
(11325, 0, 'config', 'config_ftp_root', '', 0),
(11322, 0, 'config', 'config_ftp_port', '21', 0),
(11323, 0, 'config', 'config_ftp_username', '', 0),
(11324, 0, 'config', 'config_ftp_password', '', 0),
(11321, 0, 'config', 'config_ftp_hostname', 'www.yoursite.com', 0),
(11320, 0, 'config', 'config_image_thumb_height', '135', 0),
(11319, 0, 'config', 'config_image_thumb_width', '105', 0),
(11318, 0, 'config', 'config_icon', '', 0),
(11317, 0, 'config', 'config_logo', 'catalog/header.jpg', 0),
(11316, 0, 'config', 'config_api_id', '1', 0),
(11315, 0, 'config', 'config_login_attempts', '5', 0),
(11314, 0, 'config', 'config_limit_admin', '25', 0),
(11313, 0, 'config', 'config_product_limit', '15', 0),
(11312, 0, 'config', 'config_product_count', '1', 0),
(11311, 0, 'config', 'config_admin_language', 'en', 0),
(11310, 0, 'config', 'config_language', 'en', 0),
(11309, 0, 'config', 'config_country_id', '230', 0),
(11308, 0, 'config', 'config_layout_id', '4', 0),
(11307, 0, 'config', 'config_template', 'default', 0),
(11306, 0, 'config', 'config_meta_keyword', 'Kiểm tra bảo hành', 0),
(11305, 0, 'config', 'config_meta_description', 'Kiểm tra bảo hành', 0),
(11304, 0, 'config', 'config_meta_title', 'Kiểm tra bảo hành', 0),
(11303, 0, 'config', 'config_telephone', '0123456789', 0),
(11302, 0, 'config', 'config_email', 'demo@gmail.com', 0),
(11301, 0, 'config', 'config_address', '126 B, Nguyen Thi Dinh, Quan 2', 0),
(11300, 0, 'config', 'config_owner', 'Thanh Phong', 0),
(11299, 0, 'config', 'config_name', 'Kiểm tra bảo hành', 0),
(11328, 0, 'config', 'config_mail_alert', '', 0),
(11329, 0, 'config', 'config_secure', '0', 0),
(11330, 0, 'config', 'config_seo_url', '0', 0),
(11331, 0, 'config', 'config_file_max_size', '300000', 0),
(11332, 0, 'config', 'config_maintenance', '0', 0),
(11333, 0, 'config', 'config_password', '0', 0),
(11334, 0, 'config', 'config_compression', '', 0),
(11335, 0, 'config', 'config_error_display', '1', 0),
(11336, 0, 'config', 'config_error_log', '1', 0),
(11337, 0, 'config', 'config_error_filename', 'error.log', 0),
(11338, 0, 'config', 'config_google_analytics', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib_store`
--

CREATE TABLE IF NOT EXISTS `lib_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ssl` varchar(255) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_url_alias`
--

CREATE TABLE IF NOT EXISTS `lib_url_alias` (
  `url_alias_id` int(11) NOT NULL AUTO_INCREMENT,
  `query` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`url_alias_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=644 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_user`
--

CREATE TABLE IF NOT EXISTS `lib_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lib_user`
--

INSERT INTO `lib_user` (`user_id`, `user_group_id`, `username`, `password`, `salt`, `firstname`, `lastname`, `email`, `image`, `code`, `ip`, `status`, `date_added`) VALUES
(5, 1, 'admin', 'c8f1858a3a8670a9ed8afb1258f38a0cf57461ec', 'bc5441a35', 'gari', 'dinh', 'demo@gmail.com', '', '', '127.0.0.1', 1, '2017-08-15 08:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `lib_user_group`
--

CREATE TABLE IF NOT EXISTS `lib_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lib_user_group`
--

INSERT INTO `lib_user_group` (`user_group_id`, `name`, `permission`) VALUES
(1, 'Administrator', 'a:2:{s:6:"access";a:43:{i:0;s:16:"catalog/category";i:1;s:17:"catalog/guarantee";i:2;s:20:"catalog/manufacturer";i:3;s:12:"catalog/menu";i:4;s:15:"catalog/product";i:5;s:18:"common/column_left";i:6;s:27:"common/download_filemanager";i:7;s:18:"common/filemanager";i:8;s:22:"common/filemanager_old";i:9;s:19:"common/header_login";i:10;s:11:"common/menu";i:11;s:14:"common/profile";i:12;s:18:"dashboard/activity";i:13;s:18:"dashboard/customer";i:14;s:21:"dashboard/information";i:15;s:16:"dashboard/online";i:16;s:13:"design/layout";i:17;s:14:"extension/feed";i:18;s:26:"extension/installer - Copy";i:19;s:19:"extension/installer";i:20;s:22:"extension/modification";i:21;s:16:"extension/module";i:22;s:20:"localisation/country";i:23;s:21:"localisation/language";i:24;s:25:"localisation/order_status";i:25;s:17:"marketing/contact";i:26;s:11:"module/html";i:27;s:15:"report/customer";i:28;s:20:"report/productviewed";i:29;s:17:"report/sale_order";i:30;s:16:"report/warehouse";i:31;s:13:"sale/customer";i:32;s:10:"sale/order";i:33;s:15:"setting/setting";i:34;s:13:"setting/store";i:35;s:11:"tool/backup";i:36;s:14:"tool/error_log";i:37;s:17:"tool/file_manager";i:38;s:23:"tool/file_manager_frame";i:39;s:21:"tool/scheduled_backup";i:40;s:8:"user/api";i:41;s:9:"user/user";i:42;s:20:"user/user_permission";}s:6:"modify";a:43:{i:0;s:16:"catalog/category";i:1;s:17:"catalog/guarantee";i:2;s:20:"catalog/manufacturer";i:3;s:12:"catalog/menu";i:4;s:15:"catalog/product";i:5;s:18:"common/column_left";i:6;s:27:"common/download_filemanager";i:7;s:18:"common/filemanager";i:8;s:22:"common/filemanager_old";i:9;s:19:"common/header_login";i:10;s:11:"common/menu";i:11;s:14:"common/profile";i:12;s:18:"dashboard/activity";i:13;s:18:"dashboard/customer";i:14;s:21:"dashboard/information";i:15;s:16:"dashboard/online";i:16;s:13:"design/layout";i:17;s:14:"extension/feed";i:18;s:26:"extension/installer - Copy";i:19;s:19:"extension/installer";i:20;s:22:"extension/modification";i:21;s:16:"extension/module";i:22;s:20:"localisation/country";i:23;s:21:"localisation/language";i:24;s:25:"localisation/order_status";i:25;s:17:"marketing/contact";i:26;s:11:"module/html";i:27;s:15:"report/customer";i:28;s:20:"report/productviewed";i:29;s:17:"report/sale_order";i:30;s:16:"report/warehouse";i:31;s:13:"sale/customer";i:32;s:10:"sale/order";i:33;s:15:"setting/setting";i:34;s:13:"setting/store";i:35;s:11:"tool/backup";i:36;s:14:"tool/error_log";i:37;s:17:"tool/file_manager";i:38;s:23:"tool/file_manager_frame";i:39;s:21:"tool/scheduled_backup";i:40;s:8:"user/api";i:41;s:9:"user/user";i:42;s:20:"user/user_permission";}}'),
(10, 'Manager', 'a:2:{s:6:"access";a:12:{i:0;s:16:"catalog/category";i:1;s:17:"catalog/guarantee";i:2;s:20:"catalog/manufacturer";i:3;s:12:"catalog/menu";i:4;s:15:"catalog/product";i:5;s:18:"common/filemanager";i:6;s:15:"report/customer";i:7;s:20:"report/productviewed";i:8;s:17:"report/sale_order";i:9;s:16:"report/warehouse";i:10;s:13:"sale/customer";i:11;s:10:"sale/order";}s:6:"modify";a:12:{i:0;s:16:"catalog/category";i:1;s:17:"catalog/guarantee";i:2;s:20:"catalog/manufacturer";i:3;s:15:"catalog/product";i:4;s:18:"dashboard/customer";i:5;s:21:"dashboard/information";i:6;s:15:"report/customer";i:7;s:20:"report/productviewed";i:8;s:17:"report/sale_order";i:9;s:16:"report/warehouse";i:10;s:13:"sale/customer";i:11;s:10:"sale/order";}}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

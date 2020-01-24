

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` text NOT NULL,
  `page_url` text NOT NULL,
  `page_order` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO page VALUES("1","JSON - Dynamic Dependent Dropdown List using Jquery and Ajax","json-dynamic-dependent-dropdown-list-using-jquery-and-ajax","0");
INSERT INTO page VALUES("2","Live Table Data Edit Delete using Tabledit Plugin in PHP","live-table-data-edit-delete-using-tabledit-plugin-in-php","5");
INSERT INTO page VALUES("3","Create Treeview with Bootstrap Treeview Ajax JQuery in PHP
","create-treeview-with-bootstrap-treeview-ajax-jquery-in-php","7");
INSERT INTO page VALUES("4","Bootstrap Multiselect Dropdown with Checkboxes using Jquery in PHP
","bootstrap-multiselect-dropdown-with-checkboxes-using-jquery-in-php","1");
INSERT INTO page VALUES("5","Facebook Style Popup Notification using PHP Ajax Bootstrap
","facebook-style-popup-notification-using-php-ajax-bootstrap","3");
INSERT INTO page VALUES("6","Modal with Dynamic Previous & Next Data Button by Ajax PHP
","modal-with-dynamic-previous-next-data-button-by-ajax-php","8");
INSERT INTO page VALUES("7","How to Use Bootstrap Select Plugin with Ajax Jquery PHP
","how-to-use-bootstrap-select-plugin-with-ajax-jquery-php","9");
INSERT INTO page VALUES("8","How to Load CSV File data into HTML Table Using AJAX jQuery
","how-to-load-csv-file-data-into-html-table-using-ajax-jquery","4");
INSERT INTO page VALUES("9","Autocomplete Textbox using Typeahead with Ajax PHP Bootstrap
","autocomplete-textbox-using-typeahead-with-ajax-php-bootstrap","6");
INSERT INTO page VALUES("10","Export Data to Excel in Codeigniter using PHPExcel
","export-data-to-excel-in-codeigniter-using-phpexcel","2");



CREATE TABLE `tbl_admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_mobile` varchar(255) NOT NULL,
  `admin_state` int(11) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_profile` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_admins VALUES("1","Prashant","prashant@agriconfertilizers.com","9974071765","1","admin@123","uploads/admin/IMG_5d525cb06d8fa.png","2019-08-13 12:16:08","2019-08-13 12:16:08");
INSERT INTO tbl_admins VALUES("2","admin","admin@admin.com","9898363557","1","admin","","2019-10-12 17:34:48","2019-09-11 19:56:25");
INSERT INTO tbl_admins VALUES("3","Demo Admin","admin@demo.com","9898363557","1","123456","","2019-10-16 22:48:17","2019-10-16 22:48:17");



CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_category VALUES("2","Namkeen","2019-09-14 10:56:27");
INSERT INTO tbl_category VALUES("3","Chevda","2019-09-14 10:56:33");



CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_city VALUES("1","1","Vadodara","2019-08-13 12:14:44");



CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_pincode` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_landline` varchar(255) DEFAULT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `customer_gst` varchar(255) DEFAULT NULL,
  `customer_gst_type` enum('1','2') DEFAULT NULL,
  `customer_gst_certificate` varchar(255) DEFAULT NULL,
  `customer_mode_of_payment` varchar(255) DEFAULT NULL,
  `customer_pan` varchar(255) DEFAULT NULL,
  `customer_aadhaar` varchar(255) DEFAULT NULL,
  `customer_aadhaar_number` varchar(255) DEFAULT NULL,
  `customer_food_license_certificate` varchar(255) DEFAULT NULL,
  `customer_credit_limit` varchar(11) DEFAULT NULL,
  `customer_credit_limit_days` varchar(11) DEFAULT NULL,
  `customer_security_deposit` varchar(255) DEFAULT NULL,
  `customer_bank_name` varchar(255) DEFAULT NULL,
  `customer_payment_type` varchar(255) DEFAULT NULL,
  `customer_cheque_number` varchar(255) DEFAULT NULL COMMENT 'dd or cheque number',
  `customer_additional_details` varchar(1000) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `updated_at` varchar(500) DEFAULT NULL,
  `created_at` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO tbl_customer VALUES("3","","2","asda","","","","2adasd@demo.com","12345","","9898363557","asd45645","1","e689028fe8fca5c804fa66148a8212e2.png","","","c2947838b953f889c631f73a08ba06b6.jfif","asd546","4fe4d7f012f6cbb0bcc7645f95b4e8f5.jpg","","","0","0","0","0","0","1","","");
INSERT INTO tbl_customer VALUES("2","","2","Vijay Sharma","Vijay","A-39 Navrang Society","390024","vijay@demo.com","123456","","9898363557","GST12345678","1","ede63280ce3f776e3e15faa0a3343c34.png","","","5c5d19c56fadc879ef2494dbc0ac3512.png","AAD16669587","5e9beccb39a79d4e433a788784fafd73.jpg","","","0","0","0","0","0","1","","");
INSERT INTO tbl_customer VALUES("4","","2","asd","","A-39 Navrang Society","","asd@demo.com","12345","","959595959595","asdasdasd","2","c9501e7dbd149780aab77e478030cdce.png","Cash","AEB14564789","60b91a367a57b2d9f62879f025eb18e6.png","adsas164565","cf580a9c04aa2640acfcbd2851abb39d.png","","","0","0","0","0","0","1","","");
INSERT INTO tbl_customer VALUES("5","ND/00005","2","asdasd","","A-39 Navrang Society","","asdas@demo.com","126456","","959595959595","gst45621345","2","","Cash","DSD4549DAS5","","asdas5d6","","50000","10","0","0","0","0","0","1","","");
INSERT INTO tbl_customer VALUES("6","ND/00006","2","Neeraj Agrawal","Neeraj Agrawal","New Sama Road","390025","neeraj@customer.com","123456","","9898363557","GST123456798","1","","","4451248987456AS456","","AAD125485","","25000","10","0","0","0","0","0","1","","");
INSERT INTO tbl_customer VALUES("7","ND/00007","2","Sanjiv Malviya","Sanjiv Malviya","New Sama Road","390025","sanjivm43@gmail.com","123456","0265363636","9898363557","GST123456","2","","Cash","PAN456256625","","AAD15856325S58","","50000","5","0","0","0","0","0","1","","");
INSERT INTO tbl_customer VALUES("8","ND/00008","2","Dev Patel","Dev","New Sama","390025","devpatel001@gmail.com","123456","9595959595","9898363557","asdasda","1","","","","","asdas456645","","","","50000","SBI","CASH","CHK452856","asdasd","1","","");
INSERT INTO tbl_customer VALUES("9","ND/00009","3","customer","customer","vadodara","390024","customer@demo.com","123456","","9898363557","GST124654789","1","","Cash","PAN45612456","","AAD15252545","","50000","25","10000","SBI","Savings","DD/14452635","","1","","");
INSERT INTO tbl_customer VALUES("10","ND/00010","3","Customer 2","Customer 2","Vadodara","390024","customer2@demo.com","123456","","9898363557","GST456213","1","","Cash","N/A","","N/A","","25000","30","10000","SBI","Cash","DD/1525652","N/A","1","","");



CREATE TABLE `tbl_customer_outstanding` (
  `customer_outstanding_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_person_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_outstanding_type` enum('1','2') NOT NULL COMMENT '1-debit,2-credit',
  `customer_outstanding_amount` varchar(255) NOT NULL,
  `customer_outstanding_date` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`customer_outstanding_id`)
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=utf8;

INSERT INTO tbl_customer_outstanding VALUES("2","","13","1","25422.00","2019-08-18","2019-08-19 14:55:07","2019-08-19 14:55:07");
INSERT INTO tbl_customer_outstanding VALUES("3","","12","2","9469.00","2019-08-18","2019-08-19 14:57:37","2019-08-19 14:57:37");
INSERT INTO tbl_customer_outstanding VALUES("4","","153","1","6348706.12 ","2019-08-18","2019-08-19 15:11:13","2019-08-19 15:11:13");
INSERT INTO tbl_customer_outstanding VALUES("5","","78","1","342298.00 ","2019-08-18","2019-08-19 15:15:45","2019-08-19 15:15:45");
INSERT INTO tbl_customer_outstanding VALUES("6","","140","2","11000.00 ","2019-08-18","2019-08-19 15:16:24","2019-08-19 15:16:24");
INSERT INTO tbl_customer_outstanding VALUES("7","","156","1","23351.00 ","2019-08-18","2019-08-19 15:18:46","2019-08-19 15:18:46");
INSERT INTO tbl_customer_outstanding VALUES("8","","289","2","1429.00 ","2019-08-18","2019-08-19 15:19:45","2019-08-19 15:19:45");
INSERT INTO tbl_customer_outstanding VALUES("9","","312","1","384805.00 ","2019-08-18","2019-08-19 15:20:33","2019-08-19 15:20:33");
INSERT INTO tbl_customer_outstanding VALUES("10","","313","2","428.00 ","2019-08-18","2019-08-19 15:21:28","2019-08-19 15:21:28");
INSERT INTO tbl_customer_outstanding VALUES("11","","340","2","582955.00 ","2019-08-18","2019-08-19 15:22:15","2019-08-19 15:22:15");
INSERT INTO tbl_customer_outstanding VALUES("12","","412","1","501309.00","2019-08-18","2019-08-19 15:23:11","2019-08-19 15:23:11");
INSERT INTO tbl_customer_outstanding VALUES("13","","453","1","209143.00 ","2019-08-18","2019-08-19 15:24:45","2019-08-19 15:24:45");
INSERT INTO tbl_customer_outstanding VALUES("14","","16","1","36967.00 ","2019-08-18","2019-08-19 15:30:44","2019-08-19 15:30:44");
INSERT INTO tbl_customer_outstanding VALUES("15","","19","2","131112.00 ","2019-08-18","2019-08-19 15:31:20","2019-08-19 15:31:20");
INSERT INTO tbl_customer_outstanding VALUES("16","","35","1","1272.00 ","2019-08-18","2019-08-19 15:32:10","2019-08-19 15:32:10");
INSERT INTO tbl_customer_outstanding VALUES("17","","36","2","41.00 ","2019-08-18","2019-08-19 15:32:51","2019-08-19 15:32:51");
INSERT INTO tbl_customer_outstanding VALUES("18","","67","1","926.00 ","2019-08-18","2019-08-19 15:34:43","2019-08-19 15:34:43");
INSERT INTO tbl_customer_outstanding VALUES("19","","121","1","1805.00 ","2019-08-18","2019-08-19 15:35:22","2019-08-19 15:35:22");
INSERT INTO tbl_customer_outstanding VALUES("20","","166","1","143945.00 ","2019-08-18","2019-08-19 15:36:00","2019-08-19 15:36:00");
INSERT INTO tbl_customer_outstanding VALUES("21","","269","1","3440.00 ","2019-08-18","2019-08-19 15:37:16","2019-08-19 15:37:16");
INSERT INTO tbl_customer_outstanding VALUES("22","","294","2","236.00 ","2019-08-18","2019-08-19 15:37:52","2019-08-19 15:37:52");
INSERT INTO tbl_customer_outstanding VALUES("23","","378","1","163564.00 ","2019-08-18","2019-08-19 15:41:09","2019-08-19 15:41:09");
INSERT INTO tbl_customer_outstanding VALUES("24","","382","1","23322.00","2019-08-18","2019-08-19 15:44:27","2019-08-19 15:44:27");
INSERT INTO tbl_customer_outstanding VALUES("25","","431","1","34200.00 ","2019-08-18","2019-08-19 15:46:10","2019-08-19 15:46:10");
INSERT INTO tbl_customer_outstanding VALUES("26","","206","1","161450.12 ","2019-08-18","2019-08-19 15:49:58","2019-08-19 15:49:58");
INSERT INTO tbl_customer_outstanding VALUES("27","","241","1","26075.00 ","2019-08-18","2019-08-19 15:50:48","2019-08-19 15:50:48");
INSERT INTO tbl_customer_outstanding VALUES("28","","267","1","204896.00","2019-08-18","2019-08-19 15:51:56","2019-08-19 15:51:56");
INSERT INTO tbl_customer_outstanding VALUES("29","","351","1","150820.00 ","2019-08-18","2019-08-19 15:52:42","2019-08-19 15:52:42");
INSERT INTO tbl_customer_outstanding VALUES("30","","420","1","63939.00 ","2019-08-18","2019-08-19 16:01:11","2019-08-19 16:01:11");
INSERT INTO tbl_customer_outstanding VALUES("31","","46","2","60057.00 ","2019-08-18","2019-08-19 16:02:43","2019-08-19 16:02:43");
INSERT INTO tbl_customer_outstanding VALUES("32","","358","1","24080.00","2019-08-18","2019-08-19 16:03:24","2019-08-19 16:03:24");
INSERT INTO tbl_customer_outstanding VALUES("33","","354","1","1633036.00 ","2019-08-18","2019-08-19 16:11:47","2019-08-19 16:11:47");
INSERT INTO tbl_customer_outstanding VALUES("34","","370","1","739425.00 ","2019-08-18","2019-08-19 16:12:49","2019-08-19 16:12:49");
INSERT INTO tbl_customer_outstanding VALUES("35","","10","1","627386.00","2019-08-18","2019-08-19 16:14:27","2019-08-19 16:14:27");
INSERT INTO tbl_customer_outstanding VALUES("36","","42","2","77943.00 ","2019-08-18","2019-08-19 16:15:29","2019-08-19 16:15:29");
INSERT INTO tbl_customer_outstanding VALUES("37","","45","2","2785.00 ","2019-08-18","2019-08-19 16:17:12","2019-08-19 16:17:12");
INSERT INTO tbl_customer_outstanding VALUES("38","","54","2","20995.00","2019-08-18","2019-08-19 16:23:23","2019-08-19 16:23:23");
INSERT INTO tbl_customer_outstanding VALUES("39","","84","1","79931.00 ","2019-08-18","2019-08-19 16:24:34","2019-08-19 16:24:34");
INSERT INTO tbl_customer_outstanding VALUES("40","","130","1","332110.00 ","2019-08-18","2019-08-19 16:25:08","2019-08-19 16:25:08");
INSERT INTO tbl_customer_outstanding VALUES("41","","145","1","36580.00 ","2019-08-18","2019-08-19 16:25:55","2019-08-19 16:25:55");
INSERT INTO tbl_customer_outstanding VALUES("42","","176","1","1024.00 ","2019-08-18","2019-08-19 16:28:26","2019-08-19 16:28:26");
INSERT INTO tbl_customer_outstanding VALUES("43","","194","1","39337.00 ","2019-08-18","2019-08-19 16:29:41","2019-08-19 16:29:41");
INSERT INTO tbl_customer_outstanding VALUES("44","","196","1","494485.00 ","2019-08-18","2019-08-19 16:30:50","2019-08-19 16:30:50");
INSERT INTO tbl_customer_outstanding VALUES("45","","200","2","7414.00 ","2019-08-18","2019-08-19 16:35:20","2019-08-19 16:35:20");
INSERT INTO tbl_customer_outstanding VALUES("46","","221","1","34033.00 ","2019-08-18","2019-08-19 16:36:09","2019-08-19 16:36:09");
INSERT INTO tbl_customer_outstanding VALUES("47","","239","2","1902.00","2019-08-18","2019-08-19 16:36:51","2019-08-19 16:36:51");
INSERT INTO tbl_customer_outstanding VALUES("48","","320","1","22777.00 ","2019-08-18","2019-08-19 16:37:39","2019-08-19 16:37:39");
INSERT INTO tbl_customer_outstanding VALUES("49","","326","1","19473.00 ","2019-08-18","2019-08-19 16:44:24","2019-08-19 16:44:24");
INSERT INTO tbl_customer_outstanding VALUES("50","","336","1","2594.00 ","2019-08-18","2019-08-19 16:45:23","2019-08-19 16:45:23");
INSERT INTO tbl_customer_outstanding VALUES("51","","391","1","134670.00 ","2019-08-18","2019-08-19 16:46:20","2019-08-19 16:46:20");
INSERT INTO tbl_customer_outstanding VALUES("52","","398","1","137064.00 Dr","2019-08-18","2019-08-19 16:47:03","2019-08-19 16:47:03");
INSERT INTO tbl_customer_outstanding VALUES("53","","425","2","11000.00 ","2019-08-18","2019-08-19 16:49:20","2019-08-19 16:49:20");
INSERT INTO tbl_customer_outstanding VALUES("54","","476","2","244218.00 ","2019-08-18","2019-08-19 16:50:08","2019-08-19 16:50:08");
INSERT INTO tbl_customer_outstanding VALUES("55","","482","1","590171.00 ","2019-08-18","2019-08-19 16:51:50","2019-08-19 16:51:50");
INSERT INTO tbl_customer_outstanding VALUES("56","","506","2","37005.00 ","2019-08-18","2019-08-19 16:52:27","2019-08-19 16:52:27");
INSERT INTO tbl_customer_outstanding VALUES("57","","122","1","3583.00","2019-08-18","2019-08-19 16:53:40","2019-08-19 16:53:40");
INSERT INTO tbl_customer_outstanding VALUES("58","","224","1","719557.00","2019-08-18","2019-08-19 16:55:19","2019-08-19 16:55:19");
INSERT INTO tbl_customer_outstanding VALUES("59","","409","2","41565.00 ","2019-08-18","2019-08-19 16:56:55","2019-08-19 16:56:55");
INSERT INTO tbl_customer_outstanding VALUES("60","","24","1","13777.00 ","2019-08-18","2019-08-19 16:58:54","2019-08-19 16:58:54");
INSERT INTO tbl_customer_outstanding VALUES("61","","63","2","73703.00 ","2019-08-18","2019-08-19 16:59:37","2019-08-19 16:59:37");
INSERT INTO tbl_customer_outstanding VALUES("62","","90","2","4392.00 ","2019-08-18","2019-08-19 17:07:39","2019-08-19 17:07:39");
INSERT INTO tbl_customer_outstanding VALUES("63","","193","2","762.00 ","2019-08-18","2019-08-19 17:08:50","2019-08-19 17:08:50");
INSERT INTO tbl_customer_outstanding VALUES("64","","250","2","5503.00 ","2019-08-18","2019-08-19 17:09:31","2019-08-19 17:09:31");
INSERT INTO tbl_customer_outstanding VALUES("65","","353","2","35.00 ","2019-08-18","2019-08-19 17:11:43","2019-08-19 17:11:43");
INSERT INTO tbl_customer_outstanding VALUES("66","","359","1","328.00 ","2019-08-18","2019-08-19 17:13:51","2019-08-19 17:13:51");
INSERT INTO tbl_customer_outstanding VALUES("67","","408","1","336562.00 ","2019-08-18","2019-08-19 17:14:52","2019-08-19 17:14:52");
INSERT INTO tbl_customer_outstanding VALUES("68","","423","1","1103792.00 ","2019-08-18","2019-08-19 17:16:32","2019-08-19 17:16:32");
INSERT INTO tbl_customer_outstanding VALUES("69","","447","2","840.24","2019-08-18","2019-08-19 17:17:45","2019-08-19 17:17:45");
INSERT INTO tbl_customer_outstanding VALUES("70","","481","1","7516.00 ","2019-08-18","2019-08-19 17:18:26","2019-08-19 17:18:26");
INSERT INTO tbl_customer_outstanding VALUES("71","","493","2","185902.00 ","2019-08-18","2019-08-19 17:21:13","2019-08-19 17:21:13");
INSERT INTO tbl_customer_outstanding VALUES("72","","496","1","25123.00 ","2019-08-18","2019-08-19 17:23:01","2019-08-19 17:23:01");
INSERT INTO tbl_customer_outstanding VALUES("73","","167","1","140489.00 ","2019-08-18","2019-08-19 17:26:36","2019-08-19 17:26:36");
INSERT INTO tbl_customer_outstanding VALUES("74","","208","1","352923.00","2019-08-18","2019-08-19 17:27:22","2019-08-19 17:27:22");
INSERT INTO tbl_customer_outstanding VALUES("75","","274","1","39865.00 ","2019-08-18","2019-08-19 17:28:22","2019-08-19 17:28:22");
INSERT INTO tbl_customer_outstanding VALUES("76","","464","1","207728.00 ","2019-08-18","2019-08-19 17:29:33","2019-08-19 17:29:33");
INSERT INTO tbl_customer_outstanding VALUES("77","","73","1","665.00","2019-08-18","2019-08-19 17:31:25","2019-08-19 17:31:25");
INSERT INTO tbl_customer_outstanding VALUES("78","","110","1","117921.00","2019-08-18","2019-08-19 17:33:05","2019-08-19 17:33:05");
INSERT INTO tbl_customer_outstanding VALUES("79","","128","1","11172.00","2019-08-18","2019-08-19 17:33:45","2019-08-19 17:33:45");
INSERT INTO tbl_customer_outstanding VALUES("80","","149","1","52167.00 ","2019-08-18","2019-08-19 17:34:57","2019-08-19 17:34:57");
INSERT INTO tbl_customer_outstanding VALUES("81","","173","1","165281.00","2019-08-18","2019-08-19 17:36:04","2019-08-19 17:36:04");
INSERT INTO tbl_customer_outstanding VALUES("82","","177","1","86059.00","2019-08-18","2019-08-19 17:36:49","2019-08-19 17:36:49");
INSERT INTO tbl_customer_outstanding VALUES("83","","223","1","84760.00","2019-08-18","2019-08-19 17:37:43","2019-08-19 17:37:43");
INSERT INTO tbl_customer_outstanding VALUES("84","","229","1","295026.00","2019-08-18","2019-08-19 17:38:34","2019-08-19 17:38:34");
INSERT INTO tbl_customer_outstanding VALUES("85","","234","1","9392.00","2019-08-18","2019-08-19 17:39:15","2019-08-19 17:39:15");
INSERT INTO tbl_customer_outstanding VALUES("86","","256","1","658777.00","2019-08-18","2019-08-19 17:39:59","2019-08-19 17:39:59");
INSERT INTO tbl_customer_outstanding VALUES("87","","299","1","159572.00","2019-08-18","2019-08-19 17:40:42","2019-08-19 17:40:42");
INSERT INTO tbl_customer_outstanding VALUES("88","","315","1","18.00 ","2019-08-18","2019-08-19 17:41:19","2019-08-19 17:41:19");
INSERT INTO tbl_customer_outstanding VALUES("89","","317","1","189315.00","2019-08-18","2019-08-19 17:41:54","2019-08-19 17:41:54");
INSERT INTO tbl_customer_outstanding VALUES("90","","318","1","381579.20","2019-08-18","2019-08-19 17:42:29","2019-08-19 17:42:29");
INSERT INTO tbl_customer_outstanding VALUES("91","","331","1","106952.00","2019-08-18","2019-08-19 17:43:03","2019-08-19 17:43:03");
INSERT INTO tbl_customer_outstanding VALUES("92","","365","1","129278.00","2019-08-18","2019-08-19 17:43:36","2019-08-19 17:43:36");
INSERT INTO tbl_customer_outstanding VALUES("93","","374","1","432327.00","2019-08-18","2019-08-19 17:44:23","2019-08-19 17:44:23");
INSERT INTO tbl_customer_outstanding VALUES("94","","383","2","17413.00","2019-08-18","2019-08-19 17:45:05","2019-08-19 17:45:05");
INSERT INTO tbl_customer_outstanding VALUES("95","","393","1","46620.00","2019-08-18","2019-08-19 17:50:38","2019-08-19 17:50:38");
INSERT INTO tbl_customer_outstanding VALUES("96","","403","1","42105.00","2019-08-18","2019-08-19 17:51:57","2019-08-19 17:51:57");
INSERT INTO tbl_customer_outstanding VALUES("97","","435","1","771583.00 ","2019-08-18","2019-08-19 17:52:54","2019-08-19 17:52:54");
INSERT INTO tbl_customer_outstanding VALUES("98","","479","2","10920.00","2019-08-18","2019-08-19 17:53:31","2019-08-19 17:53:31");
INSERT INTO tbl_customer_outstanding VALUES("99","","480","2","7.00 ","2019-08-18","2019-08-19 17:54:04","2019-08-19 17:54:04");
INSERT INTO tbl_customer_outstanding VALUES("100","","55","1","707909.00 ","2019-08-18","2019-08-19 17:56:07","2019-08-19 17:56:07");
INSERT INTO tbl_customer_outstanding VALUES("101","","80","1","93147.00","2019-08-18","2019-08-19 17:57:35","2019-08-19 17:57:35");
INSERT INTO tbl_customer_outstanding VALUES("102","","213","2","115680.00","2019-08-18","2019-08-20 10:47:22","2019-08-20 10:47:22");
INSERT INTO tbl_customer_outstanding VALUES("103","","334","1","1884026.00 ","2019-08-18","2019-08-20 10:48:09","2019-08-20 10:48:09");
INSERT INTO tbl_customer_outstanding VALUES("104","","335","1","46649.00","2019-08-18","2019-08-20 10:48:50","2019-08-20 10:48:50");
INSERT INTO tbl_customer_outstanding VALUES("105","","400","1","128573.00","2019-08-18","2019-08-20 10:52:08","2019-08-20 10:52:08");
INSERT INTO tbl_customer_outstanding VALUES("106","","430","1","506605.00","2019-08-18","2019-08-20 10:53:02","2019-08-20 10:53:02");
INSERT INTO tbl_customer_outstanding VALUES("107","","444","1","361587.00","2019-08-18","2019-08-20 10:54:38","2019-08-20 10:54:38");
INSERT INTO tbl_customer_outstanding VALUES("108","","43","1","66432.00","2019-08-18","2019-08-20 10:55:16","2019-08-20 10:55:16");
INSERT INTO tbl_customer_outstanding VALUES("109","","58","1","1571189.00 ","2019-08-18","2019-08-20 10:55:53","2019-08-20 10:55:53");
INSERT INTO tbl_customer_outstanding VALUES("110","","106","1","372529.00","2019-08-18","2019-08-20 10:57:27","2019-08-20 10:57:27");
INSERT INTO tbl_customer_outstanding VALUES("111","","178","1","198977.00 ","2019-08-18","2019-08-20 10:58:22","2019-08-20 10:58:22");
INSERT INTO tbl_customer_outstanding VALUES("112","","249","1","358555.00 ","2019-08-18","2019-08-20 11:00:26","2019-08-20 11:00:26");
INSERT INTO tbl_customer_outstanding VALUES("113","","272","1","710703.00 ","2019-08-18","2019-08-20 11:12:30","2019-08-20 11:12:30");
INSERT INTO tbl_customer_outstanding VALUES("114","","295","1","973830.00 ","2019-08-18","2019-08-20 11:13:07","2019-08-20 11:13:07");
INSERT INTO tbl_customer_outstanding VALUES("115","","330","1","141932.00","2019-08-18","2019-08-20 11:13:47","2019-08-20 11:13:47");
INSERT INTO tbl_customer_outstanding VALUES("116","","188","1","8727734.00","2019-08-18","2019-08-20 11:15:10","2019-08-20 11:15:10");
INSERT INTO tbl_customer_outstanding VALUES("117","","182","1","169484.00 ","2019-08-18","2019-08-20 11:17:22","2019-08-20 11:17:22");
INSERT INTO tbl_customer_outstanding VALUES("118","","198","1","53941.00","2019-08-18","2019-08-20 11:17:55","2019-08-20 11:17:55");
INSERT INTO tbl_customer_outstanding VALUES("119","","263","1","204040.00","2019-08-18","2019-08-20 11:18:34","2019-08-20 11:18:34");
INSERT INTO tbl_customer_outstanding VALUES("120","","264","1","14086.00 ","2019-08-18","2019-08-20 11:19:11","2019-08-20 11:19:11");
INSERT INTO tbl_customer_outstanding VALUES("121","","347","1","30813.00","2019-08-18","2019-08-20 11:19:50","2019-08-20 11:19:50");
INSERT INTO tbl_customer_outstanding VALUES("122","","386","1","47262.00","2019-08-18","2019-08-20 11:20:29","2019-08-20 11:20:29");
INSERT INTO tbl_customer_outstanding VALUES("123","","11","1","34786.00 ","2019-08-18","2019-08-20 11:21:18","2019-08-20 11:21:18");
INSERT INTO tbl_customer_outstanding VALUES("124","","220","1","146860.00","2019-08-18","2019-08-20 11:21:56","2019-08-20 11:21:56");
INSERT INTO tbl_customer_outstanding VALUES("125","","474","1","93047.00","2019-08-18","2019-08-20 11:23:24","2019-08-20 11:23:24");
INSERT INTO tbl_customer_outstanding VALUES("126","","69","1","5695.00","2019-08-18","2019-08-20 11:24:29","2019-08-20 11:24:29");
INSERT INTO tbl_customer_outstanding VALUES("127","","235","1","50982.00","2019-08-18","2019-08-20 11:26:23","2019-08-20 11:26:23");
INSERT INTO tbl_customer_outstanding VALUES("128","","306","1","143400.00","2019-08-18","2019-08-20 11:27:00","2019-08-20 11:27:00");
INSERT INTO tbl_customer_outstanding VALUES("129","","8","1","111637.00","2019-08-18","2019-08-20 11:27:55","2019-08-20 11:27:55");
INSERT INTO tbl_customer_outstanding VALUES("130","","33","1","68064.00","2019-08-18","2019-08-20 11:28:39","2019-08-20 11:28:39");
INSERT INTO tbl_customer_outstanding VALUES("131","","210","1","131007.00","2019-08-18","2019-08-20 11:29:18","2019-08-20 11:29:18");
INSERT INTO tbl_customer_outstanding VALUES("132","","159","1","48496.00 ","2019-08-18","2019-08-20 11:31:47","2019-08-20 11:31:47");
INSERT INTO tbl_customer_outstanding VALUES("133","","255","1","4550.00","2019-08-18","2019-08-20 11:33:47","2019-08-20 11:33:47");
INSERT INTO tbl_customer_outstanding VALUES("134","","404","1","6277.00 ","2019-08-18","2019-08-20 11:36:28","2019-08-20 11:36:28");
INSERT INTO tbl_customer_outstanding VALUES("135","","433","1","8110.00","2019-08-18","2019-08-20 11:38:49","2019-08-20 11:38:49");
INSERT INTO tbl_customer_outstanding VALUES("136","","438","1","42808.00","2019-08-18","2019-08-20 11:39:29","2019-08-20 11:39:29");
INSERT INTO tbl_customer_outstanding VALUES("137","","7","1","3150.00","2019-08-18","2019-08-20 11:40:01","2019-08-20 11:40:01");
INSERT INTO tbl_customer_outstanding VALUES("138","","77","1","459419.00","2019-08-18","2019-08-20 11:40:40","2019-08-20 11:40:40");
INSERT INTO tbl_customer_outstanding VALUES("139","","94","1","74427.00","2019-08-18","2019-08-20 11:44:04","2019-08-20 11:44:04");
INSERT INTO tbl_customer_outstanding VALUES("140","","129","1","32872.00","2019-08-18","2019-08-20 11:44:39","2019-08-20 11:44:39");
INSERT INTO tbl_customer_outstanding VALUES("141","","136","1","22326.00 ","2019-08-18","2019-08-20 11:45:07","2019-08-20 11:45:07");
INSERT INTO tbl_customer_outstanding VALUES("142","","146","1","121873.00 ","2019-08-18","2019-08-20 11:45:39","2019-08-20 11:45:39");
INSERT INTO tbl_customer_outstanding VALUES("143","","165","1","61850.00","2019-08-18","2019-08-20 11:46:06","2019-08-20 11:46:06");
INSERT INTO tbl_customer_outstanding VALUES("144","","202","1","64741.00","2019-08-18","2019-08-20 11:46:37","2019-08-20 11:46:37");
INSERT INTO tbl_customer_outstanding VALUES("145","","238","1","2320969.00","2019-08-18","2019-08-20 11:47:19","2019-08-20 11:47:19");
INSERT INTO tbl_customer_outstanding VALUES("146","","244","1","23654.00","2019-08-18","2019-08-20 11:47:58","2019-08-20 11:47:58");
INSERT INTO tbl_customer_outstanding VALUES("147","","245","1","69186.00","2019-08-18","2019-08-20 11:48:28","2019-08-20 11:48:28");
INSERT INTO tbl_customer_outstanding VALUES("148","","309","1","3823280.00","2019-08-18","2019-08-20 11:49:09","2019-08-20 11:49:09");
INSERT INTO tbl_customer_outstanding VALUES("149","","387","1","92928.00","2019-08-18","2019-08-20 11:49:44","2019-08-20 11:49:44");
INSERT INTO tbl_customer_outstanding VALUES("150","","437","1","47446.00","2019-08-18","2019-08-20 11:50:44","2019-08-20 11:50:44");
INSERT INTO tbl_customer_outstanding VALUES("151","","466","1","24898.00","2019-08-18","2019-08-20 11:51:15","2019-08-20 11:51:15");
INSERT INTO tbl_customer_outstanding VALUES("152","","472","1","121476.00","2019-08-18","2019-08-20 11:51:46","2019-08-20 11:51:46");
INSERT INTO tbl_customer_outstanding VALUES("153","","491","1","12294.00","2019-08-18","2019-08-20 11:52:21","2019-08-20 11:52:21");
INSERT INTO tbl_customer_outstanding VALUES("154","","501","1","84354.00","2019-08-18","2019-08-20 11:52:54","2019-08-20 11:52:54");
INSERT INTO tbl_customer_outstanding VALUES("155","","4","1","188931.00","2019-08-18","2019-08-20 11:53:51","2019-08-20 11:53:51");
INSERT INTO tbl_customer_outstanding VALUES("156","","85","1","2069777.90","2019-08-18","2019-08-20 11:55:11","2019-08-20 11:55:11");
INSERT INTO tbl_customer_outstanding VALUES("157","","95","1","743.00","2019-08-18","2019-08-20 11:55:52","2019-08-20 11:55:52");
INSERT INTO tbl_customer_outstanding VALUES("158","","103","1","460516.00","2019-08-18","2019-08-20 11:56:31","2019-08-20 11:56:31");
INSERT INTO tbl_customer_outstanding VALUES("159","","133","1","53077.00","2019-08-18","2019-08-20 11:57:06","2019-08-20 11:57:06");
INSERT INTO tbl_customer_outstanding VALUES("160","","181","1","40049.00","2019-08-18","2019-08-20 11:57:48","2019-08-20 11:57:48");
INSERT INTO tbl_customer_outstanding VALUES("161","","183","1","74958.00","2019-08-18","2019-08-20 11:58:28","2019-08-20 11:58:28");
INSERT INTO tbl_customer_outstanding VALUES("162","","225","1","620.00","2019-08-18","2019-08-20 11:59:12","2019-08-20 11:59:12");
INSERT INTO tbl_customer_outstanding VALUES("163","","303","1","417771.00","2019-08-18","2019-08-20 12:02:18","2019-08-20 12:02:18");
INSERT INTO tbl_customer_outstanding VALUES("164","","376","1","55878.00","2019-08-18","2019-08-20 12:04:11","2019-08-20 12:04:11");
INSERT INTO tbl_customer_outstanding VALUES("165","","405","1","653245.00","2019-08-18","2019-08-20 12:04:57","2019-08-20 12:04:57");
INSERT INTO tbl_customer_outstanding VALUES("166","","448","1","281169.00","2019-08-18","2019-08-20 12:08:17","2019-08-20 12:08:17");
INSERT INTO tbl_customer_outstanding VALUES("167","","119","1","6188.00","2019-08-18","2019-08-20 12:09:49","2019-08-20 12:09:49");
INSERT INTO tbl_customer_outstanding VALUES("168","","160","1","2625.00","2019-08-18","2019-08-20 12:10:19","2019-08-20 12:10:19");
INSERT INTO tbl_customer_outstanding VALUES("169","","281","1","6801.00","2019-08-18","2019-08-20 12:13:09","2019-08-20 12:13:09");
INSERT INTO tbl_customer_outstanding VALUES("170","","321","1","3587.00","2019-08-18","2019-08-20 12:13:43","2019-08-20 12:13:43");
INSERT INTO tbl_customer_outstanding VALUES("171","","397","1","101288.00","2019-08-18","2019-08-20 12:15:19","2019-08-20 12:15:19");
INSERT INTO tbl_customer_outstanding VALUES("172","","135","1","162534.00","2019-08-18","2019-08-20 12:16:00","2019-08-20 12:16:00");
INSERT INTO tbl_customer_outstanding VALUES("173","","143","1","212881.00","2019-08-18","2019-08-20 12:16:30","2019-08-20 12:16:30");
INSERT INTO tbl_customer_outstanding VALUES("174","","199","1","159566.00","2019-08-18","2019-08-20 12:17:22","2019-08-20 12:17:22");
INSERT INTO tbl_customer_outstanding VALUES("175","","350","1","713024.00","2019-08-18","2019-08-20 12:18:26","2019-08-20 12:18:26");
INSERT INTO tbl_customer_outstanding VALUES("176","","446","1","170883.00","2019-08-18","2019-08-20 12:19:09","2019-08-20 12:19:09");
INSERT INTO tbl_customer_outstanding VALUES("177","","460","1","90485.00","2019-08-18","2019-08-20 12:19:57","2019-08-20 12:19:57");
INSERT INTO tbl_customer_outstanding VALUES("178","","475","1","8926.00","2019-08-18","2019-08-20 12:20:31","2019-08-20 12:20:31");
INSERT INTO tbl_customer_outstanding VALUES("179","","5","1","473731.00","2019-08-18","2019-08-20 12:21:09","2019-08-20 12:21:09");
INSERT INTO tbl_customer_outstanding VALUES("180","","92","1","40278.00","2019-08-18","2019-08-20 12:22:27","2019-08-20 12:22:27");
INSERT INTO tbl_customer_outstanding VALUES("181","","157","1","17404.00","2019-08-18","2019-08-20 12:23:05","2019-08-20 12:23:05");
INSERT INTO tbl_customer_outstanding VALUES("182","","168","1","12859.00","2019-08-18","2019-08-20 12:23:38","2019-08-20 12:23:38");
INSERT INTO tbl_customer_outstanding VALUES("183","","218","1","83207.00 ","2019-08-18","2019-08-20 12:36:23","2019-08-20 12:36:23");
INSERT INTO tbl_customer_outstanding VALUES("184","","219","1","1058938.00 ","2019-08-18","2019-08-20 12:37:01","2019-08-20 12:37:01");
INSERT INTO tbl_customer_outstanding VALUES("185","","262","1","433245.00","2019-08-18","2019-08-20 12:37:34","2019-08-20 12:37:34");
INSERT INTO tbl_customer_outstanding VALUES("186","","268","1","895.00","2019-08-18","2019-08-20 12:38:15","2019-08-20 12:38:15");
INSERT INTO tbl_customer_outstanding VALUES("187","","308","1","420132.00","2019-08-18","2019-08-20 12:38:47","2019-08-20 12:38:47");
INSERT INTO tbl_customer_outstanding VALUES("188","","332","1","5142.00","2019-08-18","2019-08-20 12:39:26","2019-08-20 12:39:26");
INSERT INTO tbl_customer_outstanding VALUES("189","","364","1","987.00","2019-08-18","2019-08-20 12:40:10","2019-08-20 12:40:10");
INSERT INTO tbl_customer_outstanding VALUES("190","","424","1","472082.00","2019-08-18","2019-08-20 12:41:09","2019-08-20 12:41:09");
INSERT INTO tbl_customer_outstanding VALUES("191","","452","1","589824.00","2019-08-18","2019-08-20 12:42:05","2019-08-20 12:42:05");
INSERT INTO tbl_customer_outstanding VALUES("192","","456","1","1275.00","2019-08-18","2019-08-20 12:42:43","2019-08-20 12:42:43");
INSERT INTO tbl_customer_outstanding VALUES("193","","503","1","36876.00","2019-08-18","2019-08-20 12:43:14","2019-08-20 12:43:14");
INSERT INTO tbl_customer_outstanding VALUES("194","","507","1","41819.00","2019-08-18","2019-08-20 12:43:41","2019-08-20 12:43:41");
INSERT INTO tbl_customer_outstanding VALUES("195","","120","1","49581.00","2019-08-18","2019-08-20 12:45:51","2019-08-20 12:45:51");
INSERT INTO tbl_customer_outstanding VALUES("196","","144","1","42700.00 ","2019-08-18","2019-08-20 12:46:22","2019-08-20 12:46:22");
INSERT INTO tbl_customer_outstanding VALUES("197","","169","1","15062.00","2019-08-18","2019-08-20 12:47:06","2019-08-20 12:47:06");
INSERT INTO tbl_customer_outstanding VALUES("198","","445","1","9560.00","2019-08-18","2019-08-20 12:47:53","2019-08-20 12:47:53");
INSERT INTO tbl_customer_outstanding VALUES("199","","18","1","26129.00","2019-08-18","2019-08-20 12:48:54","2019-08-20 12:48:54");
INSERT INTO tbl_customer_outstanding VALUES("200","","23","1","16548.00","2019-08-18","2019-08-20 12:49:24","2019-08-20 12:49:24");
INSERT INTO tbl_customer_outstanding VALUES("201","","34","1","78028.00","2019-08-18","2019-08-20 12:49:53","2019-08-20 12:49:53");
INSERT INTO tbl_customer_outstanding VALUES("202","","51","1","14128.00","2019-08-18","2019-08-20 12:50:30","2019-08-20 12:50:30");
INSERT INTO tbl_customer_outstanding VALUES("203","","126","1","45241.00","2019-08-18","2019-08-20 12:51:05","2019-08-20 12:51:05");
INSERT INTO tbl_customer_outstanding VALUES("204","","215","1","6408.00","2019-08-18","2019-08-20 12:51:40","2019-08-20 12:51:40");
INSERT INTO tbl_customer_outstanding VALUES("205","","242","1","864357.00","2019-08-18","2019-08-20 12:54:13","2019-08-20 12:54:13");
INSERT INTO tbl_customer_outstanding VALUES("206","","302","1","866.00","2019-08-18","2019-08-20 12:54:39","2019-08-20 12:54:39");
INSERT INTO tbl_customer_outstanding VALUES("207","","357","1","308412.00","2019-08-18","2019-08-20 12:55:13","2019-08-20 12:55:13");
INSERT INTO tbl_customer_outstanding VALUES("208","","360","1","26145.00","2019-08-18","2019-08-20 12:55:59","2019-08-20 12:55:59");
INSERT INTO tbl_customer_outstanding VALUES("209","","455","1","29048.00","2019-08-18","2019-08-20 12:56:39","2019-08-20 12:56:39");
INSERT INTO tbl_customer_outstanding VALUES("210","","461","1","291998.00","2019-08-18","2019-08-20 12:57:18","2019-08-20 12:57:18");
INSERT INTO tbl_customer_outstanding VALUES("211","","492","1","85847.00","2019-08-18","2019-08-20 14:04:06","2019-08-20 14:04:06");
INSERT INTO tbl_customer_outstanding VALUES("212","","499","1","641633.00","2019-08-18","2019-08-20 14:04:39","2019-08-20 14:04:39");
INSERT INTO tbl_customer_outstanding VALUES("213","","508","1","314356.00 ","2019-08-18","2019-08-20 14:05:09","2019-08-20 14:05:09");
INSERT INTO tbl_customer_outstanding VALUES("214","","74","1","15136.00 ","2019-08-18","2019-08-20 14:05:40","2019-08-20 14:05:40");
INSERT INTO tbl_customer_outstanding VALUES("215","","99","1","86813.00","2019-08-18","2019-08-20 14:06:10","2019-08-20 14:06:10");
INSERT INTO tbl_customer_outstanding VALUES("216","","240","1","1365283.00","2019-08-18","2019-08-20 14:06:50","2019-08-20 14:06:50");
INSERT INTO tbl_customer_outstanding VALUES("217","","406","1","72624.00","2019-08-18","2019-08-20 14:07:24","2019-08-20 14:07:24");
INSERT INTO tbl_customer_outstanding VALUES("218","","426","1","23789.00","2019-08-18","2019-08-20 14:08:01","2019-08-20 14:08:01");
INSERT INTO tbl_customer_outstanding VALUES("219","","434","1","53430.00","2019-08-18","2019-08-20 14:08:33","2019-08-20 14:08:33");
INSERT INTO tbl_customer_outstanding VALUES("220","","436","1","33242.00","2019-08-18","2019-08-20 14:09:13","2019-08-20 14:09:13");
INSERT INTO tbl_customer_outstanding VALUES("221","","441","1","71073.00","2019-08-18","2019-08-20 14:09:50","2019-08-20 14:09:50");
INSERT INTO tbl_customer_outstanding VALUES("222","","27","1","596.06","2019-08-18","2019-08-20 14:10:36","2019-08-20 14:10:36");
INSERT INTO tbl_customer_outstanding VALUES("223","","29","1","38522.00","2019-08-18","2019-08-20 14:11:07","2019-08-20 14:11:07");
INSERT INTO tbl_customer_outstanding VALUES("224","","38","1","21464.00","2019-08-18","2019-08-20 14:11:53","2019-08-20 14:11:53");
INSERT INTO tbl_customer_outstanding VALUES("225","","65","1","12414.00","2019-08-18","2019-08-20 14:12:44","2019-08-20 14:12:44");
INSERT INTO tbl_customer_outstanding VALUES("226","","154","1","29179.00","2019-08-18","2019-08-20 14:13:10","2019-08-20 14:13:10");
INSERT INTO tbl_customer_outstanding VALUES("227","","187","1","164102.00","2019-08-18","2019-08-20 14:13:51","2019-08-20 14:13:51");
INSERT INTO tbl_customer_outstanding VALUES("228","","214","1","486107.00","2019-08-18","2019-08-20 14:14:41","2019-08-20 14:14:41");
INSERT INTO tbl_customer_outstanding VALUES("229","","369","1","5664.00","2019-08-18","2019-08-20 14:15:15","2019-08-20 14:15:15");
INSERT INTO tbl_customer_outstanding VALUES("230","","371","1","476.00","2019-08-18","2019-08-20 14:15:43","2019-08-20 14:15:43");
INSERT INTO tbl_customer_outstanding VALUES("231","","418","1","137039.00","2019-08-18","2019-08-20 14:16:32","2019-08-20 14:16:32");
INSERT INTO tbl_customer_outstanding VALUES("232","","273","1","39806.00","2019-08-18","2019-08-20 14:17:09","2019-08-20 14:17:09");
INSERT INTO tbl_customer_outstanding VALUES("233","","44","1","61525.00","2019-08-18","2019-08-20 14:17:48","2019-08-20 14:17:48");
INSERT INTO tbl_customer_outstanding VALUES("234","","57","1","32505.00 ","2019-08-18","2019-08-20 14:19:16","2019-08-20 14:19:16");
INSERT INTO tbl_customer_outstanding VALUES("235","","72","1","34229.00 Dr","2019-08-18","2019-08-20 14:20:03","2019-08-20 14:20:03");
INSERT INTO tbl_customer_outstanding VALUES("236","","87","1","129746.00","2019-08-18","2019-08-20 14:20:45","2019-08-20 14:20:45");
INSERT INTO tbl_customer_outstanding VALUES("237","","93","1","16286.00","2019-08-18","2019-08-20 14:21:18","2019-08-20 14:21:18");
INSERT INTO tbl_customer_outstanding VALUES("238","","96","1","1903.00","2019-08-18","2019-08-20 14:21:49","2019-08-20 14:21:49");
INSERT INTO tbl_customer_outstanding VALUES("239","","98","1","4311.00 ","2019-08-18","2019-08-20 14:22:21","2019-08-20 14:22:21");
INSERT INTO tbl_customer_outstanding VALUES("240","","139","1","15170.00","2019-08-18","2019-08-20 14:22:49","2019-08-20 14:22:49");
INSERT INTO tbl_customer_outstanding VALUES("241","","190","1","48987.00 ","2019-08-18","2019-08-20 14:23:26","2019-08-20 14:23:26");
INSERT INTO tbl_customer_outstanding VALUES("242","","197","1","136186.00","2019-08-18","2019-08-20 14:23:59","2019-08-20 14:23:59");
INSERT INTO tbl_customer_outstanding VALUES("243","","211","1","171216.00","2019-08-18","2019-08-20 14:24:31","2019-08-20 14:24:31");
INSERT INTO tbl_customer_outstanding VALUES("244","","228","1","318897.00 ","2019-08-18","2019-08-20 14:25:04","2019-08-20 14:25:04");
INSERT INTO tbl_customer_outstanding VALUES("245","","237","1","66544.00","2019-08-18","2019-08-20 14:25:37","2019-08-20 14:25:37");
INSERT INTO tbl_customer_outstanding VALUES("246","","243","1","16806.00","2019-08-18","2019-08-20 14:26:12","2019-08-20 14:26:12");
INSERT INTO tbl_customer_outstanding VALUES("247","","251","1","39026.00","2019-08-18","2019-08-20 14:26:45","2019-08-20 14:26:45");
INSERT INTO tbl_customer_outstanding VALUES("248","","252","1","121467.00","2019-08-18","2019-08-20 14:27:10","2019-08-20 14:27:10");
INSERT INTO tbl_customer_outstanding VALUES("249","","260","1","71782.00","2019-08-18","2019-08-20 14:27:36","2019-08-20 14:27:36");
INSERT INTO tbl_customer_outstanding VALUES("250","","270","1","43036.00","2019-08-18","2019-08-20 14:28:22","2019-08-20 14:28:22");
INSERT INTO tbl_customer_outstanding VALUES("251","","276","1","1532669.00","2019-08-18","2019-08-20 14:28:48","2019-08-20 14:28:48");
INSERT INTO tbl_customer_outstanding VALUES("252","","278","1","29465.00 ","2019-08-18","2019-08-20 14:29:31","2019-08-20 14:29:31");
INSERT INTO tbl_customer_outstanding VALUES("253","","356","1","36840.00","2019-08-18","2019-08-20 14:30:01","2019-08-20 14:30:01");
INSERT INTO tbl_customer_outstanding VALUES("254","","368","1","236271.00","2019-08-18","2019-08-20 14:30:33","2019-08-20 14:30:33");
INSERT INTO tbl_customer_outstanding VALUES("255","","390","1","24882.00","2019-08-18","2019-08-20 14:31:31","2019-08-20 14:31:31");
INSERT INTO tbl_customer_outstanding VALUES("256","","449","1","22991.00","2019-08-18","2019-08-20 14:32:13","2019-08-20 14:32:13");
INSERT INTO tbl_customer_outstanding VALUES("257","","462","1","78355.00","2019-08-18","2019-08-20 14:32:42","2019-08-20 14:32:42");
INSERT INTO tbl_customer_outstanding VALUES("258","","471","1","69757.00","2019-08-18","2019-08-20 14:33:08","2019-08-20 14:33:08");
INSERT INTO tbl_customer_outstanding VALUES("259","","497","1","39289.00","2019-08-18","2019-08-20 14:33:41","2019-08-20 14:33:41");
INSERT INTO tbl_customer_outstanding VALUES("260","","498","1","157803.00","2019-08-18","2019-08-20 14:34:12","2019-08-20 14:34:12");
INSERT INTO tbl_customer_outstanding VALUES("261","","504","1","9206.00 ","2019-08-18","2019-08-20 14:34:47","2019-08-20 14:34:47");
INSERT INTO tbl_customer_outstanding VALUES("262","","59","1","73290.00","2019-08-18","2019-08-20 14:35:17","2019-08-20 14:35:17");
INSERT INTO tbl_customer_outstanding VALUES("263","","76","1","63501.00","2019-08-18","2019-08-20 14:35:50","2019-08-20 14:35:50");
INSERT INTO tbl_customer_outstanding VALUES("264","","81","1","7942.00","2019-08-18","2019-08-20 14:36:36","2019-08-20 14:36:36");
INSERT INTO tbl_customer_outstanding VALUES("265","","175","1","148848.00","2019-08-18","2019-08-20 14:37:07","2019-08-20 14:37:07");
INSERT INTO tbl_customer_outstanding VALUES("266","","179","1","12473.00","2019-08-18","2019-08-20 14:37:37","2019-08-20 14:37:37");
INSERT INTO tbl_customer_outstanding VALUES("267","","195","1","58856.00","2019-08-18","2019-08-20 14:38:24","2019-08-20 14:38:24");
INSERT INTO tbl_customer_outstanding VALUES("268","","227","1","8300.00","2019-08-18","2019-08-20 14:39:50","2019-08-20 14:39:50");
INSERT INTO tbl_customer_outstanding VALUES("269","","230","1","21015.00","2019-08-18","2019-08-20 14:40:28","2019-08-20 14:40:28");
INSERT INTO tbl_customer_outstanding VALUES("270","","257","1","349277.00","2019-08-18","2019-08-20 14:40:56","2019-08-20 14:40:56");
INSERT INTO tbl_customer_outstanding VALUES("271","","292","1","8478.00","2019-08-18","2019-08-20 14:41:23","2019-08-20 14:41:23");
INSERT INTO tbl_customer_outstanding VALUES("272","","324","1","9471.00","2019-08-18","2019-08-20 14:41:52","2019-08-20 14:41:52");
INSERT INTO tbl_customer_outstanding VALUES("273","","325","1","1299.00","2019-08-18","2019-08-20 14:42:19","2019-08-20 14:42:19");
INSERT INTO tbl_customer_outstanding VALUES("274","","345","1","120896.00","2019-08-18","2019-08-20 14:43:01","2019-08-20 14:43:01");
INSERT INTO tbl_customer_outstanding VALUES("275","","410","1","8618.00","2019-08-18","2019-08-20 14:43:39","2019-08-20 14:43:39");
INSERT INTO tbl_customer_outstanding VALUES("276","","415","1","14291.00","2019-08-18","2019-08-20 14:44:14","2019-08-20 14:44:14");
INSERT INTO tbl_customer_outstanding VALUES("277","","416","1","47890.00","2019-08-18","2019-08-20 14:44:48","2019-08-20 14:44:48");
INSERT INTO tbl_customer_outstanding VALUES("278","","422","1","12556.00","2019-08-18","2019-08-20 14:45:20","2019-08-20 14:45:20");
INSERT INTO tbl_customer_outstanding VALUES("279","","432","1","95549.90","2019-08-18","2019-08-20 14:45:54","2019-08-20 14:45:54");
INSERT INTO tbl_customer_outstanding VALUES("280","","458","1","7263.00","2019-08-18","2019-08-20 14:46:33","2019-08-20 14:46:33");
INSERT INTO tbl_customer_outstanding VALUES("281","","469","1","70681.00","2019-08-18","2019-08-20 14:47:02","2019-08-20 14:47:02");
INSERT INTO tbl_customer_outstanding VALUES("282","","488","1","8008.00","2019-08-18","2019-08-20 14:47:39","2019-08-20 14:47:39");
INSERT INTO tbl_customer_outstanding VALUES("283","","68","1","11222.00","2019-08-18","2019-08-20 14:48:15","2019-08-20 14:48:15");
INSERT INTO tbl_customer_outstanding VALUES("284","","97","1","3898.00","2019-08-18","2019-08-20 14:48:53","2019-08-20 14:48:53");
INSERT INTO tbl_customer_outstanding VALUES("285","","134","1","13060.00","2019-08-18","2019-08-20 14:49:22","2019-08-20 14:49:22");
INSERT INTO tbl_customer_outstanding VALUES("286","","151","1","5942.00","2019-08-18","2019-08-20 14:50:16","2019-08-20 14:50:16");
INSERT INTO tbl_customer_outstanding VALUES("287","","209","1","533708.00","2019-08-18","2019-08-20 14:50:43","2019-08-20 14:50:43");
INSERT INTO tbl_customer_outstanding VALUES("288","","247","1","16934.00","2019-08-18","2019-08-20 14:51:13","2019-08-20 14:51:13");
INSERT INTO tbl_customer_outstanding VALUES("289","","277","1","1846.00","2019-08-18","2019-08-20 14:51:42","2019-08-20 14:51:42");
INSERT INTO tbl_customer_outstanding VALUES("290","","304","1","8200.00","2019-08-18","2019-08-20 14:52:23","2019-08-20 14:52:23");
INSERT INTO tbl_customer_outstanding VALUES("291","","314","1","13314.00","2019-08-18","2019-08-20 14:52:58","2019-08-20 14:52:58");
INSERT INTO tbl_customer_outstanding VALUES("292","","333","1","2176195.74","2019-08-18","2019-08-20 14:53:27","2019-08-20 14:53:27");
INSERT INTO tbl_customer_outstanding VALUES("293","","346","1","339021.00","2019-08-18","2019-08-20 14:53:54","2019-08-20 14:53:54");
INSERT INTO tbl_customer_outstanding VALUES("294","","352","1","71.70","2019-08-18","2019-08-20 14:54:24","2019-08-20 14:54:24");
INSERT INTO tbl_customer_outstanding VALUES("295","","384","1","5571867.00","2019-08-18","2019-08-20 14:54:52","2019-08-20 14:54:52");
INSERT INTO tbl_customer_outstanding VALUES("296","","443","1","37059.00","2019-08-18","2019-08-20 14:55:33","2019-08-20 14:55:33");
INSERT INTO tbl_customer_outstanding VALUES("297","","188","1","8727734.00 ","2019-08-18","2019-08-20 14:58:33","2019-08-20 14:58:33");
INSERT INTO tbl_customer_outstanding VALUES("298","","428","2","38727.00","2019-08-18","2019-08-20 15:01:22","2019-08-20 15:01:22");
INSERT INTO tbl_customer_outstanding VALUES("299","","266","2","11000.00","2019-08-18","2019-08-20 15:47:30","2019-08-20 15:01:52");
INSERT INTO tbl_customer_outstanding VALUES("300","","483","2","136209.00","2019-08-18","2019-08-20 15:03:11","2019-08-20 15:03:11");
INSERT INTO tbl_customer_outstanding VALUES("301","","30","2","106978.00","2019-08-18","2019-08-20 15:04:21","2019-08-20 15:04:21");
INSERT INTO tbl_customer_outstanding VALUES("302","","388","2","1785.00","2019-08-18","2019-08-20 15:06:49","2019-08-20 15:06:49");
INSERT INTO tbl_customer_outstanding VALUES("303","","112","2","12.00","2019-08-18","2019-08-20 15:07:34","2019-08-20 15:07:34");
INSERT INTO tbl_customer_outstanding VALUES("304","","184","2","152057.00","2019-08-18","2019-08-20 15:08:25","2019-08-20 15:08:25");
INSERT INTO tbl_customer_outstanding VALUES("305","","413","2","5537.00","2019-08-18","2019-08-20 15:10:03","2019-08-20 15:10:03");
INSERT INTO tbl_customer_outstanding VALUES("306","","485","2","2396.00","2019-08-18","2019-08-20 15:10:31","2019-08-20 15:10:31");
INSERT INTO tbl_customer_outstanding VALUES("307","","83","2","1409.00","2019-08-18","2019-08-20 15:11:07","2019-08-20 15:11:07");
INSERT INTO tbl_customer_outstanding VALUES("308","","236","2","123163.00","2019-08-18","2019-08-20 15:11:43","2019-08-20 15:11:43");
INSERT INTO tbl_customer_outstanding VALUES("309","","53","2","3166.00","2019-08-18","2019-08-20 15:12:28","2019-08-20 15:12:28");
INSERT INTO tbl_customer_outstanding VALUES("310","","39","2","91944.00","2019-08-18","2019-08-20 15:46:52","2019-08-20 15:13:05");
INSERT INTO tbl_customer_outstanding VALUES("311","","71","2","28169.00","2019-08-18","2019-08-20 15:13:41","2019-08-20 15:13:41");
INSERT INTO tbl_customer_outstanding VALUES("312","","118","2","2236.00 ","2019-08-18","2019-08-20 15:14:11","2019-08-20 15:14:11");
INSERT INTO tbl_customer_outstanding VALUES("313","","163","2","797678.00","2019-08-18","2019-08-20 15:45:59","2019-08-20 15:14:50");
INSERT INTO tbl_customer_outstanding VALUES("314","","40","2","35061.00","2019-08-18","2019-08-20 15:44:44","2019-08-20 15:15:29");
INSERT INTO tbl_customer_outstanding VALUES("316","","348","2","848.00 ","2019-08-18","2019-08-20 15:16:34","2019-08-20 15:16:34");
INSERT INTO tbl_customer_outstanding VALUES("317","","31","2","1023.00","2019-08-18","2019-08-20 15:20:13","2019-08-20 15:20:13");
INSERT INTO tbl_customer_outstanding VALUES("318","","49","2","68119.00","2019-08-18","2019-08-20 15:20:47","2019-08-20 15:20:47");
INSERT INTO tbl_customer_outstanding VALUES("319","","115","2","31133.00","2019-08-18","2019-08-20 15:21:24","2019-08-20 15:21:24");
INSERT INTO tbl_customer_outstanding VALUES("320","","419","2","80044.00 ","2019-08-18","2019-08-20 15:22:03","2019-08-20 15:22:03");
INSERT INTO tbl_customer_outstanding VALUES("321","","467","2","70992.00","2019-08-18","2019-08-20 15:22:38","2019-08-20 15:22:38");
INSERT INTO tbl_customer_outstanding VALUES("322","","487","2","12031.16","2019-08-18","2019-08-20 15:24:28","2019-08-20 15:24:28");
INSERT INTO tbl_customer_outstanding VALUES("323","","394","2","12750.00","2019-08-18","2019-08-20 15:25:03","2019-08-20 15:25:03");
INSERT INTO tbl_customer_outstanding VALUES("324","","283","2","16.00 ","2019-08-18","2019-08-20 15:25:32","2019-08-20 15:25:32");
INSERT INTO tbl_customer_outstanding VALUES("325","","155","2","2885.00","2019-08-18","2019-08-20 15:26:07","2019-08-20 15:26:07");
INSERT INTO tbl_customer_outstanding VALUES("326","","271","2","18417.00","2019-08-18","2019-08-20 15:26:59","2019-08-20 15:26:59");
INSERT INTO tbl_customer_outstanding VALUES("327","","427","2","13418.00","2019-08-18","2019-08-20 15:28:31","2019-08-20 15:28:31");
INSERT INTO tbl_customer_outstanding VALUES("328","","451","2","18541.00","2019-08-18","2019-08-20 15:28:58","2019-08-20 15:28:58");
INSERT INTO tbl_customer_outstanding VALUES("329","","502","2","10024.00 ","2019-08-18","2019-08-20 15:29:31","2019-08-20 15:29:31");
INSERT INTO tbl_customer_outstanding VALUES("330","","26","2","41542.00","2019-08-18","2019-08-20 15:29:59","2019-08-20 15:29:59");
INSERT INTO tbl_customer_outstanding VALUES("331","","101","2","11270.00","2019-08-18","2019-08-20 15:30:28","2019-08-20 15:30:28");
INSERT INTO tbl_customer_outstanding VALUES("332","","322","2","9568.00","2019-08-18","2019-08-20 15:30:59","2019-08-20 15:30:59");
INSERT INTO tbl_customer_outstanding VALUES("333","","246","2","5717.00","2019-08-18","2019-08-20 15:31:36","2019-08-20 15:31:36");
INSERT INTO tbl_customer_outstanding VALUES("334","","463","2","16452.00","2019-08-18","2019-08-20 15:32:12","2019-08-20 15:32:12");
INSERT INTO tbl_customer_outstanding VALUES("335","","82","2","17036.00","2019-08-18","2019-08-20 15:32:45","2019-08-20 15:32:45");
INSERT INTO tbl_customer_outstanding VALUES("336","","123","2","3841.00","2019-08-18","2019-08-20 15:33:19","2019-08-20 15:33:19");
INSERT INTO tbl_customer_outstanding VALUES("337","","216","2","6637.00","2019-08-18","2019-08-20 15:33:51","2019-08-20 15:33:51");
INSERT INTO tbl_customer_outstanding VALUES("338","","298","2","127444.00","2019-08-18","2019-08-20 15:34:17","2019-08-20 15:34:17");
INSERT INTO tbl_customer_outstanding VALUES("339","","372","2","179732.00","2019-08-18","2019-08-20 15:34:45","2019-08-20 15:34:45");
INSERT INTO tbl_customer_outstanding VALUES("340","","2","2","2464.7168","2019-08-21","2019-08-21 11:10:40","2019-08-21 11:10:40");
INSERT INTO tbl_customer_outstanding VALUES("341","","82","2","1232.3584","2019-08-21","2019-08-21 19:12:33","2019-08-21 19:12:33");
INSERT INTO tbl_customer_outstanding VALUES("342","","59","2","1184.96","2019-08-22","2019-08-22 17:58:51","2019-08-22 17:58:51");
INSERT INTO tbl_customer_outstanding VALUES("343","","68","2","246.47168","2019-08-24","2019-08-24 13:38:11","2019-08-24 13:38:11");
INSERT INTO tbl_customer_outstanding VALUES("344","","130","2","25989.1352","2019-08-26","2019-08-26 11:26:06","2019-08-26 11:26:06");
INSERT INTO tbl_customer_outstanding VALUES("345","","241","2","6398.784","2019-08-26","2019-08-26 13:44:13","2019-08-26 13:44:13");
INSERT INTO tbl_customer_outstanding VALUES("346","","236","2","14622.4064","2019-08-26","2019-08-26 17:11:00","2019-08-26 17:11:00");
INSERT INTO tbl_customer_outstanding VALUES("347","","384","2","13698.72","2019-08-27","2019-08-27 17:02:55","2019-08-27 17:02:55");
INSERT INTO tbl_customer_outstanding VALUES("348","","378","2","28599.0096","2019-08-30","2019-08-30 17:32:11","2019-08-30 17:32:11");
INSERT INTO tbl_customer_outstanding VALUES("349","","16","2","30310","2019-08-31","2019-08-31 15:05:53","2019-08-31 15:05:53");
INSERT INTO tbl_customer_outstanding VALUES("350","","236","2","4677.75","2019-09-02","2019-09-02 11:02:08","2019-09-02 11:02:08");
INSERT INTO tbl_customer_outstanding VALUES("351","","238","2","25084.08","2019-09-02","2019-09-02 11:05:17","2019-09-02 11:05:17");
INSERT INTO tbl_customer_outstanding VALUES("352","","309","2","25401.6","2019-09-02","2019-09-02 11:07:55","2019-09-02 11:07:55");
INSERT INTO tbl_customer_outstanding VALUES("353","","235","2","9384.8832","2019-09-02","2019-09-02 11:09:47","2019-09-02 11:09:47");
INSERT INTO tbl_customer_outstanding VALUES("354","","506","2","42999.236","2019-09-02","2019-09-02 11:59:37","2019-09-02 11:59:37");
INSERT INTO tbl_customer_outstanding VALUES("355","","378","2","58196.88","2019-09-02","2019-09-02 12:03:11","2019-09-02 12:03:11");
INSERT INTO tbl_customer_outstanding VALUES("356","","178","2","24040.8","2019-09-02","2019-09-02 13:15:56","2019-09-02 13:15:56");
INSERT INTO tbl_customer_outstanding VALUES("357","","378","2","23360.4","2019-09-02","2019-09-02 15:48:52","2019-09-02 15:48:52");
INSERT INTO tbl_customer_outstanding VALUES("358","","78","2","13779.6036","2019-09-03","2019-09-03 13:25:00","2019-09-03 13:25:00");
INSERT INTO tbl_customer_outstanding VALUES("359","","238","2","28667.52","2019-09-03","2019-09-03 16:09:41","2019-09-03 16:09:41");
INSERT INTO tbl_customer_outstanding VALUES("360","","236","2","3554.88","2019-09-03","2019-09-03 16:12:42","2019-09-03 16:12:42");
INSERT INTO tbl_customer_outstanding VALUES("361","","518","2","24780","2019-09-04","2019-09-04 10:46:13","2019-09-04 10:46:13");
INSERT INTO tbl_customer_outstanding VALUES("362","","182","2","4493.9608","2019-09-04","2019-09-04 12:36:48","2019-09-04 12:36:48");
INSERT INTO tbl_customer_outstanding VALUES("363","","236","2","31756.928","2019-09-04","2019-09-04 13:37:07","2019-09-04 13:37:07");
INSERT INTO tbl_customer_outstanding VALUES("364","","378","2","10001.88","2019-09-04","2019-09-04 14:41:10","2019-09-04 14:41:10");
INSERT INTO tbl_customer_outstanding VALUES("365","","312","2","17827.7232","2019-09-04","2019-09-04 14:43:53","2019-09-04 14:43:53");
INSERT INTO tbl_customer_outstanding VALUES("366","","340","2","20476.1088","2019-09-04","2019-09-04 14:52:01","2019-09-04 14:52:01");
INSERT INTO tbl_customer_outstanding VALUES("367","","474","2","10805.1424","2019-09-04","2019-09-04 17:23:16","2019-09-04 17:23:16");
INSERT INTO tbl_customer_outstanding VALUES("368","","42","2","7109.76","2019-09-05","2019-09-05 12:57:01","2019-09-05 12:57:01");
INSERT INTO tbl_customer_outstanding VALUES("369","","370","2","36370.215","2019-09-05","2019-09-05 13:06:27","2019-09-05 13:06:27");
INSERT INTO tbl_customer_outstanding VALUES("370","","78","2","22277.248","2019-09-05","2019-09-05 16:07:46","2019-09-05 16:07:46");
INSERT INTO tbl_customer_outstanding VALUES("371","","412","2","2358.72","2019-09-05","2019-09-05 16:37:59","2019-09-05 16:37:59");
INSERT INTO tbl_customer_outstanding VALUES("372","","370","2","49669.2","2019-09-06","2019-09-06 12:36:09","2019-09-06 12:36:09");
INSERT INTO tbl_customer_outstanding VALUES("373","","412","2","11340","2019-09-06","2019-09-06 17:05:26","2019-09-06 17:05:26");
INSERT INTO tbl_customer_outstanding VALUES("374","","370","2","42232.7925","2019-09-07","2019-09-07 12:29:45","2019-09-07 12:29:45");
INSERT INTO tbl_customer_outstanding VALUES("375","","129","2","9622.522","2019-09-07","2019-09-07 14:07:50","2019-09-07 14:07:50");
INSERT INTO tbl_customer_outstanding VALUES("376","","84","2","22575","2019-09-07","2019-09-07 14:44:20","2019-09-07 14:44:20");
INSERT INTO tbl_customer_outstanding VALUES("377","","506","2","37520","2019-09-07","2019-09-07 15:14:21","2019-09-07 15:14:21");
INSERT INTO tbl_customer_outstanding VALUES("378","","483","2","9669.2736","2019-09-09","2019-09-09 11:03:17","2019-09-09 11:03:17");
INSERT INTO tbl_customer_outstanding VALUES("379","","340","2","20580","2019-09-09","2019-09-09 14:24:38","2019-09-09 14:24:38");
INSERT INTO tbl_customer_outstanding VALUES("380","","84","2","4620","2019-09-09","2019-09-09 14:25:36","2019-09-09 14:25:36");



CREATE TABLE `tbl_departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO tbl_departments VALUES("5","Accounting","2","2019-09-11 20:40:34","2019-09-11 20:37:34");



CREATE TABLE `tbl_employee_attendance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `attendance` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

INSERT INTO tbl_employee_attendance VALUES("61","05-10-2019","2","P","2019-10-06 23:28:56","2019-10-06 00:45:44");
INSERT INTO tbl_employee_attendance VALUES("62","05-10-2019","8","A","2019-10-06 23:28:56","2019-10-06 00:45:45");
INSERT INTO tbl_employee_attendance VALUES("63","05-10-2019","9","P","2019-10-06 23:28:56","2019-10-06 00:45:45");
INSERT INTO tbl_employee_attendance VALUES("64","05-10-2019","10","P","2019-10-06 23:28:56","2019-10-06 00:45:45");
INSERT INTO tbl_employee_attendance VALUES("65","05-10-2019","11","L","2019-10-06 23:28:56","2019-10-06 00:45:45");
INSERT INTO tbl_employee_attendance VALUES("66","06-10-2019","2","P","2019-10-06 23:30:08","2019-10-06 23:30:08");
INSERT INTO tbl_employee_attendance VALUES("67","06-10-2019","8","A","2019-10-06 23:30:08","2019-10-06 23:30:08");
INSERT INTO tbl_employee_attendance VALUES("68","06-10-2019","9","P","2019-10-06 23:30:08","2019-10-06 23:30:08");
INSERT INTO tbl_employee_attendance VALUES("69","06-10-2019","10","P","2019-10-06 23:30:09","2019-10-06 23:30:09");
INSERT INTO tbl_employee_attendance VALUES("70","06-10-2019","11","L","2019-10-06 23:30:09","2019-10-06 23:30:09");
INSERT INTO tbl_employee_attendance VALUES("71","13-10-2019","2","P","2019-10-13 20:59:48","2019-10-13 20:59:48");
INSERT INTO tbl_employee_attendance VALUES("72","13-10-2019","8","A","2019-10-13 20:59:48","2019-10-13 20:59:48");
INSERT INTO tbl_employee_attendance VALUES("73","13-10-2019","9","A","2019-10-13 20:59:48","2019-10-13 20:59:48");
INSERT INTO tbl_employee_attendance VALUES("74","13-10-2019","10","A","2019-10-13 20:59:48","2019-10-13 20:59:48");
INSERT INTO tbl_employee_attendance VALUES("75","13-10-2019","11","P","2019-10-13 20:59:48","2019-10-13 20:59:48");



CREATE TABLE `tbl_employee_grant_leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `date_from` varchar(255) NOT NULL,
  `date_to` varchar(255) DEFAULT 'NULL',
  `total_days` int(11) NOT NULL,
  `leave_reason` varchar(255) DEFAULT 'NULL',
  `status` enum('1','0') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO tbl_employee_grant_leaves VALUES("3","2","2019-09-29","2019-10-04","5","adsadas","1","2019-09-29 17:09:39","2019-09-29 17:09:39");
INSERT INTO tbl_employee_grant_leaves VALUES("4","2","2019-09-29","2019-10-04","6","adsadas","1","2019-09-29 17:10:37","2019-09-29 17:10:37");
INSERT INTO tbl_employee_grant_leaves VALUES("5","11","2019-10-06","","1","asdas","1","2019-10-06 00:36:36","2019-10-06 00:36:36");



CREATE TABLE `tbl_employee_salary_payouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `salary` double(10,2) NOT NULL,
  `extra_allowances` double(10,2) DEFAULT NULL,
  `status` enum('1','0') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_employee_salary_payouts VALUES("3","2","2019","10","25000.00","250.00","1","2019-09-29 18:52:22","2019-09-29 18:52:22");



CREATE TABLE `tbl_employee_total_leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `leaves` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tbl_employee_total_leaves VALUES("2","2","2019","22","1","2019-10-13 21:07:50","2019-10-13 21:07:50");



CREATE TABLE `tbl_employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_designation` varchar(255) DEFAULT NULL,
  `employee_hq` varchar(255) DEFAULT NULL,
  `employee_mobile` varchar(255) DEFAULT NULL,
  `employee_doj` varchar(255) NOT NULL,
  `employee_dob` varchar(255) NOT NULL,
  `employee_pan` varchar(255) DEFAULT NULL,
  `employee_email` varchar(255) NOT NULL,
  `employee_aadhaar_file` varchar(255) DEFAULT NULL,
  `employee_aadhaar_number` varchar(255) DEFAULT NULL,
  `employee_password` varchar(255) NOT NULL,
  `employee_nominee_name` varchar(255) DEFAULT NULL,
  `employee_nominee_relation` varchar(255) DEFAULT NULL,
  `employee_spouse_name` varchar(255) DEFAULT NULL,
  `employee_pan_file` text DEFAULT NULL,
  `employee_reporting_manager_id` int(11) unsigned NOT NULL,
  `employee_department_id` int(11) unsigned NOT NULL,
  `employee_bank_name` varchar(255) DEFAULT NULL,
  `employee_bank_ifsc` varchar(255) DEFAULT NULL,
  `employee_bank_branch` varchar(255) DEFAULT NULL,
  `employee_bank_number` varchar(255) DEFAULT NULL,
  `employee_total_leaves` varchar(255) DEFAULT NULL COMMENT 'leaves per year',
  `employee_grade` varchar(255) DEFAULT NULL COMMENT 'UPDATE',
  `employee_salary` double(10,2) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO tbl_employees VALUES("2","","2","Rohit Vyas","PHP Developer","Vadodara","98983635578","2019-09-12","2019-09-12","PAN12456","rohit@demo.com","","","12345","Rohan","Son","abc","","0","5","","","","","","B","25000.00","1","2019-09-29 18:29:53","2019-09-12 21:14:54");
INSERT INTO tbl_employees VALUES("8","NE/00008","2","Varun Patel","","","9898363557","2019-10-05","2019-10-05","","varun@demo.com","","","123456","","","","","2","5","","","","","","","0.00","1","2019-10-05 21:48:18","2019-10-05 21:48:18");
INSERT INTO tbl_employees VALUES("9","NE/00009","2","Vidhi Razdan","","Mumbai","9898363557","2019-10-05","2018-11-30","","vidhi@demo.com","","","123456","","","","","2","5","","","","","","","0.00","1","2019-10-05 21:59:45","2019-10-05 21:59:45");
INSERT INTO tbl_employees VALUES("10","NE/00010","2","Pranav Sen","","Surat","9898363557","2019-10-06","2019-10-08","","pranav@demo.com","","","123456","","","","","2","5","","","","","","","0.00","1","2019-10-05 22:00:47","2019-10-05 22:00:47");
INSERT INTO tbl_employees VALUES("11","NE/00011","2","Rahul Singh","Programmer","Ahmedabad","9898363557","2019-10-05","2019-10-05","","rahul@demo.com","","","123456","","","","","2","5","","","","","","","0.00","1","2019-10-05 22:01:49","2019-10-05 22:01:49");
INSERT INTO tbl_employees VALUES("12","NE/00012","3","employee","Developer","Vadodara","9898363557","1993-11-12","1978-10-02","pan14546","demo@employee.com","","aa12456","123456","","","","","2","5","SBI","SBIN0025","NIZAMPURA","3652564564","25","","0.00","1","2019-10-16 23:04:39","2019-10-16 23:04:39");



CREATE TABLE `tbl_employees_documents` (
  `employee_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `salary_document` varchar(255) DEFAULT 'NULL',
  `appointment_letter` varchar(255) DEFAULT NULL,
  `reliveing_letter` varchar(255) DEFAULT 'NULL',
  `experience_letter` varchar(255) DEFAULT 'NULL',
  `confirmation_letter` varchar(255) DEFAULT NULL,
  `promotion_letter` varchar(255) DEFAULT 'NULL',
  `status` enum('1','0') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO tbl_employees_documents VALUES("8","2","09b9d8cc1e2cc43acaab79d5dde305f3.jpg","","26b9d2e3de06d02146fece6dd51e2175.jpg","33f2e0d472b8c361893fba0660d45fbe.jpg","56c0e44abff17a74be514442045107dc.jpg","8ca31af1e5ec1fa5fe6149cd65dc816c.jpg","1","2019-09-29 15:55:07","2019-09-29 15:55:07");



CREATE TABLE `tbl_expense_master` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tbl_expense_master VALUES("2","Tea","2019-10-05 23:15:19");
INSERT INTO tbl_expense_master VALUES("3","Utility Bill","2019-10-05 23:16:23");
INSERT INTO tbl_expense_master VALUES("4","Water Bill","2019-10-05 23:16:34");



CREATE TABLE `tbl_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT 'NULL',
  `cheque_number` varchar(255) DEFAULT 'NULL',
  `bank_name` varchar(255) DEFAULT 'NULL',
  `remark` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO tbl_expenses VALUES("4","2","3","2019-10-06","4500.00","2","f6e91ae9e3fc2d99bdf446f57c052459.jpg","45644454456","","","asdadasd","2019-10-06 00:03:58");
INSERT INTO tbl_expenses VALUES("5","2","2","2019-10-06","4500.00","2","f6e91ae9e3fc2d99bdf446f57c052459.jpg","45644454456","","","asdadasd","2019-10-06 00:03:58");



CREATE TABLE `tbl_godown` (
  `godown_id` int(11) NOT NULL AUTO_INCREMENT,
  `godown_person_name` varchar(255) NOT NULL,
  `godown_person_mobile` varchar(255) NOT NULL,
  `godown_person_designation` varchar(255) NOT NULL,
  `godown_name` varchar(255) NOT NULL,
  `godown_email` varchar(255) NOT NULL,
  `godown_password` varchar(255) NOT NULL,
  `godown_address` varchar(255) NOT NULL,
  `godown_state` varchar(255) NOT NULL,
  `godown_city` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`godown_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO tbl_godown VALUES("1","JAIMIN PATEL","9924292322","MANAGER","ASLALI","aslali@agriconfertilizers.com","aslali","ASLALI","1","1","1","2019-08-21 19:32:29","2019-08-21 11:16:23");
INSERT INTO tbl_godown VALUES("2","SAGAR","9913333534","MANAGER","RAJKOT ","rajkot@agriconfertilizers.com","rajkot","Rajkot","1","1","1","2019-08-21 19:29:23","2019-08-21 11:17:03");
INSERT INTO tbl_godown VALUES("3","DILIP INGLE","9561224455","MANAGER","PUNE","pune@agriconfertilizers.com","pune","PUNE","1","1","1","2019-08-21 19:30:06","2019-08-21 19:26:32");
INSERT INTO tbl_godown VALUES("4","SUMERSI","9825232440","MANAGER","BHARUCH","bharuch@agriconfertilizers.com","bharuch","BHARUCH","1","1","1","2019-08-21 19:30:53","2019-08-21 19:28:42");
INSERT INTO tbl_godown VALUES("5","Rahul Singh","9898363557","Godown Manager","Test Godown","test@godown.com","12345","Vadodara","1","1","2","2019-09-18 22:36:13","2019-09-18 22:36:13");
INSERT INTO tbl_godown VALUES("6","godown","9898363557","Developer","godown","demo@godown.com","123456","vadodara","1","1","3","2019-10-16 23:07:32","2019-10-16 23:07:32");



CREATE TABLE `tbl_invoice_detail` (
  `invoice_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `dispatch_quantity` int(11) NOT NULL,
  `dispatched_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`invoice_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

INSERT INTO tbl_invoice_detail VALUES("59","50","16","30","5","2019-10-19 20:33:31","2019-10-19 20:33:31");
INSERT INTO tbl_invoice_detail VALUES("60","50","16","31","7","2019-10-19 20:33:31","2019-10-19 20:33:31");



CREATE TABLE `tbl_invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) DEFAULT NULL,
  `invoice_delivery_note` varchar(255) DEFAULT NULL,
  `invoice_terms_of_payment` varchar(255) DEFAULT NULL,
  `invoice_supplier_reference` varchar(255) DEFAULT NULL,
  `invoice_other_reference` varchar(255) DEFAULT NULL,
  `invoice_buyer_order_number` varchar(255) DEFAULT NULL,
  `invoice_buyer_order_date` varchar(255) DEFAULT NULL,
  `invoice_dispatch_document_number` varchar(255) DEFAULT NULL,
  `invoice_delivery_note_date` varchar(255) DEFAULT NULL,
  `invoice_dispatch_through` varchar(255) DEFAULT NULL,
  `invoice_dispatch_destination` varchar(255) DEFAULT NULL,
  `invoice_driver_name` varchar(255) DEFAULT NULL,
  `invoice_gate_pass_number` varchar(255) DEFAULT NULL,
  `invoice_vehicle_number` varchar(255) DEFAULT NULL,
  `invoice_driver_contact_number` varchar(255) DEFAULT NULL,
  `transport_by` varchar(255) DEFAULT NULL,
  `added_freight` double(10,2) NOT NULL,
  `added_discount` double(10,2) NOT NULL,
  `round_off` double(10,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

INSERT INTO tbl_invoices VALUES("50","16","INV6","2019-10-19","NA","","NA","08:23:34","ORD/00016","2019-10-19","NA","2019-10-31","NA","NA","NA","NA","NA","NA","NA","20.00","0.00","0.00","2019-10-19 20:33:28","2019-10-19 20:33:28");
INSERT INTO tbl_invoices VALUES("51","16","INV7","2019-10-10","NA","","NA","08:23:34","ORD/00016","2019-10-19","NA","2019-10-11","NA","NA","NA","NA","NA","NA","NA","50.00","0.00","0.00","2019-10-19 20:56:27","2019-10-19 20:56:27");



CREATE TABLE `tbl_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL COMMENT 'tbl_modules(module_id)',
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `status` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

INSERT INTO tbl_menus VALUES("23","21","Edit","","","1","2019-02-27 11:16:58");
INSERT INTO tbl_menus VALUES("24","21","Delete","","","1","2019-02-27 11:16:58");
INSERT INTO tbl_menus VALUES("25","21","Add","add.php","","1","2019-02-27 11:16:58");
INSERT INTO tbl_menus VALUES("26","21","View","view.php","","1","2019-02-27 11:17:30");
INSERT INTO tbl_menus VALUES("38","26","Edit","","","1","2019-03-01 11:30:11");
INSERT INTO tbl_menus VALUES("39","26","Delete","","","1","2019-03-01 11:30:11");
INSERT INTO tbl_menus VALUES("40","26","add","add.php","","1","2019-03-01 11:30:11");
INSERT INTO tbl_menus VALUES("41","26","view","view.php","","1","2019-03-01 11:30:21");
INSERT INTO tbl_menus VALUES("42","27","Edit","","","1","2019-03-01 11:32:47");
INSERT INTO tbl_menus VALUES("43","27","Delete","","","1","2019-03-01 11:32:47");
INSERT INTO tbl_menus VALUES("44","27","add","add.php","","1","2019-03-01 11:32:47");
INSERT INTO tbl_menus VALUES("45","27","view","view.php","","1","2019-03-01 11:33:10");
INSERT INTO tbl_menus VALUES("46","28","Edit","","","1","2019-03-01 17:18:18");
INSERT INTO tbl_menus VALUES("47","28","Delete","","","1","2019-03-01 17:18:18");
INSERT INTO tbl_menus VALUES("48","28","add","add.php","","1","2019-03-01 17:18:18");
INSERT INTO tbl_menus VALUES("49","28","view","view.php","","1","2019-03-01 17:18:28");
INSERT INTO tbl_menus VALUES("50","29","Edit","","","1","2019-03-05 17:31:54");
INSERT INTO tbl_menus VALUES("51","29","Delete","","","1","2019-03-05 17:31:54");
INSERT INTO tbl_menus VALUES("52","29","view","view.php","","1","2019-03-05 17:31:54");
INSERT INTO tbl_menus VALUES("53","30","Edit","","","1","2019-03-29 23:41:18");
INSERT INTO tbl_menus VALUES("54","30","Delete","","","1","2019-03-29 23:41:18");
INSERT INTO tbl_menus VALUES("55","30","Add","add.php","","1","2019-03-29 23:41:18");
INSERT INTO tbl_menus VALUES("56","21","outstanding","outstanding.php","","1","2019-03-30 23:02:26");
INSERT INTO tbl_menus VALUES("57","31","Edit","","","1","2019-04-07 11:36:27");
INSERT INTO tbl_menus VALUES("58","31","Delete","","","1","2019-04-07 11:36:27");
INSERT INTO tbl_menus VALUES("67","32","Edit","","","1","2019-09-11 20:22:17");
INSERT INTO tbl_menus VALUES("68","32","Delete","","","1","2019-09-11 20:22:17");
INSERT INTO tbl_menus VALUES("69","32","Add","add.php","","1","2019-09-11 20:22:17");
INSERT INTO tbl_menus VALUES("70","32","View","view.php","","1","2019-09-11 20:22:33");
INSERT INTO tbl_menus VALUES("71","33","Edit","","","1","2019-09-11 20:46:37");
INSERT INTO tbl_menus VALUES("72","33","Delete","","","1","2019-09-11 20:46:37");
INSERT INTO tbl_menus VALUES("73","33","Add Employee","add.php","1","1","2019-09-11 20:46:37");
INSERT INTO tbl_menus VALUES("74","33","View Employees","view.php","2","1","2019-09-11 20:46:44");
INSERT INTO tbl_menus VALUES("75","34","Edit","","","1","2019-09-13 22:26:47");
INSERT INTO tbl_menus VALUES("76","34","Delete","","","1","2019-09-13 22:26:47");
INSERT INTO tbl_menus VALUES("77","34","Add","add.php","","1","2019-09-13 22:26:47");
INSERT INTO tbl_menus VALUES("78","34","View","view.php","","1","2019-09-13 22:26:58");
INSERT INTO tbl_menus VALUES("79","30","View","view.php","","1","2019-09-24 00:46:07");
INSERT INTO tbl_menus VALUES("80","33","Grade and Salary","assign_grade.php","3","1","2019-09-29 14:55:53");
INSERT INTO tbl_menus VALUES("81","33","Upload Documents","upload_documents.php","4","1","2019-09-29 14:56:14");
INSERT INTO tbl_menus VALUES("82","33","Add Annual Leaves","add_leave.php","5","1","2019-09-29 16:23:28");
INSERT INTO tbl_menus VALUES("83","33","Grant Leave","grant_leave.php","6","1","2019-09-29 16:23:40");
INSERT INTO tbl_menus VALUES("84","33","Pay Salary","pay_salary.php","7","1","2019-09-29 18:37:08");
INSERT INTO tbl_menus VALUES("85","33","Take Attendance","attendance.php","8","1","2019-10-05 20:51:20");
INSERT INTO tbl_menus VALUES("86","30","Expenses","add_expenses.php","3","1","2019-10-05 23:08:31");
INSERT INTO tbl_menus VALUES("87","31","Expense Report","expense_report.php","5","1","2019-10-06 00:20:15");
INSERT INTO tbl_menus VALUES("88","33","View Attendance","view_attendance.php","9","1","2019-10-06 00:51:52");
INSERT INTO tbl_menus VALUES("89","31","Attendance Report","attendance_report.php","4","1","2019-10-06 01:04:54");
INSERT INTO tbl_menus VALUES("90","31","Order Report","order_report.php","1","1","2019-10-06 14:03:22");
INSERT INTO tbl_menus VALUES("91","31","Invoice Report","invoice_report.php","2","1","2019-10-06 14:03:38");
INSERT INTO tbl_menus VALUES("92","31","Payment Report","payment_report.php","3","1","2019-10-06 14:04:04");
INSERT INTO tbl_menus VALUES("93","31","Target Report","target_report.php","","1","2019-10-06 14:10:33");
INSERT INTO tbl_menus VALUES("94","26","Add Purchase Order","purchase_order.php","3","1","2019-10-11 22:16:40");
INSERT INTO tbl_menus VALUES("96","26","View Purchase Order","view_purchase_order.php","4","1","2019-10-12 20:15:23");
INSERT INTO tbl_menus VALUES("97","31","Vendor Report","vendor_report.php","","1","2019-10-14 23:11:29");
INSERT INTO tbl_menus VALUES("98","31","Salary Report","salary_report.php","","1","2019-10-14 23:28:20");
INSERT INTO tbl_menus VALUES("99","31","GST Report","gst_report.php","","1","2019-10-17 21:56:15");



CREATE TABLE `tbl_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `module_order` int(11) NOT NULL,
  `module_class` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO tbl_modules VALUES("21","customer","4","ti-user","2019-09-21 23:57:19");
INSERT INTO tbl_modules VALUES("26","product","2","ti-view-list","2019-09-21 23:56:51");
INSERT INTO tbl_modules VALUES("27","category","1","ti-menu-alt","2019-09-21 23:56:49");
INSERT INTO tbl_modules VALUES("28","godown","6","ti-home","2019-09-21 23:57:32");
INSERT INTO tbl_modules VALUES("29","order","7","ti-receipt","2019-09-21 23:57:51");
INSERT INTO tbl_modules VALUES("30","account","8","ti-agenda","2019-09-24 00:49:35");
INSERT INTO tbl_modules VALUES("31","reports","9","ti-files","2019-09-21 23:57:56");
INSERT INTO tbl_modules VALUES("32","department","6","ti-layout-accordion-separated","2019-09-22 00:05:13");
INSERT INTO tbl_modules VALUES("33","employee","3","ti-user","2019-09-22 00:04:20");
INSERT INTO tbl_modules VALUES("34","vendors","5","ti-user","2019-09-22 00:04:29");



CREATE TABLE `tbl_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_sender_user_type` varchar(255) NOT NULL,
  `notification_sender_user_id` int(11) NOT NULL,
  `notification_receiver_user_type` varchar(255) NOT NULL,
  `notification_receiver_user_id` int(11) NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `notification_description` varchar(255) NOT NULL,
  `notification_url` varchar(255) NOT NULL,
  `notification_status` enum('0','1') NOT NULL COMMENT '0-unread,1-read',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO tbl_notifications VALUES("1","4","29","2","1","Target Achieved","<b>GREAT ! </b> Chandan lohar has achieved the target of <b></b> by placing <b>1 Orders</b> assigned between  to ","","1","2019-08-24 20:03:49","2019-08-24 17:53:06");
INSERT INTO tbl_notifications VALUES("2","2","1","4","29","Target Achieved","<b>CONGRATULATIONS Chandan lohar</b>, You have achieved the target of <b></b> by placing <b>1 Orders</b> assigned between  to ","","0","2019-08-24 17:53:06","2019-08-24 17:53:06");
INSERT INTO tbl_notifications VALUES("3","4","29","1","1","Target Achieved","<b>GREAT Chandan lohar</b>, has achieved the target of <b></b> by placing <b>1 Orders</b> assigned by Prashant between  to ","","0","2019-08-24 17:53:06","2019-08-24 17:53:06");
INSERT INTO tbl_notifications VALUES("4","4","29","2","1","New Order","You got a new order from Chandan lohar as order number <b>#ORDER4</b>","","1","2019-08-24 20:03:49","2019-08-24 17:53:06");
INSERT INTO tbl_notifications VALUES("5","4","29","2","1","Target Achieved","<b>GREAT ! </b> Chandan lohar has achieved the target of <b></b> by placing <b>1 Orders</b> assigned between  to ","","1","2019-08-24 20:03:49","2019-08-24 19:18:17");
INSERT INTO tbl_notifications VALUES("6","2","1","4","29","Target Achieved","<b>CONGRATULATIONS Chandan lohar</b>, You have achieved the target of <b></b> by placing <b>1 Orders</b> assigned between  to ","","0","2019-08-24 19:18:17","2019-08-24 19:18:17");
INSERT INTO tbl_notifications VALUES("7","4","29","1","1","Target Achieved","<b>GREAT Chandan lohar</b>, has achieved the target of <b></b> by placing <b>1 Orders</b> assigned by Prashant between  to ","","0","2019-08-24 19:18:17","2019-08-24 19:18:17");
INSERT INTO tbl_notifications VALUES("8","4","29","2","1","New Order","You got a new order from Chandan lohar as order number <b>#ORDER1</b>","","1","2019-08-24 20:03:49","2019-08-24 19:18:17");
INSERT INTO tbl_notifications VALUES("9","2","1","3","1","New Order Assigned","You have a new order from Prashant for order number <b>#</b>","","0","2019-08-24 19:34:59","2019-08-24 19:34:59");
INSERT INTO tbl_notifications VALUES("14","4","30","2","1","Target Achieved","<b>GREAT ! </b> Sales Person has achieved the target of <b></b> by placing <b>2 Orders</b> assigned between  to ","","1","2019-08-27 13:27:34","2019-08-26 21:50:11");
INSERT INTO tbl_notifications VALUES("15","2","1","4","30","Target Achieved","<b>CONGRATULATIONS Sales Person</b>, You have achieved the target of <b></b> by placing <b>2 Orders</b> assigned between  to ","","0","2019-08-26 21:50:11","2019-08-26 21:50:11");
INSERT INTO tbl_notifications VALUES("16","4","30","1","1","Target Achieved","<b>GREAT Sales Person</b>, has achieved the target of <b></b> by placing <b>2 Orders</b> assigned by Prashant between  to ","","0","2019-08-26 21:50:11","2019-08-26 21:50:11");
INSERT INTO tbl_notifications VALUES("17","4","30","2","1","New Order","You got a new order from Sales Person as order number <b>#ORDER2</b>","","1","2019-08-27 13:27:34","2019-08-26 21:50:11");
INSERT INTO tbl_notifications VALUES("18","2","1","3","1","New Order Assigned","You have a new order from Prashant for order number <b>#</b>","","0","2019-08-26 21:50:38","2019-08-26 21:50:38");



CREATE TABLE `tbl_order_detail` (
  `order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_product_quantity` int(10) unsigned NOT NULL DEFAULT 0,
  `order_dispatch_quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'N/A',
  `order_product_discount` varchar(255) NOT NULL,
  `order_product_rate` varchar(255) NOT NULL,
  `dispatched_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

INSERT INTO tbl_order_detail VALUES("26","14","1","10","0","0","40","2019-10-19 15:20:41","2019-10-19 15:20:41");
INSERT INTO tbl_order_detail VALUES("27","14","2","20","0","0","90","2019-10-19 15:20:42","2019-10-19 15:20:42");
INSERT INTO tbl_order_detail VALUES("30","16","4","10","0","0","250","2019-10-19 20:23:40","2019-10-19 20:23:40");
INSERT INTO tbl_order_detail VALUES("31","16","5","10","0","0","500","2019-10-19 20:23:40","2019-10-19 20:23:40");



CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(11) NOT NULL COMMENT '2-admin,4-customer/distributer',
  `user_id` int(11) NOT NULL COMMENT 'admin or customer id',
  `godown_id` varchar(255) DEFAULT NULL COMMENT 'multiple godown ids seperated by comma',
  `order_number` varchar(255) NOT NULL,
  `transport_by` varchar(255) DEFAULT NULL,
  `order_approve_status` enum('0','1') NOT NULL,
  `order_dispatch_status` enum('0','1','2') NOT NULL COMMENT '0-not dispatched,1-dispatched,2-partially dispatched',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO tbl_orders VALUES("14","4","9","6","ORD/00014","","1","0","2019-10-19 15:21:43","2019-10-19 15:20:39");
INSERT INTO tbl_orders VALUES("16","4","10","6","ORD/00016","","1","1","2019-10-19 20:56:30","2019-10-19 20:23:34");



CREATE TABLE `tbl_owner` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_company_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_address` varchar(255) NOT NULL,
  `owner_city_id` int(11) NOT NULL,
  `owner_state_id` int(11) NOT NULL,
  `owner_pincode` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `owner_mobile` varchar(255) NOT NULL,
  `owner_company_pan_number` varchar(255) DEFAULT NULL,
  `owner_company_fssi_number` varchar(255) NOT NULL,
  `owner_bank_name` varchar(255) NOT NULL,
  `owner_bank_account_number` varchar(255) NOT NULL,
  `owner_bank_ifsc` varchar(255) NOT NULL,
  `owner_gst` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_owner VALUES("1","Nikki Bites","NIKKI BITES","New Vadodara","1","1","390007","nikkibites@demo.com","9898363557","PAN4525485","FSSI452856","HDFC Bank, New Sama Road, Vadodara","50200016346924","HDFC0000416","GST1234546564","2019-09-24 00:40:11","2019-09-23 22:17:09");



CREATE TABLE `tbl_packing` (
  `packing_id` int(11) NOT NULL AUTO_INCREMENT,
  `packing_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`packing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

INSERT INTO tbl_packing VALUES("1","10 X 5 Kg","2019-08-13 12:26:58");
INSERT INTO tbl_packing VALUES("2","5 X 10 Kg","2019-08-13 12:27:22");
INSERT INTO tbl_packing VALUES("3","1 X 25 Kg","2019-08-13 12:27:30");
INSERT INTO tbl_packing VALUES("4","1 X 50 KG","2019-08-13 14:45:25");
INSERT INTO tbl_packing VALUES("5","5 X 5 KG","2019-08-13 14:45:37");
INSERT INTO tbl_packing VALUES("6","1 X 45 KG","2019-08-13 14:46:04");
INSERT INTO tbl_packing VALUES("7","1 BUCKET","2019-08-13 14:46:39");
INSERT INTO tbl_packing VALUES("8","1 X 15 KG ","2019-08-13 14:46:51");
INSERT INTO tbl_packing VALUES("9","30 X 500 gm","2019-08-13 15:17:01");
INSERT INTO tbl_packing VALUES("10","40 X 100 gm.","2019-08-13 15:17:10");
INSERT INTO tbl_packing VALUES("11","40 X 250 gm.","2019-08-13 15:17:17");
INSERT INTO tbl_packing VALUES("12","20 X 500 gm.","2019-08-13 15:17:28");
INSERT INTO tbl_packing VALUES("13","10 X 1Kg.","2019-08-13 15:17:41");
INSERT INTO tbl_packing VALUES("14","30 X 200 gm.","2019-08-13 15:18:00");
INSERT INTO tbl_packing VALUES("15","20 X 500 ml.","2019-08-13 15:18:23");
INSERT INTO tbl_packing VALUES("16","10 X 1 Ltr.","2019-08-13 15:18:29");
INSERT INTO tbl_packing VALUES("17","2 X 5 Ltr.","2019-08-13 15:18:35");
INSERT INTO tbl_packing VALUES("18","12 X 2 Kg","2019-08-13 15:18:42");
INSERT INTO tbl_packing VALUES("19","25 X 1 kg.","2019-08-13 15:19:14");
INSERT INTO tbl_packing VALUES("20","20 X 400 gm.","2019-08-13 16:03:55");
INSERT INTO tbl_packing VALUES("21","40 X 250 ml.","2019-08-13 16:15:34");
INSERT INTO tbl_packing VALUES("22","15 X  1 KG","2019-08-13 16:15:55");
INSERT INTO tbl_packing VALUES("23","15 X 0.8 KG","2019-08-13 16:16:03");
INSERT INTO tbl_packing VALUES("24","10 X 1 LIT","2019-08-13 16:16:23");
INSERT INTO tbl_packing VALUES("25","2 X 5 LIT","2019-08-13 16:16:32");
INSERT INTO tbl_packing VALUES("26","10 X 800 gm","2019-08-13 16:16:48");
INSERT INTO tbl_packing VALUES("27","15 X 500 gm","2019-08-13 16:17:00");
INSERT INTO tbl_packing VALUES("28","20 X 500","2019-08-13 16:30:22");
INSERT INTO tbl_packing VALUES("29","40 X 200 gm","2019-08-13 16:34:11");
INSERT INTO tbl_packing VALUES("30","80 X 50 ml.","2019-08-13 16:42:18");
INSERT INTO tbl_packing VALUES("31","10 X 500 ml","2019-08-13 16:42:29");
INSERT INTO tbl_packing VALUES("32","5 X 1000 ml","2019-08-13 16:42:34");
INSERT INTO tbl_packing VALUES("33","5 X 5 Kg.","2019-08-13 16:42:52");
INSERT INTO tbl_packing VALUES("34","1 X 50 Kg.","2019-08-13 16:42:57");
INSERT INTO tbl_packing VALUES("35","1 X 25Kg.","2019-08-13 16:43:09");
INSERT INTO tbl_packing VALUES("36","40 X 50 gm.","2019-08-13 17:07:13");
INSERT INTO tbl_packing VALUES("37","50 X 100 ml.","2019-08-13 17:07:36");
INSERT INTO tbl_packing VALUES("38","10 X 1 kg.","2019-08-13 17:10:56");
INSERT INTO tbl_packing VALUES("39","25 X 1 KG","2019-08-14 11:38:36");
INSERT INTO tbl_packing VALUES("40","30 X 1 KG Drum","2019-08-14 11:38:43");
INSERT INTO tbl_packing VALUES("41","10 X 1 Lit.","2019-08-14 11:38:53");
INSERT INTO tbl_packing VALUES("42","8 x 3 KG","2019-08-14 11:39:05");
INSERT INTO tbl_packing VALUES("43","12 x 3 KG Drum","2019-08-14 11:39:15");
INSERT INTO tbl_packing VALUES("44","2 x 5 Lit.","2019-08-14 11:39:21");
INSERT INTO tbl_packing VALUES("45","24 x 100 Gm.","2019-08-14 11:39:29");
INSERT INTO tbl_packing VALUES("46","6 x 4 KG (Pouch)","2019-08-14 11:39:37");
INSERT INTO tbl_packing VALUES("47","1 x 10 KG (Bucket)","2019-08-14 11:39:43");
INSERT INTO tbl_packing VALUES("48","25 X 100 GM","2019-08-14 14:09:50");
INSERT INTO tbl_packing VALUES("49","25 X 50 GM","2019-08-14 14:25:45");
INSERT INTO tbl_packing VALUES("50","15 X 1.4 KG","2019-08-14 14:43:11");
INSERT INTO tbl_packing VALUES("51","25 KG","2019-08-14 14:43:21");
INSERT INTO tbl_packing VALUES("52","40 x 250 ml","2019-08-14 14:43:33");
INSERT INTO tbl_packing VALUES("53","20 x 500 ml","2019-08-14 14:43:39");
INSERT INTO tbl_packing VALUES("54","2 X 5 KG","2019-08-14 15:03:03");
INSERT INTO tbl_packing VALUES("55","10 KG	","2019-08-14 15:12:44");
INSERT INTO tbl_packing VALUES("56","1 KG	","2019-08-14 15:12:50");
INSERT INTO tbl_packing VALUES("58","60 X 1 gm+20 ml","2019-08-23 16:38:26");
INSERT INTO tbl_packing VALUES("59","35 X 1 Kg","2019-08-23 16:46:42");



CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_amount` double(10,0) DEFAULT NULL,
  `payment_bank` varchar(255) DEFAULT NULL COMMENT 'based on accouting type',
  `payment_utr_number` varchar(255) DEFAULT NULL,
  `payment_document` varchar(255) DEFAULT NULL,
  `payment_status` enum('0','1') NOT NULL DEFAULT '0',
  `payment_remark` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`payment_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO tbl_payments VALUES("1","2","2019-09-14 00:00:00","NEFT","500","SBI","1545482","d558bd4fce3070da998cc4d97d7c5c3d.png","1","ADASDASD","2019-09-22 01:24:22","2019-09-14 00:08:45");
INSERT INTO tbl_payments VALUES("2","6","2019-09-22 00:00:00","NEFT","500","SBI","0","","1","Hello There !","2019-09-28 19:38:46","2019-09-22 00:50:35");
INSERT INTO tbl_payments VALUES("3","6","2019-09-28 00:00:00","RTGS","5000","SBI","UTR14525","","1","ASDASDASDASD","2019-09-28 18:25:25","2019-09-28 18:24:59");
INSERT INTO tbl_payments VALUES("4","6","2019-10-06 00:00:00","NEFT","5500","SBI","123456785","","1","Test","2019-10-06 21:18:31","2019-10-06 21:03:22");
INSERT INTO tbl_payments VALUES("5","6","2019-10-06 00:00:00","NEFT","6500","SBI","UTR4561221","","0","asdasdas","2019-10-06 21:34:37","2019-10-06 21:34:37");
INSERT INTO tbl_payments VALUES("6","9","2019-10-19 00:00:00","NEFT","5000","SBI","UTR12452","","1","2 Invoices","2019-10-19 20:59:17","2019-10-19 20:59:04");
INSERT INTO tbl_payments VALUES("7","10","2019-10-19 00:00:00","NEFT","5000","SBI","UTR15226","","1","2 Invoices created","2019-10-19 21:02:12","2019-10-19 21:01:56");



CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_stock` int(11) unsigned NOT NULL,
  `product_packaging` varchar(255) NOT NULL,
  `product_billing_rate` varchar(255) NOT NULL,
  `product_gst` varchar(255) NOT NULL,
  `product_hsn_code` varchar(255) NOT NULL,
  `product_batch_number` varchar(255) NOT NULL,
  `product_discount` varchar(255) NOT NULL,
  `product_unit` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO tbl_product VALUES("1","2","2","Khatta Meetha Namkeen","100","4","40","12","HSN25452","","0","2","1","2019-10-19 21:20:24","2019-09-14 11:10:51");
INSERT INTO tbl_product VALUES("2","2","2","Ferrari Chevda","100","4","90","5","HSN785544","","0","2","1","2019-10-19 21:20:28","2019-09-14 11:10:51");
INSERT INTO tbl_product VALUES("3","2","2","Demo Product","45","2","15","12","HSN123456456465","","0","1","1","2019-10-13 18:09:08","2019-10-12 21:16:08");
INSERT INTO tbl_product VALUES("4","3","2","P1","0","1","250","12","HSN1264","","0","1","1","2019-10-19 20:56:29","2019-10-16 23:05:29");
INSERT INTO tbl_product VALUES("5","3","2","P2","15","3","500","5","HSNUIO","","0","1","1","2019-10-19 20:56:30","2019-10-16 23:05:40");



CREATE TABLE `tbl_product_stock_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stock_type` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `godown_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO tbl_product_stock_history VALUES("8","3","2","10","5","2019-10-12 21:39:46","2019-10-12 21:39:46");
INSERT INTO tbl_product_stock_history VALUES("9","3","1","5","5","2019-10-12 21:42:05","2019-10-12 21:42:05");
INSERT INTO tbl_product_stock_history VALUES("10","4","1","20","6","2019-10-16 23:12:31","2019-10-16 23:12:31");
INSERT INTO tbl_product_stock_history VALUES("11","5","1","30","6","2019-10-16 23:12:36","2019-10-16 23:12:36");
INSERT INTO tbl_product_stock_history VALUES("12","4","2","5","6","2019-10-16 23:13:03","2019-10-16 23:13:03");
INSERT INTO tbl_product_stock_history VALUES("13","5","2","5","6","2019-10-16 23:13:04","2019-10-16 23:13:04");
INSERT INTO tbl_product_stock_history VALUES("14","4","2","5","6","2019-10-19 14:46:05","2019-10-19 14:46:05");
INSERT INTO tbl_product_stock_history VALUES("15","2","1","30","6","2019-10-19 15:51:15","2019-10-19 15:51:15");
INSERT INTO tbl_product_stock_history VALUES("16","1","2","5","6","2019-10-19 16:26:53","2019-10-19 16:26:53");
INSERT INTO tbl_product_stock_history VALUES("17","2","2","10","6","2019-10-19 16:26:54","2019-10-19 16:26:54");
INSERT INTO tbl_product_stock_history VALUES("18","1","1","15","6","2019-10-19 16:27:49","2019-10-19 16:27:49");
INSERT INTO tbl_product_stock_history VALUES("19","1","2","5","6","2019-10-19 16:29:57","2019-10-19 16:29:57");
INSERT INTO tbl_product_stock_history VALUES("20","2","2","5","6","2019-10-19 16:29:57","2019-10-19 16:29:57");
INSERT INTO tbl_product_stock_history VALUES("21","1","2","5","6","2019-10-19 16:31:01","2019-10-19 16:31:01");
INSERT INTO tbl_product_stock_history VALUES("22","2","2","5","6","2019-10-19 16:31:01","2019-10-19 16:31:01");
INSERT INTO tbl_product_stock_history VALUES("23","1","2","5","6","2019-10-19 16:39:15","2019-10-19 16:39:15");
INSERT INTO tbl_product_stock_history VALUES("24","2","2","5","6","2019-10-19 16:39:15","2019-10-19 16:39:15");
INSERT INTO tbl_product_stock_history VALUES("25","1","2","5","6","2019-10-19 16:39:35","2019-10-19 16:39:35");
INSERT INTO tbl_product_stock_history VALUES("26","2","2","5","6","2019-10-19 16:39:35","2019-10-19 16:39:35");
INSERT INTO tbl_product_stock_history VALUES("27","4","2","5","6","2019-10-19 20:33:31","2019-10-19 20:33:31");
INSERT INTO tbl_product_stock_history VALUES("28","5","2","7","6","2019-10-19 20:33:31","2019-10-19 20:33:31");
INSERT INTO tbl_product_stock_history VALUES("29","4","2","5","6","2019-10-19 20:56:29","2019-10-19 20:56:29");
INSERT INTO tbl_product_stock_history VALUES("30","5","2","3","6","2019-10-19 20:56:30","2019-10-19 20:56:30");
INSERT INTO tbl_product_stock_history VALUES("31","1","1","100","6","2019-10-19 21:20:24","2019-10-19 21:20:24");
INSERT INTO tbl_product_stock_history VALUES("32","2","1","100","6","2019-10-19 21:20:28","2019-10-19 21:20:28");



CREATE TABLE `tbl_purchase_order_detail` (
  `purchase_order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_hsn` varchar(255) DEFAULT NULL,
  `product_qty` int(11) NOT NULL,
  `product_per_qty` double(10,2) NOT NULL COMMENT 'product price per qty',
  `product_discount` double(10,2) DEFAULT NULL,
  `product_gst` double(10,2) DEFAULT NULL,
  `product_gst_amount` double(10,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`purchase_order_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tbl_purchase_order_detail VALUES("5","3","X1","HSN451","10","500.00","0.00","12.00","600.00","2019-10-17 22:17:16","2019-10-17 22:17:16");
INSERT INTO tbl_purchase_order_detail VALUES("6","3","X2","HSN4562","5","250.00","0.00","5.00","62.50","2019-10-17 22:17:16","2019-10-17 22:17:16");
INSERT INTO tbl_purchase_order_detail VALUES("7","4","asdasd","asdas","20","100.00","0.00","12.00","240.00","2019-10-19 11:26:46","2019-10-19 11:26:46");



CREATE TABLE `tbl_purchase_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `po_date` varchar(255) DEFAULT NULL,
  `po_number` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `dispatch_through` varchar(255) DEFAULT NULL,
  `dispatch_by` varchar(255) DEFAULT NULL,
  `transport_by` varchar(255) DEFAULT NULL,
  `vehicle_number` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `admin_id` int(11) unsigned NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tbl_purchase_orders VALUES("2","12","2019-10-17","PO/00002","INV12345","Truck","Vadodara","Truck","gj062145","","3","1","2019-10-17 22:03:39","2019-10-17 22:03:39");
INSERT INTO tbl_purchase_orders VALUES("3","12","2019-10-17","PO/00003","INV101","Truck","asd","ad","asd","asd","3","1","2019-10-17 22:17:15","2019-10-17 22:17:15");
INSERT INTO tbl_purchase_orders VALUES("4","12","2019-10-10","PO/00004","as","asd","sad","sd","asd","sdasd","3","1","2019-10-19 11:26:46","2019-10-19 11:26:46");



CREATE TABLE `tbl_sales_person` (
  `sales_person_id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `sales_person_name` varchar(255) NOT NULL,
  `sales_person_designation` varchar(255) DEFAULT NULL,
  `sales_person_hq` varchar(255) DEFAULT NULL,
  `sales_person_mobile` varchar(255) DEFAULT NULL,
  `sales_person_doj` varchar(255) NOT NULL,
  `sales_person_dob` varchar(255) NOT NULL,
  `sales_person_pan` varchar(255) DEFAULT NULL,
  `sales_person_email` varchar(255) NOT NULL,
  `sales_person_aadhaar` varchar(255) DEFAULT NULL,
  `sales_person_aadhaar_number` varchar(255) DEFAULT NULL,
  `sales_person_password` varchar(255) NOT NULL,
  `sales_person_spouse_name` varchar(255) DEFAULT NULL,
  `sales_person_spouse_mobile` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sales_person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

INSERT INTO tbl_sales_person VALUES("7","1","HARDIK PATEL","ASM","ANAND","9510775567","2017-05-22","1986-07-08","BFSPP6122A","hardik@agriconfertilizers.com","","644669979093","hardik","","","1","2019-08-16 22:40:11","2019-06-04 11:46:10");
INSERT INTO tbl_sales_person VALUES("8","0","SHAILESH PATEL","ASM","RAJKOT","9727765399","2019-01-01","1970-01-01","","shailesh@agriconfertilizers.com","","","shailesh","","","1","2019-06-29 08:55:39","2019-06-04 11:48:02");
INSERT INTO tbl_sales_person VALUES("9","1","KALPESH JADAV","ASM","GANDHINAGAR","9429323513","2016-06-01","1985-02-03","AKTPJ2057K","kalpesh@agriconfertilizers.com","uploads/aadhaar/IMG_5d6612d1b20a7.jpeg","725858784247","kalpesh","Hansaben Jadav","9974071765","1","2019-08-28 11:06:17","2019-06-04 11:50:03");
INSERT INTO tbl_sales_person VALUES("10","1","VIPUL KAMANI","","RAJKOT","9974071765","2016-06-01","1984-06-28","","vipul@agriconfertilizers.com","uploads/aadhaar/IMG_5d172e0aea7d3.jpeg","405832203835","vipul","NAYNABEN KAMANI","9974071765","1","2019-08-16 22:40:11","2019-06-04 13:30:09");
INSERT INTO tbl_sales_person VALUES("11","1","ABHAYSING VALA","SALES","JAMNAGAR","9825088760","2017-08-01","1986-12-01","AXVPV6656P","abhay@agriconfertilizers.com","","","abhay","","","1","2019-08-16 22:40:11","2019-06-05 05:12:01");
INSERT INTO tbl_sales_person VALUES("12","1","MANSUKH DABHI","SALES EXCUTIVE","JUNAGADH","9924525120","2017-07-01","1970-01-01","ANAPD2099K","mansukh@agriconfertilizers.com","","","mansukh","","","1","2019-08-16 22:40:11","2019-06-05 05:14:31");
INSERT INTO tbl_sales_person VALUES("13","1","NARSINHBHAI KOLADIA","","BARODA","9925253147","2016-06-01","1956-08-16","","narsinhbhai@agriconfertilizers.com","","365109418612","narsinhbhai","","","1","2019-08-16 22:40:11","2019-06-05 05:18:29");
INSERT INTO tbl_sales_person VALUES("14","1","PANKAJ KORIA","","UPLETA","9925235147","2017-05-10","1974-05-03","BEGPK1879C","pankaj@agriconfertilizers.com","","646028380227","pankaj","","","1","2019-08-16 22:40:11","2019-06-05 05:20:08");
INSERT INTO tbl_sales_person VALUES("15","1","BHAVESH PANCHASARA","","DEESA","9923547815","2016-06-01","1993-08-26","BWWPP9214N","bhavesh@agriconfertilizers.com","","467322379222","bhavesh","","","1","2019-08-16 22:40:11","2019-06-05 05:21:23");
INSERT INTO tbl_sales_person VALUES("16","1","MITESH PANCHAL","","PALANPUR","9958746285","2016-06-01","1979-09-20","AUDPP9400A","mitesh@agriconfertilizers.com","","259169077505","mitesh","","","1","2019-08-16 22:40:11","2019-06-05 05:22:22");
INSERT INTO tbl_sales_person VALUES("17","1","SURAT","","SURAT","9958424754","1970-01-01","1970-01-01","","surat@agriconfertilizers.com","","","surat","","","1","2019-08-28 15:53:49","2019-06-05 05:23:21");
INSERT INTO tbl_sales_person VALUES("20","0","KAMLESH LAD","SALES EXECUTIVE","","95254614875","","","JIJDWDWD","kamlesh@agriconfertilizers.com","","","kamlesh","","","1","2019-06-14 12:29:23","2019-06-14 12:29:23");
INSERT INTO tbl_sales_person VALUES("21","1","NAIMISH PATEL","SALES EXECUTIVE","VADODARA","954444514584","2017-07-01","1970-01-01","BRBPP8946H","naimish@agriconfertilizers.com","","470211891964","naimish","","","1","2019-08-16 22:40:11","2019-06-14 12:32:08");
INSERT INTO tbl_sales_person VALUES("22","1","JAYANTI PRAJAPATI","SALES EXECUTIVE","MEHSANA","945158158482","2019-04-01","1966-06-01","BVVPP7086A","jayanti@agriconfertilizers.com","","598054339475","jayanti","","","1","2019-08-16 22:40:11","2019-06-14 12:33:26");
INSERT INTO tbl_sales_person VALUES("23","1","VISHNU HERMA","SALES EXECUTIVE","KUTCH","941515158554","1970-01-01","1970-01-01","","vishnu@agriconfertilizers.com","","","vishnu","","","1","2019-08-16 22:40:11","2019-06-14 12:37:05");
INSERT INTO tbl_sales_person VALUES("24","1","HARSHIL D PATEL","SALES EXECUTIVE","IDAR","951232458621","2016-09-01","1994-12-20","","harshil@agriconfertilizers.com","","443206117205","harshil","","","1","2019-08-16 22:40:11","2019-06-18 10:13:48");
INSERT INTO tbl_sales_person VALUES("27","1","asda","asdasdas","adasd","9898363557","2019-08-16","2019-08-16","44545456","sales@demo.com","uploads/aadhaar/IMG_5d56e3a61f660.jpg","xcvxcv","12345","asd","9595959595","1","2019-08-16 22:41:02","2019-08-16 22:41:02");
INSERT INTO tbl_sales_person VALUES("28","1","sadsd","","","9595959595","2019-08-16","2019-08-23","","sanjivm43@gmail.com","","","12345","","","1","2019-08-16 22:47:18","2019-08-16 22:47:18");
INSERT INTO tbl_sales_person VALUES("29","1","KAMLESH LAD","SALES REPRESENTATIVE","SURAT","9925235880","2016-01-08","1972-11-22","ABKPL4247M","kamlesh@agriconfertilizers.com","","452384964187","kamlesh","JAYSHRIBEN","","1","2019-08-28 18:58:40","2019-08-28 18:58:40");



CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) NOT NULL,
  `state_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_state VALUES("1","Gujarat","","2019-08-13 12:14:26");



CREATE TABLE `tbl_super_admin` (
  `super_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`super_admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_super_admin VALUES("1","admin","admin","2019-02-26 15:32:36");



CREATE TABLE `tbl_target` (
  `target_id` int(11) NOT NULL AUTO_INCREMENT,
  `target_year` int(11) NOT NULL,
  `target_month` int(11) DEFAULT NULL COMMENT 'tbl_target_months(month_id)',
  `target_amount` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`target_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO tbl_target VALUES("2","2019","9","25000","6","2","2019-09-21 21:47:42");
INSERT INTO tbl_target VALUES("3","2019","10","20000","9","3","2019-10-16 00:00:00");
INSERT INTO tbl_target VALUES("4","2019","9","30000","10","3","2019-10-19 20:19:17");
INSERT INTO tbl_target VALUES("5","2019","10","30000","10","3","2019-10-19 20:19:47");
INSERT INTO tbl_target VALUES("6","2019","11","45000","10","3","2019-10-19 20:21:58");



CREATE TABLE `tbl_target_months` (
  `month_id` int(11) NOT NULL AUTO_INCREMENT,
  `month_name` varchar(255) NOT NULL,
  PRIMARY KEY (`month_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO tbl_target_months VALUES("1","JANUARY");
INSERT INTO tbl_target_months VALUES("2","FEBRUARY");
INSERT INTO tbl_target_months VALUES("3","MARCH");
INSERT INTO tbl_target_months VALUES("4","APRIL");
INSERT INTO tbl_target_months VALUES("5","MAY");
INSERT INTO tbl_target_months VALUES("6","JUNE");
INSERT INTO tbl_target_months VALUES("7","JULY");
INSERT INTO tbl_target_months VALUES("8","AUGUST");
INSERT INTO tbl_target_months VALUES("9","SEPTEMBER");
INSERT INTO tbl_target_months VALUES("10","OCTOBER");
INSERT INTO tbl_target_months VALUES("11","NOVEMBER");
INSERT INTO tbl_target_months VALUES("12","DECEMBER");



CREATE TABLE `tbl_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO tbl_unit VALUES("1","BAGS","2019-08-13 12:27:59");
INSERT INTO tbl_unit VALUES("2","POUCH","2019-08-13 12:28:08");
INSERT INTO tbl_unit VALUES("3","BOTTLE","2019-08-23 14:10:31");



CREATE TABLE `tbl_user_roles` (
  `user_role_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_user_roles VALUES("37","1","23","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("38","1","24","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("39","1","25","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("40","1","26","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("41","1","34","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("42","1","35","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("43","1","36","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("44","1","37","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("45","1","38","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("46","1","39","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("47","1","40","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("48","1","41","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("49","1","42","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("50","1","43","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("51","1","44","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("52","1","45","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("53","1","46","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("54","1","47","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("55","1","48","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("56","1","49","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("57","1","50","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("58","1","51","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("59","1","52","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("60","1","53","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("61","1","54","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("62","1","55","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("63","1","56","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("64","1","57","2019-08-24 14:47:53");
INSERT INTO tbl_user_roles VALUES("65","1","58","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("66","1","59","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("67","1","60","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("68","1","61","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("69","1","62","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("70","1","63","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("71","1","64","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("72","1","65","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("73","1","66","2019-08-24 14:47:54");
INSERT INTO tbl_user_roles VALUES("0","2","23","2019-10-14 23:28:30");
INSERT INTO tbl_user_roles VALUES("0","2","24","2019-10-14 23:28:30");
INSERT INTO tbl_user_roles VALUES("0","2","25","2019-10-14 23:28:30");
INSERT INTO tbl_user_roles VALUES("0","2","26","2019-10-14 23:28:30");
INSERT INTO tbl_user_roles VALUES("0","2","38","2019-10-14 23:28:30");
INSERT INTO tbl_user_roles VALUES("0","2","39","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","40","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","41","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","42","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","43","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","44","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","45","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","46","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","47","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","48","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","49","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","50","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","51","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","52","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","53","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","54","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","55","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","56","2019-10-14 23:28:31");
INSERT INTO tbl_user_roles VALUES("0","2","57","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","58","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","67","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","68","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","69","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","70","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","71","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","72","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","73","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","74","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","75","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","76","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","77","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","78","2019-10-14 23:28:32");
INSERT INTO tbl_user_roles VALUES("0","2","79","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","80","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","81","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","82","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","83","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","84","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","85","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","86","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","87","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","88","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","89","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","90","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","91","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","92","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","93","2019-10-14 23:28:33");
INSERT INTO tbl_user_roles VALUES("0","2","94","2019-10-14 23:28:34");
INSERT INTO tbl_user_roles VALUES("0","2","96","2019-10-14 23:28:34");
INSERT INTO tbl_user_roles VALUES("0","2","97","2019-10-14 23:28:34");
INSERT INTO tbl_user_roles VALUES("0","2","98","2019-10-14 23:28:34");
INSERT INTO tbl_user_roles VALUES("0","3","23","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","24","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","25","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","26","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","38","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","39","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","40","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","41","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","42","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","43","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","44","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","45","2019-10-17 21:59:20");
INSERT INTO tbl_user_roles VALUES("0","3","46","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","47","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","48","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","49","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","50","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","51","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","52","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","53","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","54","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","55","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","56","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","57","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","58","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","67","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","68","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","69","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","70","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","71","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","72","2019-10-17 21:59:21");
INSERT INTO tbl_user_roles VALUES("0","3","73","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","74","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","75","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","76","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","77","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","78","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","79","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","80","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","81","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","82","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","83","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","84","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","85","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","86","2019-10-17 21:59:22");
INSERT INTO tbl_user_roles VALUES("0","3","87","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","88","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","89","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","90","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","91","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","92","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","93","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","94","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","96","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","97","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","98","2019-10-17 21:59:23");
INSERT INTO tbl_user_roles VALUES("0","3","99","2019-10-17 21:59:23");



CREATE TABLE `tbl_user_types` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user_types VALUES("1","Super Admin","2019-02-25 18:28:10","2019-02-25 18:28:10");
INSERT INTO tbl_user_types VALUES("2","Admin","2019-02-25 18:28:10","2019-02-25 18:28:10");
INSERT INTO tbl_user_types VALUES("3","Godown","2019-09-13 23:08:30","2019-02-25 18:28:10");
INSERT INTO tbl_user_types VALUES("4","Customer/Distributer","2019-09-28 18:26:27","2019-09-13 23:07:57");



CREATE TABLE `tbl_vendors` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_code` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `vendor_address` varchar(255) NOT NULL,
  `vendor_pincode` varchar(255) DEFAULT NULL,
  `vendor_email` varchar(255) DEFAULT NULL,
  `vendor_password` varchar(255) NOT NULL,
  `vendor_landline` varchar(255) DEFAULT NULL,
  `vendor_mobile` varchar(255) DEFAULT NULL,
  `vendor_gst` varchar(255) DEFAULT NULL,
  `vendor_gst_type` enum('1','2') DEFAULT NULL,
  `vendor_gst_certificate` varchar(255) DEFAULT NULL,
  `vendor_mode_of_payment` varchar(255) DEFAULT NULL,
  `vendor_pan` varchar(255) DEFAULT NULL,
  `vendor_aadhaar` varchar(255) DEFAULT NULL,
  `vendor_aadhaar_number` varchar(255) DEFAULT NULL,
  `vendor_food_license_certificate` varchar(255) DEFAULT NULL,
  `vendor_credit_limit` varchar(11) DEFAULT NULL,
  `vendor_credit_limit_days` varchar(11) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`vendor_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO tbl_vendors VALUES("8","","2","asdasd","asdas","","","vendor@demo.com","123456","","9595959595","GST45256325","2","","Cash","","","UIDUI456421","","100000","25","1","2019-10-14 22:56:42","0000-00-00 00:00:00");
INSERT INTO tbl_vendors VALUES("9","VE/00009","2","asdasd","asdas","","","vendor@demo.com","123456","","9595959595","GST45256325","2","","Cash","","","UIDUI456421","","100000","25","1","2019-09-13 19:07:43","0000-00-00 00:00:00");
INSERT INTO tbl_vendors VALUES("10","VE/00010","2","asddas","","","","asda@demo.com","12345","","9898363557","gst1123465","2","5c80903cc2ea125a98b49ff1d90988e4.png","Cash","","","aad4562154","","50000","25","1","2019-09-13 22:14:32","2019-09-13 22:14:32");
INSERT INTO tbl_vendors VALUES("11","VE/00011","2","Vendor Rakesh","Rakhesh Sharma","New Sama Road","39002","vendor_rakesh@demo.com","123456","","9898363557","123456","1","","","","","aa16452","","10","20","1","2019-10-12 18:24:43","2019-10-12 18:24:43");
INSERT INTO tbl_vendors VALUES("12","VE/00012","3","Vendor 1","Vendor 1","Vadodara","390024","sanjivm43@gmail.com","","","9898363557","gst123456","1","","Cash","pan1246565","","aad456489","","25000","50","1","2019-10-17 22:01:00","2019-10-17 22:01:00");


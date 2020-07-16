-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2017 at 11:25 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `badsa_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcod_master`
--

CREATE TABLE IF NOT EXISTS `barcod_master` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `size_type` varchar(255) NOT NULL,
  `medicine_id` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `barcod_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `drug_master`
--

CREATE TABLE IF NOT EXISTS `drug_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicine_id` varchar(255) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `drug_value` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `drug_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `employee_master`
--

CREATE TABLE IF NOT EXISTS `employee_master` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) NOT NULL,
  `emp_name` varchar(254) NOT NULL,
  `job_role` varchar(254) NOT NULL,
  `user_name` varchar(254) NOT NULL,
  `user_psswd` varchar(254) NOT NULL,
  `emp_cnct` varchar(254) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employee_master`
--

INSERT INTO `employee_master` (`emp_id`, `user_type`, `emp_name`, `job_role`, `user_name`, `user_psswd`, `emp_cnct`, `status`, `date`) VALUES
(1, '0', 'Administrator', 'admin', 'admin', '123', '1111111111', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `key`
--

CREATE TABLE IF NOT EXISTS `key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `key`
--

INSERT INTO `key` (`id`, `key`, `time`) VALUES
(1, 'f16c38d8c9ef0507d4f15fd83a11a109', '2017-05-29 18:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `ph_category_master`
--

CREATE TABLE IF NOT EXISTS `ph_category_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categ_name` varchar(255) NOT NULL,
  `medi_tax` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ph_category_master`
--

INSERT INTO `ph_category_master` (`id`, `categ_name`, `medi_tax`, `status`, `date`) VALUES
(3, 'SHOES', '0', '1', '27-05-2017'),
(4, 'CHAPPEL', '0', '1', '27-05-2017'),
(1, 'test', '0', '1', '2017-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `ph_config_master`
--

CREATE TABLE IF NOT EXISTS `ph_config_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `com_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sch_img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ph_config_master`
--

INSERT INTO `ph_config_master` (`id`, `name`, `com_name`, `address`, `mobile`, `email`, `sch_img`, `status`, `date`) VALUES
(1, 'BADSA', 'BADSA ', 'BARASAT ROAD, GHOLA BAZAR, KOLKATA - 700 110,', '033 2565 4645', '', '1495627301_logo1.png', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `ph_employee_master`
--

CREATE TABLE IF NOT EXISTS `ph_employee_master` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ph_employee_master`
--

INSERT INTO `ph_employee_master` (`id`, `emp_name`, `employee_id`, `mobile`, `email`, `address`, `salary`, `status`, `date`) VALUES
(1, 'Bijay', 'B/EMP/1', '9231520717', 'deepbhakat@gmail.com', '172/5, Picnic Garden Road,', '30000', '1', '2017-05-18'),
(2, 'ram', 'B/EMP/2', '9231520717', 'deepbhakat@gmail.com', '172/5, Picnic Garden Road,', '20000', '1', '01-06-2017');

-- --------------------------------------------------------

--
-- Table structure for table `ph_medicine_master`
--

CREATE TABLE IF NOT EXISTS `ph_medicine_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categ_id` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `medici_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ph_medicine_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_patient_master`
--

CREATE TABLE IF NOT EXISTS `ph_patient_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pati_name` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `acc_no` varchar(255) NOT NULL,
  `bank_name2` varchar(255) NOT NULL,
  `acc_no2` varchar(255) NOT NULL,
  `bank_name3` varchar(255) NOT NULL,
  `acc_no3` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ph_patient_master`
--

INSERT INTO `ph_patient_master` (`id`, `pati_name`, `customer_id`, `address`, `mobile`, `email`, `bank_name`, `acc_no`, `bank_name2`, `acc_no2`, `bank_name3`, `acc_no3`, `status`, `date`) VALUES
(1, 'TAPAN SHAW', 'B/CUS/1', '172/5, Picnic Garden Road,', '09231520717', 'deepbhakat@gmail.com', '', '', '', '', '', '', '1', '2017-04-23'),
(2, 'NANDA LAL YADAV', 'B/CUS/2', 'KOLKATA', '9858458475', 'RAM@RAM.CIN', '', '', '', '', '', '', '1', '2017-05-27'),
(4, 'ww', 'B/CUS/4', '172/5, Picnic Garden Road,', '9231520717', 'deepbhakat@gmail.com', '', '', '', '', '', '', '1', '2017-06-03'),
(6, 'aaaa', 'B/CUS/6', '172/5, Picnic Garden Road,', '09231520717', 'deepbhakat@gmail.com', '', '', '', '', '', '', '1', '2017-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `ph_purchase_master`
--

CREATE TABLE IF NOT EXISTS `ph_purchase_master` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(255) NOT NULL,
  `voucher_date` varchar(255) NOT NULL,
  `sup_id` varchar(255) NOT NULL,
  `bill_date` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `medicine_id` varchar(255) NOT NULL,
  `for_type` varchar(255) NOT NULL,
  `size_type` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `ptr` varchar(255) NOT NULL,
  `base_type` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `nts` varchar(255) NOT NULL,
  `dis_status` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `tax_status` varchar(255) NOT NULL,
  `taxpm` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_rate` varchar(255) NOT NULL,
  `total_rate_p` varchar(255) NOT NULL,
  `total_qty_p` varchar(255) NOT NULL,
  `dis_amt` varchar(255) NOT NULL,
  `after_dis` varchar(255) NOT NULL,
  `tax_amt` varchar(255) NOT NULL,
  `net_amt` varchar(255) NOT NULL,
  `dis_amtb` varchar(255) NOT NULL,
  `after_disb` varchar(255) NOT NULL,
  `tax_amtb` varchar(255) NOT NULL,
  `net_amtb` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ph_purchase_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_purchase_return`
--

CREATE TABLE IF NOT EXISTS `ph_purchase_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(255) NOT NULL,
  `return_no` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `purchase_id` varchar(255) NOT NULL,
  `sup_id` varchar(255) NOT NULL,
  `medicine_id` varchar(255) NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `ptr` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `for_type` varchar(255) NOT NULL,
  `size_type` varchar(255) NOT NULL,
  `qtyih` varchar(255) NOT NULL,
  `return_qty` varchar(255) NOT NULL,
  `tot_amt` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ph_purchase_return`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_rate_info`
--

CREATE TABLE IF NOT EXISTS `ph_rate_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(255) NOT NULL,
  `medici_name` varchar(255) NOT NULL,
  `qihs` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ph_rate_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_sales_master`
--

CREATE TABLE IF NOT EXISTS `ph_sales_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_date` varchar(255) NOT NULL,
  `ph_emp_id` varchar(255) NOT NULL,
  `pati_id` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `purchase_id` varchar(255) NOT NULL,
  `medicine_id` varchar(255) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `size_type` varchar(255) NOT NULL,
  `for_type` varchar(255) NOT NULL,
  `qtyih` varchar(255) NOT NULL,
  `sale_qty` varchar(255) NOT NULL,
  `gross_amt` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `update_invoice` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ph_sales_master`
--

INSERT INTO `ph_sales_master` (`id`, `bill_date`, `ph_emp_id`, `pati_id`, `barcode`, `purchase_id`, `medicine_id`, `mrp`, `item_name`, `size_type`, `for_type`, `qtyih`, `sale_qty`, `gross_amt`, `invoice_no`, `receipt_no`, `update_invoice`, `status`, `date`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `ph_sales_payment`
--

CREATE TABLE IF NOT EXISTS `ph_sales_payment` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `dis_status` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `dis_amt` varchar(255) NOT NULL,
  `credit_amt` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `cheque_date` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `gros_amt` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `totgg_amt` varchar(255) NOT NULL,
  `net_amt` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ph_sales_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_sale_return`
--

CREATE TABLE IF NOT EXISTS `ph_sale_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_no` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `purchase_id` varchar(255) NOT NULL,
  `pati_id` varchar(255) NOT NULL,
  `medicine_id` varchar(255) NOT NULL,
  `sale_id` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `dis_amt` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `for_type` varchar(255) NOT NULL,
  `size_type` varchar(255) NOT NULL,
  `return_qty` varchar(255) NOT NULL,
  `tot_amt` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ph_sale_return`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_supplier_master`
--

CREATE TABLE IF NOT EXISTS `ph_supplier_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_name` varchar(255) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `cperson_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `acc_no` varchar(255) NOT NULL,
  `bank_name2` varchar(255) NOT NULL,
  `acc_no2` varchar(255) NOT NULL,
  `bank_name3` varchar(255) NOT NULL,
  `acc_no3` varchar(255) NOT NULL,
  `cst_no` varchar(255) NOT NULL,
  `gst_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ph_supplier_master`
--

INSERT INTO `ph_supplier_master` (`id`, `sup_name`, `supplier_id`, `address`, `city`, `state`, `cperson_name`, `mobile`, `email`, `bank_name`, `acc_no`, `bank_name2`, `acc_no2`, `bank_name3`, `acc_no3`, `cst_no`, `gst_no`, `status`, `date`) VALUES
(1, 'HARI KRISHNA YADAV', 'B/SUP/1', 'KOLKATA', 'KOAKTA', 'WEST BENGAL', 'MR M M GHOSH', '88888778', 'ram@gmail.com', 'S', '', '', '', '', '', '657657', 'GST - 75444', '1', '2017-04-23'),
(2, 'NANDA KISHORE  YADAV', 'B/SUP/2', 'KOLKATA', 'KOLKATA', 'WEST BENGAL', 'MR HARISH BABU', '9858458475', 'RAM@RAM.CIN', '', '', '', '', '', '', '', '', '1', '2017-05-27'),
(3, 'Manik c/howdhury', 'B/SUP/3', '172/5, Picnic Garden Road,', 'Kolkata', 'West Bengal', 'paban', '09231520717', 'deepbhakat@gmail.com', '', '', '', '', '', '', '', '', '1', '2017-06-03'),
(4, 'SIDDHESWARI HOSIERY', 'B/SUP/4', '172/5, Picnic Garden Road,', '', 'West Bengal', 'pabanj', '09231520717', '', '', '', '', '', '', '', '', '', '1', '2017-06-03'),
(6, 'awww', 'B/SUP/6', '172/5, Picnic Garden Road,', 'Kolkata', 'West Bengal', '', '09231520717', 'deepbhakat@gmail.com', '', '', '', '', '', '', '', '', '1', '2017-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `ph_supplier_payment`
--

CREATE TABLE IF NOT EXISTS `ph_supplier_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(255) NOT NULL,
  `sup_id` varchar(255) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `cheque_date` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `less_pay` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ph_supplier_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_temp_sales_master`
--

CREATE TABLE IF NOT EXISTS `ph_temp_sales_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_date` varchar(255) NOT NULL,
  `pati_type` varchar(255) NOT NULL,
  `pati_id` varchar(255) NOT NULL,
  `pati_name` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `bed_no` varchar(255) NOT NULL,
  `refer_id` varchar(255) NOT NULL,
  `purchase_id` varchar(255) NOT NULL,
  `medicine_id` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `base` varchar(255) NOT NULL,
  `qty_inhand` varchar(255) NOT NULL,
  `iss_qty` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `dico_per` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `gross_amt` varchar(255) NOT NULL,
  `dis_amt` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `update_invoice` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payandprint` int(1) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ph_temp_sales_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `ph_type_master`
--

CREATE TABLE IF NOT EXISTS `ph_type_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categ_id` varchar(255) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ph_type_master`
--

INSERT INTO `ph_type_master` (`id`, `categ_id`, `type_name`, `status`, `date`) VALUES
(2, '2', 'MINU', '1', '08-04-2017'),
(3, '1', 'LG', '1', '23-04-2017'),
(4, '4', 'KOLAPURI', '1', '27-05-2017'),
(5, '3', 'SHREE LEATHER', '1', '27-05-2017'),
(7, '3', 'aaaa', '1', '08-06-2017');

-- --------------------------------------------------------

--
-- Table structure for table `quick_bill`
--

CREATE TABLE IF NOT EXISTS `quick_bill` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `for_type` varchar(255) NOT NULL,
  `size_type` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `tot_amt` varchar(255) NOT NULL,
  `dis_status` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `dis_amt` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quick_bill`
--


-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `date`) VALUES
(1, '2018-03-01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

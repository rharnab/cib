-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 07:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cib`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `findStringfromnumber`(in_string VARCHAR(50)) RETURNS varchar(60) CHARSET latin1
    NO SQL
BEGIN
    DECLARE ctrNumber VARCHAR(50);
    DECLARE finNumber VARCHAR(50) DEFAULT '';
    DECLARE sChar VARCHAR(1);
    DECLARE inti INTEGER DEFAULT 1;

    IF LENGTH(in_string) > 0 THEN
        WHILE(inti <= LENGTH(in_string)) DO
            SET sChar = SUBSTRING(in_string, inti, 1);
            SET ctrNumber = FIND_IN_SET(sChar, '0,1,2,3,4,5,6,7,8,9'); 
            IF ctrNumber > 0 THEN
                SET finNumber = CONCAT(finNumber, sChar);
            END IF;
            SET inti = inti + 1;
        END WHILE;
        RETURN CAST(finNumber AS UNSIGNED);
    ELSE
        RETURN 0;
    END IF;    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_summary`
--

CREATE TABLE IF NOT EXISTS `account_summary` (
  `IdClient` varchar(50) NOT NULL,
  `CARD_LIST` varchar(50) NOT NULL,
  `STATEMENT_DATE` varchar(50) NOT NULL,
  `ACCOUNTNO` varchar(50) NOT NULL,
  `STATEMENT_DATE_SORT` date NOT NULL,
  `OVLFEE_AMOUNT` varchar(50) NOT NULL,
  `OVDFEE_AMOUNT` varchar(50) NOT NULL,
  `SUM_REVERSE` varchar(50) NOT NULL,
  `SUM_CREDIT` varchar(50) NOT NULL,
  `SUM_OTHER` varchar(50) NOT NULL,
  `SUM_INTEREST` varchar(50) NOT NULL,
  `SUM_PURCHASE` varchar(50) NOT NULL,
  `SUM_WITHDRAWAL` varchar(50) NOT NULL,
  `MIN_AMOUNT_DUE` varchar(50) NOT NULL,
  `AVAIL_CASH_LIMIT` varchar(50) NOT NULL,
  `CASH_LIMIT` varchar(50) NOT NULL,
  `INSTALL_UNPAID_AMOUNT` varchar(50) NOT NULL,
  `INSTALL_MONTH_PAYM` varchar(50) NOT NULL,
  `AVAIL_CRD_LIMIT` varchar(50) NOT NULL,
  `CRD_LIMIT` varchar(50) NOT NULL,
  `EBALANCE` varchar(50) NOT NULL,
  `SBALANCE` varchar(50) NOT NULL,
  `ACURC` varchar(50) NOT NULL,
  `ACURN` varchar(50) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `uploadedFIleName` varchar(200) NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
`br_key` int(11) NOT NULL,
  `br_code` varchar(4) NOT NULL DEFAULT '',
  `br_name` varchar(100) NOT NULL DEFAULT '',
  `br_add` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
`id` int(11) NOT NULL,
  `br_title` varchar(120) NOT NULL,
  `br_code` varchar(9) NOT NULL,
  `br_address` longtext NOT NULL,
  `br_city` longtext NOT NULL,
  `br_division` longtext,
  `br_phone` varchar(50) DEFAULT NULL,
  `br_email` varchar(50) DEFAULT NULL,
  `swift_code` varchar(200) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_action`
--

CREATE TABLE IF NOT EXISTS `card_action` (
`action_id` int(11) NOT NULL,
  `accont_no` varchar(20) NOT NULL,
  `card_on_name` varchar(200) DEFAULT NULL,
  `request_type` varchar(10) NOT NULL,
  `request_branch` int(11) NOT NULL,
  `request_date_br` datetime NOT NULL,
  `request_by_br` varchar(50) NOT NULL,
  `auth_by_br` varchar(50) NOT NULL,
  `request_by_ho` varchar(50) NOT NULL,
  `auth_by_ho` varchar(50) NOT NULL,
  `request_br_athu_date` datetime NOT NULL,
  `ho_request_date` datetime NOT NULL,
  `ho_approve_date` datetime NOT NULL,
  `card_no` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_charge_temp`
--

CREATE TABLE IF NOT EXISTS `card_charge_temp` (
`temp_id` int(11) NOT NULL,
  `card_holder_name` varchar(200) NOT NULL,
  `card_no_file` varchar(200) NOT NULL,
  `account_no_file` varchar(200) NOT NULL,
  `payable_net_amount` varchar(50) NOT NULL,
  `payable_vat_amount` varchar(50) NOT NULL,
  `debit_amount` varchar(50) NOT NULL,
  `upload_dt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_close`
--

CREATE TABLE IF NOT EXISTS `card_close` (
`id` bigint(20) unsigned NOT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closing_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report',
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3683 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `card_status`
--

CREATE TABLE IF NOT EXISTS `card_status` (
`id` int(11) NOT NULL,
  `status_type` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cib_download_history`
--

CREATE TABLE IF NOT EXISTS `cib_download_history` (
`id` int(11) NOT NULL,
  `download_file` varchar(200) DEFAULT NULL,
  `download_by` varchar(10) DEFAULT NULL,
  `reporting_date` varchar(50) DEFAULT NULL,
  `download_timestamp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cib_error`
--

CREATE TABLE IF NOT EXISTS `cib_error` (
`id` int(11) NOT NULL,
  `error_type` varchar(10) DEFAULT NULL,
  `error_code` varchar(10) DEFAULT NULL,
  `error_description` text,
  `query` text,
  `condition` varchar(250) DEFAULT NULL,
  `error_field` text
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cib_generate_history`
--

CREATE TABLE IF NOT EXISTS `cib_generate_history` (
`id` bigint(20) unsigned NOT NULL,
  `mis_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cl_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_timestamp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cib_history_log`
--

CREATE TABLE IF NOT EXISTS `cib_history_log` (
`id` bigint(20) unsigned NOT NULL,
  `mis_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cl_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_timestamp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_timestamp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_table`
--

CREATE TABLE IF NOT EXISTS `cl_table` (
`id` bigint(20) unsigned NOT NULL,
  `personal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_address` text COLLATE utf8mb4_unicode_ci,
  `resident_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_address` text COLLATE utf8mb4_unicode_ci,
  `correspondence_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenced_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketed_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statement_cycle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unpaid_emi_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliquency` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report'
) ENGINE=MyISAM AUTO_INCREMENT=32939 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_table_archive`
--

CREATE TABLE IF NOT EXISTS `cl_table_archive` (
`id` bigint(20) unsigned NOT NULL,
  `personal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_address` text COLLATE utf8mb4_unicode_ci,
  `resident_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_address` text COLLATE utf8mb4_unicode_ci,
  `correspondence_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenced_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketed_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statement_cycle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unpaid_emi_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliquency` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report',
  `archive_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18508 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts_info`
--

CREATE TABLE IF NOT EXISTS `contracts_info` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_contract_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_phase` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code_of_credit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date_of_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planned_end_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_end_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periodicity_of_payment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_of_payment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_instalment_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_limit` int(100) DEFAULT NULL,
  `exp_date_of_next_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_amt` int(100) DEFAULT NULL,
  `number_of_overdue_and_not_paid_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt` int(100) DEFAULT NULL,
  `date_of_last_charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_charged_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_delay_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recovery_due` int(100) DEFAULT NULL,
  `recovery_during_the_reporting_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cumulative_recovery` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_law_suit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_classification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times_rescheduled` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `economic_purpose_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaulter_flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_disburse_amt` int(100) DEFAULT NULL,
  `outstanding_amt` int(100) DEFAULT NULL,
  `flag_update` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_dollar` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2657 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts_info_archive`
--

CREATE TABLE IF NOT EXISTS `contracts_info_archive` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_contract_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_phase` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code_of_credit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date_of_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planned_end_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_end_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periodicity_of_payment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_of_payment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_instalment_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_limit` int(100) DEFAULT NULL,
  `exp_date_of_next_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_amt` int(100) DEFAULT NULL,
  `number_of_overdue_and_not_paid_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt` int(100) DEFAULT NULL,
  `date_of_last_charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_charged_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_delay_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recovery_due` int(100) DEFAULT NULL,
  `recovery_during_the_reporting_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cumulative_recovery` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_law_suit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_classification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times_rescheduled` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `economic_purpose_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaulter_flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_disburse_amt` int(100) DEFAULT NULL,
  `outstanding_amt` int(100) DEFAULT NULL,
  `flag_update` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archive_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=24565 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract_phases`
--

CREATE TABLE IF NOT EXISTS `contract_phases` (
`contr_phases_id` int(11) NOT NULL,
  `value` varchar(2) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contract_types`
--

CREATE TABLE IF NOT EXISTS `contract_types` (
`contr_type_id` int(11) NOT NULL,
  `value` varchar(2) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency_codes`
--

CREATE TABLE IF NOT EXISTS `currency_codes` (
`currency_code_id` int(11) NOT NULL,
  `value` varchar(3) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `district_list`
--

CREATE TABLE IF NOT EXISTS `district_list` (
`id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_table`
--

CREATE TABLE IF NOT EXISTS `menu_table` (
`sl` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `parent` varchar(30) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `role` varchar(250) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=10016 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mis_table`
--

CREATE TABLE IF NOT EXISTS `mis_table` (
`id` bigint(20) unsigned NOT NULL,
  `personal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_address` text COLLATE utf8mb4_unicode_ci,
  `resident_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_address` text COLLATE utf8mb4_unicode_ci,
  `contract_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_address` text COLLATE utf8mb4_unicode_ci,
  `register_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenced_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_zone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_circle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_officer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit_amt_bd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report'
) ENGINE=MyISAM AUTO_INCREMENT=2323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
`payment_method_id` int(11) NOT NULL,
  `value` varchar(3) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periodicity`
--

CREATE TABLE IF NOT EXISTS `periodicity` (
`periodicity_id` int(11) NOT NULL,
  `value` varchar(1) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(4) NOT NULL,
  `permission_name` varchar(120) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rate_tb`
--

CREATE TABLE IF NOT EXISTS `rate_tb` (
`id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `rate_date` date NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `role_name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_old`
--

CREATE TABLE IF NOT EXISTS `role_old` (
`id` int(11) NOT NULL,
  `role_name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sector_list`
--

CREATE TABLE IF NOT EXISTS `sector_list` (
  `code` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slug_table`
--

CREATE TABLE IF NOT EXISTS `slug_table` (
`id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `menu_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stmt_info`
--

CREATE TABLE IF NOT EXISTS `stmt_info` (
  `IdClient` varchar(50) NOT NULL,
  `CARD_LIST` varchar(50) NOT NULL,
  `STATEMENT_DATE` varchar(30) NOT NULL,
  `STATEMENT_DATE_SORT` date NOT NULL,
  `MAIN_CARD` varchar(50) NOT NULL,
  `StartDate` varchar(50) NOT NULL,
  `StartDateSort` datetime NOT NULL,
  `NEXT_STATEMENT_DATE` varchar(30) NOT NULL,
  `NEXT_STATEMENT_DATE_SORT` date NOT NULL,
  `PAYMENT_DATE` varchar(30) NOT NULL,
  `PAYMENT_DATE_SORT` date NOT NULL,
  `EndDate` varchar(50) NOT NULL,
  `EndDateSort` datetime NOT NULL,
  `STATEMENT_PERIOD` varchar(50) NOT NULL,
  `StatementType` varchar(50) NOT NULL,
  `SendType` varchar(50) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_info`
--

CREATE TABLE IF NOT EXISTS `subject_info` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `production_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_brth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_nid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nr` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_code` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2650 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_info_archive`
--

CREATE TABLE IF NOT EXISTS `subject_info_archive` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `production_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_brth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_nid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nr` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 for start, 1 for process, 2 for final CIB accept and 5 for hold',
  `archive_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22878 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_fname` varchar(25) NOT NULL,
  `user_lname` varchar(25) NOT NULL,
  `user_id` int(6) NOT NULL,
  `user_pass` varchar(40) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `access_id` varchar(100) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `change_password_YN` varchar(5) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_summary`
--
ALTER TABLE `account_summary`
 ADD PRIMARY KEY (`IdClient`,`CARD_LIST`,`STATEMENT_DATE`,`ACCOUNTNO`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
 ADD PRIMARY KEY (`br_key`), ADD UNIQUE KEY `br_code` (`br_code`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_action`
--
ALTER TABLE `card_action`
 ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `card_charge_temp`
--
ALTER TABLE `card_charge_temp`
 ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `card_close`
--
ALTER TABLE `card_close`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_status`
--
ALTER TABLE `card_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_download_history`
--
ALTER TABLE `cib_download_history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_error`
--
ALTER TABLE `cib_error`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_generate_history`
--
ALTER TABLE `cib_generate_history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_history_log`
--
ALTER TABLE `cib_history_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cl_table`
--
ALTER TABLE `cl_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cl_table_archive`
--
ALTER TABLE `cl_table_archive`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts_info`
--
ALTER TABLE `contracts_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts_info_archive`
--
ALTER TABLE `contracts_info_archive`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_phases`
--
ALTER TABLE `contract_phases`
 ADD PRIMARY KEY (`contr_phases_id`);

--
-- Indexes for table `contract_types`
--
ALTER TABLE `contract_types`
 ADD PRIMARY KEY (`contr_type_id`);

--
-- Indexes for table `currency_codes`
--
ALTER TABLE `currency_codes`
 ADD PRIMARY KEY (`currency_code_id`);

--
-- Indexes for table `district_list`
--
ALTER TABLE `district_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_table`
--
ALTER TABLE `menu_table`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `mis_table`
--
ALTER TABLE `mis_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
 ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `periodicity`
--
ALTER TABLE `periodicity`
 ADD PRIMARY KEY (`periodicity_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_tb`
--
ALTER TABLE `rate_tb`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_old`
--
ALTER TABLE `role_old`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
 ADD PRIMARY KEY (`id`), ADD KEY `role_id` (`role_id`), ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `sector_list`
--
ALTER TABLE `sector_list`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `slug_table`
--
ALTER TABLE `slug_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stmt_info`
--
ALTER TABLE `stmt_info`
 ADD PRIMARY KEY (`IdClient`,`MAIN_CARD`,`STATEMENT_DATE`) USING BTREE;

--
-- Indexes for table `subject_info`
--
ALTER TABLE `subject_info`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_index` (`fi_subject_code`,`card_fi_sub`);

--
-- Indexes for table `subject_info_archive`
--
ALTER TABLE `subject_info_archive`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `access_id` (`access_id`), ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
MODIFY `br_key` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `card_action`
--
ALTER TABLE `card_action`
MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `card_charge_temp`
--
ALTER TABLE `card_charge_temp`
MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `card_close`
--
ALTER TABLE `card_close`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3683;
--
-- AUTO_INCREMENT for table `card_status`
--
ALTER TABLE `card_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cib_download_history`
--
ALTER TABLE `cib_download_history`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT for table `cib_error`
--
ALTER TABLE `cib_error`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=314;
--
-- AUTO_INCREMENT for table `cib_generate_history`
--
ALTER TABLE `cib_generate_history`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `cib_history_log`
--
ALTER TABLE `cib_history_log`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cl_table`
--
ALTER TABLE `cl_table`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32939;
--
-- AUTO_INCREMENT for table `cl_table_archive`
--
ALTER TABLE `cl_table_archive`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18508;
--
-- AUTO_INCREMENT for table `contracts_info`
--
ALTER TABLE `contracts_info`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2657;
--
-- AUTO_INCREMENT for table `contracts_info_archive`
--
ALTER TABLE `contracts_info_archive`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24565;
--
-- AUTO_INCREMENT for table `contract_phases`
--
ALTER TABLE `contract_phases`
MODIFY `contr_phases_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `contract_types`
--
ALTER TABLE `contract_types`
MODIFY `contr_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `currency_codes`
--
ALTER TABLE `currency_codes`
MODIFY `currency_code_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `district_list`
--
ALTER TABLE `district_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `menu_table`
--
ALTER TABLE `menu_table`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10016;
--
-- AUTO_INCREMENT for table `mis_table`
--
ALTER TABLE `mis_table`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2323;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `periodicity`
--
ALTER TABLE `periodicity`
MODIFY `periodicity_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rate_tb`
--
ALTER TABLE `rate_tb`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `role_old`
--
ALTER TABLE `role_old`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slug_table`
--
ALTER TABLE `slug_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subject_info`
--
ALTER TABLE `subject_info`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2650;
--
-- AUTO_INCREMENT for table `subject_info_archive`
--
ALTER TABLE `subject_info_archive`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22878;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role_old` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2022 at 11:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitnitro`
--

-- --------------------------------------------------------

--
-- Table structure for table `bitcoin`
--

CREATE TABLE `bitcoin` (
  `cc_id` int(11) NOT NULL,
  `cc_user_id` varchar(11) NOT NULL COMMENT 'userid from user tbl',
  `cc_currency_address` varchar(100) NOT NULL,
  `cc_username` varchar(100) NOT NULL COMMENT 'username from user table',
  `cc_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bitcoin`
--

INSERT INTO `bitcoin` (`cc_id`, `cc_user_id`, `cc_currency_address`, `cc_username`, `cc_date`) VALUES
(1, '2', 'wal333444999sdfdhe', 'admin', '2022-06-07 15:08:52'),
(2, '1', ' http://localhost/bitnitro/register?id=btc', 'waltostic', '2022-06-07 20:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `bitnitrocash`
--

CREATE TABLE `bitnitrocash` (
  `cc_id` int(11) NOT NULL,
  `cc_user_id` varchar(11) NOT NULL COMMENT 'userid from user tbl',
  `cc_currency_address` varchar(100) NOT NULL,
  `cc_username` varchar(100) NOT NULL COMMENT 'username from user table',
  `cc_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bitnitrocash`
--

INSERT INTO `bitnitrocash` (`cc_id`, `cc_user_id`, `cc_currency_address`, `cc_username`, `cc_date`) VALUES
(1, '2', ' http://localhost/bitnitro/register?id=waltostic ', 'admin', '2022-06-07 20:40:09'),
(2, '1', ' http://localhost/bitnitro/register?id=bitnitro', 'waltostic', '2022-06-07 20:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `shiba`
--

CREATE TABLE `shiba` (
  `cc_id` int(11) NOT NULL,
  `cc_user_id` varchar(11) NOT NULL COMMENT 'userid from user tbl',
  `cc_currency_address` varchar(100) NOT NULL,
  `cc_username` varchar(100) NOT NULL COMMENT 'username from user table',
  `cc_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shiba`
--

INSERT INTO `shiba` (`cc_id`, `cc_user_id`, `cc_currency_address`, `cc_username`, `cc_date`) VALUES
(1, '2', 'waltech33444e4', 'admin', '2022-06-07 15:08:56'),
(2, '1', 'btc http://localhost/bitnitro/register?id=waltostic ', 'waltostic', '2022-06-07 20:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ad_id` int(11) NOT NULL,
  `ad_email` varchar(100) NOT NULL,
  `ad_password` varchar(100) NOT NULL,
  `ad_password_reset_link` varchar(100) NOT NULL,
  `ad_email_verification_link` varchar(100) NOT NULL,
  `ad_login_token` varchar(100) NOT NULL,
  `ad_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ad_id`, `ad_email`, `ad_password`, `ad_password_reset_link`, `ad_email_verification_link`, `ad_login_token`, `ad_date`) VALUES
(1, 'admin@gmail.com', '403ae0d9d74c356f6034cbb09f62f598', '', '', '241cb148672033af6fc765f448a44d54', '2022-06-11 08:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cryptocurrency`
--

CREATE TABLE `tbl_cryptocurrency` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_table` varchar(255) NOT NULL,
  `c_logo` varchar(255) NOT NULL,
  `c_creator_id` int(11) NOT NULL,
  `c_admin_wallet_address` varchar(255) NOT NULL,
  `c_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cryptocurrency`
--

INSERT INTO `tbl_cryptocurrency` (`c_id`, `c_name`, `c_table`, `c_logo`, `c_creator_id`, `c_admin_wallet_address`, `c_date`) VALUES
(11, 'bitcoin', 'bitcoin', '', 1, '0xa180fe01b906a1be37be6c534a3300785b20d947btc', '2022-06-08 10:51:42'),
(12, 'bitnitro cash', 'bitnitrocash', '', 1, 'bit0xa180fe01b906a1be37be6c534a3300785b20d947', '2022-06-08 10:51:28'),
(13, 'shiba', 'shiba', '', 1, 'shib0xa180fe01b906a1be37be6c534a3300785b20d947', '2022-06-08 10:51:45'),
(14, 'usdt (bep 24)', 'usdtbep', '', 1, 'usdt0xa180fe01b906a1be37be6c534a3300785b20d947', '2022-06-08 10:51:52'),
(16, 'waltech', 'waltech', '', 1, 'waltech0xa180fe01b906a1be37be6c534a3300785b20d9474', '2022-06-08 11:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deposit`
--

CREATE TABLE `tbl_deposit` (
  `dpt_id` int(11) NOT NULL,
  `dpt_user_id` int(11) NOT NULL,
  `dpt_username` varchar(100) NOT NULL,
  `dpt_package_name` varchar(100) NOT NULL,
  `dpt_package_id` int(11) NOT NULL,
  `dpt_amount` varchar(11) NOT NULL,
  `dpt_pkg_interest_rate` varchar(11) NOT NULL COMMENT 'package interest rate set by the system admin (%)',
  `dpt_total_income` varchar(11) NOT NULL,
  `dpt_pkg_due_day` varchar(50) NOT NULL,
  `dpt_wallet_id` varchar(100) NOT NULL COMMENT 'deposit wallet used',
  `dpt_wallet_name` varchar(100) NOT NULL,
  `dpt_wallet_address` varchar(255) NOT NULL COMMENT 'user wallet address',
  `dpt_company_wallet_address` varchar(255) NOT NULL,
  `dpt_status` int(11) NOT NULL COMMENT '0=pending; 1=approved; 2=unapproved;\r\n3=settled;',
  `dpt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dpt_withdraw_date` varchar(50) NOT NULL COMMENT 'date of cash out'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_deposit`
--

INSERT INTO `tbl_deposit` (`dpt_id`, `dpt_user_id`, `dpt_username`, `dpt_package_name`, `dpt_package_id`, `dpt_amount`, `dpt_pkg_interest_rate`, `dpt_total_income`, `dpt_pkg_due_day`, `dpt_wallet_id`, `dpt_wallet_name`, `dpt_wallet_address`, `dpt_company_wallet_address`, `dpt_status`, `dpt_date`, `dpt_withdraw_date`) VALUES
(2, 1, 'waltostic', 'Advance', 20, '506', '5', '531.3', '5', '12', 'bitnitro cash', ' http://localhost/bitnitro/register?id=bitnitro', 'bit0xa180fe01b906a1be37be6c534a3300785b20d947', 2, '2022-04-03 14:43:33', ''),
(4, 1, 'waltostic', 'Advance', 20, '505', '5', '530.25', '5', '12', 'bitnitro cash', ' http://localhost/bitnitro/register?id=bitnitro', 'bit0xa180fe01b906a1be37be6c534a3300785b20d947', 2, '2022-05-11 08:27:16', ''),
(5, 1, 'waltostic', 'Starter', 17, '19', '30', '24.7', '10', '11', 'bitcoin', ' http://localhost/bitnitro/register?id=btc', '0xa180fe01b906a1be37be6c534a3300785b20d947btc', 3, '2022-05-04 20:38:40', ''),
(6, 1, 'waltostic', 'Gold', 18, '51', '30', '66.3', '7', '14', 'usdt (bep 24)', ' http://localhost/bitnitro/register?id=waltostic ', 'usdt0xa180fe01b906a1be37be6c534a3300785b20d947', 3, '2022-05-03 05:17:02', ''),
(7, 1, 'waltostic', 'Gold', 18, '54', '30', '70.2', '7', '13', 'shiba', 'btc http://localhost/bitnitro/register?id=waltostic ', 'shib0xa180fe01b906a1be37be6c534a3300785b20d947', 1, '2022-06-11 07:59:32', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `pkg_id` int(11) NOT NULL,
  `pkg_name` varchar(50) NOT NULL,
  `pkg_min_amount` int(11) NOT NULL,
  `pkg_max_amount` int(11) NOT NULL,
  `pkg_due_day` int(11) NOT NULL,
  `pkg_percentage` int(11) NOT NULL,
  `pkg_creator_id` int(11) NOT NULL,
  `pkg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`pkg_id`, `pkg_name`, `pkg_min_amount`, `pkg_max_amount`, `pkg_due_day`, `pkg_percentage`, `pkg_creator_id`, `pkg_date`) VALUES
(17, 'Starter', 1, 50, 10, 30, 1, '2022-06-05 22:04:51'),
(18, 'Gold', 50, 101, 7, 30, 1, '2022-06-05 22:06:47'),
(19, 'Premium', 100, 500, 3, 30, 1, '2022-06-05 22:06:18'),
(20, 'Advance', 500, 1000, 5, 5, 1, '2022-06-09 08:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `ref_id` varchar(10) NOT NULL,
  `ref_username` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `total_amount` varchar(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `login_token` varchar(255) NOT NULL,
  `keep_me_login` varchar(255) NOT NULL,
  `password_reset` varchar(255) NOT NULL,
  `email_verification` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `full_name`, `username`, `email`, `password`, `phone`, `ref_id`, `ref_username`, `status`, `total_amount`, `country`, `state`, `login_token`, `keep_me_login`, `password_reset`, `email_verification`, `photo`, `date`) VALUES
(1, 'walter godson happiness', 'waltostic', 'happiness@gmail.com', '403ae0d9d74c356f6034cbb09f62f598', '08136109828', '', '', '', '273', '', '', '641b99546b669507206755d770ddf214', '', '', '', '19966903151394285583070620221037.jpg', '2022-06-06 15:06:48'),
(2, 'walter godson nazike', 'admin', 'admin@gmail.com', '403ae0d9d74c356f6034cbb09f62f598', '08136109828', '', '', '', '', '', '', '9132b88a59a807ccf2a53b2ec725ae4a', '', '', '', '61524057046431746070620220737.jpg', '2022-06-06 15:20:16'),
(3, '', 'happiness', '', '403ae0d9d74c356f6034cbb09f62f598', '', '', 'waltostic', '', '', '', '', '', '', '', '', '', '2022-06-07 04:27:27'),
(4, '', 'waltostic1@gmail.com', '', '403ae0d9d74c356f6034cbb09f62f598', '', '', '', '', '', '', '', '', '', '', '', '', '2022-06-07 04:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `usdtbep`
--

CREATE TABLE `usdtbep` (
  `cc_id` int(11) NOT NULL,
  `cc_user_id` varchar(11) NOT NULL COMMENT 'userid from user tbl',
  `cc_currency_address` varchar(100) NOT NULL,
  `cc_username` varchar(100) NOT NULL COMMENT 'username from user table',
  `cc_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usdtbep`
--

INSERT INTO `usdtbep` (`cc_id`, `cc_user_id`, `cc_currency_address`, `cc_username`, `cc_date`) VALUES
(1, '2', 'wewe', 'admin', '2022-06-07 15:09:21'),
(2, '1', ' http://localhost/bitnitro/register?id=waltostic ', 'waltostic', '2022-06-07 20:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `waltech`
--

CREATE TABLE `waltech` (
  `cc_id` int(11) NOT NULL,
  `cc_user_id` varchar(11) NOT NULL COMMENT 'userid from user tbl',
  `cc_currency_address` varchar(255) NOT NULL,
  `cc_username` varchar(100) NOT NULL COMMENT 'username from user table',
  `cc_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitcoin`
--
ALTER TABLE `bitcoin`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `bitnitrocash`
--
ALTER TABLE `bitnitrocash`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `shiba`
--
ALTER TABLE `shiba`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ad_id`),
  ADD UNIQUE KEY `ad_email` (`ad_email`);

--
-- Indexes for table `tbl_cryptocurrency`
--
ALTER TABLE `tbl_cryptocurrency`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_id` (`c_id`,`c_name`);

--
-- Indexes for table `tbl_deposit`
--
ALTER TABLE `tbl_deposit`
  ADD PRIMARY KEY (`dpt_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`pkg_id`),
  ADD UNIQUE KEY `pkg_name` (`pkg_name`),
  ADD UNIQUE KEY `pkg_min_amount` (`pkg_min_amount`),
  ADD UNIQUE KEY `pkg_max_amount` (`pkg_max_amount`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `usdtbep`
--
ALTER TABLE `usdtbep`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `waltech`
--
ALTER TABLE `waltech`
  ADD PRIMARY KEY (`cc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitcoin`
--
ALTER TABLE `bitcoin`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bitnitrocash`
--
ALTER TABLE `bitnitrocash`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shiba`
--
ALTER TABLE `shiba`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cryptocurrency`
--
ALTER TABLE `tbl_cryptocurrency`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_deposit`
--
ALTER TABLE `tbl_deposit`
  MODIFY `dpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `pkg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usdtbep`
--
ALTER TABLE `usdtbep`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `waltech`
--
ALTER TABLE `waltech`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

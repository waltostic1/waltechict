<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-08-04 13:00:28 --> Severity: Warning --> Undefined property: stdClass::$guilder_id C:\xampp\htdocs\monisharelab\application\controllers\Admin_Login.php 66
ERROR - 2021-08-04 13:29:01 --> 404 Page Not Found: Install/index
ERROR - 2021-08-04 14:11:45 --> Severity: Warning --> Undefined property: Install::$index_model C:\xampp\htdocs\monisharelab\application\controllers\Install.php 17
ERROR - 2021-08-04 14:11:45 --> Severity: error --> Exception: Call to a member function index() on null C:\xampp\htdocs\monisharelab\application\controllers\Install.php 17
ERROR - 2021-08-04 14:12:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'user_id' varchar(50)...' at line 1 - Invalid query: CREATE TABLE 'admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'user_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'full_name' varchar(255) CHARACTER SET latin1 NOT NULL,
			'user_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'email' varchar(100) CHARACTER SET latin1 NOT NULL,
			'passwrd' varchar(100) CHARACTER SET latin1 NOT NULL,
			'sex' varchar(10) CHARACTER SET latin1 NOT NULL,
			'country' varchar(50) CHARACTER SET latin1 NOT NULL,
			'state' varchar(50) CHARACTER SET latin1 NOT NULL,
			'phone_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'bank_name' varchar(50) CHARACTER SET latin1 NOT NULL,
			'acc_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'acc_type' varchar(20) CHARACTER SET latin1 NOT NULL,
			'acc_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'email_v_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'is_email_verified' varchar(10) CHARACTER SET latin1 NOT NULL,
			'passwrd_rest_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'status' int(11) NOT NULL,
			'ref_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'admin_id' varchar(20) CHARACTER SET latin1 NOT NULL,
			'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			'others' varchar(255) CHARACTER SET latin1 NOT NULL,
			'login_key' varchar(255) CHARACTER SET latin1 NOT NULL,
			PRIMARY KEY ('sn'),
			UNIQUE KEY 'user_id' ('user_id'),
			UNIQUE KEY 'email' ('email'),
			UNIQUE KEY 'user_name' ('user_name')
		  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
ERROR - 2021-08-04 14:14:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'if not exists TABLE 'admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'...' at line 1 - Invalid query: CREATE if not exists TABLE 'admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'user_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'full_name' varchar(255) CHARACTER SET latin1 NOT NULL,
			'user_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'email' varchar(100) CHARACTER SET latin1 NOT NULL,
			'passwrd' varchar(100) CHARACTER SET latin1 NOT NULL,
			'sex' varchar(10) CHARACTER SET latin1 NOT NULL,
			'country' varchar(50) CHARACTER SET latin1 NOT NULL,
			'state' varchar(50) CHARACTER SET latin1 NOT NULL,
			'phone_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'bank_name' varchar(50) CHARACTER SET latin1 NOT NULL,
			'acc_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'acc_type' varchar(20) CHARACTER SET latin1 NOT NULL,
			'acc_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'email_v_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'is_email_verified' varchar(10) CHARACTER SET latin1 NOT NULL,
			'passwrd_rest_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'status' int(11) NOT NULL,
			'ref_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'admin_id' varchar(20) CHARACTER SET latin1 NOT NULL,
			'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			'others' varchar(255) CHARACTER SET latin1 NOT NULL,
			'login_key' varchar(255) CHARACTER SET latin1 NOT NULL,
			PRIMARY KEY ('sn'),
			UNIQUE KEY 'user_id' ('user_id'),
			UNIQUE KEY 'email' ('email'),
			UNIQUE KEY 'user_name' ('user_name')
		  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
ERROR - 2021-08-04 14:15:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'user_id' varchar(50)...' at line 1 - Invalid query: CREATE TABLE if not exists 'admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'user_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'full_name' varchar(255) CHARACTER SET latin1 NOT NULL,
			'user_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'email' varchar(100) CHARACTER SET latin1 NOT NULL,
			'passwrd' varchar(100) CHARACTER SET latin1 NOT NULL,
			'sex' varchar(10) CHARACTER SET latin1 NOT NULL,
			'country' varchar(50) CHARACTER SET latin1 NOT NULL,
			'state' varchar(50) CHARACTER SET latin1 NOT NULL,
			'phone_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'bank_name' varchar(50) CHARACTER SET latin1 NOT NULL,
			'acc_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'acc_type' varchar(20) CHARACTER SET latin1 NOT NULL,
			'acc_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'email_v_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'is_email_verified' varchar(10) CHARACTER SET latin1 NOT NULL,
			'passwrd_rest_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'status' int(11) NOT NULL,
			'ref_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'admin_id' varchar(20) CHARACTER SET latin1 NOT NULL,
			'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			'others' varchar(255) CHARACTER SET latin1 NOT NULL,
			'login_key' varchar(255) CHARACTER SET latin1 NOT NULL,
			PRIMARY KEY ('sn'),
			UNIQUE KEY 'user_id' ('user_id'),
			UNIQUE KEY 'email' ('email'),
			UNIQUE KEY 'user_name' ('user_name')
		  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
ERROR - 2021-08-04 14:15:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'user_id' varchar(50)...' at line 1 - Invalid query: CREATE TABLE if not exists 'admin' (
			'sn' int(11) NOT NULL AUTO_INCREMENT,
			'user_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'full_name' varchar(255) CHARACTER SET latin1 NOT NULL,
			'user_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'email' varchar(100) CHARACTER SET latin1 NOT NULL,
			'passwrd' varchar(100) CHARACTER SET latin1 NOT NULL,
			'sex' varchar(10) CHARACTER SET latin1 NOT NULL,
			'country' varchar(50) CHARACTER SET latin1 NOT NULL,
			'state' varchar(50) CHARACTER SET latin1 NOT NULL,
			'phone_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'bank_name' varchar(50) CHARACTER SET latin1 NOT NULL,
			'acc_name' varchar(100) CHARACTER SET latin1 NOT NULL,
			'acc_type' varchar(20) CHARACTER SET latin1 NOT NULL,
			'acc_no' varchar(20) CHARACTER SET latin1 NOT NULL,
			'email_v_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'is_email_verified' varchar(10) CHARACTER SET latin1 NOT NULL,
			'passwrd_rest_link' varchar(255) CHARACTER SET latin1 NOT NULL,
			'status' int(11) NOT NULL,
			'ref_id' varchar(50) CHARACTER SET latin1 NOT NULL,
			'admin_id' varchar(20) CHARACTER SET latin1 NOT NULL,
			'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			'others' varchar(255) CHARACTER SET latin1 NOT NULL,
			'login_key' varchar(255) CHARACTER SET latin1 NOT NULL,
			PRIMARY KEY ('sn'),
			UNIQUE KEY 'user_id' ('user_id'),
			UNIQUE KEY 'email' ('email'),
			UNIQUE KEY 'user_name' ('user_name')
		  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
ERROR - 2021-08-04 14:27:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'user investment package' at line 9 - Invalid query: CREATE TABLE user_investment_pack (
			id int(11) NOT NULL AUTO_INCREMENT,
			user_id varchar(50) NOT NULL,
			package_id int(3) NOT NULL,
			package_type int(11) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			PRIMARY KEY (id),
			UNIQUE KEY user_id (user_id)
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = user investment package;
			
ERROR - 2021-08-04 14:28:31 --> Query error: Table 'user' already exists - Invalid query: CREATE TABLE user (
			sn int(11) NOT NULL AUTO_INCREMENT,
			user_id varchar(50) NOT NULL,
			full_name varchar(255) NOT NULL,
			user_name varchar(100) NOT NULL,
			email varchar(100) NOT NULL,
			passwrd varchar(100) NOT NULL,
			sex varchar(10) NOT NULL,
			country varchar(50) NOT NULL,
			state varchar(50) NOT NULL,
			phone_no varchar(20) NOT NULL,
			bank_name varchar(50) NOT NULL,
			acc_name varchar(100) NOT NULL,
			acc_type varchar(20) NOT NULL,
			acc_no varchar(20) NOT NULL,
			email_v_link varchar(255) NOT NULL,
			is_email_verified varchar(10) NOT NULL,
			passwrd_rest_link varchar(255) NOT NULL,
			status int(11) NOT NULL,
			ref_id varchar(50) NOT NULL,
			admin_id varchar(20) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp(),
			others varchar(255) NOT NULL,
			login_key varchar(255) NOT NULL,
			PRIMARY KEY (sn),
			UNIQUE KEY user_id (user_id),
			UNIQUE KEY user_name (user_name),
			UNIQUE KEY email (email)
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
		  
		
ERROR - 2021-08-04 14:34:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ';
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1' at line 16 - Invalid query: CREATE TABLE if not exists transaction (
			sn int(20) NOT NULL AUTO_INCREMENT,
			txn_id varchar(50) NOT NULL,
			amount int(11) NOT NULL,
			sender_id varchar(50) NOT NULL,
			receiver_id varchar(50) NOT NULL,
			date_created varchar(20) NOT NULL,
			start_time int(11) NOT NULL,
			elapse_time int(11) NOT NULL,
			txn_status int(2) NOT NULL,
			activate_user varchar(2) NOT NULL,
			pop varchar(255) NOT NULL,
			type varchar(255) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			PRIMARY KEY (sn),
			UNIQUE KEY txn_id (txn_id);
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
		
ERROR - 2021-08-04 14:44:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ';
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1' at line 16 - Invalid query: CREATE TABLE `transaction` (
		  `sn` int(20) NOT NULL,
		  `txn_id` varchar(50) NOT NULL,
		  `amount` int(11) NOT NULL,
		  `sender_id` varchar(50) NOT NULL,
		  `receiver_id` varchar(50) NOT NULL,
		  `date_created` varchar(20) NOT NULL,
		  `start_time` int(11) NOT NULL,
		  `elapse_time` int(11) NOT NULL,
		  `txn_status` int(2) NOT NULL,
		  `activate_user` varchar(2) NOT NULL,
		  `pop` varchar(255) NOT NULL,
		  `type` varchar(255) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			PRIMARY KEY (sn),
			UNIQUE KEY txn_id (txn_id);
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
		
ERROR - 2021-08-04 14:44:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ';
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1' at line 16 - Invalid query: CREATE TABLE `transaction` (
		  `sn` int(20) NOT NULL,
		  `txn_id` varchar(50) NOT NULL,
		  `amount` int(11) NOT NULL,
		  `sender_id` varchar(50) NOT NULL,
		  `receiver_id` varchar(50) NOT NULL,
		  `date_created` varchar(20) NOT NULL,
		  `start_time` int(11) NOT NULL,
		  `elapse_time` int(11) NOT NULL,
		  `txn_status` int(2) NOT NULL,
		  `activate_user` varchar(2) NOT NULL,
		  `pop` varchar(255) NOT NULL,
		  `type` varchar(255) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			PRIMARY KEY (sn),
			UNIQUE KEY txn_id (txn_id);
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
		
ERROR - 2021-08-04 14:47:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ';
		  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4' at line 16 - Invalid query: CREATE TABLE if not exists transaction (
			sn int(20) NOT NULL AUTO_INCREMENT,
			txn_id varchar(50) NOT NULL,
			amount int(11) NOT NULL,
			sender_id varchar(50) NOT NULL,
			receiver_id varchar(50) NOT NULL,
			date_created varchar(20) NOT NULL,
			start_time int(11) NOT NULL,
			elapse_time int(11) NOT NULL,
			txn_status int(2) NOT NULL,
			activate_user varchar(2) NOT NULL,
			pop varchar(255) NOT NULL,
			type varchar(255) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			PRIMARY KEY (sn),
			UNIQUE KEY txn_id (txn_id);
		  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
		
ERROR - 2021-08-04 14:47:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'user investment package' at line 9 - Invalid query: CREATE TABLE user_investment_pack (
			id int(11) NOT NULL AUTO_INCREMENT,
			user_id varchar(50) NOT NULL,
			package_id int(3) NOT NULL,
			package_type int(11) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			PRIMARY KEY (id),
			UNIQUE KEY user_id (user_id)
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = user investment package;
			
ERROR - 2021-08-04 14:49:28 --> Query error: Table 'user_investment_pack' already exists - Invalid query: CREATE TABLE user_investment_pack (
			id int(11) NOT NULL AUTO_INCREMENT,
			user_id varchar(50) NOT NULL,
			package_id int(3) NOT NULL,
			package_type int(11) NOT NULL,
			date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			PRIMARY KEY (id),
			UNIQUE KEY user_id (user_id)
		  ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
			
ERROR - 2021-08-04 14:51:35 --> Severity: Warning --> Undefined property: stdClass::$guilder_id C:\xampp\htdocs\monisharelab\application\controllers\Admin_Login.php 66
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:21 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:25 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:25 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:25 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:25 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:25 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:25 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:29 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:29 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:29 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:29 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:29 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:29 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:31 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:31 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:31 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:31 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:31 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:31 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:38 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:38 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:38 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:39 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:39 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:36:46 --> 404 Page Not Found: Sss/s
ERROR - 2021-08-04 16:37:04 --> 404 Page Not Found: Sss/s

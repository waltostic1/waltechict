<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-12-10 10:46:52 --> Query error: Table 'lovelypack.staffinfo' doesn't exist - Invalid query: SELECT *
FROM `staffinfo`
WHERE `email` = 'happiness1@gmail.com'
AND `passwrd` = '403ae0d9d74c356f6034cbb09f62f598'
ERROR - 2021-12-10 10:50:32 --> Query error: Table 'lovelypack.staffinfo' doesn't exist - Invalid query: SELECT *
FROM `staffinfo`
WHERE `email` = 'happiness1@gmail.com'
AND `passwrd` = '403ae0d9d74c356f6034cbb09f62f598'
ERROR - 2021-12-10 13:08:51 --> Severity: error --> Exception: rand() expects exactly 2 arguments, 1 given C:\xampp\htdocs\lovelypack\application\views\staff\txn_form.php 15
ERROR - 2021-12-10 13:09:29 --> Severity: error --> Exception: rand() expects exactly 2 arguments, 1 given C:\xampp\htdocs\lovelypack\application\views\staff\txn_form.php 15
ERROR - 2021-12-10 13:48:05 --> Query error: Unknown column 'user_id' in 'field list' - Invalid query: INSERT INTO `transaction` (`user_id`, `txn_id`, `txn_type`, `amount`, `txn_purpose`, `creator_id`) VALUES ('', '10122021034713507', 'Sales', '300000', 'daily sales', '2')

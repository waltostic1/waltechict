<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-06-26 07:17:34 --> Severity: Warning --> Undefined variable $ss C:\xampp\htdocs\bit\app\application\views\txn_bonus_history.php 38
ERROR - 2022-06-26 07:17:34 --> Severity: Warning --> Undefined variable $ss C:\xampp\htdocs\bit\app\application\views\txn_bonus_history.php 39
ERROR - 2022-06-26 07:17:34 --> Severity: Warning --> Undefined variable $ss C:\xampp\htdocs\bit\app\application\views\txn_bonus_history.php 40
ERROR - 2022-06-26 07:17:34 --> Severity: Warning --> Undefined variable $ss C:\xampp\htdocs\bit\app\application\views\txn_bonus_history.php 41
ERROR - 2022-06-26 07:17:34 --> Severity: Warning --> Undefined variable $ss C:\xampp\htdocs\bit\app\application\views\txn_bonus_history.php 42
ERROR - 2022-06-26 20:40:32 --> Severity: error --> Exception: Too few arguments to function CI_DB_driver::query(), 0 passed in C:\xampp\htdocs\bit\app\application\models\Admin_model.php on line 403 and at least 1 expected C:\xampp\htdocs\bit\app\system\database\DB_driver.php 608
ERROR - 2022-06-26 20:40:34 --> Severity: error --> Exception: Too few arguments to function CI_DB_driver::query(), 0 passed in C:\xampp\htdocs\bit\app\application\models\Admin_model.php on line 403 and at least 1 expected C:\xampp\htdocs\bit\app\system\database\DB_driver.php 608
ERROR - 2022-06-26 20:40:47 --> Severity: error --> Exception: Too few arguments to function CI_DB_driver::query(), 0 passed in C:\xampp\htdocs\bit\app\application\models\Admin_model.php on line 403 and at least 1 expected C:\xampp\htdocs\bit\app\system\database\DB_driver.php 608
ERROR - 2022-06-26 20:42:14 --> Severity: error --> Exception: Too few arguments to function CI_DB_driver::query(), 0 passed in C:\xampp\htdocs\bit\app\application\models\Admin_model.php on line 403 and at least 1 expected C:\xampp\htdocs\bit\app\system\database\DB_driver.php 608
ERROR - 2022-06-26 21:40:36 --> Query error: Unknown column 'c_names' in 'order clause' - Invalid query: SELECT *
FROM `tbl_cryptocurrency`
ORDER BY `c_names`
ERROR - 2022-06-26 23:17:18 --> Query error: Unknown column 'system_wallet' in 'where clause' - Invalid query: SELECT SUM(dpt_amount) as inAmt FROM tbl_deposit WHERE dpt_date >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND dpt_wallet_id=system_wallet;
ERROR - 2022-06-26 23:17:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\bit\app\application\controllers\Txn_info.php:142) C:\xampp\htdocs\bit\app\system\core\Common.php 570

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-10 00:29:18 --> Severity: Warning --> Array to string conversion C:\xampp\htdocs\eyesapp\system\database\DB_driver.php 1519
ERROR - 2022-04-10 00:29:18 --> Query error: Unknown column 'Array' in 'field list' - Invalid query: UPDATE `tbl_group_list` SET `gl_description` = 'To move omoku youth to the next level', `gl_logo` = Array
WHERE `gl_id` = '5'
ERROR - 2022-04-10 00:30:39 --> Severity: Warning --> unlink(C:\xampp\htdocs\eyesapp/img/group_photo/group_photo): No such file or directory C:\xampp\htdocs\eyesapp\application\controllers\Active_group.php 115
ERROR - 2022-04-10 00:31:33 --> Severity: Warning --> unlink(C:\xampp\htdocs\eyesapp/img/group_photo/768768837157349852100420221239.jpg): No such file or directory C:\xampp\htdocs\eyesapp\application\controllers\Active_group.php 115
ERROR - 2022-04-10 00:43:08 --> Severity: Warning --> unlink(C:\xampp\htdocs\eyesapp/img/group_photo/567145931732829833100420221203.jpg): No such file or directory C:\xampp\htdocs\eyesapp\application\controllers\Active_group.php 115
ERROR - 2022-04-10 00:46:58 --> Severity: Warning --> unlink(C:\xampp\htdocs\eyesapp/img/group_photo/60434990856725868100420221208.jpg): No such file or directory C:\xampp\htdocs\eyesapp\application\controllers\Active_group.php 115
ERROR - 2022-04-10 15:04:42 --> Severity: Warning --> unlink(C:\xampp\htdocs\eyesapp/img/group_photo/12924585971187476878100420221233.jpg): No such file or directory C:\xampp\htdocs\eyesapp\application\controllers\Active_group.php 115
ERROR - 2022-04-10 15:17:05 --> Severity: Warning --> Undefined variable $groupName C:\xampp\htdocs\eyesapp\application\views\active_group.php 63
ERROR - 2022-04-10 15:17:27 --> Severity: Warning --> Undefined variable $newGroupName C:\xampp\htdocs\eyesapp\application\views\active_group.php 63
ERROR - 2022-04-10 15:21:03 --> Severity: Warning --> Undefined variable $groupNamse C:\xampp\htdocs\eyesapp\application\views\active_group.php 51
ERROR - 2022-04-10 15:21:08 --> Severity: Warning --> Undefined variable $groupNamse C:\xampp\htdocs\eyesapp\application\views\active_group.php 51
ERROR - 2022-04-10 15:50:33 --> Query error: Unknown column 'tbl_user.user_id' in 'on clause' - Invalid query: SELECT *
FROM `omoku_youth_association`
JOIN `tbl_user` ON `tbl_user`.`user_id`=`omoku_youth_association`.`g_user_id`
WHERE `g_contestant_status` = '1'
ORDER BY `g_vote_point` DESC
ERROR - 2022-04-10 15:52:26 --> Severity: Warning --> Undefined variable $g_vote_point C:\xampp\htdocs\eyesapp\application\views\active_group.php 91
ERROR - 2022-04-10 15:52:26 --> Severity: Warning --> Attempt to read property "g_vote_point" on null C:\xampp\htdocs\eyesapp\application\views\active_group.php 91
ERROR - 2022-04-10 19:07:32 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-10 19:07:55 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-10 19:07:59 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-10 19:08:02 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-10 19:08:06 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-10 19:08:33 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-10 19:09:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'JOIN `tbl_user` ON `tbl_user`.`id`=.`g_user_id`
WHERE `g_contestant_status` =...' at line 2 - Invalid query: SELECT *
JOIN `tbl_user` ON `tbl_user`.`id`=.`g_user_id`
WHERE `g_contestant_status` = '1'
ORDER BY `g_vote_point` DESC
ERROR - 2022-04-10 19:11:02 --> Severity: Warning --> Undefined variable $fetch_contestants_data C:\xampp\htdocs\eyesapp\application\views\active_group.php 101
ERROR - 2022-04-10 19:11:02 --> Severity: error --> Exception: Call to a member function num_rows() on null C:\xampp\htdocs\eyesapp\application\views\active_group.php 101
ERROR - 2022-04-10 19:12:21 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-10 19:40:06 --> Query error: Table 'eyesapp.waltech group of' doesn't exist - Invalid query: SELECT *
FROM `waltech group of` `boy`
ERROR - 2022-04-10 19:50:16 --> Query error: Table 'eyesapp.waltech group of' doesn't exist - Invalid query: SELECT *
FROM `waltech group of` `boy`
ERROR - 2022-04-10 21:45:40 --> Severity: Warning --> Undefined variable $memberG_user_id C:\xampp\htdocs\eyesapp\application\views\active_group.php 71
ERROR - 2022-04-10 21:45:40 --> Severity: Warning --> Undefined variable $memberG_user_id C:\xampp\htdocs\eyesapp\application\views\active_group.php 71

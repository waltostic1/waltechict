<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-05 08:30:15 --> Query error: Invalid utf8 character string: 'Diocese_of_Ahoad_AYF\xF0\x9F\x91\x88\xF0\x9F\x91\x88\xF0\x9F\x91' - Invalid query: SELECT *
FROM `Diocese_of_Ahoad_AYF👈👈👈👈`
JOIN `tbl_user` ON `tbl_user`.`id`=`Diocese_of_Ahoad_AYF👈👈👈👈`.`g_user_id`
WHERE `g_user_id` = '10'
 LIMIT 1
ERROR - 2022-05-05 08:30:15 --> Severity: error --> Exception: Call to a member function num_rows() on bool /home/waltechi/eyesapp.waltechict.com/application/controllers/Contestant_link_processor.php 54

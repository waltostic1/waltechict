 <!-- get user login session -->
 <?php
  $user_id=$this->session->userdata('user_id');
  $user_first_name=$this->session->userdata('user_first_name');
  $user_last_name=$this->session->userdata('user_last_name');
  $user_email=$this->session->userdata('user_email');
  $user_phone=$this->session->userdata('user_phone');
  $user_username=$this->session->userdata('user_username');
  $user_sex=$this->session->userdata('user_sex');
  $user_address=$this->session->userdata('user_address');
  $user_country=$this->session->userdata('user_country');
  $user_state=$this->session->userdata('user_state');
  $user_city=$this->session->userdata('user_city');
  $user_about_me=$this->session->userdata('user_about_me');
  $user_status=$this->session->userdata('user_status');
  $user_photo=$this->session->userdata('user_photo');
  $user_date=$this->session->userdata('user_date');
  ?>
 <!-- end of get login session -->

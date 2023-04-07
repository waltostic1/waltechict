<?php
@ session_start();
$this->session->unset_userdata('user_id');
session_destroy();
@session_start();
//$this->session->set_flashdata('form', '<script>Swal.fire("Login is required","","error")</script>'); 

$this->session->set_userdata('go_back_after_logout','yes');  // set session to enable a user return back to previous page after logout
redirect(base_url('login'));
?>

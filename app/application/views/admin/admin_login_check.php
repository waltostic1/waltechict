<?php
if (null == ($this->session->userdata('adminId'))) {
    //redirect('../admin_login');
echo "<script>window.open('../admin_login','_self')</script>";

}

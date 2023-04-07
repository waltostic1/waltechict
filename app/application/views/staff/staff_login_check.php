<?php
if (null == ($this->session->userdata('staff_id'))) {
    // redirect('../staff_login');
    echo "<script>window.open('../staff_login','_self')</script>";

}
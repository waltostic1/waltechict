<?php
if (!null == ($this->session->userdata('adminEmail')) || !null == ($this->session->userdata('adminId'))) {
  
} else {
    redirect(base_url('login'));
}

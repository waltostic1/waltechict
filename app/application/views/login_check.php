<?php
if (null == ($this->session->userdata('user_id'))) {
    redirect(base_url('login'));
}

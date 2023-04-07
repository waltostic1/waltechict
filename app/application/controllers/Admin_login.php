<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_login extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}


	public function index()
	{
		$this->load->view('admin_login');
	}

	function login()
	{
		if ($this->input->post('login') != null) {

			$this->form_validation->set_rules('email', 'email or username', 'required|trim');
			$this->form_validation->set_rules('password', 'password', 'required');


			if ($this->form_validation->run()) {

				// define login by email address data
				$data = array(
					'ad_email'	   =>  $this->security->xss_clean($this->input->post('email')),
					'ad_password' => md5(md5($this->input->post('password')))
				);


				$loginQuery = $this->admin_model->loginQuery($data);

				if ($loginQuery->num_rows() > 0) {


					foreach ($loginQuery->result() as $row) {
						$this->session->set_userdata('adminId', $row->ad_id);
						$this->session->set_userdata('adminEmail', $row->ad_email);
					}

					//update user login_key
					$adminId = $row->ad_id;
					$loginKey = md5(rand());

					$this->session->set_userdata('adminLoginKey', $loginKey);

					$updateLoginKey = $this->admin_model->updateLoginKey($adminId, $loginKey);

					if ($updateLoginKey > 0) {
						$this->session->set_userdata('loginError', '');
						redirect(base_url('txn_info')); //go to txn_info
					}
				} else {
					$this->session->set_flashdata('form', "<script>Swal.fire('Error','Invalid admin login details','error')</script>");
					
					$this->session->set_userdata('loginError', 'Invalid admin login details');
					$this->index();
				}
			} else {
				$this->index();
			}
		} else {
			redirect('admin_login');
		}
	}
}

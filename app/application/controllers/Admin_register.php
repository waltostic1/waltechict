<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_register extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}


	public function index()
	{

		$data['fetch_admin'] = $this->admin_model->getSystemAdmin();
		$this->load->view('admin_register', $data);
	}

	function registrationSuccess()
	{
		$this->load->view('admin_registration_success_page');
	}

	function process()
	{
		if ($this->input->post('registerAccount') != null) {


			$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[tbl_admin.ad_email]|max_length[100]');
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('reEnterPassword', 're-enter password', 'required|matches[password]');

			if ($this->form_validation->run()) {

				$data = array(
					'ad_email'	   =>  $this->security->xss_clean($this->input->post('email')),
					'ad_password' => md5(md5($this->input->post('password')))
				);


				$id = $this->admin_model->insert($data);

				if ($id > 0) {
					$this->session->set_flashdata('form', "<script>Swal.fire('Admin created successfully!','','success')</script>");
					echo '<script>window.open("' . base_url('admin_login') . '","_self")</script>';
				} else {
					$this->index();
				}
			} else {
				echo "";
				$this->index();
			}
		} else {
			redirect('admin_register');
		}
	}
}

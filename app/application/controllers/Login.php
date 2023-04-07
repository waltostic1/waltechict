<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('model');
	}


	public function index()
	{
      $_config_=$this->db->get('tbl_configuration');
      if($_config_-> num_rows()>0){
        foreach($_config_->result() as $row){
          $this->session->set_userdata('configEmail',$row->config_email);
        }
      }
      
		$this->load->view('login');
	}

	// admin login into users account automatically
	function adminLogin()
	{
		if ($this->session->userdata('adminId') == $this->security->xss_clean($this->input->get('token_c'))) {
			$userId = $this->security->xss_clean($this->input->get('token_a'));
			$password = $this->security->xss_clean($this->input->get('token_b'));
			$page = $this->security->xss_clean($this->input->get('page'));

			// define login data
			$data = array(
				'user_id'	   =>  $userId,
				'password' => $password
			);

			$loginQuery = $this->model->adminLogin($data);

			if ($loginQuery->num_rows() > 0) {

				foreach ($loginQuery->result() as $row) {
					$this->session->set_userdata('user_id', $row->user_id);
					$this->session->set_userdata('username', $row->username);
					$this->session->set_userdata('admin_state', 'on');
				}
				$this->session->set_flashdata('form', '<script>Swal.fire("Welcome ' . $row->username . '","","success")</script>');

				echo '<script>window.open("' . base_url($page) . '","_self")</script>';
			} else {
				$this->session->set_flashdata('form', '<script>Swal.fire("Login error","Invalid login details","error")</script>');
				$this->index();
			}
		}
	}
	// user login
	function login()
	{

		if ($this->input->post('login') == 'Login') {

			//$log=$this->input->post('login');
			//echo "<script>alert('$log')</script>";

			$this->form_validation->set_rules('username', 'username', 'required|trim');
			$this->form_validation->set_rules('password', 'password', 'required');


			if ($this->form_validation->run()) {

				// define user login data
				$data = array(
					'username'	   =>  $this->security->xss_clean($this->input->post('username')),
					'password' => md5(md5($this->input->post('password')))
				);

				// define admin login data
				$data_admin = array(
					'ad_email'	   =>  $this->security->xss_clean($this->input->post('username')),
					'ad_password' => md5(md5($this->input->post('password')))
				);

				// user login cmd
				$loginQuery = $this->model->login($data);

				if ($loginQuery->num_rows() > 0) {

					foreach ($loginQuery->result() as $row) {
                      if($row->is_email_verified=='no'){
                        $this->session->set_flashdata('form', '<script>Swal.fire("Account not verified","please check your email to verify your account","error")</script>');
						$this->index();
                       return;
                      }
						$this->session->set_userdata('user_id', $row->user_id);
						$this->session->set_userdata('username', $row->username);
						$status=$row->status;
					}
					if($status=='0'){
						echo "<h3 style='margin-top:100px; color:red; text-align:center'>Sorry your account is disabled, contact support team for more info</h3>";
						echo "<p style='color:red; text-align:center'><a href=".base_url('login').">Back</a></p>";
						return;
					}


					$this->session->set_flashdata('form', '<script>Swal.fire("Welcome ' . $row->username . '","","success")</script>');
					$previous_page = $this->session->userdata('go_back_after_logout'); // this is gotten from logout.php in view folder
					echo $previous_page == null ? '<script>window.open("' . base_url('dashboard') . '","_self")</script>' : '<script>history.go(-2)</script>';
				} else {
					// admin login cmd

					$loginQuery = $this->model->adminLoginQuery($data_admin);

					if ($loginQuery->num_rows() > 0) {


						foreach ($loginQuery->result() as $row) {
							$this->session->set_userdata('adminId', $row->ad_id);
							$this->session->set_userdata('adminEmail', $row->ad_email);
						}

						//update user login_key
						$adminId = $row->ad_id;
						$loginKey = md5(rand());

						$this->session->set_userdata('adminLoginKey', $loginKey);

						$updateLoginKey = $this->model->updateAdminLoginKey($adminId, $loginKey);

						if ($updateLoginKey > 0) {
							$this->session->set_userdata('loginError', '');
							redirect(base_url('txn_info')); //go to txn_view_users
						}
					} else {
						$this->session->set_flashdata('form', "<script>Swal.fire('Error','Invalid login details','error')</script>");
						$this->session->set_flashdata('form', '<script>Swal.fire("Login error","Invalid login detailsd","error")</script>');
						$this->index();
					}
				}
			} else {
				$this->index();
			}
		} else {
			redirect(base_url('login'));
		}
	}

}

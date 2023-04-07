<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password_reset extends CI_Controller
{

	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('model');
	}


	public function index()
	{
		$this->load->view('password_reset');
	}

	function new_password()
	{
		$account_type = $this->security->xss_clean($this->input->get('acc_type'));
		$email = $this->security->xss_clean($this->input->get('email'));
		$link = $this->security->xss_clean($this->input->get('link'));
		$data['account_type'] = $account_type;
		$data['email'] = $email;
		$data['link'] = $link;
      
      	// check if the link exists
      if ($account_type == "admin") {
        $chkLink=$this->model->checkAdminLink($link, $email);
       	if(!$chkLink->num_rows()>0){
          echo "<h1 style='color:red'>Sorry, link not found.</h1>";
          return;
        }
      }
      else if ($account_type == "member") {
        $chkLink=$this->model->checkMemberLink($link, $email);
       	if(!$chkLink->num_rows()>0){
          echo "<h1 style='color:red'>Sorry, link not found.</h1>";
          return;
        }
      }
      	
     
		$this->load->view('new_password', $data);
	}

	// save password
	function save_password()
	{
		 $new_password = md5(md5($this->security->xss_clean($this->input->post('new_password'))));
		 $account_type = $this->security->xss_clean($this->input->post('acc_type'));
		 $email = $this->security->xss_clean($this->input->post('email'));
		 $link = $this->security->xss_clean($this->input->post('link'));

		if ($account_type == "admin") {
			$data=array(
				"ad_email"=>$email,
				"ad_password_reset_link"=>$link
			);
			if($this->model->save_admin_password($data,$new_password)){
				$this->session->set_flashdata('form', '<script>Swal.fire("Password saved successfully","","success")</script>');
				echo '<script>window.open("' . base_url('login') . '","_self")</script>';
			}else{
				echo "<h1 style='color:red'>Sorry, link not found.</h1>";
			}
		} else if ($account_type == "member") {
			$data=array(
				"email"=>$email,
				"password_reset "=>$link				
			);
			if($this->model->save_user_password($data,$new_password)>0){
				$this->session->set_flashdata('form', '<script>Swal.fire("Password saved successfully","","success")</script>');
				echo '<script>window.open("' . base_url('login') . '","_self")</script>';
			}else{
				echo "<h1 style='color:red'>Sorry, link not found.</h1>";
			}
		}else{
			echo "<h1 style='color:red'>Sorry, link not found.</h1>";
		}
		
	}


	// request for password reset through email
	function send_reset_mail()
	{
		// get system config email
		$get_config_email=$this->db->get('tbl_configuration')->result();
		if(count($get_config_email)>0){
			foreach($get_config_email as $get_config_email){
				$configEmail=$get_config_email->config_email;
			}
		}

		if ($this->input->post('reset') == 'Reset') {

			$this->form_validation->set_rules('email', 'email', 'required|trim');
			$this->form_validation->set_rules('account_type', 'account_type', 'required');


			if ($this->form_validation->run()) {

				$account_type = $this->security->xss_clean($this->input->post('account_type'));
				$email = $this->security->xss_clean($this->input->post('email'));
				$rand_no = md5(md5(rand()));
				$msg = "<h1 style='color:blue'>You received this mail because you request for a password reset <h1>
				<h4>Click the link below to reset your password or copy and paste the link below in the address bar of your web browser</h4>
				<p><a href='" . base_url("password_reset/new_password?acc_type=$account_type&email=$email&link=$rand_no") . "'>" . base_url("password_reset/new_password?acc_type=$account_type&email=$email&link=$rand_no") . "</a></p>
				<p> please ignore this message if you did not initiate this.</p>";
				if ($account_type == "admin") {
					$resetP = $this->model->resetAdmin($email, $rand_no);
					if ($resetP > 0) {
						// send a mail to the email address						
						$to = "$email";
						$subject = 'Password reset from BitNitro';
						$headers  = "From:$configEmail\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

					

						if(mail($to, $subject, $msg, $headers)){
						$this->session->set_flashdata('form', '<script>Swal.fire("Success! password reset link sent.","please check your mail box | spam.","success")</script>');
						$this->session->set_flashdata("password_reset_request", "<div class='bg-light p-3'><h6 class='text-success '> Password reset link has been sent successfully to your email, please check your mail box | spam.</h6></div>");

                          echo '<script>window.open("' . base_url('password_reset') . '","_self")</script>';
                        }
					}
				} else if ($account_type == "member") {
					$resetP = $this->model->resetMember($email, $rand_no);
					if ($resetP > 0) {
						// send a mail to the email address						
						$to = "$email";
						$subject = 'Password reset from BitNitro';
						$headers  = "From:$configEmail\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

						

						if(mail($to, $subject, $msg, $headers)){
						$this->session->set_flashdata('form', '<script>Swal.fire("Success! password reset link sent.","please check your mail box | spam.","success")</script>');
						$this->session->set_flashdata("password_reset_request", "<div class='bg-light p-3'><h6 class='text-success '> Password reset link has been sent successfully to your email, please check your mail box | spam.</h6></div>");

						echo '<script>window.open("' . base_url('password_reset') . '","_self")</script>';
                        }
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

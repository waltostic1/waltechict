<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('model');
	}

	public function index()
	{
		// get ref username from the url post if it exists
		// store username in session
		//$sessionRefUsername="";
		$refUrlUsername=$this->input->get('ref');
		$this->session->set_userdata('session_ref_username',$refUrlUsername);

		$this->load->view('register');
	}

	function register()
	{
		if ($this->input->post('register') != null) {

			$this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[tbl_user.username]|max_length[50]');
          $this->form_validation->set_rules('email', 'email', 'required|trim|is_unique[tbl_user.email]|max_length[50]');
			$this->form_validation->set_rules('ref', 'ref username', 'trim|max_length[50]');
			$this->form_validation->set_rules('password', 'password', 'required');
			//$this->form_validation->set_rules('reEnterPassword', 're-enter password', 'required|matches[password]');


			if ($this->form_validation->run()) {

				$ref_username = $this->security->xss_clean($this->input->post('ref'));
				$username = $this->security->xss_clean($this->input->post('username'));
              	$email = $this->security->xss_clean($this->input->post('email'));

				$refId = "1";
				// get the ref id from the usertable using the ref username
				$response1 = $this->model->getRef($ref_username);
				if ($response1->num_rows() > 0) {
					foreach ($response1->result() as $row) {
						$refId = $row->user_id;
					}
				} else {
					$refId = '';
					$ref_username = "";
				}
              $emailVlink=md5(rand());
				$data = array(
					'username'	   =>  $username,
                    'email' => $email,
					'ref_username'	   => $ref_username,
					'ref_id' => $refId,
					'password' => md5(md5($this->input->post('password'))),
					'total_amount' => '0',
					'status' => '1',
                  	'is_email_verified'=>'no',
                  	'email_verification' => $emailVlink,

				);

				$queryResponse = $this->model->register($data);

				if ($queryResponse > 0) {
                  $password=$this->input->post('password');
                  
                  // send a mail to the user
			$to = "$email";
            $msg="<h3>Hi $username</h3>";
            $msg.="<h3>Welcome to Bitnitro Crypto Mining Company</h3>";
            $msg.="<h4>Your registration was successful</h4>";
            $msg.="<h4>Please activate your account by clicking the email verification link below or copy and paste the link in the address bar of your browser</h4>";
            $msg.="<h4><a href='".base_url('register/activate_account?email=').$email."&emailVlink=".$emailVlink."'>".base_url('register/activate_account?email=').$email."&					emailVlink=".$emailVlink."</a></h4>";
            $msg.="<h4 style='color:green'>Your login details are <br> (Username: $username)<br>(password: $password)<br> Do well to keep them safe.</h4>";
           
			
            $configEmail=$this->session->userdata('configEmail');
			$subject = 'Successful registration @ bitnitro';
			echo $headers  = "From:$configEmail\r\n";return;
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$m = mail($to, $subject, $msg, $headers);
                  
					//$this->session->set_flashdata('form', '<script>Swal.fire("Registration success","","success")</script>');
					//redirect(base_url('login'));
                  
                  redirect(base_url('register/success'));
                  
				}
			} else {
				$this->index();
			}
		} else {
			//echo('<script>alert("no")</script>');
			redirect(base_url('register'));
		}
	}
  
  function success(){
   echo " <h1 style='color:green; text-align:center'>Your registration was successful</h1>";
     echo "<h2 style='text-align:center'>Please check your email to activate your account</h2>";
    echo "<h2 style='text-align:center'><a href='".base_url('login')."'>Login</a></h2>";
  }
  
  
  function activate_account(){
    $email = $this->security->xss_clean($this->input->get('email'));
    $emailVlink = $this->security->xss_clean($this->input->get('emailVlink'));
    $data=array(
    "email"=>$email,
    "email_verification"=>$emailVlink,
    );
        
    
    $_response_ = $this->model->emailVerification($data);
    if($_response_>0){
       echo " <h1 style='color:green; text-align:center'>Email verification was successful</h1>";
     echo "<h2 style='text-align:center'>You can now login into your account</h2>";
    echo "<h2 style='text-align:center'><a href='".base_url('login')."'>Login</a></h2>";
    }else{
       echo "<h1 style='color:red; text-align:center'>Invalid link</h1>";
    }
    
    
  }
}

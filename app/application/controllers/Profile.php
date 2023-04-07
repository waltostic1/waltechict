<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('model');
	}


	public function index()
	{

		$userId = $this->session->userdata('user_id');
		$data['get_cryptocurrency'] = $this->model->getCryptocurrency();

		$data['get_user_info'] = $this->model->getUserInfo($userId);

		//$data['fetch_system_admin']=$this->index_model->getSystemAdmin();
		$this->load->view('profile', $data);
	}

	function getCryptocurrencyTableData()
	{
		$userId = $this->session->userdata('user_id');
		$tableName = $this->input->post('tableName');
		$getData = $this->model->getUserCryptocurrencyAddress($userId, $tableName);
		if ($getData->num_rows() > 0) {
			foreach ($getData->result() as $row) {
				echo $row->cc_currency_address;
			}
		}
	}



	// upload img

	public function do_upload()
	{
		if (isset($_FILES['profile_photo']['name']) && !null == ($_FILES['profile_photo']['name'])) {

			$config['upload_path']          = './img/profile_photo/';
			$config['allowed_types']        = 'gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG';
			$config['max_size']             = 3000;
			$config['file_name']			= rand() . rand() . date('dmYhs') . '.jpg';
			$config['file_size']     		= 19.2;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('profile_photo')) {
				$error =  $this->upload->display_errors('<p>', '</p>');
				$error = str_replace('<p>', '', $error);
				$error = str_replace('</p>', '', $error);

				// comment one of the following lines

				$this->session->set_flashdata('form', "<script>Swal.fire('$error','Please check the image and try again','error')</script>");
				//echo "<script>Swal.fire('$error','Please check the image and try again','error')</script>";
				echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
			} else {
				$dbImg = 'profile_photo';
				$this->process_image($config, $dbImg);
			}
		} else {

			// comment one of the following lines

			$this->session->set_flashdata('form', "<script>Swal.fire('Error','Please select an image and try again.','error')</script>");
			//echo "<script>Swal.fire('Error','Please select an image and try again.','error')</script>";
			echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
		}
	}


	// photo upload process
	function process_image($config, $dbImg)
	{
		$data = $this->upload->data();
		echo '<img src="' . base_url() . 'img/profile_photo/' . $data["file_name"] . '" style="max-width:50%; height:auto"/>';
		if ($dbImg == 'profile_photo') {
			$userId = $this->session->userdata('user_id');

			$previous_profile_photo = $this->input->post('previous_profile_photo');

			$imgName = array('photo' => $config['file_name']);

			$resultQ = $this->model->saveProfilePhoto($imgName, $userId);
			if ($resultQ > 0) {

				$pathToDirect = getcwd();

				if (!$previous_profile_photo == null) {
					unlink($pathToDirect . '/img/profile_photo/' . $previous_profile_photo . '');
				}


				// comment one of the following lines

				$this->session->set_flashdata('form', "<script>Swal.fire('Profile photo saved successfully','Login is required','success')</script>");

				echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
			}
		} else {

			// comment one of the following lines

			$this->session->set_flashdata('form', "<script>Swal.fire('Error','Profile photo was not saved','error')</script>");
			//echo "<script>Swal.fire('Error','Profile photo was not saved','error')</script>";
			echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
		}
	}

	// end of upload img

	function saveProfilePhoto()
	{
		$this->do_upload();
	}


	// save wallet
	function save_wallet()
	{          
		$userId = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');
		$tableName = $this->security->xss_clean($this->input->post('tableName'));
		$walletAddress = $this->security->xss_clean($this->input->post('walletAddress'));
      	$txnPin=$this->security->xss_clean($this->input->post('txnPin'));
     
     if($this->session->userdata('admin_state')=="on"){
       $inputPin=$this->session->userdata('txn_pin');
     }else{
       $inputPin=md5(md5($txnPin));
     }
      
      // check txnPin
      if($inputPin==$this->session->userdata('txn_pin')){       
      

		if ($walletAddress != "") {

			// check if the user data exists in the table, update it else insert new record

			$userChk = $this->model->checkUser($tableName, $userId);
			if ($userChk->num_rows() > 0) {
				$queryResponse = $this->model->saveWallet($walletAddress, $tableName, $userId);
				if ($queryResponse > 0) {
					echo '<script>Swal.fire("Wallet address saved successfully","","success")</script>';
					echo "$walletAddress";
				} else {
					echo '<script>Swal.fire("Error","No changes were made.","error")</script>';
					echo "$walletAddress";
				}
			} else {
				$queryInsert = $this->model->insertWallet($walletAddress, $tableName, $userId, $username);
				if ($queryInsert > 0) {
					echo '<script>Swal.fire("New wallet address saved successfully","","success")</script>';
					echo "$walletAddress";
				} else {
					echo '<script>Swal.fire("Error","No changes were made.","error")</script>';
				}
			}
		} else {
			echo '<script>Swal.fire("Input error!","No changes were made.","error")</script>';
		}
    }else{
        echo '<script>Swal.fire("Invalid transaction PIN","","error")</script>';
      }
  
	}

	function saveProfile()
	{
		if ($this->input->post('save_profile') != null) {
			$this->form_validation->set_rules('telephone', 'telephone', 'required|trim|max_length[11]|numeric|min_length[11]');
			$this->form_validation->set_rules('email', 'email', 'required|trim|max_length[50]');
			$this->form_validation->set_rules('full_name', 'full name', 'required|trim|max_length[100]');
			


			if ($this->form_validation->run()) {
				$data = array(

					'email'	=>  $this->security->xss_clean($this->input->post('email')),
					'full_name' => $this->security->xss_clean($this->input->post('full_name')),
					'phone' => $this->security->xss_clean($this->input->post('telephone')),
				);
				$userId = $this->session->userdata('user_id');
				$queryResponse = $this->model->saveProfile($data, $userId);

				if ($queryResponse > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Profile saved successfully","","success")</script>');

					echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
				} else {
					$this->session->set_flashdata('form', '<script>Swal.fire("Error","No changes were made may be the email address already exist.","error")</script>');

					echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
				}
			} else {
				$this->session->set_flashdata('form', '<script>Swal.fire("Profile not saved","Please check your form ","error")</script>');
				$this->index();
				//echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
			}
		} else {
			redirect(base_url('profile'));
		}
	}


	    public function save_user_pin(){
        $this->form_validation->set_rules('txn_pin', 'transaction pin', 'required|trim|max_length[4]|numeric|min_length[4]');
       if ($this->form_validation->run()) {
            $pin = md5(md5($this->input->post('txn_pin')));
          	 
            $userId = $this->session->userdata('user_id');
            if ($pin == "") {
                echo '<script>Swal.fire("Invalid pin","No changes were made.","error")</script>';
                return;
            }
            $queryResponse = $this->model->savePin($userId, $pin);

            if ($queryResponse > 0) {
                $this->session->set_flashdata('form', '<script>Swal.fire("Pin saved successfully","","success")</script>');
                echo '<script>window.open("' . base_url('profile') . '","_self")</script>';

            } else {
                echo '<script>Swal.fire("Error","No changes were made.","error")</script>';

            }

        } else {
           echo '<script>Swal.fire("Invalid pin format","also ensure it contains only 4 digits","error")</script>';

        }
    }
  
  
  function get_txn_reset_code(){
    $configEmail=$this->session->userdata('configEmail'); // the company's email address
    $userEmail=$this->session->userdata('email');
    $userId = $this->session->userdata('user_id');
    $resetCode=substr(md5(md5(rand())),0,10);
    
    $_update_=$this->model->updateTxnResetCode($userEmail, $userId, $resetCode);
    if($_update_>0){
      
      // send 10 characters reset code to the user's email
      
      			
      $msg="<h4>Hi $userEmail </h4>";
      $msg.="<p>Your ten (10) characters transaction <code>reset code </code> is $resetCode</p>";
      $msg.="<p>Please ignore if you didn't request for this.</p>";
      		$subject = 'Transaction reset code request from BitNitro';
			$headers  = "From:$configEmail\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$m = mail($userEmail, $subject, $msg, $headers); 
      
      
      // message user
      echo "<span class='text-success'>Your request was successful and <code>Reset code</code> has been sent to your email, please check your email. </span>";
      echo '<script>Swal.fire("Your request was successful.","Txn reset code has been sent to your email, please check your mail.","success")</script>';
    }
  }
    
    
  
  function reset_user_pin(){
     $this->form_validation->set_rules('txn_pin', 'transaction pin', 'required|trim|max_length[4]|numeric|min_length[4]');
       if ($this->form_validation->run()) {
            $pin = md5(md5($this->input->post('txn_pin')));
         	$reset_code=$this->security->xss_clean($this->input->post('reset_code'));
          	 
            $userId = $this->session->userdata('user_id');
            if ($pin == "") {
                echo '<script>Swal.fire("Invalid pin","No changes were made.","error")</script>';
                return;
            }
            $queryResponse = $this->model->resetPin($userId, $pin, $reset_code);

            if ($queryResponse > 0) {
                $this->session->set_flashdata('form', '<script>Swal.fire("Pin saved successfully","","success")</script>');
                echo '<script>window.open("' . base_url('profile') . '","_self")</script>';

            } else {
                echo '<script>Swal.fire("Error! no changes were made.","Reasons: invalid ten(10) characters reset code; Input error.","error")</script>';

            }

        } else {
           echo '<script>Swal.fire("Invalid pin format","also ensure it contains only 4 digits","error")</script>';

        }
  }
}

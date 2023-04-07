<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_share_bonus extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_pending_deposit'] = $this->admin_model->getPendingDeposit(); // get deposit
		$this->load->view('txn_share_bonus', $data);
	}


	// share bonus

	function share()
	{

		//note: receiver cagegory => specified user=1; all users=2; users that have made deposit=3; users that have not made deposit=4

		$amount = $this->security->xss_clean($this->input->post('amount'));
		$username = $this->security->xss_clean($this->input->post('username'));
		$receiver = $this->security->xss_clean($this->input->post('receiver'));
		$finalRceiver = $this->security->xss_clean($this->input->post('finalRceiver')); // not in used yet

		// receiver 1 = a specific user
		if ($receiver == "1") {
			// get user data and get the balance
			$result = $this->admin_model->getUserData($username);
			if ($result->num_rows() > 0) {

				foreach ($result->result() as $row) {
					$bonus = $row->total_amount;
					$userId = $row->user_id;
                  	$userEmail=$row->email;
				}
				$totalBonus = $amount + $bonus;
				$result2 = $this->admin_model->shareBonusToUser($username, $totalBonus, $userId, $amount);
				if ($result2 > 0) {
                  
                  // send mail to the receiver
                  
			$to = "$userEmail";
            $msg="<h3>Hi $username</h3>";
            $msg.="<p>Your account has been credited with USD $amount bonus</p>";
            $msg.="<p>You can find this in your system wallet</p>";
            $msg.="<p>Thanks for choosing BitNitro</p>";
            
            
            $configEmail=$this->session->userdata('configEmail');

			$subject = 'Bonus credit alert from BitNitro';
			$headers  = "From:$configEmail\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$m = mail($to, $subject, $msg, $headers);                 
                  
                  // end of send mail to the receiver
                  
					$this->session->set_flashdata('form', '<script>Swal.fire("Bonus sent successfully","","success")</script>');
					echo '<script>window.open("' . base_url('txn_share_bonus') . '","_self")</script>';
					return;
				} else {
					echo '<script>Swal.fire("Bonus not sent","","error")</script>';
					return;
				}
			} else {
				echo '<script>Swal.fire("Invalid username","","error")</script>';
				return;
			}
		} else if ($receiver == "2") {
			//note: receiver cagegory => all users=2;

			// get all users => loop through and add bonus;
			$result = $this->admin_model->getUsers();
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row) {
                  $userEmail=$row->email;
					$bonus = $row->total_amount;
					$username = $row->username;
					$userId = $row->user_id;
					$totalBonus = $amount + $bonus;
					$result2 = $this->admin_model->shareBonusToUser($username, $totalBonus, $userId, $amount);
                  
                                    // send mail to the receiver
                  
			$to = "$userEmail";
            $msg="<h3>Hi $userEmail</h3>";
           $msg.="<p>Your account has been credited with USD $amount bonus</p>";
            $msg.="<p>You can find this in your system wallet</p>";
            $msg.="<p>Thanks for choosing BitNitro</p>";
            
            
            $configEmail=$this->session->userdata('configEmail');

			$subject = 'Bonus credit alert from BitNitro';
			$headers  = "From:$configEmail\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$m = mail($to, $subject, $msg, $headers);                 
                  
                  // end of send mail to the receiver
				}
				if ($result2 > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Bonus sent successfully","","success")</script>');
					echo '<script>window.open("' . base_url('txn_share_bonus') . '","_self")</script>';
					return;
				} else {
					echo '<script>Swal.fire("Bonus not sent","","error")</script>';
					return;
				}
			} else {
				echo '<script>Swal.fire("Invalid users","","error")</script>';
				return;
			}
		} else if ($receiver == "3") {
			//note: receiver cagegory =>  users that have made deposit=3;
			// get all users that have made deposit => loop through and add bonus;
			$result = $this->admin_model->getUsersHaveDeposit();
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row) {
					$bonus = $row->total_amount;
					$username = $row->username;
                  $userEmail=$row->email;
					$userId = $row->user_id;
					$totalBonus = $amount + $bonus;
					$result2 = $this->admin_model->shareBonusToUser($username, $totalBonus, $userId, $amount);
                  	
                                    // send mail to the receiver
                  
			$to = "$userEmail";
            $msg="<h3>Hi $userEmail</h3>";
            $msg.="<p>Your account has been credited with USD $amount bonus</p>";
            $msg.="<p>You can find this in your system wallet</p>";
            $msg.="<p>Thanks for choosing BitNitro</p>";
            
            
            $configEmail=$this->session->userdata('configEmail');

			$subject = 'Bonus credit alert from BitNitro';
			$headers  = "From:$configEmail\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$m = mail($to, $subject, $msg, $headers);                 
                  
                  // end of send mail to the receiver
				}
				if ($result2 > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Bonus sent successfully","","success")</script>');
					echo '<script>window.open("' . base_url('txn_share_bonus') . '","_self")</script>';
					return;
				} else {
					echo '<script>Swal.fire("Bonus not sent","","error")</script>';
					return;
				}
			} else {
				echo '<script>Swal.fire("Invalid users","","error")</script>';
				return;
			}
		} else if ($receiver == "4") {
			//note: receiver cagegory =>  users that have not made deposit=4
			// get all users that have made deposit => loop through and add bonus;
			$result = $this->admin_model->getUsersHaveNoDeposit();
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row) {
					$bonus = $row->total_amount;
					$username = $row->username;
					$userId = $row->user_id;
                  	$userEmail=$row->email;
					$totalBonus = $amount + $bonus;
					$result2 = $this->admin_model->shareBonusToUser($username, $totalBonus, $userId, $amount);
                                    // send mail to the receiver
                  
			$to = "$userEmail";
            $msg="<h3>Hi $userEmail</h3>";
           $msg.="<p>Your account has been credited with USD $amount bonus</p>";
            $msg.="<p>You can find this in your system wallet</p>";
            $msg.="<p>Thanks for choosing BitNitro</p>";
            
            
            $configEmail=$this->session->userdata('configEmail');

			$subject = 'Bonus credit alert from BitNitro';
			$headers  = "From:$configEmail\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$m = mail($to, $subject, $msg, $headers);                 
                  
                  // end of send mail to the receiver
				}
				if ($result2 > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Bonus sent successfully","","success")</script>');
					echo '<script>window.open("' . base_url('txn_share_bonus') . '","_self")</script>';
					return;
				} else {
					echo '<script>Swal.fire("Bonus not sent","","error")</script>';
					return;
				}
			} else {
				echo '<script>Swal.fire("Invalid users","","error")</script>';
				return;
			}
		} else {
			echo '<script>Swal.fire("Invalid command","","error")</script>';
			return;
		}


		// // credit the upliner | referrer
		// $report = $this->admin_model->creditRef($refId, $finalBalance);
		// if ($report > 0) {
		// 	// send a report to the ref
		// 	$data = array(
		// 		'rr_user_id' => $refId,
		// 		'rr_downline_username' => $depositorUsername,
		// 		'rr_bonus' => $bonus,
		// 	);
		// 	$report2 = $this->admin_model->sendRefReport($data);
		// 	if ($report2 > 0) {
		// 		$this->session->set_flashdata('form', '<script>Swal.fire("Transaction approved","Referral bonus credited","success")</script>');
		// 		echo '<script>window.open("' . base_url('txn_pending_deposit') . '","_self")</script>';
		// 		return;
		// 	} else {
		// 		echo '<script>Swal.fire("Referral bonus not credited","Please try again","error")</script>';
		// 		return;
		// 	}
		// }
		// //return;

	}
	// end of share bonus function



}

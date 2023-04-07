<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Make_deposit extends CI_Controller
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
		$data['get_package'] = $this->model->getPackage();
		$data['get_cryptocurrency'] = $this->model->getCryptocurrency();

		$data['get_user_info'] = $this->model->getUserInfo($userId);

		$this->load->view('make_deposit', $data);
	}



	function deposit()
	{

		if ($this->input->post('walletId') != "" || $this->input->post('depositAmount') != "") {
			//
			$pkgDueDay = $this->security->xss_clean($this->input->post('pkgDueDay'));
			$pkgName = $this->security->xss_clean($this->input->post('pkgName'));
			$pkgId = $this->security->xss_clean($this->input->post('pkgId'));
			$depositAmount = $this->security->xss_clean($this->input->post('depositAmount'));
			$walletId = $this->security->xss_clean($this->input->post('walletId'));
			$tracking_id=$this->security->xss_clean($this->input->post('tracking_id'));
			$userId = $this->session->userdata('user_id');
			$userName = $this->session->userdata('username');
			$pkgPercentage = $this->security->xss_clean($this->input->post('pkgPercentage'));
			$income = (($pkgPercentage / 100) * $depositAmount) + $depositAmount;

			//(setPercentage / 100) * amount;


			// if user invests from his account
			if ($walletId == "system_wallet") {
				//echo '<script>Swal.fire("Deposit not successful","Please update you wallet address and try again.","error")</script>';

				// check if the user has such amount
				// check if the user has the requested amount
				$chkResponse = $this->model->userBalance($userId);
				if ($chkResponse->num_rows() > 0) {
					foreach ($chkResponse->result() as $row) {
						$userBalance = $row->total_amount;
					}

					if ($depositAmount > $userBalance) {
						echo '<script>Swal.fire("Insufficient fund!","","error")</script>';
						return;
					} else {
						// debit user account
						$newBalance = $userBalance - $depositAmount;
						$response = $this->model->debitUser($userId, $newBalance);
						if ($response > 0) {
							// if debit is successfull
							// place deposit


							$data = array(
								'dpt_user_id' => $userId,
								'dpt_username' => $userName,
								'dpt_pkg_due_day' => $pkgDueDay,
								'dpt_package_name' => $pkgName,
								'dpt_package_id ' => $pkgId,
								'dpt_amount' => $depositAmount,
								'dpt_pkg_interest_rate' => $pkgPercentage,
								'dpt_total_income' => round($income, 2),
								'dpt_wallet_id' => $walletId,
								'dpt_txn_tracking_id' => $tracking_id,
								'dpt_wallet_name' => "system_wallet",
								'dpt_company_wallet_address' => "company_system_wallet",
								'dpt_wallet_address' => "system_wallet",
		
								'dpt_status' => '1',
							);
		
							$depositResponse = $this->model->deposit($data, $userId);
		
							if ($depositResponse > 0) {
								$this->session->set_flashdata('form', '<script>Swal.fire("Deposit saved and approved successfully","","success")</script>');
								//echo '<script>Swal.fire("Deposit saved successfully","Please wait for the admin to confirm your order","success")</script>';
								echo '<script>window.open("' . base_url('make_deposit') . '","_self")</script>';
							} else {
								//$this->session->set_flashdata('form', '<script>Swal.fire("Error","No changes were made.","error")</script>');
								echo '<script>Swal.fire("Deposit error","Please check your order and try again.","error")</script>';
								//echo '<script>window.open("' . base_url('make_deposit') . '","_self")</script>';
							}


							// end of place deposit
						} else {
							echo '<script>Swal.fire("Debit error!","","error")</script>';
							return;
						}
					}
				}




				return;
			} else {





				// get wallet name using walletId
				$getW = $this->model->getWalletName($walletId);
				if ($getW->num_rows() > 0) {
					foreach ($getW->result() as $row) {
						$walletName = $row->c_name;
						$walletTableName = $row->c_table;
						$company_wallet_address = $row->c_admin_wallet_address;
					}
					// get the user wallet address
					$getUserW = $this->model->getUserWalletAddress($walletTableName, $userId);
					if ($getUserW->num_rows() > 0) {
						foreach ($getUserW->result() as $row2) {
							$userWalletAddress = $row2->cc_currency_address;
						}
					} else {
						echo '<script>Swal.fire("Deposit not successful","Please update you wallet address and try again.","error")</script>';
						return;
					}


					$data = array(
						'dpt_user_id' => $userId,
						'dpt_username' => $userName,
						'dpt_pkg_due_day' => $pkgDueDay,
						'dpt_package_name' => $pkgName,
						'dpt_package_id ' => $pkgId,
						'dpt_amount' => $depositAmount,
						'dpt_pkg_interest_rate' => $pkgPercentage,
						'dpt_total_income' => round($income, 2),
						'dpt_wallet_id' => $walletId,
						'dpt_wallet_name' => $walletName,
						'dpt_txn_tracking_id' => $tracking_id,
						'dpt_company_wallet_address' => $company_wallet_address,
						'dpt_wallet_address' => $userWalletAddress,

						'dpt_status' => '0',
					);

					$depositResponse = $this->model->deposit($data, $userId);

					if ($depositResponse > 0) {

						// sending mails

						$configEmail = $userEmail = "example@example.com";
						//get the email of the user
						$getUser=$this->db->where('user_id', $userId)->get('tbl_user')->result();
						if(count($getUser)>0){
							foreach($getUser as $getUserInfo){
								$userEmail=$getUserInfo->email;
							}
						}

						// get configEmail from the system config table
						$getConfigEmail=$this->db->get('tbl_configuration')->result();
						if(count($getConfigEmail)>0){
							foreach($getConfigEmail as $_getConfigEmail){
								$configEmail = $_getConfigEmail->config_email;
							}
						}

						$msg='
						<div style="width: 400px; background-color:white; color:black; padding:10px;">
							<h5 style="background-color:black; color:#ffab00; text-align:center; padding:14px;">BitNitro
								mining company</h5>
							<div style="padding: 3px 14px 3px 14px">
								<h5>Deposit Alert </h5>
								<p>Your client initiated payment and here are the details <br>
								<b>Username: </b>'. $userName.'<br><b>Email:</b> '.$userEmail.'<br> <b>Amount:</b> $'. number_format($depositAmount, 2) . '<br>
								<b>Wallet:</b> '. strtoupper($walletName) .'<br> Transaction reference: '.$tracking_id.'</p>								
								<p><a href="'.base_url('/txn_pending_deposit').'"style="background-color:#ffab00; font-weight:bolder; color:black; 
								border-radius:4px; padding:8px;">Visit Your Dashboard</a></p>			
							</div>
						</div>';
						$configEmail = $this->session->userdata('configEmail');
						$subject = 'Deposit alert from BitNitro';
						$headers = "From:$configEmail\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	
						$m = mail($configEmail, $subject, $msg, $headers);

						// end of sending mails

						$this->session->set_flashdata('form', '<script>Swal.fire("Deposit saved successfully","Please wait for the admin to confirm your order","success")</script>');
						//echo '<script>Swal.fire("Deposit saved successfully","Please wait for the admin to confirm your order","success")</script>';
						echo '<script>window.open("' . base_url('make_deposit') . '","_self")</script>';
					} else {
						//$this->session->set_flashdata('form', '<script>Swal.fire("Error","No changes were made.","error")</script>');
						echo '<script>Swal.fire("Deposit error","Please check your order and try again.","error")</script>';
						//echo '<script>window.open("' . base_url('make_deposit') . '","_self")</script>';
					}
				} else {
					echo '<script>Swal.fire("Invalid input","Please check your order and try again.","error")</script>';
				}
			}
		} else {
			//redirect(base_url('make_deposit'));
			echo '<script>Swal.fire("Invalid order","Please check your order and try again.","error")</script>';
		}
	}
}

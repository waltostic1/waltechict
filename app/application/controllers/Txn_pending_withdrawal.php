<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_pending_withdrawal extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_pending_withdrawal'] = $this->admin_model->getPendingWithdrawal(); // get withdrawal
		$this->load->view('txn_pending_withdrawal', $data);
		//$this->load->view('bootstrap_table',$data);
	}

	
	function settle_txn()
	{
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$trackingId = $this->security->xss_clean($this->input->post('trackingId'));
		$userEmail='example@example.com';

		// get withdrawal order of a txn using txn id
		$getTxn = $this->admin_model->getTxnWithdrawal($txnId);
		foreach ($getTxn->result() as $row) {
			$wd_id = $row->wd_id;
			$wd_user_id = $row->wd_user_id;
			$wd_username = $row->wd_username;
			$wd_user_wallet_name = $row->wd_user_wallet_name;
			$wd_user_wallet_address = $row->wd_user_wallet_address;
			$wd_amount = $row->wd_amount;
			$wd_status = $row->wd_status;
			$wd_date = $row->wd_date;

			$msg='
			<div style="width: 400px; background-color:white; color:black; padding:10px;">
				<h5 style="background-color:black; color:#ffab00; text-align:center; padding:14px;">BitNitro
					mining company</h5>
				<div style="padding: 3px 14px 3px 14px">
					<h5>Withdrawal Successful </h5>
					<p>Hi '. $wd_username.', you have successfully withdrawn
						<b>$'. number_format($wd_amount, 2) . '</b> worth of
						<b>'. strtoupper($wd_user_wallet_name) .'</b> from your account</p>
					<p><b>Withdrawal Address:</b> <br>'. $wd_user_wallet_address .'<br>
					<b>Transaction:</b> <br>'.$wd_id.'-'.rand(1000000000000, 9000000000000) .'<br>
					<b>Tracking Id:</b> <br>'. $trackingId .'<br>
					<b>Withdrawal Date:</b><br>'. $wd_date .' </p>
					<p><a href="'.base_url('/dashboard').'"style="background-color:#ffab00; font-weight:bolder; color:black; 
					border-radius:4px; padding:8px;">Visit Your Dashboard</a></p>
					<p>Don\'t recognize this activity? please <a href="'.base_url('/password_reset').'">reset your password</a> 
					and contact customer support immediately.</p>
					<p>Please check with the receiving platform or wallet as the transaction is already confirmed on the blockchain explorer.</p>
					<p style="text-align:center;"><i>-- Please do not replay to this message --</i></p>
				</div>
			</div>
			';
		}

		// get users email using the wd_user_id
		$getUser = $this->admin_model->getUserById($wd_user_id);
		foreach ($getUser->result() as $r) {
			$userEmail = $r->email;

		}

			$response = $this->admin_model->settleTxn($txnId, $trackingId);
		if ($response > 0) {

			// send a mail to the user
           $configEmail=$this->session->userdata('configEmail');
			$to = "$userEmail";

			$subject = 'Successful withdrawal';
			$headers  = "From:$configEmail\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";


			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction settled","","success")</script>');
			$m = mail($to, $subject, $msg, $headers);

			echo '<script>window.open("' . base_url('txn_pending_withdrawal') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}

	function cancel_txn()
	{
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		
		// get withdrawal order of a txn using txn id
		$getTxn = $this->admin_model->getTxnWithdrawal($txnId);
		foreach ($getTxn->result() as $row) {
			$wd_id = $row->wd_id;
			$wd_user_id = $row->wd_user_id;
			$wd_username = $row->wd_username;
			$wd_amount = $row->wd_amount;         
			$wd_user_wallet_name = $row->wd_user_wallet_name;
		}

		// get the table name from the tbl_cryptocurrency table
		$getCryptocurrencyTable = $this->db->where('c_name', $wd_user_wallet_name)->get('tbl_cryptocurrency')->result();
		foreach($getCryptocurrencyTable as $tableName){
			$c_table=$tableName->c_table;
		}

		// get the total amount the user has from the crypto table eg (bitcoin) using the user id. note: $c_table= bitcoin table for instance
		$getTotalAmount = $this->db->where('cc_user_id', $wd_user_id)->get("$c_table")->result();
		foreach($getTotalAmount as $totalAmount){
			$cc_total_amount=$totalAmount->cc_total_amount;
		}

		// get the email address of the user
		$getUserEmail = $this->db->where('user_id', $wd_user_id)->get("tbl_user")->result();
		foreach($getUserEmail as $userEmail){
			$user_email=$userEmail->email;
		}


		// add up the total amount of the user with that of the withdrawal amount
		// ie $cc_total_amount+$wd_amount
		$newTotalAmount = $cc_total_amount + $wd_amount;

		// delete from the withdrawal table and update the currency table ie bitcoin for instance


		$deleteWithdrawal=$this->db->where('wd_id', $txnId)->delete('tbl_withdrawal');
		if($this->db->affected_rows()>0){
			// update the user amount
			$this->db->set("cc_total_amount", $newTotalAmount)->where("cc_user_id", $wd_user_id)->update("$c_table");
			if($this->db->affected_rows() > 0){

				// send mail to user/participant
				$msg='
			<div style="width: 400px; background-color:white; color:black; padding:10px;">
				<h5 style="background-color:black; color:#ffab00; text-align:center; padding:14px;">BitNitro
					mining company</h5>
				<div style="padding: 3px 14px 3px 14px">
					<h5>Withdrawal Auto Reversal</h5>
					<p>Hi '. $wd_username.', your withdrawal order of
						<b>$'. number_format($wd_amount, 2) . '</b> worth of
						<b>'. strtoupper($wd_user_wallet_name) .'</b> has been reversed to your account</p>
				
					<p><a href="'.base_url('/dashboard').'"style="background-color:#ffab00; font-weight:bolder; color:black; 
					border-radius:4px; padding:8px;">Visit Your Dashboard</a> to confirm you balance is intact</p>
					
				</div>
			</div>
			';

			$configEmail=$this->session->userdata('configEmail');
			$to = "$user_email";

			$subject = "Auto reversal of withdrawal order from $configEmail";
			$headers  = "From:$configEmail\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";


			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction settled","","success")</script>');
			$m = mail($to, $subject, $msg, $headers);

				
				$this->session->set_flashdata('form', '<script>Swal.fire("Withdrawal request canceled","","success")</script>');
				echo '<script>window.open("' . base_url('txn_pending_withdrawal') . '","_self")</script>';	
			}else{
				echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
			}
		}

	}
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_queried_deposit extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_queried_deposit'] = $this->admin_model->getQueriedDeposit(); // get queried
		$this->load->view('txn_queried_deposit', $data);
	}


	// approve txn
	function approveTxn()
	{

		$cryptoId = $this->security->xss_clean($this->input->post('cryptoId'));
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$initialDeposit = $this->security->xss_clean($this->input->post('initialDeposit'));
		$userId = $this->security->xss_clean($this->input->post('depositorId')); // user id=depositor's id
		$txnSenderId = $this->security->xss_clean($this->input->post('depositorId'));
		$bonus = (5 / 100) * $initialDeposit;


		// get crypto table name using the cryptoId
		$rep=$this->admin_model->getCryptoTable($cryptoId);
		if($rep->num_rows()>0){
			foreach($rep->result() as $row){
				$cryptoTable=$row->c_table;
				$cryptoName=$row->c_name;
			}
		}else{
			echo "Error! try again.";
			return;
		}

		$response = $this->admin_model->approveTxn($txnId, $txnSenderId);
		if ($response > 0) {

			// get depositor data in other to retrieve ref id
			$dataReport = $this->admin_model->getDepositor($userId);
			if ($dataReport->num_rows() > 0) {
				foreach ($dataReport->result() as $row) {
					$refId = $row->ref_id;
					$depositorUsername = $row->username;
					$depositorEmail=$row->email;
				}
              
              
                    // send mail to the depositor

                    $to = "$depositorEmail";
					$msg='
					<div style="width: 400px; background-color:white; color:black; padding:10px;">
			<h5 style="background-color:black; color:#ffab00; text-align:center; padding:14px;">BitNitro
				mining company</h5>
			<div style="padding: 3px 14px 3px 14px">
				<h5>Deposit Successful </h5>
				<p>Hi '. $depositorUsername.', your deposit of <b>$'. number_format($initialDeposit, 2) . '</b> worth of
					<b>'. strtoupper($cryptoName) .'</b> is now approved. Wait for investment due date for cashout. Log in to check your transaction.</p>					
				<p><a href="'.base_url('/dashboard').'"style="background-color:#ffab00; font-weight:bolder; color:black; 
				border-radius:4px; padding:8px;">Visit Your Dashboard</a></p>
				<p>Don\'t recognize this activity? please <a href="'.base_url('/password_reset').'">reset your password</a> 
				and contact customer support immediately.</p>
				<p style="text-align:center;"><i>-- Please do not replay to this automated message --</i></p>
				<p><br><b>Risk warning:</b> Cryptocurrency trading is subject to high market risk. BitNitro will make the best efforts to choose high-quality
				coins, but will not be responsible for your trading losses. Please trade with caution.<br><b>Kindly note:</b> Please be aware of phishing sites
				 and always make sure you are visiting the official BitNitro website when entering sensitive data.<p>
			</div>
		</div>
					';


                    $configEmail = $this->session->userdata('configEmail');

                    $subject = 'Deposit approval from BitNitro';
                    $headers = "From:$configEmail\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    $m = mail($to, $subject, $msg, $headers);

                    // end of send mail to the depositor
              
              
              
				$dataReport2 = $this->admin_model->getRef($refId);
				if ($dataReport2->num_rows() > 0) {
					foreach ($dataReport2->result() as $row) {
						
						$total_amount = $row->total_amount;
					}
					$finalBalance = $total_amount + $bonus;
				}else{
					$this->session->set_flashdata('form', '<script>Swal.fire("Transaction approved","Referral bonus not credited: invalid referral","success")</script>');
					echo '<script>window.open("' . base_url('txn_queried_deposit') . '","_self")</script>';
					return;
				}




				// credit the upliner | referrer
				$report = $this->admin_model->creditRef($refId, $finalBalance);
				if ($report > 0) {
					// send a report to the ref
					$data = array(
						'rr_user_id' => $refId,
						'rr_downline_username' => $depositorUsername,
						'rr_bonus' => $bonus,
						'rr_comment'=>"ref. bonus for the purchase of $cryptoName"
					);
					$report2 = $this->admin_model->sendRefReport($data);
					if ($report2 > 0) {
						$this->session->set_flashdata('form', '<script>Swal.fire("Transaction approved","Referral bonus credited","success")</script>');
						echo '<script>window.open("' . base_url('txn_queried_deposit') . '","_self")</script>';
						return;
					} else {
						echo '<script>Swal.fire("Referral bonus not credited","Please try again","error")</script>';
						return;
					}
				}
				//return;
			}

			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction approved","no referral bonus was credited","success")</script>');
			echo '<script>window.open("' . base_url('txn_queried_deposit') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}
	// end of approve txn
	

	// queryTxn
	function queryTxn()
	{
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$txnSenderId = $this->security->xss_clean($this->input->post('depositorId'));
		$response = $this->admin_model->queryTxn($txnId, $txnSenderId);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction moved to query","","info")</script>');
			echo '<script>window.open("' . base_url('txn_queried_deposit') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}
	// end of query txn




	// delete txn
	function deleteTxn()
	{
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$txnSenderId = $this->security->xss_clean($this->input->post('depositorId'));
		$response = $this->admin_model->deleteTxn($txnId, $txnSenderId);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction moved to \'Recycle_Bin\'","","info")</script>');
			echo '<script>window.open("' . base_url('txn_queried_deposit') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}
	// end of delete txn
	
}

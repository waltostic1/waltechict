<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_successful_deposit extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_successful_deposit'] = $this->admin_model->getSuccessfulDeposit(); // get deposit
		$this->load->view('txn_successful_deposit', $data);
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
				}
				$dataReport2 = $this->admin_model->getRef($refId);
				if ($dataReport2->num_rows() > 0) {
					foreach ($dataReport2->result() as $row) {
						
						$total_amount = $row->total_amount;
					}
					$finalBalance = $total_amount + $bonus;
				}else{
					$this->session->set_flashdata('form', '<script>Swal.fire("Transaction approved","Referral bonus not credited: invalid referral","success")</script>');
					echo '<script>window.open("' . base_url('txn_pending_deposit') . '","_self")</script>';
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
						echo '<script>window.open("' . base_url('txn_pending_deposit') . '","_self")</script>';
						return;
					} else {
						echo '<script>Swal.fire("Referral bonus not credited","Please try again","error")</script>';
						return;
					}
				}
				//return;
			}

			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction approved","no referral bonus was credited","success")</script>');
			echo '<script>window.open("' . base_url('txn_pending_deposit') . '","_self")</script>';
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
			echo '<script>window.open("' . base_url('txn_pending_deposit') . '","_self")</script>';
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
			echo '<script>window.open("' . base_url('txn_pending_deposit') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}
	// end of delete txn
	
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_successful_withdrawal extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_successful_withdrawal'] = $this->admin_model->getSuccessfulWithdrawal();// get successful withdrawal
		$this->load->view('txn_successful_withdrawal',$data);
		//$this->load->view('bootstrap_table',$data);
	}


	function settle_txn()
	{	
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$trackingId = $this->security->xss_clean($this->input->post('trackingId'));
		$response = $this->admin_model->settleTxn($txnId,$trackingId);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction settled","","success")</script>');
			echo '<script>window.open("' . base_url('txn_pending_withdrawal') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}


}
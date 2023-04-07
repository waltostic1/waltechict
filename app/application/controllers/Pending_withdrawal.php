<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pending_withdrawal extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_pending_withdrawal'] = $this->admin_model->getPendingWithdrawal();// get withdrawal
		$this->load->view('pending_withdrawal',$data);
	}


	function settledTxn()
	{		
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$response = $this->admin_model->settleTxn($txnId);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction settled","","success")</script>');
			echo '<script>window.open("' . base_url('pending_withdrawal') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}


}

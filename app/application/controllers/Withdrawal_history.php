<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal_history extends CI_Controller
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
		$data['get_withdrawal'] = $this->model->getWithdrawal($userId);
		$data['get_user_info'] = $this->model->getUserInfo($userId);
		$this->load->view('withdrawal_history', $data);
	}



	function cancelTxn()
	{
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$userId = $this->session->userdata('user_id');
		$response = $this->model->cancelTxn($txnId, $userId);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction canceled","","success")</script>');
			echo '<script>window.open("' . base_url('deposit_history') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}

	function cashOutTxn()
	{
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$txnAmount = $this->security->xss_clean($this->input->post('txnAmount'));
		$userId = $this->session->userdata('user_id');
		$response = $this->model->cashOutTxn($txnId, $txnAmount, $userId);
		if ($response > 0) {
			// response return's success
			// update user amount in the tbl_user table

			$response2 = $this->model->amountUpdate($txnAmount, $userId);
			if ($response2 > 0) {
				$this->session->set_flashdata('form', '<script>Swal.fire("Cash out was successful","","success")</script>');
				echo '<script>window.open("' . base_url('deposit_history') . '","_self")</script>';
			} else {
				echo '<script>Swal.fire("Cash out process not complete","Please contact admin","error")</script>';
			}
		} else {
			echo '<script>Swal.fire("Cash out failed","Please try again","error")</script>';
		}
	}
}

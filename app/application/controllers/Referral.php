<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Referral extends CI_Controller
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
		$data['get_user_info'] = $this->model->getUserInfo($userId);
		$data['fetch_referral'] = $this->model->getReferral($userId);// get referrals
		$data['fetch_ref_report'] = $this->model->getRefReport($userId);// get ref report
		$this->load->view('referral',$data);
	}


	function settledTxn()
	{		
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$response = $this->model->settleTxn($txnId);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Transaction settled","","success")</script>');
			echo '<script>window.open("' . base_url('referral') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again","error")</script>';
		}
	}


}

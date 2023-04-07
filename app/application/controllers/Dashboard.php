<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->model('model');
	}


	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['get_user_info'] = $this->model->getUserInfo($userId);
		$data['get_deposit'] = $this->model->getDeposit($userId);

		$data['get_pending_deposit'] = $this->model->getPendingDeposit($userId);
		$data['get_approved_deposit'] = $this->model->getApprovedDeposit($userId);
		$data['get_unapproved_deposit'] = $this->model->getUnapprovedDeposit($userId);
		$data['get_settled_deposit'] = $this->model->getSettledDeposit($userId);
		$data['get_settled_withdrawal'] = $this->model->getSettledWithdrawal($userId);
		$data['get_pending_withdrawal'] = $this->model->getPendingWithdrawal($userId);

		
		
		
		
		$this->load->view('dashboard',$data);
	}
}

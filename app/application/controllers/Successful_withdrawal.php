<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Successful_withdrawal extends CI_Controller
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
		$data['get_withdrawal'] = $this->model->getSuccessfulWithdrawal($userId);// get successful withdrawals
		$data['get_user_info'] = $this->model->getUserInfo($userId);
		$this->load->view('successful_withdrawal', $data);
	}

}

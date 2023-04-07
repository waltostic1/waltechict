<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Deposit_history extends CI_Controller
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
		$data['get_deposit'] = $this->model->getDeposit($userId);
		$data['get_user_info'] = $this->model->getUserInfo($userId);
		$this->load->view('deposit_history', $data);
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
		$dpt_username = $this->security->xss_clean($this->input->post('dpt_username'));
		$dpt_package_name = $this->security->xss_clean($this->input->post('dpt_package_name'));
		$dpt_package_id = $this->security->xss_clean($this->input->post('dpt_package_id'));
		$dpt_amount = $this->security->xss_clean($this->input->post('dpt_amount'));
		$dpt_wallet_id = $this->security->xss_clean($this->input->post('dpt_wallet_id'));
		$dpt_pkg_due_day = $this->security->xss_clean($this->input->post('dpt_pkg_due_day'));
		$dpt_pkg_interest_rate = $this->security->xss_clean($this->input->post('dpt_pkg_interest_rate'));
		$dpt_total_income = $this->security->xss_clean($this->input->post('dpt_total_income'));
		$dpt_wallet_name = $this->security->xss_clean($this->input->post('dpt_wallet_name'));
		$dpt_wallet_address = $this->security->xss_clean($this->input->post('dpt_wallet_address'));
		$dpt_company_wallet_address = $this->security->xss_clean($this->input->post('dpt_company_wallet_address'));
		$dpt_status = $this->security->xss_clean($this->input->post('dpt_status'));

		// get the table name from cryptocurrency table using the wallet id

		$auto_reinvest="0"; // initialize to 0;
		// get automatic re-investment status from the system config table
		$get_auto_reinvest=$this->db->get('tbl_configuration')->result();
		if(count($get_auto_reinvest)>0){
			foreach($get_auto_reinvest as $get_row){
				$auto_reinvest=$get_row->config_auto_reinvest;
			}
		}
		

		$profit=($dpt_pkg_interest_rate*$dpt_amount)/100;
		
		// if auto re-investment is turned on 
		if($auto_reinvest=="1"){
			$profit_or_txnAmount=$profit;
		}else{
			$profit_or_txnAmount=$txnAmount;
		}
		
		


		$tablename = "";
		$result = $this->model->getCrypto($dpt_wallet_id);
		if ($result->num_rows() > 0) {
			foreach ($result->result() as $rows) {
				$tablename = $rows->c_table;
			}
		}

		$data = array(
			'wd_user_id' => $userId,
			'wd_username' => $dpt_username,
			'wd_package_name' => $dpt_package_name,
			'wd_package_id' => $dpt_package_id,
			'wd_amount' => $dpt_amount,
			'wd_wallet_id' => $dpt_wallet_id,
			'wd_pkg_due_day' => $dpt_pkg_due_day,
			'wd_pkg_due_day' => $dpt_pkg_due_day,
			'wd_pkg_interest_rate' => $dpt_pkg_interest_rate,
			'wd_total_income' => $dpt_total_income,
			'wd_wallet_name' => $dpt_wallet_name,
			'wd_wallet_address' => $dpt_wallet_address,
			'wd_company_wallet_address' => $dpt_company_wallet_address,
			'wd_status' => '0',
		);


		$dataReinvest = array(
			'dpt_user_id' => $userId,
			'dpt_username' => $dpt_username,
			'dpt_pkg_due_day' => $dpt_pkg_due_day,
			'dpt_package_name' => $dpt_package_name,
			'dpt_package_id ' => $dpt_package_id,
			'dpt_amount' => $dpt_amount,
			'dpt_pkg_interest_rate' => $dpt_pkg_interest_rate,
			'dpt_total_income' => round($dpt_total_income, 2),
			'dpt_wallet_id' => $dpt_wallet_id,
			'dpt_wallet_name' => $dpt_wallet_name,
			'dpt_txn_tracking_id' => $tracking_id,
			'dpt_company_wallet_address' => $dpt_company_wallet_address,
			'dpt_wallet_address' => $dpt_wallet_address,
			'dpt_status' => '1',
		);


		
	

		// insert data into the cashout table and
		// insert dataReinvest into deposit table (reinvestment)
		// update deposit table
		$response = $this->model->cashOutTxn($txnId, $userId, $data, $auto_reinvest, $dataReinvest);
		if ($response > 0) {
			// response return's success
			// update crypto table (eg. btc table) total amount in the tbl_user table


			// if wallet id = system_wallet// run a seperate code
			// 
			if ($dpt_wallet_id == "system_wallet") {
				$response2 = $this->model->amountUpdateUserTable($profit_or_txnAmount, $userId);
				if ($response2 > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Cash out was successful","","success")</script>');
					echo '<script>window.open("' . base_url('deposit_history') . '","_self")</script>';
					return;
				} else {
					echo '<script>Swal.fire("Cash out process not complete","Please contact admin","error")</script>';
					return;
				}
			} else {

				$response2 = $this->model->amountUpdate($profit_or_txnAmount, $userId, $tablename);
				if ($response2 > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Cash out was successful","","success")</script>');
					echo '<script>window.open("' . base_url('deposit_history') . '","_self")</script>';
					return;
				} else {
					echo '<script>Swal.fire("Cash out process not complete","Please contact admin","error")</script>';
					return;
				}
			}


			//$this->session->set_flashdata('form', '<script>Swal.fire("Cash out was successful","","success")</script>');
			//echo '<script>window.open("' . base_url('deposit_history') . '","_self")</script>';

		} else {
			echo '<script>Swal.fire("Cash out failed","Please try again","error")</script>';
		}
	}
}

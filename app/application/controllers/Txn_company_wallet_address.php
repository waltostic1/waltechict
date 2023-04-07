<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Txn_company_wallet_address extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}


	public function index()
	{

		$adminId = $this->session->userdata('adminId');
		$data['get_cryptocurrency'] = $this->admin_model->getCryptocurrency();

		$this->load->view('txn_company_wallet_address', $data);
	}


	// save wallet
	function save_wallet()
	{
		$adminId = $this->session->userdata('adminId');
		$cryptoId = $this->security->xss_clean($this->input->post('cryptoId'));
		$walletAddress = $this->security->xss_clean($this->input->post('walletAddress'));

		if ($walletAddress != "") {
			$queryResponse = $this->admin_model->saveWallet($walletAddress, $cryptoId, $adminId);
			if ($queryResponse > 0) {
				echo '<script>Swal.fire("Wallet address saved successfully","","success")</script>';
				echo "$walletAddress";
			} else {
				echo '<script>Swal.fire("Error","No changes were made.","error")</script>';
				echo "$walletAddress";
			}
		} else {
			echo '<script>Swal.fire("Input error!","No changes were made.","error")</script>';
		}
	}

}

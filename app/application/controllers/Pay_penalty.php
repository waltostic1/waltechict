<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pay_penalty extends CI_Controller
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
		$data['get_cryptocurrency'] = $this->model->getCryptocurrency();
		$data['get_user_info'] = $this->model->getUserInfo($userId);
		$data['fetch_penalty'] = $this->model->getPenalty($userId); 
		$this->load->view('pay_penalty', $data);
	}

	function pay_penalty(){
		$userId = $this->session->userdata('user_id');
		$wallet_name = $this->security->xss_clean($this->input->post('wallet_name'));
		$wallet_id = $this->security->xss_clean($this->input->post('wallet_id'));
		$pen_id = $this->security->xss_clean($this->input->post('pen_id'));
		$company_wallet_address= $this->security->xss_clean($this->input->post('company_wallet_address'));
		$user_wallet_address= $this->security->xss_clean($this->input->post('user_wallet_address'));
		// get wallet name and wallet id from cryptocurrency table using unique companys wallet address
		$response = $this->model->payPenalty($pen_id,$company_wallet_address,$user_wallet_address,$userId, $wallet_name, $wallet_id);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Penalty paid & notification has been sent to the support team","Please wait while your issue is been resolved","success")</script>');
			echo '<script>window.open("' . base_url('pay_penalty') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","This request must have been sent, if not please try again or reload the page","error")</script>';
		}
	}
	
}

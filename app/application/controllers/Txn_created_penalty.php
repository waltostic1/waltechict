<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_created_penalty extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_created_penalty'] = $this->admin_model->getCreatedPenalty(); 
		$this->load->view('txn_created_penalty', $data);
	}

	function delete(){
		$txnId = $this->security->xss_clean($this->input->post('txnId'));
		$UserId= $this->security->xss_clean($this->input->post('penaltyUserId'));
		$response = $this->admin_model->deletePenalty($txnId,$UserId);
		if ($response > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Penalty deleted successfully","","success")</script>');
			echo '<script>window.open("' . base_url('txn_created_penalty') . '","_self")</script>';
		} else {
			echo '<script>Swal.fire("Operation failed","Please try again or reload the page to see if it has taken effect","error")</script>';
		}
	}
	
}

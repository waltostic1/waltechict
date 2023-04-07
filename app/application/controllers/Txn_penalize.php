<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_penalize extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{		
		$this->load->view('txn_penalize');
	}


	// penalize function

	function penalize()
	{

		//note: receiver cagegory => specified user=1; all users=2; users that have made deposit=3; users that have not made deposit=4

		$amount = $this->security->xss_clean($this->input->post('amount'));
		$username = $this->security->xss_clean($this->input->post('username'));
		$comment=$this->security->xss_clean($this->input->post('comment'));

		// receiver 1 = a specific user
		if (!$username == "") {
			// check if the user has a pending  penalized order
			$chkPenalty=$this->admin_model->checkPenalty($username);
			if($chkPenalty->num_rows()>0){
				echo '<script>Swal.fire("User already has pending penalty order","","error")</script>';
				return;
			}
			// get user data
			$result = $this->admin_model->getUserData($username);
			if ($result->num_rows() > 0) {

				foreach ($result->result() as $row) {					
					$userId = $row->user_id;
				}
				
				$result2 = $this->admin_model->penalize($username, $userId, $amount, $comment);
				if ($result2 > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Penalty saved successfully","","success")</script>');
					echo '<script>window.open("' . base_url('txn_penalize') . '","_self")</script>';
					return;
				} else {
					echo '<script>Swal.fire("Penalty not saved","","error")</script>';
					return;
				}
			} else {
				echo '<script>Swal.fire("Invalid username","","error")</script>';
				return;
			}
		} else{
			echo '<script>Swal.fire("Invalid username","please check username","error")</script>';
			return;	
		}

	}
	// end of penalize function



}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contestant_link_processor extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->model('model');
	}


	public function index()
	{
      echo "<h1 class='text-light bg-success'>Voting has closed.</h1>";
      return;
      
		$userId = $this->session->userdata('user_id');
		$_group_name = $this->input->get('g_name'); // from tbl_group_list
		$_contestant_id = $this->input->get('m_id'); // from the contestants group table
		$_no_vote = $this->input->get('no_vote');
		if ($_no_vote != "" && $_no_vote > 0) {
			//echo 'Userid'.$userId.' MemberId:'.$_contestant_id.' Group name:'.$_group_name.' Unit:'.$_no_vote;
			// *** check if group table exists in tbl_group_list table
			$chkTbl = $this->model->chkTbl($_group_name);
			if ($chkTbl->num_rows() > 0) {
				//***chk if the sender|user has such unit in the tbl_vote_unit tale */
				$chkUnit = $this->model->chkUnit($userId, $_no_vote);
				if ($chkUnit->num_rows() > 0) {
					//*** debit sender|user */
					$debit = $this->model->debitSender($userId, $_no_vote);
					//*** update contestant */
					$updateCon = $this->model->updateContestant($_contestant_id, $_group_name, $_no_vote);
					//** update txn table */
					$updateTxn = $this->model->updateTxn($userId, $_no_vote, $_contestant_id, $_group_name);
					//*** if all queries are successful */
					if ($updateTxn > 0 && $updateCon > 0 && $debit > 0) {
						$this->session->set_flashdata('form', "<script>Swal.fire('Thanks for voting.','You can still vote again.', 'success')</script>");
						echo '<script>window.open("' . base_url('dashboard') . '","_self")</script>';
					} else {
						$this->session->set_flashdata('form', "<script>Swal.fire('Votes no successful', 'Please try again', 'error')</script>");
						echo '<script>window.open("' . base_url('dashboard') . '","_self")</script>';
					}
				} else {
					$this->session->set_flashdata('form', "<script>Swal.fire('Insufficient unit', 'Please top up unit', 'error')</script>");
					echo '<script>window.open("' . base_url('dashboard') . '","_self")</script>';
				}
			} else {
				$this->session->set_flashdata('form', "<script>Swal.fire('Invalid link or group name','Please try again','error')</script>");
				echo '<script>window.open("' . base_url('dashboard') . '","_self")</script>';
			}
		} else {
			if ($_group_name != '' && $_contestant_id != '') {

				$dataR = $this->model->getConUsername($_group_name, $_contestant_id);

				if ($dataR->num_rows() > 0) {
					// get the contestant username
					foreach($dataR->result() as $row){
						$conUserName=$row->username;
					}
					$this->session->set_userdata('_contestant_username_', $conUserName);
					$this->session->set_userdata('_contestant_id_', $_contestant_id);
					$this->session->set_userdata('_group_name_', $_group_name);
					$this->load->view('contestant_link_processor');
				} else {
					//redirect(base_url('dashboard'));
				}
			} else {
				$this->load->view('login');
			}
		}
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_bonus_history extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_user_with_bonus'] = $this->admin_model->getAllRefWithBonus2(); //  get all users with ref bonus without grouping
		$this->load->view('txn_bonus_history', $data);
	}
	
}

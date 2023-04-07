<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_view_ref_bonus extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_user_with_bonus'] = $this->admin_model->getAllRefWithBonus(); // get get get all users with ref bonus
		$this->load->view('txn_view_ref_bonus', $data);
	}
	
}

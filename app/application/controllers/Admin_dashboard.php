<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->model('admin_model');
	}


	public function index()
	{
	$adminId = $this->session->userdata('adminId');
		
	$this->load->view('admin_dashboard');	
	
	}

	
}

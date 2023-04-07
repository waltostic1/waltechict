<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Install extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('install_model');
	}


	public function index()
	{
		$this->load->view('install');
		$this->install_model->index();
	}

	
}

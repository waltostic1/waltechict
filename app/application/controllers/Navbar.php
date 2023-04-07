<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navbar extends CI_Controller
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
		$data['get_user_info'] = $this->model->getUserInfo($userId);

		$this->load->view('sidebar', $data);
		$this->load->view('navbar', $data);
	}
}

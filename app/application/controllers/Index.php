<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		//$this->load->model('index_model');
	}


	public function index()
	{	
		
	$this->load->view('index');	
	//echo "<script>window.open('".base_url('login')."','_self')</script>";
		
	}

	
}

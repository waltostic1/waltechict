<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error_500 extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
	}


	public function index()
	{		
	$this->load->view('error-500');	
		
	}

	
}

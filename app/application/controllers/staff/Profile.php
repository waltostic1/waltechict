<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __Construct(){
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('staff/model');
	}

	
	public function index()
	{
		$data['fetch_staff']=$this->model->getStaff();
		$this->load->view('staff/profile',$data);
	}

}
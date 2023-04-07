<!-- staff dashboard -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$s = $this->load->model('staff/model');
	}

	public function index()
	{

		$data='';

		$this->load->view('staff/dashboard', $data); // load the dashboard
		
	}

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

//include_once (dirname(__FILE__) . "/Edit_package_class.php");
//class Package extends Edit_package_class

class Txn_app_configuration extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_config'] = $this->admin_model->getConfig();// get config
		$this->load->view('txn_app_configuration',$data);
	}

		
	// save configuration email function
	function save_config()
	{			
      $this->form_validation->set_rules('configEmail', 'Email', 'trim|required|valid_email');
      if ($this->form_validation->run()) {
				$configEmail = $this->security->xss_clean($this->input->post('configEmail'));
				$reinvest = $this->security->xss_clean($this->input->post('reinvest'));
              	$configId = $this->security->xss_clean($this->input->post('configId'));

				
				$_save = $this->admin_model->saveConfigEmail($configEmail,$configId, $reinvest);
				if ($_save > 0) {
					 echo "<script>Swal.fire('saved successfully.','','success')</script>";					

				} else {
					echo "<script>Swal.fire('No changes were made','please try again','error')</script>";				
				}
      }else {
					echo "<script>Swal.fire('Invalid email','please try check and try again','error')</script>";				
				}
			
	}
	// end of save configuration email function



}

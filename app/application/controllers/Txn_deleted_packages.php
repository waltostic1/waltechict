<?php
defined('BASEPATH') or exit('No direct script access allowed');

//include_once (dirname(__FILE__) . "/Edit_package_class.php");
//class Package extends Edit_package_class

class Txn_deleted_packages extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_package'] = $this->admin_model->getDeletedPackage();// get package
		$this->load->view('txn_deleted_packages',$data);
	}


	// restore deleted package function
	function restore_package()
	{
		if ($this->input->post('postAction') == "true") {		
		
				$packageId = $this->security->xss_clean($this->input->post('packageId'));
				
				$adminId = $this->session->userdata('adminId');


				$pkg_restore = $this->admin_model->restoreDeletedPkg($packageId);
				if ($pkg_restore > 0) {
					$this->session->set_flashdata('form', "<script>Swal.fire('Package restored successfully.','','success')</script>");
					echo '<script>window.open("'.base_url('txn_deleted_packages').'","_self")</script>';

				} else {
					echo "<script>Swal.fire('Package not restored','please try again','error')</script>";				
				}
			
		} else {
			echo "<script>Swal.fire('Error','Invalid details','error')</script>";
		}
	}
	// end of delete package function

}

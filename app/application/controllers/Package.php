<?php
defined('BASEPATH') or exit('No direct script access allowed');

//include_once (dirname(__FILE__) . "/Edit_package_class.php");
//class Package extends Edit_package_class

class Package extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_package'] = $this->admin_model->getPackage();// get package
		$this->load->view('package',$data);
	}



	// add package function
	function add_package()
	{
		if ($this->input->post('postAction') == "true") {
			echo "";

			$this->form_validation->set_rules('packageName', 'package name', 'required|trim|is_unique[tbl_package.pkg_name]|max_length[50]');
			$this->form_validation->set_rules('minAmount', 'minimum amount', 'required|trim|numeric|greater_than[0]|is_unique[tbl_package.pkg_min_amount]|max_length[11]');
			$this->form_validation->set_rules('maxAmount', 'maximum amount', 'required|trim|numeric|greater_than[0]|is_unique[tbl_package.pkg_max_amount]|max_length[11]');
			$this->form_validation->set_rules('dueDay', 'maturity day', 'required|trim|numeric|greater_than[0]|max_length[5]');
			$this->form_validation->set_rules('percentage', 'percentage interest', 'required|trim|numeric|greater_than[0]|max_length[5]');


			if ($this->form_validation->run()) {
				$packageName = $this->security->xss_clean($this->input->post('packageName'));
				$minAmount = $this->security->xss_clean($this->input->post('minAmount'));
				$maxAmount = $this->security->xss_clean($this->input->post('maxAmount'));
				$dueDay = $this->security->xss_clean($this->input->post('dueDay'));
				$percentage = $this->security->xss_clean($this->input->post('percentage'));
				$adminId = $this->session->userdata('adminId');

				$data = array(
					'pkg_name ' => $packageName,
					'pkg_min_amount ' => $minAmount,
					'pkg_max_amount ' => $maxAmount,
					'pkg_due_day' => $dueDay,
					'pkg_percentage' => $percentage,
					'pkg_creator_id' => $adminId,
				);

				$pkg_add = $this->admin_model->addPkg($data);
				if ($pkg_add > 0) {
					$this->session->set_flashdata('form', "<script>Swal.fire('Package added successfully.','','success')</script>");
					echo '<script>window.open("'.base_url('package').'","_self")</script>';
		
?>
					<!-- <script>
						$(document).ready(function() {
							$("#processing").html("Package added successfully.");
							$("#add-package-form")[0].reset()// reset the form 
							$("#processing").addClass("");
							$("#processing").removeClass("text-danger");
												
							$("#package-name-error").html("");
							$("#min-amount-error").html("");
							$("#max-amount-error").html("");
							$("#due-day-error").html("");
							$("#percentage-error").html("");

						});
					</script> -->
				<?php
				} else {
					echo "<script>Swal.fire('Error in adding package','please try again','error')</script>";
				?>
					<script>
						$(document).ready(function() {
							$("#processing").html("Error in adding package! please try again.");
						});
					</script>
				<?php
				}
			} else {
				echo "<script>Swal.fire('Input error','please check form input and try again','error')</script>";

				?>
				<script>
					$(document).ready(function() {

						// set error reporting for various inputs

						var packageNameErr = "<?php echo form_error('packageName') ?>";
						var minAmountErr = "<?php echo form_error('minAmount') ?>";
						var maxAmountErr = "<?php echo form_error('maxAmount') ?>";
						var dueDayErr = "<?php echo form_error('dueDay') ?>";
						var percentageErr = "<?php echo form_error('percentage') ?>";
						if (packageNameErr == '<p>The package name field must contain a unique value.</p>') {
							packageNameErr = "<p> Package already exists please try another one.</p>";
						}
						if (minAmountErr == '<p>The minimum amount field must contain a unique value.</p>') {
							minAmountErr = "<p> This minimum value already exists please try another one.</p>";
						}

						if (maxAmountErr == '<p>The maximum amount field must contain a unique value.</p>') {
							maxAmountErr = "<p> This maximum value already exists please try another one.</p>";
						}

						$("#processing").html("Input error! please check form input and try again.");
						$("#processing").addClass("text-danger my-3");
						$("#package-name-error").html(packageNameErr);
						$("#min-amount-error").html(minAmountErr);
						$("#max-amount-error").html(maxAmountErr);
						$("#due-day-error").html(dueDayErr);
						$("#percentage-error").html(percentageErr);


					});
				</script>
<?php

			}
		} else {
			echo "<script>Swal.fire('Error','Invalid details','error')</script>";
		}
	}
	// end of add package function


}

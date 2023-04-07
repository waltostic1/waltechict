<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_info extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}


	public function index()
	{
		echo "<p>System info</p>";
	}

	function add_package()
	{
		if ($this->input->post('postAction') == "true") {
			echo "<p id='processing' class='text-info'>Processing...</p>";

			$this->form_validation->set_rules('packageName', 'package name', 'required|trim|is_unique[tbl_package.pkg_name]|max_length[50]');
			$this->form_validation->set_rules('minAmount', 'minimum amount', 'required|trim|numeric|is_unique[tbl_package.pkg_min_amount]|max_length[11]');
			$this->form_validation->set_rules('maxAmount', 'maximum amount', 'required|trim|numeric|is_unique[tbl_package.pkg_max_amount]|max_length[11]');
			$this->form_validation->set_rules('dueDay', 'maturity day', 'required|trim|numeric|max_length[5]');
			$this->form_validation->set_rules('percentage', 'percentage interest', 'required|trim|numeric|max_length[5]');


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
					echo "<script>Swal.fire('Success','Package added successfully','success')</script>";
?>
					<script>
						$(document).ready(function() {
							$("#processing").html("Package added successfully, you can still add another one.");
						});
					</script>
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
				echo "<script>Swal.fire('Error in input','please try again','error')</script>";
				?>
				<script>
					$(document).ready(function() {
						$("#processing").html("Error in input! please try again.");
					});
				</script>
<?php
			}
		} else {
			echo "<script>Swal.fire('Error','Invalid details','error')</script>";
		}
	}
}

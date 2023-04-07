<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_staff extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin/model');
	}


	public function index()
	{


		$data['fetch_staff'] = $this->model->getStaff();
		$this->load->view('admin/view_staff', $data);
	}

	function delete_staff()
	{

		$staffId = $this->input->post('staffId');
		$output = $this->model->deleteStaff($staffId);
		if ($output > 0) {
			echo "<script>alert('Staff deleted successfully'); window.open('view_staff','_self')</script>";
		}
	}


	// get staff data
	function getStaffData()
	{
		if (!null == $this->input->post('staff_id')) {

			$staff_id = $this->input->post('staff_id');
			$resultQ = $this->model->getStaffData($staff_id);
			if ($resultQ->num_rows() > 0) {
				foreach ($resultQ->result() as $row) {
					$userId = $row->user_id;
					$sn = $row->sn;
					$fullName = $row->full_name;
					$userName = $row->user_name;
					$email = $row->email;
					$sex = $row->sex;
					$phone = $row->phone_no;
				}

?>
				<style>
					input,
					select {
						margin-right: 10px;
						border-radius: 4px;
						border: solid 2px gray;
						background-color: seashell;
					}
				</style>
				<p class="update-staff-response"></p>
				<form id="update-staff-form" method="post" name="staffUpdateForm" action="#">
					<input type="hidden" name="csrftoken" value="ea49375f43c7e6a59c77df1e4de562b3f1350124eeb70e5d5124e4ce3b5251c2b4d12e9aaf2a3ddc618c178c8dc4620b">

					<input type="hidden" readonly name="staffSn" value="<?php echo $sn ?>">


					<div class="container text-info col-sm-12 col-md-12 p-2">

						<div class="form-group ">
							<div class="col-12 container-fluid  " style="padding:10px;">
								<div class="row">
									<div class="col-12 col-md-4 text-md-right">
										<label>Full name:</label>
									</div>
									<div class="col-12 col-md-8 ">
										<input class="form-control" type="text" required name="fullName" value="<?php echo $fullName ?>">
									</div>
								</div>
							</div>
						</div>


						<div class="form-group ">
							<div class="col-12 container-fluid  " style="padding:10px;">
								<div class="row">
									<div class="col-12 col-md-4 text-md-right">
										<label>Username:</label>
									</div>
									<div class="col-12 col-md-8 ">
										<input class="form-control" type="text" required name="username" value="<?php echo $userName ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<div class="col-12 container-fluid  " style="padding:10px;">
								<div class="row">
									<div class="col-12 col-md-4 text-md-right">
										<label>Email:</label>
									</div>
									<div class="col-12 col-md-8 ">
										<input class="form-control" type="email" required name="email" value="<?php echo $email ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<div class="col-12 container-fluid  " style="padding:10px;">
								<div class="row">
									<div class="col-12 col-md-4 text-md-right">
										<label>Password:</label>
									</div>
									<div class="col-12 col-md-8 ">
										<input class="form-control" type="password" required name="password">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<div class="col-12 container-fluid  " style="padding:10px;">
								<div class="row">
									<div class="col-12 col-md-4 text-md-right">
										<label>Sex:</label>
									</div>
									<div class="col-12 col-md-8 ">
										<select required name="sex" id="sex" class="form-control">
											<?php
											if ($sex == 'Male') {
												echo "<option value='Male'>Male</option><option value='Female'>Female</option>";
											} else if ($sex == 'Female') {
												echo "<option value='Female'>Female</option> <option value='Male'>Male</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<div class="col-12 container-fluid  " style="padding:10px;">
								<div class="row">
									<div class="col-12 col-md-4 text-md-right">
										<label>Phone:</label>
									</div>
									<div class="col-12 col-md-8 ">
										<input class="form-control" type="text" required name="phone" minlength="11" maxlength="11" value="<?php echo $phone ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group text-right">

							<input type="submit" value="Update" class="btn btn-outline-primary float-right" id="btn-update-staff">

						</div>

					</div>


				</form>
				<p class="update-staff-response"></p>

				<script>
					$(document).ready(function() {
						$('#update-staff-form').on('submit', function(e) {
							e.preventDefault();
							$.ajax({
								url: "<?php echo base_url('admin/view_staff/doUpdate'); ?>",
								method: "POST",
								data: new FormData(this),
								contentType: false,
								cache: false,
								processData: false,
								success: function(data) {
									$('.update-staff-response').html(data);
								}
							});
						});
					});
				</script>



<?php

			} else {
				echo 'no result found';
			}
		} else {
			echo 'Error!';
		}
	}




	function doUpdate()
	{

		if (!null == $this->input->post('csrftoken') && !null == $this->input->post('staffSn')) {
			$staff_sn = $this->input->post('staffSn');

			$data = array(
				'full_name' => $this->security->xss_clean($this->input->post('fullName')),
				'user_name' => $this->security->xss_clean($this->input->post('username')),
				'email'	   =>  $this->security->xss_clean($this->input->post('email')),
				'phone_no'	   =>  $this->security->xss_clean($this->input->post('phone')),
				'passwrd' => md5(md5($this->input->post('password'))),
				'sex' => $this->security->xss_clean($this->input->post('sex')),
			);

			$resultQ = $this->model->updateStaff($data, $staff_sn);
			if ($resultQ == 1) {
				echo "<p class='text-success font-weight-bold'>Record updated successfully</p>";
				echo '<script>alert("Record updated successfully"); window.open("view_staff","_self")</script>';
			} else {
				echo "<p class='text-danger font-weight-bold'>Record update failed</p>";
				echo "<p class='text-danger'>Tips: email address and username must be unique; Check your network connection; contact your service provider </p>";
				echo '<script>alert("Record updated failed")</script>';
			}
		} else {
			echo "No admin found, please reload your web browser ";
			echo '<p><a href="" class=" page-link">Reload</a></p>';
			echo '<script>alert("No admin found, please reload your web browser")</script>';
		}
	}
}

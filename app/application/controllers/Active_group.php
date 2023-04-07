<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Active_group extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('model');
	}


	public function index()
	{
		// get user id
		$userId = $this->session->userdata('user_id');

		// get data from url variables
		// create session active group id for the active group once a user clicks on a group
		$activeGroupId = $this->input->get('group_id');
		$activeGroupName = $this->input->get('group_name');
		if ($activeGroupId != "" && $activeGroupName != "") {
			//if ($activeGroupId != "") {
			$this->session->set_userdata('active_group_id', $activeGroupId);
			$this->session->set_userdata('active_group_name', $activeGroupName);
		}

		$newActiveGroupId = "";
		$newActiveGroupName = "";




		// check if the sessions id is null & redirect to the admin url
		$newActiveGroupId = $this->session->userdata('active_group_id');
		$newActiveGroupName = $this->session->userdata('active_group_name');
		$newActiveGroupId == "" ? redirect(base_url('groups')) : $newActiveGroupId;
		$newActiveGroupName == "" ? redirect(base_url('groups')) : $newActiveGroupName;

		//$data['fetch_group_members']=$this->model->getGroupMembers($newActiveGroupId);
		$data['fetch_group_data'] = $this->model->getGroupDataByGroupId($newActiveGroupId);

		// fetch members data from the group table
		$data['fetch_members_data'] = $this->model->getMemberData($newActiveGroupName);

		//get contestants data
		$data['fetch_contestants_data'] = $this->model->getContestantsDataByGroupName($newActiveGroupName);

		// get all pending and dissapproved contestants
		$data['contestant_request'] = $this->model->getPendingContestants($newActiveGroupName);

		// get the total numbers of contestants with total votes
		$data['get_total_contestants_with_total_votes'] = $this->model->getTotalContestantWithTotalVotes($newActiveGroupName);

		// check if the user is the admin of the group
		$data['check_membership_type'] = $this->model->checkMembershipType($newActiveGroupName, $userId);

		// check if the user is a contestant in the group
		$data['check_contestant_status'] = $this->model->checkContestantStatus($newActiveGroupName, $userId);

		$this->load->view('active_group', $data);
	}



	function save_group_profile()
	{
		$this->do_upload();
	}





	// upload img configuration
	public function do_upload()
	{
		if (isset($_FILES['groupLogo']['name']) && !null == ($_FILES['groupLogo']['name'])) {

			$config['upload_path']          = './img/group_photo/';
			$config['allowed_types']        = 'gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG';
			$config['max_size']             = 3000;
			$config['file_name']			= rand() . rand() . date('dmYhs') . '.jpg';
			$config['file_size']     		= 19.2;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('groupLogo')) {
				$error =  $this->upload->display_errors('<p>', '</p>');
				$error = str_replace('<p>', '', $error);
				$error = str_replace('</p>', '', $error);

				$this->session->set_flashdata('form', "<script>Swal.fire('$error','Please check the image and try again','error')</script>");
				//echo '<script>window.open("' . base_url('group') . '","_self")</script>';
				$this->index();
			} else {
				$dbImg = 'group_photo';

				// call the process image function()
				$this->process_image($config, $dbImg);
			}
		} else {

			$this->session->set_flashdata('form', "<script>Swal.fire('Error','Please select an image and try again.','error')</script>");
			//echo '<script>window.open("' . base_url('group') . '","_self")</script>';
			$this->index();
		}
	}


	// image upload process
	function process_image($config, $dbImg)
	{
		$data = $this->upload->data();
		//echo '<img src="' . base_url() . 'img/group_photo/' . $data["file_name"] . '" style="max-width:50%; height:auto"/>';
		if ($dbImg == 'group_photo') {
			$userId = $this->session->userdata('user_id');
			$previous_group_photo = $this->input->post('previous_group_photo');
			$group_description = $this->security->xss_clean($this->input->post('group_description'));
			$groupId = $this->session->userdata('active_group_id');

			$imgName = $config['file_name'];
			$dataArray = array(
				'gl_description' => $group_description,
				'gl_logo' => $imgName,
			);



			// save group data into the database
			$resultQ = $this->model->saveGroupPhoto($dataArray, $groupId);

			if ($resultQ > 0) {

				$pathToDirect = getcwd();

				if (!$previous_group_photo == null) {
					unlink($pathToDirect . '/img/group_photo/' . $previous_group_photo . '');
				}


				$this->session->set_flashdata('form', "<script>Swal.fire('group logo saved successfully','Login is required','success')</script>");
				echo '<script>window.open("' . base_url('active_group') . '","_self")</script>';
			}
		} else {

			$this->session->set_flashdata('form', "<script>Swal.fire('Error','group logo was not saved','error')</script>");
			redirect(base_url('active_group'));
		}
	}

	// end of upload img


	// contest 
	function contest()
	{


		// check if the user has updated his profile
		$user_photo = $this->session->userdata('user_photo');
		$user_email = $this->session->userdata('user_sex');
		$user_phone = $this->session->userdata('user_phone');

		if ($user_email == "" || $user_phone == "" || $user_photo == "") {
			$this->session->set_flashdata('form', "<script>Swal.fire('Please update your profile','','info')</script>");
			echo '<script>window.open("' . base_url('profile') . '","_self")</script>';
		} else {
			$group_name = $this->session->userdata('active_group_name');
			$user_id = $this->session->userdata('user_id');


			$dataResult1 = $this->model->checkContest($user_id, $group_name);


			if (!$dataResult1->num_rows() > 0) {
				$dataResult2 = $this->model->updateContest($user_id, $group_name);
				if ($dataResult2 > 0) {
					$this->session->set_flashdata('form', "<script>Swal.fire('Request submitted','wait for approval by the admin','success')</script>");
					echo '<script>window.open("' . base_url('active_group') . '","_self")</script>';
				} else {
					$this->session->set_flashdata('form', "<script>Swal.fire('Error','Request not sent','error')</script>");
					echo '<script>window.open("' . base_url('active_group') . '","_self")</script>';
				}
			} else {
				$this->session->set_flashdata('form', "<script>Swal.fire('Error','Request already sent','error')</script>");
				echo '<script>window.open("' . base_url('active_group') . '","_self")</script>';
			}
		}
	}
	// end of contest

	// publish votes
	function publish_votes()
	{
		$groupName = $this->security->xss_clean($this->input->post('groupName'));
		$user_id = $this->session->userdata('user_id');
		if ($groupName != "" && $groupName != null) {
			// update tbl_group_list table and set gl_publish_point to 1 (1=yes, 0=no)
			$data = array(
				'gl_publish_point' => '1'
			);
			$resultQ = $this->model->publish_votes($data, $groupName, $user_id);
			if ($resultQ > 0) {
				$this->session->set_flashdata('form', "<script>Swal.fire('Votes published successfully','Group members can now view points','success')</script>");
				echo '<script>window.open("' . base_url('active_group') . '","_self")</script>';
			} else {
				echo "<script>Swal.fire('Invalid command_0','','error')</script>";
			}
		} else {
			echo "<script>Swal.fire('Invalid command','','error')</script>";
		}
	}
	// end of publish votes


	// hide votes
	function hide_votes()
	{
		$groupName = $this->security->xss_clean($this->input->post('groupName'));
		$user_id = $this->session->userdata('user_id');
		if ($groupName != "" && $groupName != null) {
			// update tbl_group_list table and set gl_publish_point to 1 (1=yes, 0=no)
			$data = array(
				'gl_publish_point' => '0'
			);
			$resultQ = $this->model->hide_votes($data, $groupName, $user_id);
			if ($resultQ > 0) {
				$this->session->set_flashdata('form', "<script>Swal.fire('Votes hidden successfully','Group members can no longer view points','success')</script>");
				echo '<script>window.open("' . base_url('active_group') . '","_self")</script>';
			} else {
				echo "<script>Swal.fire('Invalid command','','error')</script>";
			}
		} else {
			echo "<script>Swal.fire('Invalid command','','error')</script>";
		}
	}
	// end of hide votes
}

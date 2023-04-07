<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_notification extends CI_Controller
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
		$data['fetch_members_data'] = $this->model->getMemberDataByGroupName($newActiveGroupName);

		//get prospective contestants data
		$data['fetch_contestants_data'] = $this->model->getContestants($newActiveGroupName);

			//get disapproved prospective contestants data
			$data['fetch_disapproved_contestants_data'] = $this->model->getDisapprovedContestants($newActiveGroupName);

			// check if the user is the admin of the group
		$data['check_membership_type']=$this->model->checkMembershipType($newActiveGroupName,$userId);

		// get all pending and dissapproved contestants
	$data['contestant_request']=$this->model->getPendingContestants($newActiveGroupName);

		$this->load->view('group_notification', $data);
	}





	// approve contestants 
	function approve_contestant()
	{
		$group_name = $this->session->userdata('active_group_name');
		$memberId = $this->security->xss_clean($this->input->post('memberId'));

		$dataResult = $this->model->approveContestant($memberId, $group_name);

		if ($dataResult > 0) {
			echo $this->session->set_flashdata('form', "<script>Swal.fire('Approved','','success')</script>");
			?>
			
			<p>Operation was successfull. </p>
		<a class="btn btn-success" href="<?php echo base_url('group_notification') ?>">Continue</a>
		
			<?php
		} else {
			echo $this->session->set_flashdata('form', "<script>Swal.fire('Error','Approval not successful','error')</script>");
			?>			
			<p>Operation failed. </p>
		<a class="btn btn-danger" href="<?php echo base_url('group_notification') ?>">Continue</a>
		
			<?php
		}
	}
	// end of approve contestants



		// disapprove contestants 
		function disapprove_contestant()
		{
			$group_name = $this->session->userdata('active_group_name');
			$memberId = $this->security->xss_clean($this->input->post('memberId'));
	
			$dataResult = $this->model->disapproveContestant($memberId, $group_name);
	
			if ($dataResult > 0) {
				echo $this->session->set_flashdata('form', "<script>Swal.fire('Disapproved','','success')</script>");
				?>
				
				<p>Operation was successfull. </p>
			<a class="btn btn-success" href="<?php echo base_url('group_notification') ?>">Continue</a>
			
				<?php
			} else {
				echo $this->session->set_flashdata('form', "<script>Swal.fire('Error','action not successful','error')</script>");
				?>			
				<p>Operation failed. </p>
			<a class="btn btn-danger" href="<?php echo base_url('group_notification') ?>">Continue</a>
			
				<?php
			}
		}
		// end of disapprove contestants


}

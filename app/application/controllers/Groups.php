<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Groups extends CI_Controller
{
	public function __Construct()
	{

		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('model');
	}


	public function index()
	{
      
		// get data from url variables
		// create session for group id and group name
		$groupId = $this->input->get('g_id');
		$groupName = $this->input->get('g_n');

		if ($groupId != "" && $groupName != "") {			
			$this->session->set_userdata('_g_id_', $groupId);
			$this->session->set_userdata('_g_n_', $groupName);
		}

		// check if the user is already logged in or not
		$this->load->view('login_check');

      

		// get data from url variables

		$urlGroupName = $this->input->get('g_n');
		if($urlGroupName !=""){
			$this->joinGroupByUrl();
		}




		$userId = $this->session->userdata('user_id');

		// get groups the a user is a member
		$data['fetch_group'] = $this->model->getGroup($userId);

		//$data['fetch_group']=$this->model->getGroupData($tableName);
		//$data['ss'] = $this->getGroup();

		$this->load->view('groups', $data);
	}

	function getGroup()
	{
		$userId = $this->session->userdata('user_id');

		// get groups name| tables name
		$data = $this->model->getGroup($userId);
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$tableName = $row->ug_gl_name;
				$groupName = str_replace('_', ' ', $tableName);


				$groupId = "";
				$totalMembers = '0';
				$groupLogo = "";
				// get tableName data from the tbl_group_list table 
				$data2 = $this->model->getTableData($tableName);
				if ($data2->num_rows() > 0) {
					foreach ($data2->result() as $row2) {
						$groupId = $row2->gl_id;
						$groupLogo = $row2->gl_logo;
					}
				}

				// get total number of members in the group from
				$data3 = $this->model->getGroupData($tableName);
				if ($data3->num_rows() > 0) {
					foreach ($data3->result() as $row3) {
						$totalMembers++;
					}
				}


?>
				<div class="col-12 grid-margin stretch-card">
					
					<div class="card">
						<a class="text-decoration-none" href="<?php echo base_url('active_group?group_id=' . $groupId . '& group_name=' . $tableName) ?>">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-12">
										<div class="d-flex align-items-center align-self-start">
											<span><?php //echo $groupId 
													?></span> <img src="img/group_photo/<?php echo $groupLogo ?>" alt="" class="rounded-circle profile-pic" width="50" height="50">
											<p class="mb-0 text-light d-flex col-9 col-lg-10 mr-lg-3"><?php echo $groupName ?></p>
											<label class="text-light mb-0  text-right badge bg-primary "><?php echo  $totalMembers ?></label>
										</div>
									</div>


								</div>

							</div>
						</a>

					</div>
				</div>


<?php


			}
		}
	}




	function createGroup()
	{
		if ($this->input->post('createGroup') != null) {

			$groupName = $this->security->xss_clean(trim(str_replace(' ', '_', $this->input->post('groupName'))));
			$groupDescription = $this->security->xss_clean(trim($this->input->post('description')));
			$userId = $this->session->userdata('user_id');
			$creatorId = $userId;

			$this->form_validation->set_rules('groupName', 'group name', 'required|is_unique[tbl_group_list.gl_group_name]|max_length[50]');
			$this->form_validation->set_rules('description', 'group description', 'required|max_length[255]');


			if ($this->form_validation->run()) {

				// data to insert into the user avtive group table
				$insertActiveGroupData = array(
					'ug_gl_name'	   =>  $groupName,
					'ug_user_id' => $creatorId,
				);


				// data to insert into the group list table
				$insertGroupData = array(
					'gl_group_name'	   =>  $groupName,
					'gl_description' => $groupDescription,
					'gl_creator_id' => $creatorId,
					'gl_logo' => '',
					'gl_publish_point' => '0',
					'gl_link' => md5($creatorId . rand()),
				);

				//data to add admin into the newly created table (group's table)
				$insertAdminData = array(
					'g_user_id'	   =>  $userId,
					'g_contestant_status' => '1',
					'g_membership_status' => '1',
					'g_membership_type' => 'admin',
					'g_vote_point' => '0',
				);

				$queryResponse = $this->model->createGroup($insertActiveGroupData, $insertGroupData, $insertAdminData, $groupName);

				if ($queryResponse > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Group created successfully","","success")</script>');
					redirect(base_url('groups'));
				} else {
					$this->index();
				}
			} else {
				$this->session->set_flashdata('form', '<script>Swal.fire("Error","Groupd not created, please check form and try again.","error")</script>');

				$this->index();
			}
		} else {
			redirect(base_url('groups#newgroupmodal'));
		}
	}

function joinGroup(){
	$groupLink=$this->input->post('groupLink');
	redirect($groupLink);
	echo "<script>window.open('$groupLink','_self')</script>";
}

// join group based on submitted url (ie when a user visits the url)
function joinGroupByUrl(){
	$urlGroupName = $this->input->get('g_n');
	if ($urlGroupName != "") {
		// get user data from login sessions
		$user_id = $this->session->userdata('user_id');

		// data to insert into the groups table
		$userData = array(
			'g_user_id' => $user_id,
			'g_membership_status' => '1',
			'g_membership_type' => 'member',
			'g_vote_point' => '0',
		);

		// data to insert into the user avtive group table
		$activeGroupData = array(
			'ug_gl_name'	   =>  $urlGroupName,
			'ug_user_id' => $user_id,
		);


		// check if the user is already a member for the group
		$check = $this->model->checkUser($user_id, $urlGroupName);
		if ($check->num_rows() > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Already a member","","info")</script>');
          
          
          $this->session->set_userdata('_g_id_','');// it is coming from the dashboard
			$this->session->set_userdata('_g_n_','');// it is coming from the dashboard
          
			redirect(base_url('groups'));
         
          
		} else {

			// add user data to the groups table
			$returnQuery1 = $this->model->addUserDataToGroup($userData, $urlGroupName);

			if ($returnQuery1 > 0) {

				// add user data to the user active group table tbl_user_active_group
				$returnQuery2 = $this->model->addUserDataToUserActiveGroup($activeGroupData);
				if ($returnQuery2 > 0) {
					$this->session->set_flashdata('form', '<script>Swal.fire("Success"," You are now a member of ' . $urlGroupName . '","success")</script>');
					redirect(base_url('groups'));
				} else {
					$this->session->set_flashdata('form', '<script>Swal.fire("Error","Join group action not successful please try again.","error")</script>');
					$this->index();
				}
			} else {
				$this->session->set_flashdata('form', '<script>Swal.fire("Join group error!","","error")</script>');
				$this->index();
			}
		}
	}
}

}

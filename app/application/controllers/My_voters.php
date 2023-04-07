<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My_voters extends CI_Controller
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
      if($userId==''){
        redirect(base_url('login'));
      }



		// check if the sessions id is null & redirect to the admin url
		$newActiveGroupId = $this->session->userdata('active_group_id');
		$newActiveGroupName = $this->session->userdata('active_group_name');
		$newActiveGroupId == "" ? redirect(base_url('groups')) : $newActiveGroupId;
		$newActiveGroupName == "" ? redirect(base_url('groups')) : $newActiveGroupName;


		// check if the user is a contestant in the group
		$data['get_my_voters'] = $this->model->getMyVoters($newActiveGroupName, $userId, $newActiveGroupId);

		$this->load->view('my_voters', $data);
	}

	
}

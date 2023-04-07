<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_staff extends CI_Controller {
	public function __Construct(){
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin/model');
		

	}

	
	public function index()
	{
		
		$this->load->view('admin/add_staff');
	}

	function registrationSuccess(){
		?>
		<h1 style="text-align: center; color:seagreen; padding:10px" class="text-center text-success p-4">Staff added successfully</h1>
		<h2 style="text-align: center; padding:10px">
			<a style="background-color:blue; padding:10px; color:white; margin-right: 6px;"  class="btn btn-primary" href="<?php echo base_url('admin/add_staff') ?>">Add another staff</a>
		<a style="background-color:blue; padding:10px; color:white; margin-left:6px"  class="btn btn-primary" href="<?php echo base_url('admin/dashboard') ?>">Dashboard</a>
	</2>
		
		<?php
		
	}

	function process(){
		if($this->input->post('registerAccount')!=null){
			
			$this->form_validation->set_rules('fullName', 'full name', 'required|trim|max_length[200]');
			$this->form_validation->set_rules('userId', 'user id', 'required|trim|is_unique[staff.user_id]');
			$this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[staff.user_name]|max_length[50]');
			$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[staff.email]|max_length[100]');			
			$this->form_validation->set_rules('phoneNumber', 'phone number', 'required|trim|is_numeric|min_length[11]|max_length[11]');
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('reEnterPassword', 're-enter password', 'required|matches[password]');
			$this->form_validation->set_rules('sex', 'sex', 'required|trim');

			/*$this->form_validation->set_rules('accountName', 'account name', 'required|trim');			
			$this->form_validation->set_rules('bankName', 'bank name', 'required|trim');			
			$this->form_validation->set_rules('accountNumber', 'account number', 'required|trim|is_numeric|min_length[10]|max_length[10]');			
			$this->form_validation->set_rules('accountType', 'account type', 'required|trim');
			$this->form_validation->set_rules('state', 'state', 'required|trim|max_length[50]');
			$this->form_validation->set_rules('country', 'country', 'required|trim|max_length[50]');
			$this->form_validation->set_rules('referralId', 'referral id', 'required|trim|max_length[50]');

			*/
			if ($this->form_validation->run()) {

				$data = array(
					//'user_id' => $this->security->xss_clean($this->input->post('userId')),
					'user_id' => $this->security->xss_clean(preg_replace('/\s+/', '_',$this->input->post('username'))),
					'full_name' => $this->security->xss_clean($this->input->post('fullName')),
					'user_name' => $this->security->xss_clean($this->input->post('username')),
					'email'	   =>  $this->security->xss_clean($this->input->post('email')),
					'phone_no'	   =>  $this->security->xss_clean($this->input->post('phoneNumber')),
					'passwrd' => md5(md5($this->input->post('password'))),
					'sex' => $this->security->xss_clean($this->input->post('sex'))
					/*'bank_name' => $this->security->xss_clean($this->input->post('bankName')),
					'acc_name' => $this->security->xss_clean($this->input->post('accountName')),
					'acc_type' => $this->security->xss_clean($this->input->post('accountType')),
					'acc_no' => $this->security->xss_clean($this->input->post('accountNumber')),
					'ref_id' => $this->security->xss_clean($this->input->post('referralId')),
					'email_v_link'=> md5(rand()),
					'state'	   =>  $this->security->xss_clean($this->input->post('state')),
					'country'	   =>  $this->security->xss_clean($this->input->post('country')),
					'is_email_verified '=>'yes',
					'login_key '=>md5(rand()),
					'status'=>'1'
					*/
				);

				
				$id = $this->model->addStaff($data);
				
				if($id>0){				
					$this->registrationSuccess();
				}else{
					$this->index();
				}
			}else{
				echo "";
				$this->index();
			}
		
	}else{
		redirect('add_staff');
	}
}
}
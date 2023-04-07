<!-- staff set_question -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Set_question extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$s = $this->load->model('staff/model');
	}

	public function index()
	{
		// set sessions
		// academic session and term
		$this->session->set_userdata('qTerm', '1st_term');
		$this->session->set_userdata('qAcademicSession', '2021/2022');

		// get subjects
		// get classes
		$data['fetch_subjects'] = $this->model->get_subjects();
		$data['fetch_classes'] = $this->model->get_classes();
		$data['fetch_q1'] = $this->getQ1();




		//var_dump($a);
		//die();
		$this->load->view('staff/set_question', $data); // load the set_question
		//$a=$this->getQ1();	
	}

	function set_class_subject()
	{

		$subjectid = $this->input->post('subjectId');
		$qClass = $this->input->post('qClass');
		// get subject's name
		$data = $this->model->get_subject($subjectid);
		foreach ($data->result() as $row) {
			$subject = $row->name;
		}
		if (!null == $subject) {
			$this->session->set_userdata('subjectId', $subjectid);
			$this->session->set_userdata('subjectName', $subject);
			$this->session->set_userdata('qClass', $qClass);
		}

		echo "<script>alert('Success');window.open('" . base_url('staff/set_question') . "','_self');</script>";
	}


	// get last question based on subject, class and term and academic session;
	// sId= subject id, c=class, t=term, a=academic session
	function getQ1()
	{
		$qNo = "";
		$newNo = 0;
		$sId = $this->session->userdata('subjectId');
		$c = $this->session->userdata('qClass');
		$t = $this->session->userdata('qTerm');
		$a = $this->session->userdata('qAcademicSession');
		$data = $this->model->getQ1($sId, $c, $t, $a);
		foreach ($data->result() as $row1) {
			$newNo++;
			$qNo = $row1->question_no;
		}
		$this->session->set_userdata('newQNo', $newNo = $newNo + 1);
		// if(!null==$qNo){
		// 	$newNo=$newNo+1;
		// 	echo "<script>alert('$newNo+1')</script>";
		// }else{
		// 	$newNo=$newNo+1;
		// 	echo "<script>alert($newNo)</script>";
		// }
	}




	// update question

	function update_question()
	{

		// get subject id and subject name
		// check if empty

		$session_subjectId = $this->security->xss_clean($this->session->userdata('subjectId'));
		$session_subjectName = $this->security->xss_clean($this->session->userdata('subjectName'));
		if (!null == $session_subjectName || !null == $session_subjectId) {


			if ($this->input->post('csrftoken') != null) {


				$this->form_validation->set_rules('questionId', 'question id', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('question', 'question', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionA', 'option A', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionB', 'option B', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionC', 'option C', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionD', 'option D', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionE', 'option E', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('answer', 'answer', 'trim|required|max_length[2]');
				$this->form_validation->set_rules('mark', 'mark', 'trim|required|max_length[5]');


				if ($this->form_validation->run()) {

					$staff_id = $this->security->xss_clean($this->session->userdata('staff_id'));
					$session_subjectId = $this->security->xss_clean($this->session->userdata('subjectId'));
					$session_subjectName = $this->security->xss_clean($this->session->userdata('subjectName'));
					$session_qClass = $this->security->xss_clean($this->session->userdata('qClass'));
					$session_term = $this->security->xss_clean($this->session->userdata('qTerm'));
					$session_academic_session = $this->security->xss_clean($this->session->userdata('qAcademicSession'));

					$qId = $this->security->xss_clean($this->input->post('questionId'));
					$question = $this->security->xss_clean($this->input->post('question'));
					$optA = $this->security->xss_clean($this->input->post('optionA'));
					$optB = $this->security->xss_clean($this->input->post('optionB'));
					$optC = $this->security->xss_clean($this->input->post('optionC'));
					$optD = $this->security->xss_clean($this->input->post('optionD'));
					$optE = $this->security->xss_clean($this->input->post('optionE'));
					$answer = $this->security->xss_clean($this->input->post('answer'));
					$mark = $this->security->xss_clean($this->input->post('mark'));

					$data = array(
						'staff_id' => $staff_id,
						'subject_id' => $session_subjectId,
						'subject_name' => $session_subjectName,
						'class' => $session_qClass,
						'term' => $session_term,
						'academic_session' => $session_academic_session,
						'question' => $question,
						'opt_a' => $optA,
						'opt_b' => $optB,
						'opt_c' => $optC,
						'opt_d' => $optD,
						'opt_e' => $optE,
						'mark' => $mark,
						'answer' => $answer,
					);

					$dataArray = array(
						'id'=>$qId,
						'staff_id' => $staff_id,
						'subject_id' => $session_subjectId,
						'subject_id' => $session_subjectId,
						'subject_name' => $session_subjectName,
						'class' => $session_qClass,
						'term' => $session_term,
						'academic_session' => $session_academic_session,
					);


					$returnD = $this->model->updateQ($data, $dataArray);
					if ($returnD > 0) {
						echo "<script>alert('$returnD Record updated successfully');window.open('" . base_url('staff/set_question') . "','_self');</script>";
					} else {
						echo '<script>alert("Sorry no record was updated \r\rThe question\'s id might not be found, \rUpdate right denied.\r\rPlease check subject and class then try again");</script>';
					}
				} else {
					echo "<script>alert('Invalid request, please contact your vendor');window.open('" . base_url('staff/set_question') . "','_self');</script>";
				}
			} else {
				//redirect(base_url('staff/set_question'));
			}
		} else {
			echo "<script>alert('No subject found, please set subject');</script>";
			
			//echo "<script>alert('No subject found please set subject');window.open('" . base_url('staff/set_question') . "','_self');</script>";
		}
	}

	// end of update question






	// set question
	function set_question()
	{

		// get subject id and subject name
		// check if empty

		$session_subjectId = $this->security->xss_clean($this->session->userdata('subjectId'));
		$session_subjectName = $this->security->xss_clean($this->session->userdata('subjectName'));
		if (!null == $session_subjectName || !null == $session_subjectId) {

			if ($this->input->post('csrftoken') != null) {

				$this->form_validation->set_rules('question', 'question', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionA', 'option A', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionB', 'option B', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionC', 'option C', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionD', 'option D', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('optionE', 'option E', 'trim|required|max_length[250]');
				$this->form_validation->set_rules('answer', 'answer', 'trim|required|max_length[2]');
				$this->form_validation->set_rules('mark', 'mark', 'trim|required|max_length[5]');


				if ($this->form_validation->run()) {

					$staff_id = $this->security->xss_clean($this->session->userdata('staff_id'));
					$qNo = $this->security->xss_clean($this->session->userdata('newQNo'));
					$session_subjectId = $this->security->xss_clean($this->session->userdata('subjectId'));
					$session_subjectName = $this->security->xss_clean($this->session->userdata('subjectName'));
					$session_qClass = $this->security->xss_clean($this->session->userdata('qClass'));
					$session_term = $this->security->xss_clean($this->session->userdata('qTerm'));
					$session_academic_session = $this->security->xss_clean($this->session->userdata('qAcademicSession'));

					$question = $this->security->xss_clean($this->input->post('question'));
					$optA = $this->security->xss_clean($this->input->post('optionA'));
					$optB = $this->security->xss_clean($this->input->post('optionB'));
					$optC = $this->security->xss_clean($this->input->post('optionC'));
					$optD = $this->security->xss_clean($this->input->post('optionD'));
					$optE = $this->security->xss_clean($this->input->post('optionE'));
					$answer = $this->security->xss_clean($this->input->post('answer'));
					$mark = $this->security->xss_clean($this->input->post('mark'));

					$data = array(
						'staff_id' => $staff_id,
						'question_no' => $qNo,
						'subject_id' => $session_subjectId,
						'subject_name' => $session_subjectName,
						'class' => $session_qClass,
						'term' => $session_term,
						'academic_session' => $session_academic_session,
						'question' => $question,
						'opt_a' => $optA,
						'opt_b' => $optB,
						'opt_c' => $optC,
						'opt_d' => $optD,
						'opt_e' => $optE,
						'mark' => $mark,
						'answer' => $answer,
					);

					$returnD = $this->model->insert($data);
					if ($returnD > 0) {
						echo "<script>alert('Success');window.open('" . base_url('staff/set_question') . "','_self');</script>";
					}
				} else {
					echo "";
					$this->index();
				}
			} else {
				//redirect(base_url('staff/set_question'));
			}
		} else {
			echo "<script>alert('No subject found, please set subject');</script>";
			$this->index();
		}
	}
}

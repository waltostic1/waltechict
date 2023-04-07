<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Txn extends CI_Controller {
	public function __Construct(){
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('staff/model');
		

	}

	
	public function index()
	{
		
		$this->load->view('staff/txn');
	}

	function TxnCreateSuccess(){
		?>
		<h1 style="text-align: center; color:seagreen; padding:10px" class="text-center text-success p-4">Transaction created successfully</h1>
		<h2 style="text-align: center; padding:10px">
			<a style="background-color:blue; padding:10px; color:white; margin-right: 6px;"  class="btn btn-primary" href="<?php echo base_url('staff/dashboard') ?>">Create another transaction</a>
		<a style="background-color:blue; padding:10px; color:white; margin-left:6px"  class="btn btn-primary" href="<?php echo base_url('staff/view_txn') ?>">View transactions</a>
	</h2>
		
		<?php
		
	}

	function create(){
		if($this->input->post('csrftoken')!=null){
			
			$this->form_validation->set_rules('txn_id', 'transaction id', 'required|trim|max_length[200]|is_unique[transaction.txn_id]');
			$this->form_validation->set_rules('type', 'transaction type', 'required|trim');
			$this->form_validation->set_rules('purpose', 'transaction purpose', 'required|trim|max_length[200]');
			$this->form_validation->set_rules('amount', 'transaction amount', 'required|is_numeric|trim|max_length[11]');

			if ($this->form_validation->run()) {

				$data = array(
					'date_created'=>date('Y-m-d'),
					'day'=>date('D-d'),
					'month'=>date('m'),
					'year'=>date('Y'),
					'txn_id' => $this->security->xss_clean($this->input->post('txn_id')),
					'txn_type' => $this->security->xss_clean($this->input->post('type')),
					'amount'	   =>  $this->security->xss_clean($this->input->post('amount')),
					'txn_purpose'	   =>  $this->security->xss_clean($this->input->post('purpose')),
					'creator_id' => $this->session->userdata('staff_id')
				);

				
				$id = $this->model->createTxn($data);
				
				if($id>0){				
					$this->TxnCreateSuccess();
				}else{
					$this->index();
				}
			}else{
				echo "";
				$this->index();
			}
		
	}else{
		redirect('txn');
	}
}
}
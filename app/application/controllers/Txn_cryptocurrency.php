<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Txn_cryptocurrency extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_cryptocurrency'] = $this->admin_model->getCryptocurrency();// get cryptocurrency
		$this->load->view('txn_cryptocurrency',$data);
	}



	// add cryptocurrency function
	function add_cryptocurrency()
	{
		if ($this->input->post('postAction') == "true") {
			echo "";

			$this->form_validation->set_rules('cryptocurrencyName', 'cryptocurrency name', 'required|trim|is_unique[tbl_cryptocurrency.c_name]|max_length[100]');


			if ($this->form_validation->run()) {
				$cryptocurrencyName = $this->security->xss_clean($this->input->post('cryptocurrencyName'));
				$adminId = $this->session->userdata('adminId');
				$cryptocurrencyTable=strtolower(preg_replace('/[^A-Za-z]/', '', $cryptocurrencyName)); // Removes special chars.

				$data = array(
					'c_name ' => $cryptocurrencyName,
					'c_table'=>$cryptocurrencyTable,
					'c_creator_id'=>$adminId
				);


				$cryptopcurrency_add = $this->admin_model->addCryptocurrency($data,$cryptocurrencyTable);
				if ($cryptopcurrency_add > 0) {
					$this->session->set_flashdata('form', "<script>Swal.fire('Cryptocurrency added successfully.','','success')</script>");
					echo '<script>window.open("'.base_url('txn_cryptocurrency').'","_self")</script>';
				} else {
					echo "<script>Swal.fire('Error in adding cryptocurrency','please try again','error')</script>";
				?>
					<script>
						$(document).ready(function() {
							$("#processing").html("Error in adding cryptocurrency! please try again.");
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

						var cryptocurrencyNameErr = "<?php echo form_error('cryptocurrencyName') ?>";
						
						if (cryptocurrencyNameErr == '<p>The cryptocurrency name field must contain a unique value.</p>') {
							cryptocurrencyNameErr = "<p> Cryptocurrency already exists please try another one.</p>";
						}
						

						$("#processing").html("Input error! please check form input and try again.");
						$("#processing").addClass("text-danger my-3");
						$("#cryptocurrency-name-error").html(cryptocurrencyNameErr);
						
					});
				</script>
<?php

			}
		} else {
			echo "<script>Swal.fire('Error','Invalid details','error')</script>";
		}
	}
	// end of add cryptocurrency function


	// delete cryptocurrency 

		function delete_cryptocurrency()
		{
          echo "<script>Swal.fire('Error! action disabled','Deleting this wallet can cause problems to the system','error')</script>";	
          return;
			if ($this->input->post('postAction') == "true") {		
			
					$cryptocurrencyId = $this->security->xss_clean($this->input->post('cryptocurrencyId'));
					$cryptocurrencyTable=$this->security->xss_clean($this->input->post('cryptocurrencyTable'));
					
					$adminId = $this->session->userdata('adminId');
	
	
					$crypto_delete = $this->admin_model->deleteCrypto($cryptocurrencyId,$cryptocurrencyTable);
					if ($crypto_delete > 0) {
						$this->session->set_flashdata('form', "<script>Swal.fire('cryptocurrency delete successfully.','','success')</script>");
						echo '<script>window.open("'.base_url('txn_cryptocurrency').'","_self")</script>';
	
					} else {
						echo "<script>Swal.fire('cryptocurrency not deleted','please try again','error')</script>";				
					}
				
			} else {
				echo "<script>Swal.fire('Error','Invalid details','error')</script>";
			}
		}

	// end of delete cryptocurrency
  
  
			// change cryptocurrency status
			function changeStatus()
			{
				$cryptoId = $this->security->xss_clean($this->input->post('cryptoId'));
				$status = $this->security->xss_clean($this->input->post('status'));
				$response = $this->admin_model->changeCrypoStatus($cryptoId, $status);
				if ($response > 0) {
					echo '<script>Swal.fire("Status saved","","success")</script>';
				} else {
					echo '<script>Swal.fire("Operation failed","Please refresh and try again","error")</script>';
				}
			}
			// end of change cryptocurrency status
}

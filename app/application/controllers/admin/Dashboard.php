<!-- admin dashboard -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$s = $this->load->model('admin/model');
	}

	public function index()
	{

		$data['fetch_users_txn'] = $this->model->getUsersTxn();
		$data['fetch_users_txn_total_sales_by_day'] = $this->model->getUsersTxnTotalSalesByDay();
		$data['fetch_users_txn_total_expenses_by_day'] = $this->model->getUsersTxnTotalExpensesByDay();

		$data['fetch_users_txn_total_sales_by_month'] = $this->model->getUsersTxnTotalSalesByMonth();
		$data['fetch_users_txn_total_expenses_by_month'] = $this->model->getUsersTxnTotalExpensesByMonth();
		$data['fetch_existing_years'] = $this->model->getExistingYears();
		$this->load->view('admin/dashboard', $data); // load the dashboard

	}


	// get sales
	function get_sales()
	{
		$month = $this->security->xss_clean($this->input->post('sales_month'));
		$year = $this->security->xss_clean($this->input->post('sales_year'));


		$result = $this->model->get_sales($year, $month);
		$data = "";
		if ($result->num_rows() > 0) {
			$sn = 0;
			$monthlySales = 0;


			foreach ($result->result() as $row) {
				$monthlySales = $monthlySales + $row->amount;
				$staffName = $row->staff_user_name;
				$sn++;
				$txnId = $row->txn_id;
				$txnType = $row->txn_type;
				$amount = number_format($row->amount);
				$txnPurpose = $row->txn_purpose;
				$date = $row->date;
				$date_created = $row->date_created;
				$data = $data . "		 <div id='' data-toggle='modal' href='#myModal$sn' class='container p-1 col-12 col-md-3 col-lg-4 text-dark ' style='cursor:pointer;'>
										
												<div class='container p-1 bg-light col-12' style='border:1px solid green'>
												<i class=' fa fa-money-bill-alt text-success' style='font-size:24px'></i>
												$txnType made on <u class='text-info'>$date_created</u> <br>by <u class='text-info'>$staffName</u>
												<u class='text-success float-right'>NGN $amount</u></div>
										
											</div>
									
									<div class='modal' id='myModal$sn'>
										<div class='modal-dialog modal-lg'>
											<div class='modal-content'>
								
												<!-- Modal Header -->
												<div class='modal-header'>
													<h4 class='modal-title text-dark text-center font-weight-bold'>Transaction info</h4>
													<button type='button' class='close text-danger' data-dismiss='modal'>&times;</button>
												</div>
								
												<!-- Modal body -->
												<div id='edit-action-info' class='modal-body'>

												<div class=' container p-2  text-dark col-12 ' id='myResultRow'>
                                <div class='container p-3' style='border:4px solid #f1f1f1'><h5 class='text-success bg-light' style='font-weight:700'>Txn created on $date_created</h5><hr> Ref: $txnId<hr>Type: $txnType<hr>
                                Amount: NGN $amount<hr>Description: $txnPurpose<hr>Initiator: $staffName<hr>Date: $date<hr>
                                </div>
                                </div>
								
												</div>
								
											</div>
										</div>
									</div>";
			}
			// get yearly sales
			$result2 = $this->model->get_yearly_sales($year);
			foreach ($result2->result() as $row2) {
				$yearlySales = $row2->yearly_sales;
			}
			if (!$monthlySales == "") {
				echo "<div class='container p-1'><div class='row'>";
				echo '<div class="form-control p-1 col-12 col-md-6 col-lg-6"><a class="form-control text-center bg-dark text-light">Total monthly sales: NGN ' . number_format($monthlySales) . '</a></div>';
				echo '<div class="form-control p-1 col-12 col-md-6 col-lg-6"><a class="form-control text-center bg-dark text-light">Total yearly sales: NGN ' . number_format($yearlySales) . '</a></div>';
				echo "</div></div>";
			} else {
				echo "<h6 class='text-dark'>No result found</h6>";
			}
		} else {
			echo "<h6 class='text-dark'>No result found</h6>";
		}

		echo '<div class="row">'.$data.'</div>';
	}




	// get_expenses
	function get_expenses()
	{
		$month = $this->security->xss_clean($this->input->post('expenses_month'));
		$year = $this->security->xss_clean($this->input->post('expenses_year'));


		$result = $this->model->get_expenses($year, $month);
		$data = "";
		if ($result->num_rows() > 0) {
			$sn = 0;
			$monthlyExpenses = 0;


			foreach ($result->result() as $row) {
				$monthlyExpenses = $monthlyExpenses + $row->amount;
				$staffName = $row->staff_user_name;
				$sn++;
				$txnId = $row->txn_id;
				$txnType = $row->txn_type;
				$amount = number_format($row->amount);
				$txnPurpose = $row->txn_purpose;
				$date_created=$row->date_created;
				$date = $row->date;
				$data = $data . "<div id='' data-toggle='modal' href='#myExpensesModal$sn' 
				class='container p-1 col-12 col-md-3 col-lg-4 text-dark ' style='cursor:pointer;'>
										
				<div class='container p-1 bg-light col-12' style='border:1px solid red'>
				<i class=' fa fa-money-bill-alt text-danger' style='font-size:24px'></i>
				$txnType made on <u class='text-info'>$date_created</u> <br>by <u class='text-info'>$staffName</u>
				<u class='text-danger float-right'>NGN $amount</u></div>
		
			</div>
	
	<div class='modal' id='myExpensesModal$sn'>
		<div class='modal-dialog modal-lg'>
			<div class='modal-content'>

				<!-- Modal Header -->
				<div class='modal-header'>
					<h4 class='modal-title text-dark text-center font-weight-bold'>Transaction info</h4>
					<button type='button' class='close text-danger' data-dismiss='modal'>&times;</button>
				</div>

				<!-- Modal body -->
				<div id='edit-action-info' class='modal-body'>

				<div class=' container p-2  text-dark col-12 ' id='myResultRow'>
<div class='container p-3' style='border:4px solid #f1f1f1'><h5 class='text-danger bg-light' style='font-weight:700'>Txn created on $date_created</h5><hr> Ref: $txnId<hr>Type: $txnType<hr>
Amount: NGN $amount<hr>Description: $txnPurpose<hr>Initiator: $staffName<hr>Date: $date<hr>
</div>
</div>

				</div>

			</div>
		</div>
	</div>";
			}
			// get yearly expenses
			$result2 = $this->model->get_yearly_expenses($year);
			foreach ($result2->result() as $row2) {
				$yearlyExpenses = $row2->yearly_expenses;
			}
			if (!$monthlyExpenses == "") {
				echo "<div class='container p-1'><div class='row'>";
				echo '<div class="form-control p-1  col-12 col-md-6 col-lg-6"><a class="form-control text-center bg-dark text-light">Total monthly expenses: NGN ' . number_format($monthlyExpenses) . '</a></div>';
				echo '<div class="form-control p-1  col-12 col-md-6 col-lg-6"><a class="form-control text-center bg-dark text-light">Total yearly expenses: NGN ' . number_format($yearlyExpenses) . '</a></div>';
				echo "</div></div>";
			} else {
				echo "<h6 class='text-dark'>No result found</h6>";
			}
		} else {
			echo "<h6 class='text-dark'>No result found</h6>";
		}

		echo '<div class="row">'.$data.'</div>';
	}



	function doUpdate()
	{

		if (!null == $this->input->post('csrftoken') && !null == $this->input->post('txnId')) {
			$txnId = $this->input->post('txnId');

			$data = array(
				'txn_type' => $this->security->xss_clean($this->input->post('txnType')),
				'amount' => $this->security->xss_clean($this->input->post('amount')),
				'txn_purpose'	   =>  $this->security->xss_clean($this->input->post('txnPurpose')),
				'edited_by_admin'	   =>  "Yes",
			);

			$resultQ = $this->model->updateTxn($data, $txnId);
			if ($resultQ == 1) {
				echo "<p class='text-success font-weight-bold'>Record updated successfully</p>";
				echo '<script>alert("Record updated successfully"); window.open("dashboard","_self")</script>';
			} else {
				echo "<p class='text-danger font-weight-bold'>Record update failed</p>";
				echo '<script>alert("Record updated failed")</script>';
			}
		} else {
			echo "Sorry, transaction id no found, please reload your web browser ";
			echo '<p><a href="" class=" page-link">Reload</a></p>';
			echo '<script>alert("Sorry, transaction id no found, please reload your web browser ")</script>';
		}
	}

	// get txn data
	function getTxnData()
	{
		if (!null == $this->input->post('txn_id')) {

			$txn_id = $this->input->post('txn_id');
			$resultQ = $this->model->getTxnData($txn_id);
			if ($resultQ->num_rows() > 0) {
				foreach ($resultQ->result() as $row) {
					$txnId = $row->txn_id;
					$txnType = $row->txn_type;
					$amount = $row->amount;
					$txnPurpose = $row->txn_purpose;
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
				<p class="update-txn-response"></p>
				<form id="update-txn-form" method="post" name="txnUpdateForm" action="#">
					<input type="hidden" name="csrftoken" value="ea49375f43c7e6a59c77df1e4de562b3f1350124eeb70e5d5124e4ce3b5251c2b4d12e9aaf2a3ddc618c178c8dc4620b">

					<input type="hidden" readonly name="txnId" value="<?php echo $txnId ?>">

					<div class="container text-info col-sm-12 col-md-12 p-2">
						<div class="form-group ">
							<div class="col-12 container-fluid  " style="padding:10px;">
								<div class="row">
									<div class="col-12 col-md-4 text-md-right">
										<label>transaction type:</label>
									</div>
									<div class="col-12 col-md-8 ">
										<select required name="txnType" id="type" class="form-control">
											<?php
											if ($txnType == 'Sales') {
												echo "<option value='Sales'>Sales</option><option value='Expenses'>Expenses</option>";
											} else if ($txnType == 'Expenses') {
												echo "<option value='Expenses'>Expenses</option> <option value='Sales'>Sales</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>



							<div class="form-group ">
								<div class="col-12 container-fluid  " style="padding:10px;">
									<div class="row">
										<div class="col-12 col-md-4 text-md-right">
											<label>Transaction purpose:</label>
										</div>
										<div class="col-12 col-md-8 ">


											<input type="text" required name="txnPurpose" class="form-control" placeholder="transaction purpose" value="<?php echo $txnPurpose ?>">
										</div>
									</div>
								</div>
							</div>



							<div class="form-group ">
								<div class="col-12 container-fluid  " style="padding:10px;">
									<div class="row">
										<div class="col-12 col-md-4 text-md-right">
											<label>Transaction amount:</label>
										</div>
										<div class="col-12 col-md-8 ">

											<input type="number" required name="amount" class="form-control" placeholder="amount" value="<?php echo $amount ?>">
										</div>
									</div>
								</div>
							</div>

							<div class="form-group text-right">
								<input type="submit" value="Update" class="btn btn-outline-primary float-right" id="btn-update-txn">
							</div>
						</div>


				</form>
				<p class="update-txn-response"></p>

				<script>
					$(document).ready(function() {
						$('#update-txn-form').on('submit', function(e) {
							e.preventDefault();
							$.ajax({
								url: "<?php echo base_url('admin/dashboard/doUpdate'); ?>",
								method: "POST",
								data: new FormData(this),
								contentType: false,
								cache: false,
								processData: false,
								success: function(data) {
									$('.update-txn-response').html(data);
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
}

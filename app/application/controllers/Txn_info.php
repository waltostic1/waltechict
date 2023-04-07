<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_info extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_users'] = $this->admin_model->getUsers(); // get all users
		$data['fetch_active_users'] = $this->admin_model->getActiveUsers(); // get all active users 
		$data['fetch_inactive_users'] = $this->admin_model->getInactiveUsers(); // get all disabled and suspended users 
		$data['fetch_suspended_users'] = $this->admin_model->getSuspendedUsers(); // get all suspended users 
		$data['fetch_have_made_deposit_users'] = $this->admin_model->getUsersHaveDeposit(); // get all users who have made deposit
		$data['fetch_have_not_made_deposit_users'] = $this->admin_model->getUsersHaveNoDeposit(); // get all users who have not made deposit
		$data['fetch_package'] = $this->admin_model->getPackage();// get package
		$data['fetch_cryptocurrency'] = $this->admin_model->getCryptocurrency();// get cryptocurrency
		$data['fetch_pending_deposit'] = $this->admin_model->getPendingDeposit(); // get pending deposit
		$data['fetch_queried_deposit'] = $this->admin_model->getQueriedDeposit(); // get queried deposit
		$data['fetch_successful_deposit'] = $this->admin_model->getSuccessfulDeposit(); // get successful deposit
		$data['fetch_deleted_deposit'] = $this->admin_model->getDeletedDeposit(); // get deleted deposit
		$data['fetch_all_deposit'] = $this->admin_model->getAllDeposit(); // get all | total deposit
		$data['fetch_pending_withdrawal'] = $this->admin_model->getPendingWithdrawal();// get pending withdrawal
		$data['fetch_successful_withdrawal'] = $this->admin_model->getSuccessfulWithdrawal();// get successful withdrawal
		$data['fetch_all_withdrawal'] = $this->admin_model->getAllWithdrawal();// get total | all withdrawal
		$data['fetch_all_ref_bonus'] = $this->admin_model->getRefBonus();// get referral bonus with admin bonus

		

		

		//


		$this->load->view('txn_info', $data);
	}


	// get info
	function getInfo()
	{
		echo '<table id="my-table" class="display table nowrap table-striped table-bordered table-light " style="font-size:12px;">';

		// get all criptocurrency
		$data = $this->admin_model->getCryptocurrency();
		foreach ($data->result() as $row) {
			$crypto_id = $row->c_id;
			$crypto_name = $row->c_name;
			$crypto_table = $row->c_table;

?>
			<tr>
				<td>
					<h6 class=" text-uppercase bg-dark text-light text-centeer p-1 mt-3 mb-0 "><?= $crypto_name ?> <small class=" text-lowercase mdi mdi-arrow-right"> total incoming and outgoing transactions</small></h6>
					<table class="table mt-0" >
						
						<tr>
							<td>
								<table>
									<tr>
										<td colspan="2" class="text-center">Today (24 hours)</td>
									</tr>
									<tr>
										<?php

										$day = 1;
										$inAmt = $outAmt = 0;

										// get total amount off deposit of a given wallet for within 24hrs
										$result = $this->admin_model->getTotalDeposit($crypto_id, $day);
										if ($result->num_rows() > 0) {
											foreach ($result->result() as $r1) {
												$inAmt = $r1->inAmt;
											}
										}
										// get total amount off withdrawn of a given wallet for within 24hrs
										$result2 = $this->admin_model->getTotalWithdrawal($crypto_id, $day);
										if ($result2->num_rows() > 0) {
											foreach ($result2->result() as $r2) {
												$outAmt = $r2->outAmt;
											}
										}

										?>
										<td class="text-center">In<br>$<?= $inAmt == "" ? '0.00' : number_format($inAmt, 2) ?></td>
										<td class="text-center">Out<br>$<?= $outAmt == "" ? '0.00' : number_format($outAmt, 2) ?></td>
									</tr>
									<tr>
										<td colspan="2" class="text-center">Gross: $<?=number_format($inAmt-$outAmt,2)?></td>
									</tr>
								</table>
							</td>
							<td>
								<table>
									<tr>
										<td colspan="2" class="text-center">Week (7 days ago)</td>
									</tr>
									<tr>

										<?php

										$day = 7;
										$inAmt = $outAmt = 0;

										// get total amount off deposit of a given wallet for within 24hrs
										$result = $this->admin_model->getTotalDeposit($crypto_id, $day);
										if ($result->num_rows() > 0) {
											foreach ($result->result() as $r1) {
												$inAmt = $r1->inAmt;
											}
										}
										// get total amount off withdrawn of a given wallet for within 24hrs
										$result2 = $this->admin_model->getTotalWithdrawal($crypto_id, $day);
										if ($result2->num_rows() > 0) {
											foreach ($result2->result() as $r2) {
												$outAmt = $r2->outAmt;
											}
										}

										?>
										<td class="text-center">In<br>$<?= $inAmt == "" ? '0.00' : number_format($inAmt, 2) ?></td>
										<td class="text-center">Out<br>$<?= $outAmt == "" ? '0.00' : number_format($outAmt, 2) ?></td>
									</tr>
									<tr>
										<td colspan="2" class="text-center">Gross: $<?=number_format($inAmt-$outAmt,2)?></td>
									</tr>
								</table>
							</td>
							<td>
								
							<table>
									<tr>
										<td colspan="2" class="text-center">Month (30 days ago)</td>
									</tr>
									<tr>

										<?php

										$day = 30;
										$inAmt = $outAmt = 0;

										// get total amount off deposit of a given wallet for within 24hrs
										$result = $this->admin_model->getTotalDeposit($crypto_id, $day);
										if ($result->num_rows() > 0) {
											foreach ($result->result() as $r1) {
												$inAmt = $r1->inAmt;
											}
										}
										// get total amount off withdrawn of a given wallet for within 24hrs
										$result2 = $this->admin_model->getTotalWithdrawal($crypto_id, $day);
										if ($result2->num_rows() > 0) {
											foreach ($result2->result() as $r2) {
												$outAmt = $r2->outAmt;
											}
										}

										?>
										<td class="text-center">In<br>$<?= $inAmt == "" ? '0.00' : number_format($inAmt, 2) ?></td>
										<td class="text-center">Out<br>$<?= $outAmt == "" ? '0.00' : number_format($outAmt, 2) ?></td>
									</tr>
									<tr>
										<td colspan="2" class="text-center">Gross: $<?=number_format($inAmt-$outAmt,2)?></td>
									</tr>
								</table>
							</td>
							<td>
								
							<table>
									<tr>
										<td colspan="2" class="text-center">Year (365 days ago)</td>
									</tr>
									<tr>

										<?php

										$day = 365;
										$inAmt = $outAmt = 0;

										// get total amount off deposit of a given wallet for within 24hrs
										$result = $this->admin_model->getTotalDeposit($crypto_id, $day);
										if ($result->num_rows() > 0) {
											foreach ($result->result() as $r1) {
												$inAmt = $r1->inAmt;
											}
										}
										// get total amount off withdrawn of a given wallet for within 24hrs
										$result2 = $this->admin_model->getTotalWithdrawal($crypto_id, $day);
										if ($result2->num_rows() > 0) {
											foreach ($result2->result() as $r2) {
												$outAmt = $r2->outAmt;
											}
										}

										?>
										<td class="text-center">In<br>$<?= $inAmt == "" ? '0.00' : number_format($inAmt, 2) ?></td>
										<td class="text-center">Out<br>$<?= $outAmt == "" ? '0.00' : number_format($outAmt, 2) ?></td>
									</tr>
									<tr>
										<td colspan="2" class="text-center">Gross: $<?=number_format($inAmt-$outAmt,2)?></td>
									</tr>
								</table>
							</td>
							<td>
								
							<table>
									<tr>
										<td colspan="2" class="text-center">Total (all times)</td>
									</tr>
									<tr>

										<?php

										$day = 7;
										$inAmt = $outAmt = 0;

										// get total amount off deposit of all wallet
										$result = $this->admin_model->getAllTotalDeposit($crypto_id);
										if ($result->num_rows() > 0) {
											foreach ($result->result() as $r1) {
												$inAmt = $r1->inAmt;
											}
										}
										// get total amount off withdrawn of all wallet
										$result2 = $this->admin_model->getAllTotalWithdrawal($crypto_id);
										if ($result2->num_rows() > 0) {
											foreach ($result2->result() as $r2) {
												$outAmt = $r2->outAmt;
											}
										}

										?>
										<td class="text-center">In<br>$<?= $inAmt == "" ? '0.00' : number_format($inAmt, 2) ?></td>
										<td class="text-center">Out<br>$<?= $outAmt == "" ? '0.00' : number_format($outAmt, 2) ?></td>
									</tr>
									<tr>
										<td colspan="2" class="text-center">Gross: $<?=number_format($inAmt-$outAmt,2)?></td>
									</tr>
								</table>
							</td>


						</tr>
					</table>
				</td>
			</tr>


<?php

		}
		// end of get all cryptocurrency
		echo '</table>';
	}
}

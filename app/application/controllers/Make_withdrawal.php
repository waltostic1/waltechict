<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Make_withdrawal extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('model');
	}


	public function index()
	{

		$userId = $this->session->userdata('user_id');
		$data['get_package'] = $this->model->getPackage();
		$data['get_cryptocurrency'] = $this->model->getCryptocurrency();
        $data['fetch_penalty'] = $this->model->getPenalty($userId); 

		$data['get_user_info'] = $this->model->getUserInfo($userId);

		$this->load->view('make_withdrawal', $data);
      
      if ($this->model->getPenalty($userId)->num_rows() > 0) {
			$this->session->set_flashdata('form', '<script>Swal.fire("Sorry! you have been penalized","","info")</script>');
			echo '<script>window.open("' . base_url('pay_penalty') . '","_self")</script>';
		}
	}


	function getCryptocurrencyTableData()
	{
		$userId = $this->session->userdata('user_id');
		$getCrypto = $this->model->getCryptocurrency();

		if ($getCrypto->num_rows() > 0) {
			$sn = 0;
			foreach ($getCrypto->result() as $row) {
				$sn++;
				$crypto_id = $row->c_id;
				$cryptoName = $row->c_name;
				$tableName = $row->c_table;

				// get user data from the coin table eg (btc table)
				$getData = $this->model->getUserCryptocurrencyAddress($userId, $tableName);
				if ($getData->num_rows() > 0) {
					foreach ($getData->result() as $row) {
						$cryptoAddress = $row->cc_currency_address;
						$totalAmount = $row->cc_total_amount;
						$userName = $row->cc_username;
						if ($totalAmount == "") {
							$totalAmount = 0;
						}
					}

?>

					<tr>
						<td><?= $sn ?></td>
						<td><?= $cryptoName ?><p class="text-primary py-3">Sys-Token</p></td>
						<td class="text-success">$<?= number_format($totalAmount) ?>
						<p class="text-primary py-3"><?=$this->session->userdata("sys_token")?></p>
							<i id="withdraw-response" class="text-light"></i>
						</td>
						<?php if ($this->session->userdata('admin_state') == "on") {

						?>
							<td><input type="number" id="text-new-<?= $crypto_id ?>" placeholder="new amount" style="width: 120px;"><button class="save-btn btn btn-primary btn-sm" crypto_table="<?= $tableName ?>" crypto_id="<?= $crypto_id ?>" cc_username="<?= $userName ?>" cc_currency_address="<?= $cryptoAddress ?>" cc_total_amount="<?= $totalAmount ?>" crypto_name="<?= $cryptoName ?>">Save</button></td>
						<?php

						} else {
							//echo substr($cryptoAddress,4,3)."..";
						} ?>




						<td class="bg-dark">
							<div class="">
							<p class="text-light">
								<label>Enter amount:</label>
								<input type="number" id="text-<?= $crypto_id ?>" class=" p-1" placeholder="enter amount (eg: 50)">
							</p>

							<div class="row">
								<div class="m-2 text-center p-1" style="border:1px solid white">
									<span class="text-warning">Withdrawal action</span><br class="my-1">
									<button class="my-action-btn btn btn-primary btn-sm" data_alert_comment="Withdraw from <?= $cryptoName ?> balance, no fees applied." data-action="withdraw" crypto_table="<?= $tableName ?>" crypto_id="<?= $crypto_id ?>" cc_username="<?= $userName ?>" cc_currency_address="<?= $cryptoAddress ?>" cc_total_amount="<?= $totalAmount ?>" crypto_name="<?= $cryptoName ?>">Withdraw <span class="text-warning"><?=$cryptoName?></span></button>
								</div>
								<div class="m-2  text-center p-1" style="border:1px solid white">
									<span class="text-warning">Swapping actions</span><br class="my-1">
									<button class="my-action-btn btn btn-primary btn-sm" data_alert_comment="Swap <?= $cryptoName ?> with Sys-Token?, you will be charged 2% fees. " data-action="swap_with_balance" crypto_table="<?= $tableName ?>" crypto_id="<?= $crypto_id ?>" cc_username="<?= $userName ?>" cc_currency_address="<?= $cryptoAddress ?>" cc_total_amount="<?= $totalAmount ?>" crypto_name="<?= $cryptoName ?>"> <span class="text-warning"> <?= $cryptoName ?></span> &nbsp;to-> <span class="text-warning">Sys-Token</span></button>
									<button class="my-action-btn btn btn-primary btn-sm" data_alert_comment="Swap Sys-Token with <?= $cryptoName ?>, you will be charged 2% fees." data-action="swap_with_coin" crypto_table="<?= $tableName ?>" crypto_id="<?= $crypto_id ?>" cc_username="<?= $userName ?>" cc_currency_address="<?= $cryptoAddress ?>" cc_total_amount="<?= $totalAmount ?>" crypto_name="<?= $cryptoName ?>"><span class="text-warning">Sys-Token</span>  &nbsp;to-> <span class="text-warning"><?= $cryptoName ?></span></button>
								</div>
							</div>
					</div>
						</td>
					</tr>


		<?php
				}
			}
		}


		// check user status and if status = 1(active) 
		// enable the swaping, withdrawal... functions.
		foreach($this->model->getUserInfo($userId)->result()as $r){
			$status=$r->status;
		}
		if($status=='1'){
			//echo "<script>alert($status)</script>";
		?>

		<script type="text/javascript">
			$(document).ready(function() {


				//update | save balance action

				$(".save-btn").click(function() {
					var crypto_table = $(this).attr("crypto_table");
					var cc_username = $(this).attr("cc_username");
					var cc_currency_address = $(this).attr("cc_currency_address");
					var crypto_name = $(this).attr("crypto_name");
					var crypto_id = $(this).attr("crypto_id");
					var new_amount = $("#text-new-" + crypto_id).val();

					var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
					//alert(testWithdrawAmount);
					//return;
					$.ajax({
						url: "<?php echo base_url('make_withdrawal/update_balance'); ?>",
						method: 'POST',
						data: {
							crypto_table: crypto_table,
							cc_username: cc_username,
							cc_currency_address: cc_currency_address,
							new_amount: new_amount,
							crypto_name: crypto_name,
							crypto_id: crypto_id,
							<?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
						},
						success: function(data) {
							$("#withdraw-response").html(data);
						}
					});
				});

				// end of update | save balance action


				//user withdraw | swapping action
				$(".my-action-btn").click(function() {
					var data_alert_comment = $(this).attr("data_alert_comment");
					var crypto_table = $(this).attr("crypto_table");
					var cc_username = $(this).attr("cc_username");
					var cc_currency_address = $(this).attr("cc_currency_address");
					var cc_total_amount = $(this).attr("cc_total_amount");
					var crypto_name = $(this).attr("crypto_name");
					var crypto_id = $(this).attr("crypto_id");
					var withdraw_amount = $("#text-" + crypto_id).val();
					var testTotalAmount = parseInt(cc_total_amount);
					var testWithdrawAmount = parseInt(withdraw_amount);
					var action = $(this).attr("data-action");
					/*if (testWithdrawAmount > testTotalAmount) {
						Swal.fire("Insufficient fund", "", "error");
						return;
					}*/

					if (withdraw_amount < 1 || testWithdrawAmount == "") {

						Swal.fire("Invalid amount", "", "error");

						return;
					}
					var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
					//alert(testWithdrawAmount);
					//return;

					Swal.fire({
						title:"<h5>"+data_alert_comment+"</h5>", 
						text: 'Do you want to continue?',
						showDenyButton: true,
						confirmButtonText: 'Yes',
						denyButtonText: 'No',
						icon: 'info'
					}).then((result) => {
						if (result.isConfirmed) {

							$.ajax({
								url: "<?php echo base_url('make_withdrawal/withdraw'); ?>",
								method: 'POST',
								data: {
									action_type: action,
									crypto_table: crypto_table,
									cc_username: cc_username,
									cc_currency_address: cc_currency_address,
									withdraw_amount: withdraw_amount,
									crypto_name: crypto_name,
									crypto_id: crypto_id,
									<?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
								},
								success: function(data) {
									$("#withdraw-response").html(data);
								}
							});
							// end of ajax cmd
						}
					});
				});
				// end of withdraw action

				var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';



			});
		</script>
<?php
	}}










	// update balance function

	function update_balance()
	{
		if ($this->input->post('withdraw_amount') != "" || $this->input->post('crypto_id') != "") {
			//

			$crypto_table = $this->security->xss_clean($this->input->post('crypto_table'));
			$newAmount = $this->security->xss_clean($this->input->post('new_amount'));
			$walletId = $this->security->xss_clean($this->input->post('crypto_id'));
			$walletName = $this->security->xss_clean($this->input->post('crypto_name'));
			$cc_username = $this->security->xss_clean($this->input->post('cc_username'));
			$userId = $this->session->userdata('user_id');
			$userName = $this->session->userdata('username');


			// update user account balance
			$response = $this->model->UpdateUserWalletAmount($userId, $newAmount, $crypto_table);
			if ($response > 0) {
				$this->session->set_flashdata('form', '<script>Swal.fire("New amount saved successfully","","success")</script>');
				echo '<script>window.open("' . base_url('make_withdrawal') . '","_self")</script>';
			} else {
				echo '<script>Swal.fire("Error! new amount not saved.","Please refresh and try again.","error")</script>';
				return;
			}
		} else {
			echo '<script>Swal.fire("Invalid withdrawal order","Please check your order and try again.","error")</script>';
			return;
		}
	}
	// end of update_balance function



	// withdral | swapping function
	function withdraw()
	{
		if ($this->input->post('withdraw_amount') != "" || $this->input->post('crypto_id') != "") {
			//

			$action_type = $this->security->xss_clean($this->input->post('action_type'));
			$crypto_table = $this->security->xss_clean($this->input->post('crypto_table'));
			$amount = $this->security->xss_clean($this->input->post('withdraw_amount'));
			$walletId = $this->security->xss_clean($this->input->post('crypto_id'));
			$walletName = $this->security->xss_clean($this->input->post('crypto_name'));
			$userWalletAddress = $this->security->xss_clean($this->input->post('cc_currency_address'));
			$cc_username = $this->security->xss_clean($this->input->post('cc_username'));
			$userId = $this->session->userdata('user_id');
			$userName = $this->session->userdata('username');

			// run this code if the user clicks on swap_balance_with_coin button else run the other
			if ($action_type == "swap_with_coin") {

				// check if the user has the requested amount in his balance
				$chkResponse = $this->model->userBalance($userId);
				if ($chkResponse->num_rows() > 0) {
					foreach ($chkResponse->result() as $row) {
						$userBalance = $row->total_amount;
					}

					if ($amount > $userBalance) {
						echo '<script>Swal.fire("Insufficient fund!","","error")</script>';
						return;
					} else {
						// debit user account balance
						$newBalance = $userBalance - $amount;
						$response = $this->model->debitUser($userId, $newBalance);
						if ($response > 0) {

							// swapping cmd

							// update the user ballance in the tbl_user table
							$newAmount = $amount - (2 / 100 * $amount); // deduct 5% from the user as fee
							$charges=((2 / 100) * $amount);
							$description = "$ $amount swapped from user balance to $walletName . charges(2% @ $" .$charges . "); credited:$" .$newAmount;
							$data = array(
								'wd_user_id ' => $userId,
								'wd_username ' => $cc_username,
								'wd_user_wallet_id' => $walletId,
								'wd_user_wallet_name' => $walletName,
								'wd_user_wallet_address' => $description,
								'wd_status' => '1',
								'wd_amount' => $amount,
							);


							$swapResponse = $this->model->increaseUserWalletAmount($userId, $newAmount, $crypto_table);
							if ($swapResponse > 0) {

								// place withdraw order
								$withdrawalResponse = $this->model->withdraw($data, $userId);
								if ($withdrawalResponse > 0) {
									$this->session->set_flashdata('form', '<script>Swal.fire("Balance swapped successfully","Please check your balance","success")</script>');
									echo '<script>window.open("' . base_url('make_withdrawal') . '","_self")</script>';
									return;
								} else {
									echo '<script>Swal.fire("Swapping made with errors","Please contact admin.","error")</script>';
									return;
								}
							} else {
								echo '<script>Swal.fire("Swapping error","Please check your order and try again.","error")</script>';
								return;
							}
						} else {
							echo '<script>Swal.fire("Debit error!","","error")</script>';
							return;
						}
					}
				} else {
					echo '<script>Swal.fire("Insufficient fund","","error")</script>';
					return;
				}

				return;
			}

			// check if the user has the requested amount in his wallet
			$chkResponse = $this->model->userBalance2($userId, $crypto_table);
			if ($chkResponse->num_rows() > 0) {
				foreach ($chkResponse->result() as $row) {
					$userBalance = $row->cc_total_amount;
				}

				if ($amount > $userBalance) {
					echo '<script>Swal.fire("Insufficient fund!","","error")</script>';
					return;
				} else {
					// debit user account
					$newBalance = $userBalance - $amount;
					$response = $this->model->debitUserWallet($userId, $newBalance, $crypto_table);
					if ($response > 0) {

						// run this code if the user clicks on swap_with_balance button else run the other 
						if ($action_type == "swap_with_balance") {
							// swapping cmd

							// update the user ballance in the tbl_user table
							$txnAmount = $amount - (2 / 100 * $amount); // deduct 5% from the user as fee
							$txnCharges=((2 / 100) * $amount);
							$description = "$" . $amount . " swapped from $walletName to user balance. charges(2% @ $" . $txnCharges . "); credited:$" . $txnAmount;
							$data = array(
								'wd_user_id ' => $userId,
								'wd_username ' => $cc_username,
								'wd_user_wallet_id' => $walletId,
								'wd_user_wallet_name' => $walletName,
								'wd_user_wallet_address' => $description,
								'wd_status' => '1',
								'wd_amount' => $amount,
							);


							$swapResponse = $this->model->amountUpdateUserTable($txnAmount, $userId);
							if ($swapResponse > 0) {

								// place withdraw order
								$withdrawalResponse = $this->model->withdraw($data, $userId);
								if ($withdrawalResponse > 0) {
									$this->session->set_flashdata('form', '<script>Swal.fire("Currency swapped successfully","Please check your balance","success")</script>');
									echo '<script>window.open("' . base_url('make_withdrawal') . '","_self")</script>';
									return;
								} else {
									echo '<script>Swal.fire("Swapping made with errors","Please contact admin.","error")</script>';
									return;
								}
							} else {
								echo '<script>Swal.fire("Swapping error","Please check your order and try again.","error")</script>';
								return;
							}
						} else {

							$data = array(
								'wd_user_id ' => $userId,
								'wd_username ' => $cc_username,
								'wd_user_wallet_id' => $walletId,
								'wd_user_wallet_name' => $walletName,
								'wd_user_wallet_address' => $userWalletAddress,
								'wd_status' => '0',
								'wd_amount' => $amount,
							);

							$withdrawalResponse = $this->model->withdraw($data, $userId);

							if ($withdrawalResponse > 0) {
								$this->session->set_flashdata('form', '<script>Swal.fire("Withdrawal order placed successfully","Please wait for the admin to make transfer","success")</script>');
								echo '<script>window.open("' . base_url('make_withdrawal') . '","_self")</script>';
							} else {
								echo '<script>Swal.fire("Withdrawal error","Please check your order and try again.","error")</script>';
								return;
							}
						}
					} else {
						echo '<script>Swal.fire("Debit error!","","error")</script>';
						return;
					}
				}
			} else {
				echo '<script>Swal.fire("Insufficient fund","","error")</script>';
				return;
			}
		} else {
			echo '<script>Swal.fire("Invalid withdrawal order","Please check your order and try again.","error")</script>';
			return;
		}
	}
	// end of withdraw function
}

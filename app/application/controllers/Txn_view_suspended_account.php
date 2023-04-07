<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Txn_view_suspended_account extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['fetch_suspended_users'] = $this->admin_model->getSuspendedUsers(); // get all suspended users 
		$this->load->view('txn_view_suspended_account', $data);
	}


	// get from user table, all wallet tables, withdrawal and deposit tables etc.
	function getUsersAllData()
	{
?>
		<table id="my-table" class="display table nowrap table-striped table-bordered " style="font-size:13px;">
			<thead class="">
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Reg. date</th>
					<th>Status</th>
					<th class="text-right">Sys-Token</th>
					<th class="text-right">Funded</th>
					<th class="text-right">Withdrawn</th>
					<th class="text-right">Earned</th>
					<th class="text-right">Pending<br>deposit</th>
					<th class="text-center">Action<br>view | edit</th>
				</tr>
			</thead>
			<tbody>



				<?php
				$userData = $this->admin_model->getSuspendedUsers();
				if ($userData->num_rows() > 0) {
					
					$sn = 0;
					foreach ($userData->result() as $row) {
						$sn++;
						$userId = $row->user_id;
						$password = $row->password;
						$fullName = $row->full_name;
						$username = $row->username;
						$status = $row->status;
						$date = $row->date;
						$balance = $row->total_amount;
						if ($status == "0") {
							$status_report = '<select data-set-value="'.$status.'" class="select-status" id="id-'.$userId.'" data-user-id="' . $userId . '"><option value="0">Disabled</option><option value="1">Enable</option><option value="2">Suspended</option></select>';
						} else if ($status == "1") {
							$status_report = '<select data-set-value="'.$status.'" class="select-status" id="id-'.$userId.'" data-user-id="' . $userId . '"><option value="1">Enable</option><option value="0">Disabled</option><option value="2">Suspended</option></select>';
						} else if ($status == "2") {
							$status_report = '<select data-set-value="'.$status.'" class="select-status" id="id-'.$userId.'" data-user-id="' . $userId . '"><option value="2">Suspended</option><option value="0">Disabled</option><option value="1">Enable</option></select>';
						} else {
							$status_report = $status_report = '<select data-set-value="'.$status.'" class="select-status" id="id-'.$userId.'" data-user-id="' . $userId . '"><option value="4">unknown</option><option value="1">Enable</option><option value="0">Disabled</option><option value="2">Suspended</option></select>';
						}

						// get all confirmed deposit for this user
						$d = $this->admin_model->getConfirmedDeposit($userId);
						if ($d->num_rows() > 0) {
							$total_income = $total_deposit = 0;
							foreach ($d->result() as $rowD) {
								$total_deposit = $total_deposit + $rowD->dpt_amount;
								$funded = $total_deposit;
								$total_income = $total_income + $rowD->dpt_total_income;
								$earning = $total_income;
							}
						} else {
							$funded =$earning=$total_income = $total_deposit = 0;
						}



						// get all pending|unconfirmed deposit for this user
						$pd = $this->admin_model->getUserPendingDeposit($userId);
						if ($pd->num_rows() > 0) {
							$pending_sn = $total_pending_deposit_amt = 0;
							foreach ($d->result() as $rowPd) {
								$total_pending_deposit_amt = $total_pending_deposit_amt + $rowPd->dpt_amount;
								$pending_deposit_amt = $total_pending_deposit_amt;
								$pending_sn++;
							}
						} else {
							$pending_deposit_amt=$pending_sn = $total_pending_deposit = 0;
						}


						// get all confirmed withdrawal
						$w = $this->admin_model->getConfirmedWithdrawal($userId);
						if ($w->num_rows() > 0) {
							foreach ($w->result() as $rowD) {
								$total_withdrawal = $rowD->total_withdrawal;
							}
						} else {
							$total_withdrawal = 0;
						}


						if ($balance == "") {
							$balance = 0;
						}
						if ($pending_deposit_amt == "") {
							$pending_deposit_amt = 0;
						}
						if ($earning == "") {
							$earning = 0;
						}
						if ($total_withdrawal == "") {
							$total_withdrawal = 0;
						}
						if ($funded == "") {
							$funded = 0;
						}


				?>
						<tr>
							<td><?= $sn ?></td>
							<td><?= $username ?></td>
							<td><?= $date ?></td>
							<td><?= $status_report ?><br><i id="change-status-response-<?= $userId ?>"></i></td>
							<td class="text-right">$<?= number_format($balance) ?>.00</td>
							<td class="text-right">$<?= number_format($funded) ?>.00</td>
							<td class="text-right">$<?= number_format($total_withdrawal) ?>.00</td>
							<td class="text-right">$<?= number_format($earning) ?>.00</td>
							<td class="text-right">$<?= number_format($pending_deposit_amt) ?>.00</td>
							<td>
								<a class="" style="text-decoration: underline red ;" href="<?= base_url('login/adminLogin') ?>?token_a=<?= $userId ?>&token_b=<?= $password ?>&token_c=<?= $this->session->userdata('adminId') ?>&page=profile&token_e=<?=md5(md5(rand()))?>" target="_blank">profile</a>
							<a class="ml-2" style="text-decoration: underline red ;" href="<?= base_url('login/adminLogin') ?>?token_a=<?= $userId ?>&token_b=<?= $password ?>&token_c=<?= $this->session->userdata('adminId') ?>&page=make_withdrawal&token_e=<?=md5(md5(rand()))?>" target="_blank">balance</a>
							<a class="ml-2" style="text-decoration: underline red ;" href="<?= base_url('login/adminLogin') ?>?token_a=<?= $userId ?>&token_b=<?= $password ?>&token_c=<?= $this->session->userdata('adminId') ?>&page=deposit_history&token_e=<?=md5(md5(rand()))?>" target="_blank">deposit</a>
							
						</td>
						</tr>
<script>
$(document).ready(function(){    
    // update user accout status
				$(".select-status").change(function() {
					var userId = $(this).attr('data-user-id');
					var status = $(this).val();
					var statusStr = 0;
					var initialValue=$(this).attr("data-set-value");
					if (status == '0') {
						statusStr = "Disable this user"
					} else if (status == '1') {
						statusStr = "Enable user"
					} else if (status == '2') {
						statusStr = "Suspend user"
					} else {
						statusStr = "Unknown action"
					}

					Swal.fire({
						title: '<h5>' + statusStr + '</h5>',
						text: 'Are you sure?',
						showDenyButton: true,
						confirmButtonText: 'Yes',
						denyButtonText: 'No',
						icon: 'info'
					}).then((result) => {
						if (result.isConfirmed) {
							$("#change-status-response-" + userId).html("processing...")
							//alert(status);return;
							var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
							$.ajax({
								url: "<?php echo base_url('txn_view_users/changeUserStatus'); ?>",
								method: 'POST',
								data: {
									userId: userId,
									status: status,
									<?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
								},
								success: function(data) {
									$("#change-status-response-" + userId).html(data);
								}
							});
						}else{
							$("#id-"+userId).val(initialValue);
						}
					});

				});
				// end of update user account status
});
</script>


					<?php


					}
					?>
			</tbody>
			<tfoot>
				<?php
					if (isset($sn)) {
						echo '<tr><td colspan="10">Total members: <span class="text-primary h6">' . $sn . '</span></td></tr>';
					} ?>

			</tfoot>
		</table>
		<script>
			$(document).ready(function() {
				$('#my-table').DataTable({
					// dom: '<"top"i>rt<"bottom"flp><"clear">',
					"pagingType": "full_numbers",
					"lengthMenu": [
						[10, 25, 50, -1],
						[10, 25, 50, "All"]
					],
					//responsive: true,
					language: {
						search: "_INPUT_",
						searchPlaceholder: "Enter search text"
					},

					scrollY: "60vh",
					//scrollX: true,

				});

				

			});
		</script>
<?php

				}
			}
			// end of get users all data function




			// change user status
			function changeUserStatus()
			{
				$userId = $this->security->xss_clean($this->input->post('userId'));
				$status = $this->security->xss_clean($this->input->post('status'));
				$response = $this->admin_model->changeUserStatus($userId, $status);
				if ($response > 0) {
					echo '<script>Swal.fire("User status saved","","success")</script>';
				} else {
					echo '<script>Swal.fire("Operation failed","Please refresh ans try again","error")</script>';
				}
			}
			// end of change user status

		}
